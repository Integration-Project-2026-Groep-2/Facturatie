To optimize this for **GitHub Copilot** in VS Code, you should save this as a `.md` file (e.g., `PRD.md` or `INSTRUCTIONS.md`) in your repository. I have restructured the text into a clear, hierarchical format that Copilot can easily parse to provide context-aware code suggestions.

---

# Project Context: Desiderius Event Management Platform (Shiftfestival)

## 1. Project Goal

Development of a distributed event management platform for Desideriushogeschool to manage networking events, workshops, and catering services. All data on participants and companies is collected for future business relations.

## 2. Core Architecture: Loosely Coupled Microservices

- **Communication**: Asynchronous messaging via **RabbitMQ**.
- **Message Format**: All data exchange must be in **XML** format.
- **Resilience**: Systems must remain operational even if one service (e.g., Facturatie, CRM) goes down.
- **Validation**: Every service must validate incoming and outgoing XML messages against XSD schemas; errors must be logged.
- **Heartbeat**: Every service must publish a **1-second heartbeat** signal for monitoring.

## 3. Team Responsibilities & Stack

- **CRM (Salesforce)**: Master data owner for participants and companies.
- **Facturatie (FOSSBilling)**: Invoicing for companies and private individuals (on-demand).
- **Kassa (Odoo POS)**: Handling payments at the entrance and bar.
- **Mailing (SendGrid/Node.js)**: Sending confirmations and mailing lists.
- **Planning (Office365)**: Session scheduling and updates.
- **Frontend (Drupal)**: Public registration and session overview.
- **Controlroom (Elastic Stack)**: Monitoring system status and statistics.
- **IoT (Raspberry Pi/Home Assistant)**: Badge scanning for transactions and attendance.

## 4. Key Functional Requirements

- **Registration**: Users/companies register for sessions via the frontend.
- **Payments**: Entrance fees and bar consumptions (drinks/food) paid via kassa (or maybe badge scan later).
- **Invoicing**:
    - **Companies**: Consolidated invoices.
    - **Individuals**: Pay on-site unless an invoice is explicitly requested.
- **Dashboards**: Real-time status of online/offline systems.

## 5. Development Standards

- **Environment**: All services must run in **Docker** containers.
- **CI/CD**: Fully automated pipelines based on Git repositories.
- **Git Strategy**: Use `main`, `dev`, `prod`, and specific `feature/` branches.
- **Exception Handling**: Logic must handle "sad paths" like delayed speakers or conflicting data across systems without total system failure.
