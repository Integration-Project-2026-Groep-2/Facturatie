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

/* mod_invoice_settings.html.twig */
class __TwigTemplate_db16613840d131de8e503973270e7caa extends Template
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

        $this->blocks = [
            'meta_title' => [$this, 'block_meta_title'],
            'breadcrumbs' => [$this, 'block_breadcrumbs'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return $this->load((((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "ajax", [], "any", false, false, false, 1)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("layout_blank.html.twig") : ("layout_default.html.twig")), 1);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $macros["mf"] = $this->macros["mf"] = $this->load("macro_functions.html.twig", 3)->unwrap();
        // line 7
        $context["active_menu"] = "system";
        // line 1
        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice settings"), "html", null, true);
        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 10
        yield "    <ol class=\"breadcrumb\">
        <li class=\"breadcrumb-item\">
            <a href=\"";
        // line 12
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/");
        yield "\">
                <svg class=\"icon\">
                    <use xlink:href=\"#home\"/>
                </svg>
            </a>
        </li>
        <li class=\"breadcrumb-item\">
            <a href=\"";
        // line 19
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("system");
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Settings"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice settings"), "html", null, true);
        yield "</li>
    </ol>
";
        yield from [];
    }

    // line 25
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 26
        yield "    <div class=\"card\">
        <div class=\"card-header\">
            <h3 class=\"card-title\">";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice settings"), "html", null, true);
        yield "</h3>
        </div>
        <form method=\"post\" action=\"";
        // line 30
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/update_params");
        yield "\" class=\"api-form\"
              data-api-msg=\"Settings updated\">
            <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\">
            <div class=\"card-body\">
                ";
        // line 34
        $context["params"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_get_params", [], "any", false, false, false, 34);
        // line 35
        yield "                <div class=\"mt-3 mb-3 row\">
                    <label class=\"col-md-3 form-label\">";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Number of days to generate new invoice before order expiration"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <input class=\"form-control\" type=\"text\" name=\"invoice_issue_days_before_expire\" value=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_issue_days_before_expire", [], "any", false, false, false, 38), "html", null, true);
        yield "\">
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice due days"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <input class=\"form-control\" type=\"text\" name=\"invoice_due_days\" value=\"";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_due_days", [], "any", false, false, false, 44), "html", null, true);
        yield "\">
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 form-label\">";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Auto invoice approval"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <div class=\"form-check form-check-inline\">
                            <input class=\"form-check-input\" id=\"radioInvoiceAutoApprovalYes\" type=\"radio\" name=\"invoice_auto_approval\" value=\"1\"";
        // line 51
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_auto_approval", [], "any", false, false, false, 51) == "1")) {
            yield " checked";
        }
        yield ">
                            <label class=\"form-check-label\" for=\"radioInvoiceAutoApprovalYes\">";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "</label>
                        </div>
                        <div class=\"form-check form-check-inline\">
                            <input class=\"form-check-input\" id=\"radioInvoiceAutoApprovalNo\" type=\"radio\" name=\"invoice_auto_approval\" value=\"0\"";
        // line 55
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_auto_approval", [], "any", false, false, false, 55) == "0")) {
            yield " checked";
        }
        yield ">
                            <label class=\"form-check-label\" for=\"radioInvoiceAutoApprovalNo\">";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "</label>
                        </div>
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 61
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Default invoice note"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <textarea class=\"form-control bb-textarea\" name=\"invoice_default_note\" rows=\"5\">";
        // line 63
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_default_note", [], "any", false, false, false, 63), "html", null, true);
        yield "</textarea>
                        <small class=\"form-hint\">";
        // line 64
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Supports markdown format."), "html", null, true);
        yield "</small>
                    </div>
                </div>
            </div>
            <div class=\"card-body\">
                <h3 class=\"card-title\">";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoicing / Sequential Invoice Numbering"), "html", null, true);
        yield "</h3>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 71
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Remove unpaid invoices after days"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <input class=\"form-control\" type=\"text\" name=\"remove_after_days\" value=\"";
        // line 73
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "remove_after_days", [], "any", true, true, false, 73)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "remove_after_days", [], "any", false, false, false, 73), 0)) : (0)), "html", null, true);
        yield "\">
                        <small class=\"form-hint\">";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Set 0 to keep invoices forever."), "html", null, true);
        yield "</small>
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice prefix/series"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <input class=\"form-control\" type=\"text\" name=\"invoice_series\" value=\"";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_series", [], "any", false, false, false, 80), "html", null, true);
        yield "\">
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 84
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid invoice prefix/series"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <input class=\"form-control\" type=\"text\" name=\"invoice_series_paid\" value=\"";
        // line 86
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_series_paid", [], "any", false, false, false, 86), "html", null, true);
        yield "\">
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 90
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Next paid invoice number"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <input class=\"form-control\" type=\"text\" name=\"invoice_starting_number\" value=\"";
        // line 92
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_starting_number", [], "any", false, false, false, 92), "html", null, true);
        yield "\">
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 96
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice number padding length"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <input class=\"form-control\" type=\"number\" name=\"invoice_number_padding\" value=\"";
        // line 98
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_number_padding", [], "any", true, true, false, 98)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_number_padding", [], "any", false, false, false, 98), 5)) : (5)), "html", null, true);
        yield "\" min=\"0\" max=\"20\">
                    </div>
                </div>
            </div>
            <div class=\"card-body\">
                <h3 class=\"card-title\">";
        // line 103
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Document settings"), "html", null, true);
        yield "</h3>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 105
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Document format"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" id=\"radioLetter\" type=\"radio\" name=\"invoice_document_format\" value=\"Letter\"";
        // line 108
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_document_format", [], "any", false, false, false, 108) == "Letter")) {
            yield " checked";
        }
        yield ">
                            <label class=\"form-check-label\" for=\"radioLetter\">";
        // line 109
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Letter"), "html", null, true);
        yield "</label>
                        </div>
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" id=\"radioA4\" type=\"radio\" name=\"invoice_document_format\" value=\"A4\"";
        // line 112
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_document_format", [], "any", false, false, false, 112) == "A4")) {
            yield " checked";
        }
        yield ">
                            <label class=\"form-check-label\" for=\"radioA4\">";
        // line 113
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("A4"), "html", null, true);
        yield "</label>
                        </div>
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 118
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Allow access to invoices without authentication"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" id=\"radioYes\" type=\"radio\" name=\"invoice_accessible_from_hash\" value=\"1\"";
        // line 121
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_accessible_from_hash", [], "any", false, false, false, 121) == "1")) {
            yield " checked";
        }
        yield ">
                            <label class=\"form-check-label\" for=\"radioYes\">";
        // line 122
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "</label>
                        </div>
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" id=\"radioNo\" type=\"radio\" name=\"invoice_accessible_from_hash\" value=\"0\"";
        // line 125
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_accessible_from_hash", [], "any", false, false, false, 125) == "0")) {
            yield " checked";
        }
        yield ">
                            <label class=\"form-check-label\" for=\"radioNo\">";
        // line 126
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "</label>
                        </div>
                    </div>
                    <p>";
        // line 129
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("If enabled, invoices can be accessed by anyone who knows the invoice hash, although it's quite a long hash and would not be brute-forceable."), "html", null, true);
        yield "</p>
                </div>
            </div>
            <div class=\"card-body\">
                <h3 class=\"card-title\">";
        // line 133
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Refunds settings"), "html", null, true);
        yield "</h3>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 135
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Refunds logic"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" id=\"radioNegativeInvoice\" type=\"radio\" name=\"invoice_refund_logic\" value=\"negative_invoice\"";
        // line 138
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_refund_logic", [], "any", false, false, false, 138) == "1")) {
            yield " checked";
        }
        yield ">
                            <label class=\"form-check-label\" for=\"radioNegativeInvoice\">";
        // line 139
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Negative invoice. Generate refund invoice continuing paid invoices numbering"), "html", null, true);
        yield "</label>
                        </div>
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" id=\"radioCreditNote\" type=\"radio\" name=\"invoice_refund_logic\" value=\"credit_note\"";
        // line 142
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_refund_logic", [], "any", false, false, false, 142) == "credit_note")) {
            yield " checked";
        }
        yield ">
                            <label class=\"form-check-label\" for=\"radioCreditNote\">";
        // line 143
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Credit note. Generate credit note with unique numbering"), "html", null, true);
        yield "</label>
                        </div>
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" id=\"radioInvoiceRefundLogic\" type=\"radio\" name=\"invoice_refund_logic\" value=\"manual\"";
        // line 146
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "invoice_refund_logic", [], "any", false, false, false, 146) == "manual")) {
            yield " checked";
        }
        yield ">
                            <label class=\"form-check-label\" for=\"radioInvoiceRefundLogic\">";
        // line 147
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Manual. No actions performed"), "html", null, true);
        yield "</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"card-body\">
                <h3 class=\"card-title\">";
        // line 153
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Add funds settings"), "html", null, true);
        yield "</h3>
                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 155
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Minimum amount for add funds invoice"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <input class=\"form-control\" type=\"text\" name=\"funds_min_amount\" value=\"";
        // line 157
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "funds_min_amount", [], "any", false, false, false, 157), "html", null, true);
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Unlimited"), "html", null, true);
        yield "\">
                    </div>
                </div>

                <div class=\"mb-3 row\">
                    <label class=\"col-md-3 col-form-label\">";
        // line 162
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Maximum amount for add funds invoice"), "html", null, true);
        yield "</label>
                    <div class=\"col-md-6\">
                        <input class=\"form-control\" type=\"text\" name=\"funds_max_amount\" value=\"";
        // line 164
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "funds_max_amount", [], "any", false, false, false, 164), "html", null, true);
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Unlimited"), "html", null, true);
        yield "\">
                    </div>
                </div>
            </div>
            <div class=\"card-footer text-end\">
                <button class=\"btn btn-primary\" type=\"submit\">";
        // line 169
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update settings"), "html", null, true);
        yield "</button>
            </div>
        </form>
    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "mod_invoice_settings.html.twig";
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
        return array (  437 => 169,  427 => 164,  422 => 162,  412 => 157,  407 => 155,  402 => 153,  393 => 147,  387 => 146,  381 => 143,  375 => 142,  369 => 139,  363 => 138,  357 => 135,  352 => 133,  345 => 129,  339 => 126,  333 => 125,  327 => 122,  321 => 121,  315 => 118,  307 => 113,  301 => 112,  295 => 109,  289 => 108,  283 => 105,  278 => 103,  270 => 98,  265 => 96,  258 => 92,  253 => 90,  246 => 86,  241 => 84,  234 => 80,  229 => 78,  222 => 74,  218 => 73,  213 => 71,  208 => 69,  200 => 64,  196 => 63,  191 => 61,  183 => 56,  177 => 55,  171 => 52,  165 => 51,  159 => 48,  152 => 44,  147 => 42,  140 => 38,  135 => 36,  132 => 35,  130 => 34,  125 => 32,  120 => 30,  115 => 28,  111 => 26,  104 => 25,  96 => 21,  89 => 19,  79 => 12,  75 => 10,  68 => 9,  57 => 5,  53 => 1,  51 => 7,  49 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_invoice_settings.html.twig", "/var/www/html/modules/Invoice/html_admin/mod_invoice_settings.html.twig");
    }
}
