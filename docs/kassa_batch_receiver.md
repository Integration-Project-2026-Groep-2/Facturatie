US-10: Bedrijfsfactuur vanuit kassagegevens (BatchClosed)
Branch: feature/US-10-invoice-generation-company
Verantwoordelijke: Bilal Bouchta
Datum: 22 april 2026
Status: Volledig geïmplementeerd en getest

1. Wat doet deze feature?
US-10 zorgt ervoor dat we de dagelijkse kassa-afsluiting vanuit Odoo POS automatisch kunnen verwerken in ons facturatiesysteem (FOSSBilling).

Wanneer een medewerker aan het einde van de dag op de afsluitknop drukt, stuurt de kassa een BatchClosed bericht (in XML) naar onze berichtenwachtrij (RabbitMQ). Onze facturatiemodule pikt dit bericht op en doet twee dingen:

Individuele facturen maken: Elke klant in de batch krijgt een eigen factuur.

Bedrijfsfacturen maken: Als een klant aan een bedrijf is gekoppeld, worden deze losse facturen netjes samengevoegd in één overkoepelende bedrijfsfactuur.

Wanneer sturen we data door?
We sturen niet zomaar alles door. De kassa stuurt alleen bestellingen mee waarbij de klant specifiek via 'factuur' wilde betalen (geen cash of pin) én waarvan we de klantgegevens (een UUID) hebben. Anonieme klanten tellen dus niet mee. Was het een rustige dag en zijn er geen facturen? Dan sturen we een lege batch; ons systeem snapt dat en sluit netjes af.

Technische routekaart:

Van: Kassa Naar: Facturatie

RabbitMQ Exchange: kassa.topic (durable)

Wachtrij (Queue): facturatie.kassa.batch.closed (durable)

Routing key: kassa.closed

2. Hoe ziet de data eruit? (XML Contract K-02)
Het bericht dat we binnenkrijgen (de BatchClosed) heeft een logische opbouw.

Algemene batch-info: Elke batch heeft een unieke batchId (zodat we niets dubbel verwerken), een tijdstip van afsluiten (closedAt) en de valuta (altijd EUR).

Gebruikers (users): Een lijst met klanten. Per klant zien we hun unieke ID, het totaalbedrag en een lijst met de bestelde producten (items).

Producten (items): Per product zien we de naam, het aantal, de stukprijs en de totaalprijs.

Samenvatting (summary): Hoeveel bestellingen en wat is het totale bedrag van deze hele batch?

Als er geen bestellingen op factuur waren, ontbreekt het users gedeelte simpelweg en staan de totalen in de summary op nul.

3. Onder de motorkap: Architectuur en bestanden
Om dit te laten werken, hebben we een paar nieuwe bestanden toegevoegd en enkele bestaande aangepast:

Het XSD-schema (kassa_batch_contract.xsd): Dit is onze poortwachter. Elk binnenkomend XML-bericht wordt eerst hieraan getoetst. Klopt de structuur niet? Dan wijzen we het direct af.

De verwerker (KassaBatchReceiverService.php): Dit is het brein van de operatie. Deze code leest de XML, controleert of we de batch niet al eerder hebben verwerkt (via een nieuwe tabel kassa_batch_processed), zoekt de klanten op in de database, maakt de facturen aan, keurt ze goed en bundelt ze waar nodig in bedrijfsfacturen.

De werkkracht (kassa_batch_receiver.php): Een script dat constant op de achtergrond draait (beheerd door Supervisor). Hij luistert naar de RabbitMQ wachtrij, pakt berichten op, stuurt ze naar de verwerker en zorgt dat verbindingen netjes herstellen als ze wegvallen.

Supervisor configuratie (supervisord.conf): Zorgt ervoor dat onze werkkracht automatisch opstart en herstart bij een eventuele crash.

4. Hoe stroomt de data? (Praktijkscenario's)
Scenario A: Een normale dag. Het bericht komt binnen. Het script herkent Klant A en Klant B. Voor beide wordt een losse factuur gemaakt. Klant A en B blijken voor hetzelfde bedrijf te werken. Het systeem pakt beide goedgekeurde facturen en smeedt ze samen tot één bedrijfsfactuur. Alles wordt netjes opgeslagen en afgevinkt.

Scenario B: Een lege batch. Kassa sluit af, maar er zijn geen factuur-bestellingen. Het script leest de batch, ziet dat er geen actie nodig is, slaat hem op als 'verwerkt' en gaat weer slapen. Geen foutmeldingen, geen overbodige acties.

Scenario C: Systeemcrash halverwege. Stel dat ons systeem uitvalt nét nadat de facturen zijn gemaakt, maar voordat we RabbitMQ hebben laten weten dat we klaar zijn. RabbitMQ zal het bericht later opnieuw aanbieden. Ons systeem ziet dan aan het batchId: "Hé, die ken ik al!" en negeert het bericht om dubbele facturen te voorkomen.

Scenario D: Spookklant. Er zit een klant-ID in de batch die we niet kennen in ons facturatiesysteem. In plaats van te crashen, noteert het systeem een waarschuwing in het logboek en gaat het gewoon vrolijk verder met de rest van de klanten in de batch.

5. Hoe werken bedrijfsfacturen precies?
Een bedrijfsfactuur is eigenlijk een bundel van losse facturen. FOSSBilling eist dat de losse facturen eerst de status 'Goedgekeurd' hebben. Daarom maakt onze code eerst een losse factuur aan, keurt deze direct goed, en kijkt daarna of de klant aan een bedrijf is gekoppeld (company_id). Is dat het geval? Dan genereert het systeem via de ingebouwde FOSSBilling-logica een overkoepelende factuur voor dat bedrijf.

6. Testen en Validatie
Je kunt de boel makkelijk lokaal testen met een geautomatiseerde 'smoke test':

Start je containers: docker compose up -d --build

Kopieer het testscript: docker cp test/smoke_kassa_batch_receiver.php facturatie-web-1:/var/www/html/

Voer het uit: docker exec facturatie-web-1 php /var/www/html/smoke_kassa_batch_receiver.php

Dit testscript controleert alles: van XSD-validatie en het verwerken van lege en volle batches, tot deduplicatie en het afvangen van foute data. Tijdens de laatste test (22 april 2026) kregen we een 100% slagingspercentage.

Je kunt ook handmatig testen door naar de RabbitMQ beheeromgeving (http://localhost:15672) te gaan, een bericht met routing key kassa.closed te publiceren op de kassa.topic exchange en de resultaten in FOSSBilling te bekijken.

7. Logs en Instellingen
Als je wilt weten wat het systeem uitspookt, kun je de logs vinden in /var/www/html/data/log/application/.

INFO: Standaard dingen (verwerkte batches, aangemaakte facturen).

WARN: Zaken die aandacht nodig hebben maar niet fataal zijn (een onbekende klant, of een batch die we al eens gehad hebben).

ERROR: Zaken die echt misgaan (ongeldige XML, verbindingsproblemen met de database of RabbitMQ).

Het systeem luistert naar diverse omgevingsvariabelen, maar de belangrijkste zijn KASSA_BATCH_EXCHANGE (standaard kassa.topic) en KASSA_BATCH_QUEUE (standaard facturatie.kassa.batch.closed).

8. Verschil met US-09 (Individuele kassafacturen)
Eerder bouwden we US-09 voor individuele bestellingen. US-10 is de logische grote broer hiervan:

US-09: Krijgt per losse bestelling een bericht (kassa.invoice.requested), controleert op dubbelingen via order_id en maakt één factuur.

US-10: Wacht tot het eind van de dag (kassa.closed), krijgt een hele rits klanten tegelijk binnen, controleert op dubbelingen via batch_id en verwerkt ze in één keer door.