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

/* mod_invoice_invoice.html.twig */
class __TwigTemplate_5343731c6d5f5bdc778dee48c385422b extends Template
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
            'sidebar2' => [$this, 'block_sidebar2'],
            'head' => [$this, 'block_head'],
            'js' => [$this, 'block_js'],
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
        $context["active_menu"] = "invoice";
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice"), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "serie", [], "any", false, false, false, 5), "html", null, true);
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::sprintf("%05s", CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "nr", [], "any", false, false, false, 5)), "html", null, true);
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
                    <use xlink:href=\"#home\" />
                </svg>
            </a>
        </li>
        <li class=\"breadcrumb-item\">
            <a href=\"";
        // line 19
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "serie", [], "any", false, false, false, 21), "html", null, true);
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::sprintf("%05s", CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "nr", [], "any", false, false, false, 21)), "html", null, true);
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
        yield "<div class=\"card mb-3\">
    <div class=\"card-header\">
        <h5 class=\"mb-0\">";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice"), "html", null, true);
        yield " #";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 28), "html", null, true);
        yield "</h5>
    </div>

    <ul class=\"nav nav-tabs\" role=\"tablist\">
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link active\" href=\"#tab-info\" data-bs-toggle=\"tab\">";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Details"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-manage\" data-bs-toggle=\"tab\">";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Manage"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-texts\" data-bs-toggle=\"tab\">";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Texts"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-buyer-credentials\" data-bs-toggle=\"tab\">";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client credentials"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-seller-credentials\" data-bs-toggle=\"tab\">";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company credentials"), "html", null, true);
        yield "</a>
        </li>
    </ul>

    <div class=\"tab-content\">
        <div class=\"tab-pane fade show active\" id=\"tab-info\" role=\"tabpanel\">
            <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                <tbody>
                    <tr>
                        <td class=\"w-50 text-end\">";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("ID"), "html", null, true);
        yield ":</td>
                        <td>#";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 55), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <td class=\"text-end\">";
        // line 58
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Number"), "html", null, true);
        yield ":</td>
                        <td>";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "serie", [], "any", false, false, false, 59), "html", null, true);
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::sprintf("%05s", CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "nr", [], "any", false, false, false, 59)), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <td class=\"text-end\">";
        // line 62
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client"), "html", null, true);
        yield ":</td>
                        <td>
                            <a href=\"";
        // line 64
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/manage");
        yield "/";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "client", [], "any", false, false, false, 64), "id", [], "any", false, false, false, 64), "html", null, true);
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "client", [], "any", false, false, false, 64), "first_name", [], "any", false, false, false, 64), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "client", [], "any", false, false, false, 64), "last_name", [], "any", false, false, false, 64), "html", null, true);
        yield "</a>
                        </td>
                    </tr>
                    <tr>
                        <td class=\"text-end\">";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield ":</td>
                        <td>
                            ";
        // line 70
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 70) == "paid")) {
            // line 71
            yield "                                <span class=\"badge bg-success me-1\"></span>
                            ";
        }
        // line 73
        yield "                            ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 73) == "unpaid")) {
            // line 74
            yield "                                <span class=\"badge bg-danger me-1\"></span>
                            ";
        }
        // line 76
        yield "                            ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 76) == "refunded")) {
            // line 77
            yield "                                <span class=\"badge bg-warning me-1\"></span>
                            ";
        }
        // line 79
        yield "                            ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 79) == "canceled")) {
            // line 80
            yield "                                <span class=\"badge bg-secondary me-1\"></span>
                            ";
        }
        // line 82
        yield "                            ";
        yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 82, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 82)]);
        yield "
                        </td>
                    </tr>
                    ";
        // line 85
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "tax", [], "any", false, false, false, 85)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 86
            yield "                    <tr>
                        <td class=\"text-end\">";
            // line 87
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxname", [], "any", false, false, false, 87), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxrate", [], "any", false, false, false, 87), "html", null, true);
            yield "%</td>
                        <td>";
            // line 88
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 88, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "tax", [], "any", false, false, false, 88), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 88)]);
            yield "</td>
                    </tr>
                    ";
        }
        // line 91
        yield "                    <tr>
                        <td class=\"text-end\">";
        // line 92
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
        yield ":</td>
                        <td>";
        // line 93
        yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 93, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "total", [], "any", false, false, false, 93), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 93)]);
        yield "</td>
                    </tr>
                    <tr>
                        <td class=\"text-end\">";
        // line 96
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency"), "html", null, true);
        yield ":</td>
                        <td>";
        // line 97
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 97), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <td class=\"text-end\">";
        // line 100
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Date Created"), "html", null, true);
        yield ":</td>
                        <td>";
        // line 101
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "created_at", [], "any", false, false, false, 101)), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <td class=\"text-end\">";
        // line 104
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Date Due"), "html", null, true);
        yield ":</td>
                        <td>";
        // line 105
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "due_at", [], "any", false, false, false, 105)), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <td class=\"text-end\">";
        // line 108
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Date Paid"), "html", null, true);
        yield ":</td>
                        <td>";
        // line 109
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "paid_at", [], "any", false, false, false, 109)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "paid_at", [], "any", false, false, false, 109)), "html", null, true);
        } else {
            yield "-";
        }
        yield "</td>
                    </tr>
                    <tr>
                        <td class=\"text-end\">";
        // line 112
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Last Reminded"), "html", null, true);
        yield ":</td>
                        ";
        // line 113
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "reminded_at", [], "any", false, false, false, 113)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<td title=";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "reminded_at", [], "any", false, false, false, 113)), "html", null, true);
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_timeago_filter(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "reminded_at", [], "any", false, false, false, 113)), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("ago"), "html", null, true);
            yield "</td>";
        } else {
            yield "<td>-</td>";
        }
        // line 114
        yield "                    </tr>
                    ";
        // line 115
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "notes", [], "any", false, false, false, 115)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 116
            yield "                    <tr>
                        <td class=\"text-end\">";
            // line 117
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Notes"), "html", null, true);
            yield ":</td>
                        <td>";
            // line 118
            yield $this->extensions['Box_TwigExtensions']->twig_markdown_filter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "notes", [], "any", false, false, false, 118));
            yield "</td>
                    </tr>
                    ";
        }
        // line 121
        yield "                </tbody>
            </table>

            <div class=\"card-footer text-center\">
                <a href=\"";
        // line 125
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("invoice");
        yield "/";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "hash", [], "any", false, false, false, 125), "html", null, true);
        yield "\" class=\"btn btn-primary\" target=\"_blank\">
                    <svg class=\"icon\" width=\"24\" height=\"24\">
                        <use xlink:href=\"#eye\" />
                    </svg>
                    <span>";
        // line 129
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("View as client"), "html", null, true);
        yield "</span>
                </a>
                <a href=\"";
        // line 131
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 131), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
        yield "\" class=\"btn btn-primary api-link\" data-api-confirm=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
        yield "\" data-api-redirect=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
        yield "\">
                    <svg class=\"icon\" width=\"24\" height=\"24\">
                        <use xlink:href=\"#delete\" />
                    </svg>
                    <span>";
        // line 135
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Delete"), "html", null, true);
        yield "</span>
                </a>
                ";
        // line 137
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 137) == "unpaid")) {
            // line 138
            yield "                <a href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/send_reminder", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 138), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\" class=\"btn btn-primary api-link\" data-api-msg=\"Payment reminder was sent\">
                    <svg class=\"icon\" width=\"24\" height=\"24\">
                        <use xlink:href=\"#mail\" />
                    </svg>
                    <span>";
            // line 142
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Send reminder"), "html", null, true);
            yield "</span>
                </a>
                <a href=\"#\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#transactionModal\">
                    <svg class=\"icon\" width=\"24\" height=\"24\">
                        <use xlink:href=\"#check\" />
                    </svg>
                    <span>";
            // line 148
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Mark as paid"), "html", null, true);
            yield "</span>
                </a>
                <div class=\"modal fade\" id=\"transactionModal\" tabindex=\"-1\" aria-labelledby=\"transactionModalLabel\" aria-hidden=\"true\">
                <div class=\"modal-dialog\">
                    <form class=\"modal-content api-form\" method=\"post\" action=\"";
            // line 152
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/mark_as_paid", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 152), "execute" => 1, "CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\" name=\"transactionForm\" data-api-reload=\"1\">
                    <div class=\"modal-header\">
                        <h5 class=\"modal-title\" id=\"transactionModalLabel\">";
            // line 154
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enter Custom Transaction ID"), "html", null, true);
            yield ":</h5>
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"";
            // line 155
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Close"), "html", null, true);
            yield "\"></button>
                    </div>
                    <div class=\"modal-body\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
            // line 158
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
            yield "\">
                        <input type=\"hidden\" name=\"id\" value=\"";
            // line 159
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 159), "html", null, true);
            yield "\">
                        <div class=\"mb-3 row\">
                            <label class=\"col-md-3 col-form-label\" for=\"transaction-id\">";
            // line 161
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Transaction ID"), "html", null, true);
            yield ":</label>
                            <div class=\"col\">
                                <input class=\"form-control\" type=\"text\" name=\"transactionId\" id=\"transaction-id\">
                            </div>
                        </div>
                        <div class=\"mb-3 row\">
                            <div class=\"col\">
                                ";
            // line 168
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Add the transaction ID of the payment to mark the invoice as paid."), "html", null, true);
            yield "<br />
                                ";
            // line 169
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("This should be the transaction ID you use to reconcile your bank statement."), "html", null, true);
            yield "
                            </div>
                        </div>
                    </div>
                    <div class=\"modal-footer\">
                        <a href=\"#\" class=\"btn btn-link link-secondary\" data-bs-dismiss=\"modal\">";
            // line 174
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Cancel"), "html", null, true);
            yield "</a>
                        <input type=\"submit\" class=\"btn btn-primary\" value=\"";
            // line 175
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Submit"), "html", null, true);
            yield "\">
                    </div>
                    </form>
                </div>
                </div>


                ";
        }
        // line 183
        yield "
                ";
        // line 184
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 184) == "paid")) {
            // line 185
            yield "                <a href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/refund", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 185), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\" class=\"btn btn-primary api-link\" data-api-confirm=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
            yield "\" data-api-redirect=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
            yield "\">
                    <svg class=\"icon\" width=\"24\" height=\"24\">
                        <use xlink:href=\"#receipt-refund\" />
                    </svg>
                    <span>";
            // line 189
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Refund"), "html", null, true);
            yield "</span>
                </a>
                ";
        }
        // line 192
        yield "                <a href=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("invoice/pdf");
        yield "/";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "hash", [], "any", false, false, false, 192), "html", null, true);
        yield "\" class=\"btn btn-primary\" target=\"_blank\">
                    <svg class=\"icon\" width=\"24\" height=\"24\">
                        <use xlink:href=\"#download\" />
                    </svg>
                    <span>";
        // line 196
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("PDF"), "html", null, true);
        yield "</span>
                </a>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-manage\" role=\"tabpanel\">
            <div class=\"card-body\">
                <form action=\"";
        // line 203
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/update");
        yield "\" method=\"post\" class=\"api-form\" data-api-reload=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice updated"), "html", null, true);
        yield "\">
                    <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 204
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 206
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioStatusPaid\" type=\"radio\" name=\"status\" value=\"paid\"";
        // line 209
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 209) == "paid")) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioStatusPaid\">";
        // line 210
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioStatusUnpaid\" type=\"radio\" name=\"status\" value=\"unpaid\"";
        // line 213
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 213) == "unpaid")) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioStatusUnpaid\">";
        // line 214
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Unpaid"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioStatusRefunded\" type=\"radio\" name=\"status\" value=\"refunded\"";
        // line 217
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 217) == "refunded")) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioStatusRefunded\">";
        // line 218
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Refunded"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioStatusCanceled\" type=\"radio\" name=\"status\" value=\"canceled\"";
        // line 221
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 221) == "canceled")) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioStatusCanceled\">";
        // line 222
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Canceled"), "html", null, true);
        yield "</label>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 227
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Approved"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioApprovedYes\" type=\"radio\" name=\"approved\" value=\"1\"";
        // line 230
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "approved", [], "any", false, false, false, 230)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioApprovedYes\">";
        // line 231
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioApprovedNo\" type=\"radio\" name=\"approved\" value=\"0\"";
        // line 234
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "approved", [], "any", false, false, false, 234)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioApprovedNo\">";
        // line 235
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "</label>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 240
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Serie and number"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"input-group\">
                                <input class=\"form-control\" type=\"text\" name=\"serie\" value=\"";
        // line 243
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "serie", [], "any", false, false, false, 243), "html", null, true);
        yield "\">
                                <input class=\"form-control w-50\" type=\"text\" name=\"nr\" value=\"";
        // line 244
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "nr", [], "any", false, false, false, 244), "html", null, true);
        yield "\">
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 249
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tax"), "html", null, true);
        yield ":</label>
                        <div class=\"col d-flex gap-2\">
                            <input class=\"form-control\" type=\"text\" name=\"taxname\" value=\"";
        // line 251
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxname", [], "any", false, false, false, 251), "html", null, true);
        yield "\">
                            <div class=\"input-group\">
                                <input class=\"form-control\" type=\"text\" name=\"taxrate\" value=\"";
        // line 253
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxrate", [], "any", false, false, false, 253), "html", null, true);
        yield "\">
                                <span class=\"input-group-text\">%</span>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 259
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Payment method"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            ";
        // line 261
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 261, $this->getSourceContext())->macro_selectbox(...["gateway_id", CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "invoice_gateways", [["format" => "pairs"]], "method", false, false, false, 261), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "gateway_id", [], "any", false, false, false, 261), 0, __trans("Select payment method")]);
        yield "
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\" for=\"created_at\">";
        // line 265
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Created at"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"input-group\">
                                <div class=\"input-icon w-100\">
                                    <input class=\"form-control datepicker\"
                                           id=\"created_at\"
                                           value=\"";
        // line 271
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "created_at", [], "any", false, false, false, 271), "Y-m-d"), "html", null, true);
        yield "\"
                                           name=\"created_at\"
                                    >
                                    <span class=\"input-icon-addon\">
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                            <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>
                                            <path d=\"M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z\"></path>
                                            <path d=\"M16 3l0 4\"></path>
                                            <path d=\"M8 3l0 4\"></path>
                                            <path d=\"M4 11l16 0\"></path>
                                            <path d=\"M11 15l1 0\"></path>
                                            <path d=\"M12 15l0 3\"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\" for=\"due_at\">";
        // line 290
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Due at"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"input-group\">
                                <div class=\"input-icon w-100\">
                                    <input class=\"form-control datepicker\"
                                           id=\"due_at\"
                                           value=\"";
        // line 296
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "due_at", [], "any", false, false, false, 296)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "due_at", [], "any", false, false, false, 296), "Y-m-d"), "html", null, true);
        }
        yield "\"
                                           name=\"due_at\"
                                    >
                                    <span class=\"input-icon-addon\">
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                            <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>
                                            <path d=\"M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z\"></path>
                                            <path d=\"M16 3l0 4\"></path>
                                            <path d=\"M8 3l0 4\"></path>
                                            <path d=\"M4 11l16 0\"></path>
                                            <path d=\"M11 15l1 0\"></path>
                                            <path d=\"M12 15l0 3\"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\" for=\"paid_at\">";
        // line 315
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid at"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"input-group\">
                                <div class=\"input-icon w-100\">
                                    <input class=\"form-control datepicker\"
                                           id=\"paid_at\"
                                           value=\"";
        // line 321
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "paid_at", [], "any", false, false, false, 321)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "paid_at", [], "any", false, false, false, 321), "Y-m-d"), "html", null, true);
        }
        yield "\"
                                           name=\"paid_at\"
                                    >
                                    <span class=\"input-icon-addon\">
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                            <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>
                                            <path d=\"M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z\"></path>
                                            <path d=\"M16 3l0 4\"></path>
                                            <path d=\"M8 3l0 4\"></path>
                                            <path d=\"M4 11l16 0\"></path>
                                            <path d=\"M11 15l1 0\"></path>
                                            <path d=\"M12 15l0 3\"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 340
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Notes"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <textarea class=\"form-control\" name=\"notes\" rows=\"6\">";
        // line 342
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "notes", [], "any", false, false, false, 342), "html", null, true);
        yield "</textarea>
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"id\" value=\"";
        // line 346
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 346), "html", null, true);
        yield "\">
                    <input type=\"submit\" value=\"";
        // line 347
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
        yield "\" class=\"btn btn-primary w-100\">
                </form>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-texts\" role=\"tabpanel\">
            <div class=\"card-body\">
                <form action=\"";
        // line 354
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/update");
        yield "\" method=\"post\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice updated"), "html", null, true);
        yield "\">
                    <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 355
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 357
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Text before invoice items table"), "html", null, true);
        yield "</label>
                        <div class=\"col\">
                            <textarea class=\"form-control bb-textarea\" name=\"text_1\" rows=\"6\">";
        // line 359
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "text_1", [], "any", false, false, false, 359), "html", null, true);
        yield "</textarea>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 363
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Text after invoice items table"), "html", null, true);
        yield "</label>
                        <div class=\"col\">
                            <textarea class=\"form-control bb-textarea\" name=\"text_2\" rows=\"6\">";
        // line 365
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "text_2", [], "any", false, false, false, 365), "html", null, true);
        yield "</textarea>
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"id\" value=\"";
        // line 369
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 369), "html", null, true);
        yield "\">
                    <button class=\"btn btn-primary w-100\" type=\"submit\">";
        // line 370
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
        yield "</button>
                </form>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-seller-credentials\" role=\"tabpanel\">
            <div class=\"card-body\">
                <h3>";
        // line 377
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company details at the moment of purchase"), "html", null, true);
        yield "</h3>

                ";
        // line 379
        $context["seller"] = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "seller", [], "any", false, false, false, 379);
        // line 380
        yield "                <form action=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/update");
        yield "\" method=\"post\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice updated"), "html", null, true);
        yield "\">
                    <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 381
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 383
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"seller_company\" value=\"";
        // line 385
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "company", [], "any", false, false, false, 385), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 389
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company VAT"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"seller_company_vat\" value=\"";
        // line 391
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "company_vat", [], "any", false, false, false, 391), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 395
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company Number"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"seller_company_number\" value=\"";
        // line 397
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "company_number", [], "any", false, false, false, 397), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 401
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"seller_address\" value=\"";
        // line 403
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "address", [], "any", false, false, false, 403), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 407
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"seller_phone\" value=\"";
        // line 409
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "phone", [], "any", false, false, false, 409), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 413
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"seller_email\" value=\"";
        // line 415
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "email", [], "any", false, false, false, 415), "html", null, true);
        yield "\">
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"id\" value=\"";
        // line 419
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 419), "html", null, true);
        yield "\">
                    <input type=\"submit\" value=\"";
        // line 420
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
        yield "\" class=\"btn btn-primary w-100\">
                </form>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-buyer-credentials\" role=\"tabpanel\">
            <div class=\"card-body\">
                <h3>";
        // line 427
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client details at the moment of purchase"), "html", null, true);
        yield "</h3>

                ";
        // line 429
        $context["buyer"] = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "buyer", [], "any", false, false, false, 429);
        // line 430
        yield "                <form action=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/update");
        yield "\" method=\"post\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice updated"), "html", null, true);
        yield "\">
                    <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 431
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 433
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("First name"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"buyer_first_name\" value=\"";
        // line 435
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "first_name", [], "any", false, false, false, 435), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 439
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Last name"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"buyer_last_name\" value=\"";
        // line 441
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "last_name", [], "any", false, false, false, 441), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 445
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"buyer_company\" value=\"";
        // line 447
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "company", [], "any", false, false, false, 447), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 451
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company VAT"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"buyer_company_vat\" value=\"";
        // line 453
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "company_vat", [], "any", false, false, false, 453), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 457
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company Number"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"buyer_company_number\" value=\"";
        // line 459
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "company_number", [], "any", false, false, false, 459), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 463
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"buyer_address\" value=\"";
        // line 465
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "address", [], "any", false, false, false, 465), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 469
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("City"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"buyer_city\" value=\"";
        // line 471
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "city", [], "any", false, false, false, 471), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 475
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("State"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            ";
        // line 478
        yield "                            <input class=\"form-control\" type=\"text\" name=\"buyer_state\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "state", [], "any", false, false, false, 478), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 482
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Country"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            ";
        // line 484
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 484, $this->getSourceContext())->macro_selectbox(...["buyer_country", CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_countries", [], "any", false, false, false, 484), CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "country", [], "any", false, false, false, 484), 0, __trans("Select country")]);
        yield "
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 488
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"buyer_phone\" value=\"";
        // line 490
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "phone", [], "any", false, false, false, 490), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 494
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Zip"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"buyer_zip\" value=\"";
        // line 496
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "zip", [], "any", false, false, false, 496), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 500
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"buyer_email\" value=\"";
        // line 502
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "email", [], "any", false, false, false, 502), "html", null, true);
        yield "\">
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"id\" value=\"";
        // line 506
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 506), "html", null, true);
        yield "\">
                    <input type=\"submit\" value=\"";
        // line 507
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
        yield "\" class=\"btn btn-primary w-100\">
                </form>
            </div>
        </div>
    </div>
</div>

<div class=\"card mb-3\">
    <div class=\"card-body\">
        <h5>";
        // line 516
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice items"), "html", null, true);
        yield "</h5>
    </div>

    ";
        // line 519
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "approved", [], "any", false, false, false, 519)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 520
            yield "    <form action=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/update");
            yield "\" method=\"post\" class=\"api-form\" data-api-reload=\"1\">
        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
            // line 521
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
            yield "\"/>
        <table class=\"table card-table table-vcenter table-striped text-nowrap\">
            <thead>
                <tr>
                    <th>";
            // line 525
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
            yield "</th>
                    <th class=\"text-center w-10\">";
            // line 526
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Quantity"), "html", null, true);
            yield "</th>
                    <th class=\"text-center w-25\">";
            // line 527
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Price"), "html", null, true);
            yield "</th>
                    <th class=\"w-1\">";
            // line 528
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tax"), "html", null, true);
            yield "</th>
                    <th class=\"w-1\"></th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 533
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "lines", [], "any", false, false, false, 533));
            foreach ($context['_seq'] as $context["i"] => $context["item"]) {
                // line 534
                yield "                <tr>
                    <td>
                        <input class=\"form-control\" type=\"text\" name=\"items[";
                // line 536
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 536), "html", null, true);
                yield "][title]\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 536), "html", null, true);
                yield "\">
                    </td>
                    <td>
                        <input class=\"form-control text-center\" type=\"number\" name=\"items[";
                // line 539
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 539), "html", null, true);
                yield "][quantity]\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "quantity", [], "any", false, false, false, 539), "html", null, true);
                yield "\" min=\"1\" max=\"1000\" required>
                    </td>
                    <td>
                        <div class=\"input-group\">
                            <input class=\"form-control\" type=\"text\" name=\"items[";
                // line 543
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 543), "html", null, true);
                yield "][price]\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "price", [], "any", false, false, false, 543), "html", null, true);
                yield "\">
                            <span class=\"input-group-text\">";
                // line 544
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 544), "html", null, true);
                yield "</span>
                        </td>
                    <td class=\"text-center\">
                        <input class=\"form-check-input m-0 align-middle\" type=\"checkbox\" name=\"items[";
                // line 547
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 547), "html", null, true);
                yield "][taxed]\" value=\"1\"";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "taxed", [], "any", false, false, false, 547)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield " checked";
                }
                yield ">
                    </td>
                    <td>
                        <a class=\"btn btn-icon api-link\"
                            href=\"";
                // line 551
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/item_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 551), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
                yield "\"
                            data-api-confirm=\"";
                // line 552
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
                yield "\"
                            data-api-reload=\"1\">
                            <svg class=\"icon\">
                                <use xlink:href=\"#delete\" />
                            </svg>
                        </a>
                    </td>
                </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['i'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 561
            yield "                <tr>
                    <td>
                        <input class=\"form-control\" type=\"text\" name=\"new_item[title]\" oninput=\"this.form['new_item[quantity]'].required = this.value.trim() !== ''\">
                    </td>
                    <td>
                        <input class=\"form-control text-center\" type=\"number\" name=\"new_item[quantity]\" min=\"1\" max=\"1000\">
                    </td>
                    <td class=\"text-center\">
                        <div class=\"input-group\">
                            <input class=\"form-control\" type=\"text\" name=\"new_item[price]\" oninput=\"this.form['new_item[quantity]'].required = this.value.trim() !== ''\">
                            <span class=\"input-group-text\">";
            // line 571
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 571), "html", null, true);
            yield "</span>
                        </div>
                    </td>
                    <td class=\"text-center\">
                        <input class=\"form-check-input m-0 align-middle\" type=\"checkbox\" name=\"new_item[taxed]\" value=\"1\">
                    </td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan=\"5\" class=\"currency\">
                        ";
            // line 583
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Subtotal"), "html", null, true);
            yield ": ";
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 583, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "subtotal", [], "any", false, false, false, 583), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 583)]);
            yield "
                    </td>
                </tr>
                <tr>
                    <td colspan=\"5\" class=\"currency\">
                        ";
            // line 588
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxname", [], "any", false, false, false, 588), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxrate", [], "any", false, false, false, 588), "html", null, true);
            yield "%: ";
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 588, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "tax", [], "any", false, false, false, 588), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 588)]);
            yield "
                    </td>
                </tr>
                <tr>
                    <td colspan=\"5\" class=\"currency\">
                        ";
            // line 593
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
            yield ": ";
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 593, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "total", [], "any", false, false, false, 593), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 593)]);
            yield "
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class=\"card-footer d-flex gap-2\">
            ";
            // line 600
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "approved", [], "any", false, false, false, 600)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 601
                yield "            <a class=\"btn btn-success w-100 api-link\"
                href=\"";
                // line 602
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/approve", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 602), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
                yield "\"
                data-api-reload=\"";
                // line 603
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoices");
                yield "\">
                <svg class=\"icon\">
                    <use xlink:href=\"#check\" />
                </svg>
                ";
                // line 607
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Approve"), "html", null, true);
                yield "
            </a>
            ";
            }
            // line 610
            yield "            <input type=\"hidden\" name=\"id\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 610), "html", null, true);
            yield "\">
            <input type=\"submit\" value=\"";
            // line 611
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
            yield "\" class=\"btn btn-primary w-25\">
        </div>
    </form>
";
        } else {
            // line 615
            yield "    <table class=\"table card-table table-vcenter table-striped text-nowrap\">
        <thead>
            <tr>
                <th class=\"w-1\"></th>
                <th class=\"w-1\"></th>
                <th>";
            // line 620
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
            yield "</th>
                <th class=\"text-center\">";
            // line 621
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tax"), "html", null, true);
            yield "</th>
                <th class=\"text-end w-1\">";
            // line 622
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
            yield "</th>
            </tr>
        </thead>
        <tbody>
            ";
            // line 626
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "lines", [], "any", false, false, false, 626));
            foreach ($context['_seq'] as $context["i"] => $context["item"]) {
                // line 627
                yield "            <tr>
                <td>";
                // line 628
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["i"] + 1), "html", null, true);
                yield "</td>
                <td class=\"d-flex\">
                    <div class=\"bull task ";
                // line 630
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "status", [], "any", false, false, false, 630), "html", null, true);
                yield "\" title=\"Task status: ";
                yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 630, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, $context["item"], "status", [], "any", false, false, false, 630)]);
                yield "\"></div>
                    <div class=\"bull charge ";
                // line 631
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "charged", [], "any", false, false, false, 631)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("yes") : ("no"));
                yield "\" title=\"";
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "charged", [], "any", false, false, false, 631)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Charged from client balance") : ("Not charged from client balance"));
                yield "\"></div>
                </td>
                <td>
                ";
                // line 634
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "order_id", [], "any", false, false, false, 634)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 635
                    yield "                <a href=\"";
                    yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("order/manage");
                    yield "/";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "order_id", [], "any", false, false, false, 635), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 635), "html", null, true);
                    yield " ";
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "quantity", [], "any", false, false, false, 635) > 1)) {
                        yield " x ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "quantity", [], "any", false, false, false, 635), "html", null, true);
                        yield " ";
                    }
                    yield "</a>
                ";
                } else {
                    // line 637
                    yield "                ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 637), "html", null, true);
                    yield " ";
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "quantity", [], "any", false, false, false, 637) > 1)) {
                        yield " x ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "quantity", [], "any", false, false, false, 637), "html", null, true);
                        yield " ";
                    }
                    // line 638
                    yield "                ";
                }
                // line 639
                yield "                </td>
                <td class=\"text-center\">";
                // line 640
                yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 640, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, $context["item"], "tax", [], "any", false, false, false, 640), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 640)]);
                yield "</td>
                <td class=\"fw-bold\">";
                // line 641
                yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 641, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, $context["item"], "total", [], "any", false, false, false, 641), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 641)]);
                yield "</td>
            </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['i'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 644
            yield "        </tbody>
        <tfoot>
            <tr>
                <td colspan=\"5\" class=\"text-end fw-bold\">
                    Subtotal: ";
            // line 648
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 648, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "subtotal", [], "any", false, false, false, 648), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 648)]);
            yield "
                </td>
            </tr>
            <tr>
                <td colspan=\"5\" class=\"text-end fw-bold\">
                    ";
            // line 653
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxname", [], "any", false, false, false, 653), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxrate", [], "any", false, false, false, 653), "html", null, true);
            yield "%: ";
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 653, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "tax", [], "any", false, false, false, 653), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 653)]);
            yield "
                </td>
            </tr>
            <tr>
                <td colspan=\"5\" class=\"text-end fw-bold\">
                    Total: ";
            // line 658
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 658, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "total", [], "any", false, false, false, 658), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 658)]);
            yield "
                </td>
            </tr>
        </tfoot>
    </table>
";
        }
        // line 664
        yield "</div>

    ";
        // line 666
        $context["transactions"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "invoice_transaction_get_list", [["invoice_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 666), "per_page" => 100]], "method", false, false, false, 666), "list", [], "any", false, false, false, 666);
        // line 667
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["transactions"] ?? null)) > 0)) {
            // line 668
            yield "    <div class=\"card overflow-auto\">
        <div class=\"card-body\">
            <h5>";
            // line 670
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Transactions"), "html", null, true);
            yield "</h5>
        </div>

        <table class=\"table card-table table-vcenter table-striped text-nowrap\">
            <thead>
                <tr>
                    <th>";
            // line 676
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("ID"), "html", null, true);
            yield "</th>
                    <th>";
            // line 677
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Type"), "html", null, true);
            yield "</th>
                    <th>";
            // line 678
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Gateway"), "html", null, true);
            yield "</th>
                    <th>";
            // line 679
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Amount"), "html", null, true);
            yield "</th>
                    <th>";
            // line 680
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
            yield "</th>
                    <th>";
            // line 681
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Date"), "html", null, true);
            yield "</th>
                    <th class=\"w-1\"></th>
                </tr>
            </thead>

            <tbody>
                ";
            // line 687
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["transactions"] ?? null));
            foreach ($context['_seq'] as $context["i"] => $context["tx"]) {
                // line 688
                yield "                <tr>
                    <td>";
                // line 689
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "txn_id", [], "any", false, false, false, 689), "html", null, true);
                yield "</td>
                    <td>";
                // line 690
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "type", [], "any", false, false, false, 690), "html", null, true);
                yield "</td>
                    <td>";
                // line 691
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "gateway", [], "any", false, false, false, 691), "html", null, true);
                yield "</td>
                    <td>";
                // line 692
                yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 692, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "amount", [], "any", false, false, false, 692), CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "currency", [], "any", false, false, false, 692)]);
                yield "</td>
                    <td>";
                // line 693
                yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 693, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "status", [], "any", false, false, false, 693)]);
                yield "</td>
                    <td>";
                // line 694
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "created_at", [], "any", false, false, false, 694)), "html", null, true);
                yield "</td>
                    <td>
                        <a class=\"btn btn-icon\" href=\"";
                // line 696
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/invoice/transaction");
                yield "/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "id", [], "any", false, false, false, 696), "html", null, true);
                yield "\">
                            <svg class=\"icon\">
                                <use xlink:href=\"#edit\" />
                            </svg>
                        </a>
                    </td>
                </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['i'], $context['tx'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 704
            yield "            </tbody>
        </table>
    </div>
    ";
        }
        yield from [];
    }

    // line 710
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_sidebar2(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 711
        yield "<div class=\"widget\">
    <div class=\"head\">
        <h2 class=\"dark-icon i-services\">";
        // line 713
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Actions"), "html", null, true);
        yield "</h2>
    </div>
    <div class=\"block\">
        <button class=\"btn btn-primary\" type=\"button\" onclick=\"window.print()\">
            <span class=\"dark-icon i-print\"></span> ";
        // line 717
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Print"), "html", null, true);
        yield "</button>
        ";
        // line 718
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 718) == "unpaid")) {
            // line 719
            yield "        <a class=\"btn btn-primary api-link\" href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/client/invoice/delete", ["hash" => CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "hash", [], "any", false, false, false, 719), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\" data-api-confirm=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
            yield "\" data-api-redirect=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
            yield "\">
            <span class=\"dark-icon i-bin\"></span> ";
            // line 720
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Delete"), "html", null, true);
            yield "</a>
        ";
        }
        // line 722
        yield "    </div>
</div>
";
        yield from [];
    }

    // line 726
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $macros["mf"]->getTemplateForMacro("macro_bb_editor", $context, 726, $this->getSourceContext())->macro_bb_editor(...[".bb-textarea"]);
        yield from [];
    }

    // line 728
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 730
        yield "<script>
    \$(function() {
        \$('input[name=gateway]:first').attr('checked', true);
        \$('#pay-now-button').on('click', function() {
            var link = \$('input[name=gateway]:checked').val();
            bb.redirect(link);

            return false;
        });
    });

</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "mod_invoice_invoice.html.twig";
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
        return array (  1627 => 730,  1620 => 728,  1609 => 726,  1602 => 722,  1597 => 720,  1588 => 719,  1586 => 718,  1582 => 717,  1575 => 713,  1571 => 711,  1564 => 710,  1555 => 704,  1539 => 696,  1534 => 694,  1530 => 693,  1526 => 692,  1522 => 691,  1518 => 690,  1514 => 689,  1511 => 688,  1507 => 687,  1498 => 681,  1494 => 680,  1490 => 679,  1486 => 678,  1482 => 677,  1478 => 676,  1469 => 670,  1465 => 668,  1462 => 667,  1460 => 666,  1456 => 664,  1447 => 658,  1435 => 653,  1427 => 648,  1421 => 644,  1412 => 641,  1408 => 640,  1405 => 639,  1402 => 638,  1393 => 637,  1377 => 635,  1375 => 634,  1367 => 631,  1361 => 630,  1356 => 628,  1353 => 627,  1349 => 626,  1342 => 622,  1338 => 621,  1334 => 620,  1327 => 615,  1320 => 611,  1315 => 610,  1309 => 607,  1302 => 603,  1298 => 602,  1295 => 601,  1293 => 600,  1281 => 593,  1269 => 588,  1259 => 583,  1244 => 571,  1232 => 561,  1217 => 552,  1213 => 551,  1202 => 547,  1196 => 544,  1190 => 543,  1181 => 539,  1173 => 536,  1169 => 534,  1165 => 533,  1157 => 528,  1153 => 527,  1149 => 526,  1145 => 525,  1138 => 521,  1133 => 520,  1131 => 519,  1125 => 516,  1113 => 507,  1109 => 506,  1102 => 502,  1097 => 500,  1090 => 496,  1085 => 494,  1078 => 490,  1073 => 488,  1066 => 484,  1061 => 482,  1053 => 478,  1048 => 475,  1041 => 471,  1036 => 469,  1029 => 465,  1024 => 463,  1017 => 459,  1012 => 457,  1005 => 453,  1000 => 451,  993 => 447,  988 => 445,  981 => 441,  976 => 439,  969 => 435,  964 => 433,  959 => 431,  952 => 430,  950 => 429,  945 => 427,  935 => 420,  931 => 419,  924 => 415,  919 => 413,  912 => 409,  907 => 407,  900 => 403,  895 => 401,  888 => 397,  883 => 395,  876 => 391,  871 => 389,  864 => 385,  859 => 383,  854 => 381,  847 => 380,  845 => 379,  840 => 377,  830 => 370,  826 => 369,  819 => 365,  814 => 363,  807 => 359,  802 => 357,  797 => 355,  791 => 354,  781 => 347,  777 => 346,  770 => 342,  765 => 340,  741 => 321,  732 => 315,  708 => 296,  699 => 290,  677 => 271,  668 => 265,  661 => 261,  656 => 259,  647 => 253,  642 => 251,  637 => 249,  629 => 244,  625 => 243,  619 => 240,  611 => 235,  605 => 234,  599 => 231,  593 => 230,  587 => 227,  579 => 222,  573 => 221,  567 => 218,  561 => 217,  555 => 214,  549 => 213,  543 => 210,  537 => 209,  531 => 206,  526 => 204,  520 => 203,  510 => 196,  500 => 192,  494 => 189,  482 => 185,  480 => 184,  477 => 183,  466 => 175,  462 => 174,  454 => 169,  450 => 168,  440 => 161,  435 => 159,  431 => 158,  425 => 155,  421 => 154,  416 => 152,  409 => 148,  400 => 142,  392 => 138,  390 => 137,  385 => 135,  374 => 131,  369 => 129,  360 => 125,  354 => 121,  348 => 118,  344 => 117,  341 => 116,  339 => 115,  336 => 114,  324 => 113,  320 => 112,  310 => 109,  306 => 108,  300 => 105,  296 => 104,  290 => 101,  286 => 100,  280 => 97,  276 => 96,  270 => 93,  266 => 92,  263 => 91,  257 => 88,  251 => 87,  248 => 86,  246 => 85,  239 => 82,  235 => 80,  232 => 79,  228 => 77,  225 => 76,  221 => 74,  218 => 73,  214 => 71,  212 => 70,  207 => 68,  194 => 64,  189 => 62,  182 => 59,  178 => 58,  172 => 55,  168 => 54,  156 => 45,  150 => 42,  144 => 39,  138 => 36,  132 => 33,  122 => 28,  118 => 26,  111 => 25,  102 => 21,  95 => 19,  85 => 12,  81 => 10,  74 => 9,  60 => 5,  56 => 1,  54 => 7,  52 => 3,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_invoice_invoice.html.twig", "/var/www/html/modules/Invoice/html_admin/mod_invoice_invoice.html.twig");
    }
}
