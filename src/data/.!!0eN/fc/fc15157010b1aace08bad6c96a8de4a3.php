<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* default-pdf.twig */
class __TwigTemplate_3df81ca5df5f48f51f543226be811509 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        if ((($context["buyer_lines"] ?? null) >= ($context["seller_lines"] ?? null))) {
            // line 2
            yield "\t";
            $context["top"] = (275 + (25 * ($context["buyer_lines"] ?? null)));
        } else {
            // line 4
            yield "\t";
            $context["top"] = (275 + (25 * ($context["seller_lines"] ?? null)));
        }
        // line 6
        yield "
";
        // line 7
        $context["address_lines"] = [];
        // line 8
        yield "\t";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable([CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "address_1", [], "any", false, false, false, 8), CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "address_2", [], "any", false, false, false, 8), CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "address_3", [], "any", false, false, false, 8)]);
        foreach ($context['_seq'] as $context["_key"] => $context["line"]) {
            // line 9
            yield "\t\t";
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), $context["line"]) > 0)) {
                // line 10
                yield "\t\t\t";
                $context["address_lines"] = Twig\Extension\CoreExtension::merge(($context["address_lines"] ?? null), [$context["line"]]);
                // line 11
                yield "\t\t";
            }
            // line 12
            yield "\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['line'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        $context["address"] = Twig\Extension\CoreExtension::join(($context["address_lines"] ?? null), ",");
        // line 14
        yield "
<!DOCTYPE html>
<html>
\t<head>
\t\t<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
\t\t<title>";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "serie_nr", [], "any", false, false, false, 19), "html", null, true);
        yield "</title>
\t\t<style>
\t\t\t";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["css"] ?? null), "html", null, true);
        yield "
\t\t</style>
\t</head>
\t<body>
\t\t";
        // line 25
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(($context["logo_source"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 26
            yield "\t\t\t<img src='";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["logo_source"] ?? null), "html", null, true);
            yield "' height='50' class='CompanyLogo'>
\t\t";
        }
        // line 28
        yield "\t\t<hr class='Rounded'>
\t\t<div class='InvoiceInfo'>
\t\t\t<p>";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice number"), "html", null, true);
        yield ": ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "serie_nr", [], "any", false, false, false, 30), "html", null, true);
        yield "</p>
\t\t\t<p>";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice date"), "html", null, true);
        yield ": ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "created_at", [], "any", false, false, false, 31)), "html", null, true);
        yield "</p>
\t\t\t<p>";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Due date"), "html", null, true);
        yield ": ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "due_at", [], "any", false, false, false, 32)), "html", null, true);
        yield "</p>
\t\t\t<p>";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice status"), "html", null, true);
        yield ": ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 33)), "html", null, true);
        yield "</p>
\t\t</div>

\t\t<h3 class='CompanyInfo'>";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company"), "html", null, true);
        yield "</h3>
\t\t<div class='CompanyInfo'>
\t\t<p>
\t\t";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["seller"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 40
            yield "\t\t";
            if (($context["key"] == "Name")) {
                yield "<b>";
            }
            // line 41
            yield "\t\t";
            if (($context["key"] == "Phone")) {
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone"), "html", null, true);
                yield " :";
            }
            // line 42
            yield "\t\t\t\t";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true);
            yield "<br>
\t\t";
            // line 43
            if (($context["key"] == "Name")) {
                yield "</b>";
            }
            // line 44
            yield "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['value'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        yield "\t\t</p>
\t\t</div>

\t\t<h3 class='ClientInfo'>";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client"), "html", null, true);
        yield "</h3>
\t\t<div class='ClientInfo'>
\t\t<p>
\t\t";
        // line 51
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["buyer"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 52
            yield "\t\t";
            if (($context["key"] == "Company")) {
                yield "<b>";
            }
            // line 53
            yield "\t\t";
            if (($context["key"] == "Phone ")) {
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone"), "html", null, true);
                yield " :";
            }
            // line 54
            yield "\t\t\t\t";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true);
            yield "<br>
\t\t";
            // line 55
            if (($context["key"] == "Company")) {
                yield "</b>";
            }
            // line 56
            yield "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['value'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        yield "\t\t</p>
\t\t</div>

\t\t<div class='Breakdown' style='top: ";
        // line 60
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["top"] ?? null), "html", null, true);
        yield "px'>
\t\t\t<table style='width:100%'>
\t\t\t\t<tr>
\t\t\t\t\t<th style='text-align: center; width:25px;'>#</th>
\t\t\t\t\t<th style='text-align: left'>";
        // line 64
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Product"), "html", null, true);
        yield "</th>
\t\t\t\t\t<th style='text-align: right'>";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Quantity & Price"), "html", null, true);
        yield "</th>
\t\t\t\t\t<th style='text-align: right'>";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
        yield "</th>
\t\t\t\t</tr>
\t\t\t\t";
        // line 68
        $context["nr"] = 0;
        // line 69
        yield "\t\t\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "lines", [], "any", false, false, false, 69));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 70
            yield "\t\t\t\t\t";
            $context["nr"] = (($context["nr"] ?? null) + 1);
            // line 71
            yield "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td style='text-align: center; width:25px;'>";
            // line 72
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nr"] ?? null), "html", null, true);
            yield "</td>
\t\t\t\t\t\t<td style='text-align: left'>";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 73), "html", null, true);
            yield "</td>
\t\t\t\t\t\t<td style='text-align: right'>";
            // line 74
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "quantity", [], "any", false, false, false, 74), "html", null, true);
            yield "x ";
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "price", [], "any", false, false, false, 74), ($context["currency_code"] ?? null));
            yield "</td>
\t\t\t\t\t\t<td style='text-align: right'>";
            // line 75
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "total", [], "any", false, false, false, 75), ($context["currency_code"] ?? null));
            yield "</td>
\t\t\t\t\t</tr>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 78
        yield "\t\t\t\t<tr>
\t\t\t\t\t<th colspan='4'>_________________________________________________________________________________________</th>
\t\t\t\t</tr>
\t\t\t\t";
        // line 81
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "tax", [], "any", false, false, false, 81) > 0)) {
            // line 82
            yield "\t\t\t\t\t<tr>
\t\t\t\t\t\t<th style='text-align: right' colspan='3'>";
            // line 83
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxname", [], "any", false, false, false, 83), "html", null, true);
            yield "
\t\t\t\t\t\t\t";
            // line 84
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxrate", [], "any", false, false, false, 84), "html", null, true);
            yield "% Tax:</th>
\t\t\t\t\t\t<th style='text-align: right'>";
            // line 85
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "tax", [], "any", false, false, false, 85), ($context["currency_code"] ?? null));
            yield "</th>
\t\t\t\t\t</tr>
\t\t\t\t";
        }
        // line 88
        yield "\t\t\t\t";
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "discount", [], "any", true, true, false, 88)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "discount", [], "any", false, false, false, 88))) : ("")) && (CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "discount", [], "any", false, false, false, 88) > 0))) {
            // line 89
            yield "\t\t\t\t\t<tr>
\t\t\t\t\t\t<th style='text-align: right' colspan='3'>";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Discount"), "html", null, true);
            yield ":</th>
\t\t\t\t\t\t<th style='text-align: right'>";
            // line 91
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "discount", [], "any", false, false, false, 91), ($context["currency_code"] ?? null));
            yield "</th>
\t\t\t\t\t</tr>
\t\t\t\t";
        }
        // line 94
        yield "\t\t\t\t<tr>
\t\t\t\t\t<th style='text-align: right'  colspan='3'>";
        // line 95
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
        yield ":</th>
\t\t\t\t\t<th style='text-align: right'>";
        // line 96
        yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "total", [], "any", false, false, false, 96), ($context["currency_code"] ?? null));
        yield "</th>
\t\t\t\t</tr>
\t\t\t</table>
\t\t<span class=\"muted-text\">";
        // line 99
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "signature", [], "any", false, false, false, 99), "html", null, true);
        yield "</span>
\t\t</div>
\t\t<div class='InvoiceFooter'>
\t\t\t";
        // line 102
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "display_bank_info", [], "any", false, false, false, 102) == 1)) {
            // line 103
            yield "\t\t\t\t<b>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Payment details"), "html", null, true);
            yield ":</b><br >
\t\t\t\t<b>";
            // line 104
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Account Owner"), "html", null, true);
            yield ":</b> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "company_name", [], "any", false, false, false, 104), "html", null, true);
            yield " | <b>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Bank"), "html", null, true);
            yield ":</b> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "bank_name", [], "any", false, false, false, 104), "html", null, true);
            yield " | <b>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("BIC / SWIFT Code"), "html", null, true);
            yield ":</b> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "bic", [], "any", false, false, false, 104), "html", null, true);
            yield " | <b>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Account number"), "html", null, true);
            yield ":</b> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "account_number", [], "any", false, false, false, 104), "html", null, true);
            yield "<br><br>
\t\t\t";
        }
        // line 106
        yield "
\t\t\t<b>";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "company_name", [], "any", false, false, false, 107), "html", null, true);
        yield "</b>
\t\t\t";
        // line 108
        if ((($tmp = ($context["address"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["address"] ?? null), "html", null, true);
            yield " <br> ";
        }
        // line 109
        yield "\t\t\t<b>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
        yield ":</b> ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "email", [], "any", false, false, false, 109), "html", null, true);
        yield " | <b>
\t\t\t";
        // line 110
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "phone", [], "any", false, false, false, 110)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone"), "html", null, true);
            yield ":</b> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "phone", [], "any", false, false, false, 110), "html", null, true);
            yield "<br> ";
        }
        // line 111
        yield "\t\t\t";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "company_vat", [], "any", false, false, false, 111)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " <b>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("VAT ID"), "html", null, true);
            yield ":</b> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "company_vat", [], "any", false, false, false, 111), "html", null, true);
            yield " | ";
        }
        // line 112
        yield "\t\t\t";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "company_number", [], "any", false, false, false, 112)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " <b>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company Registration #:"), "html", null, true);
            yield "</b> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "company_number", [], "any", false, false, false, 112), "html", null, true);
            yield " | ";
        }
        // line 113
        yield "\t\t\t<b>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Website"), "html", null, true);
        yield ": </b>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["footer"] ?? null), "www", [], "any", false, false, false, 113), "html", null, true);
        yield "
\t\t</div>
\t</body>
</html>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "default-pdf.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  407 => 113,  398 => 112,  389 => 111,  381 => 110,  374 => 109,  368 => 108,  364 => 107,  361 => 106,  342 => 104,  337 => 103,  335 => 102,  329 => 99,  323 => 96,  319 => 95,  316 => 94,  310 => 91,  306 => 90,  303 => 89,  300 => 88,  294 => 85,  290 => 84,  286 => 83,  283 => 82,  281 => 81,  276 => 78,  267 => 75,  261 => 74,  257 => 73,  253 => 72,  250 => 71,  247 => 70,  242 => 69,  240 => 68,  235 => 66,  231 => 65,  227 => 64,  220 => 60,  215 => 57,  209 => 56,  205 => 55,  200 => 54,  193 => 53,  188 => 52,  184 => 51,  178 => 48,  173 => 45,  167 => 44,  163 => 43,  158 => 42,  151 => 41,  146 => 40,  142 => 39,  136 => 36,  128 => 33,  122 => 32,  116 => 31,  110 => 30,  106 => 28,  100 => 26,  98 => 25,  91 => 21,  86 => 19,  79 => 14,  77 => 13,  71 => 12,  68 => 11,  65 => 10,  62 => 9,  57 => 8,  55 => 7,  52 => 6,  48 => 4,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "default-pdf.twig", "/var/www/html/modules/Invoice/pdf_template/default-pdf.twig");
    }
}
