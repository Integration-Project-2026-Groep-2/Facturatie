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

/* mod_client_manage.html.twig */
class __TwigTemplate_3eb4b77ed30cffd38267179ca57d7144 extends Template
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
            'js' => [$this, 'block_js'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layout_default.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $macros["mf"] = $this->macros["mf"] = $this->load("macro_functions.html.twig", 3)->unwrap();
        // line 5
        $context["active_menu"] = "client";
        // line 1
        $this->parent = $this->load("layout_default.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "first_name", [], "any", false, false, false, 7), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "last_name", [], "any", false, false, false, 7), "html", null, true);
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
        yield "<ul class=\"breadcrumb\">
    <li class=\"breadcrumb-item\">
        <svg class=\"icon\">
            <use xlink:href=\"#home\" />
        </svg>
    </li>
    <li class=\"breadcrumb-item\">
        <a href=\"";
        // line 17
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Clients"), "html", null, true);
        yield "</a>
    </li>
    <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "first_name", [], "any", false, false, false, 19), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "last_name", [], "any", false, false, false, 19), "html", null, true);
        yield "</li>
</ul>
";
        yield from [];
    }

    // line 23
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 24
        yield "    <ul class=\"nav nav-tabs\" role=\"tablist\">
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link active\" href=\"#tab-info\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Profile"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-profile\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Edit"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-orders\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Orders"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-invoice\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-support\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tickets"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-balance\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Payments"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-history\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Logins"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-emails\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Emails"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-transactions\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Transactions"), "html", null, true);
        yield "</a>
        </li>
    </ul>

<div class=\"card\">
    <div class=\"tab-content\">
        <div class=\"tab-pane fade show active\" id=\"tab-info\" role=\"tabpanel\" aria-labelledby=\"index-tab\">
            <div class=\"card-body position-relative\">
                <span class=\"avatar avatar-xl mb-3 avatar-rounded shadow position-absolute top-0 end-0 m-3\" style=\"background-image: url(";
        // line 58
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_gravatar_filter(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "email", [], "any", false, false, false, 58)), "html", null, true);
        yield "&size=112)\"></span>

                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <tbody>
                        <tr>
                            <td class=\"w-50 text-end\">";
        // line 63
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client ID"), "html", null, true);
        yield ":</td>
                            <td>";
        // line 64
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 64), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <td class=\"text-end\">";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Name"), "html", null, true);
        yield ":</td>
                            <td><strong class=\"text-danger\">";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "first_name", [], "any", false, false, false, 68), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "last_name", [], "any", false, false, false, 68), "html", null, true);
        yield "</strong></td>
                        </tr>
                        <tr>
                            <td class=\"text-end\">";
        // line 71
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company"), "html", null, true);
        yield ":</td>
                            <td><strong class=\"text-success\">";
        // line 72
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "company", [], "any", true, true, false, 72)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "company", [], "any", false, false, false, 72), "-")) : ("-")), "html", null, true);
        yield "</strong></td>
                        </tr>
                        <tr>
                            <td class=\"text-end\">";
        // line 75
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
        yield ":</td>
                            <td>";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "email", [], "any", false, false, false, 76), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <td class=\"text-end\">";
        // line 79
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield ":</td>
                            <td>
                                ";
        // line 81
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "status", [], "any", false, false, false, 81) == "active")) {
            // line 82
            yield "                                    <span class=\"badge bg-success me-1\"></span>
                                ";
        }
        // line 84
        yield "                                ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "status", [], "any", false, false, false, 84) == "suspended")) {
            // line 85
            yield "                                    <span class=\"badge bg-danger me-1\"></span>
                                ";
        }
        // line 87
        yield "                                ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "status", [], "any", false, false, false, 87) == "canceled")) {
            // line 88
            yield "                                    <span class=\"badge bg-secondary me-1\"></span>
                                ";
        }
        // line 90
        yield "                                ";
        yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 90, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "status", [], "any", false, false, false, 90)]);
        yield "
                            </td>
                        </tr>
                        <tr>
                            <td class=\"text-end\">";
        // line 94
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Group"), "html", null, true);
        yield ":</td>
                            <td>";
        // line 95
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "group", [], "any", true, true, false, 95)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "group", [], "any", false, false, false, 95), "-")) : ("-")), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <td class=\"text-end\">";
        // line 98
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency"), "html", null, true);
        yield ":</td>
                            <td>";
        // line 99
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "currency", [], "any", true, true, false, 99)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "currency", [], "any", false, false, false, 99), "-")) : ("-")), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <td class=\"text-end\">";
        // line 102
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Fund balance"), "html", null, true);
        yield ":</td>
                            <td class=\"text-danger fw-bold\">";
        // line 103
        yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 103, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "balance", [], "any", false, false, false, 103), CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "currency", [], "any", false, false, false, 103)]);
        yield "</td>
                        </tr>
                        ";
        // line 105
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "notes", [], "any", false, false, false, 105)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 106
            yield "                        <tr>
                            <td class=\"text-end\">";
            // line 107
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Notes"), "html", null, true);
            yield ":</td>
                            <td>
                                <svg class=\"icon\">
                                    <use xlink:href=\"#support\" />
                                </svg>
                                <a href=\"#tab-profile\" data-bs-toggle=\"tab\" role=\"button\">";
            // line 112
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "notes", [], "any", false, false, false, 112), "html", null, true);
            yield "</a>
                            </td>
                        </tr>
                        ";
        }
        // line 116
        yield "                        <tr>
                            <td class=\"text-end\">IP:</td>
                            <td>";
        // line 118
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "ip", [], "any", false, false, false, 118)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield $this->extensions['Box_TwigExtensions']->ipLookupLink(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "ip", [], "any", false, false, false, 118));
        } else {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Unknown"), "html", null, true);
        }
        yield "</td>
                        </tr>
                        <tr>
                            <td class=\"text-end\">";
        // line 121
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("API Key"), "html", null, true);
        yield ":</td>
                            <td>";
        // line 122
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "api_token", [], "any", true, true, false, 122)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "api_token", [], "any", false, false, false, 122), "-")) : ("-")), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <td class=\"text-end\">";
        // line 125
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address"), "html", null, true);
        yield ":</td>
                            <td>
                                <span class=\"flag flag-country-";
        // line 127
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "country", [], "any", false, false, false, 127)), "html", null, true);
        yield "\" title=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v0 = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_countries", [], "any", false, false, false, 127)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "country", [], "any", false, false, false, 127)] ?? null) : null), "html", null, true);
        yield "\"></span>
                                ";
        // line 128
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v1 = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_countries", [], "any", false, false, false, 128)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1[CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "country", [], "any", false, false, false, 128)] ?? null) : null), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "state", [], "any", false, false, false, 128), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "address_1", [], "any", false, false, false, 128), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "address_2", [], "any", false, false, false, 128), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "city", [], "any", false, false, false, 128), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "postcode", [], "any", false, false, false, 128), "html", null, true);
        yield "
                            </td>
                        </tr>
                        <tr>
                            <td class=\"text-end\">";
        // line 132
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Registered on"), "html", null, true);
        yield ":</td>
                            <td>";
        // line 133
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "created_at", [], "any", false, false, false, 133)), "html", null, true);
        yield "</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class=\"card-footer text-center\">
                <a href=\"";
        // line 140
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/login");
        yield "/";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 140), "html", null, true);
        yield "\" class=\"btn btn-primary\" target=\"_blank\">
                    <svg class=\"icon\" width=\"24\" height=\"24\">
                        <use xlink:href=\"#login\" />
                    </svg>
                    <span>";
        // line 144
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Login to client area"), "html", null, true);
        yield "</span>
                </a>
                <a class=\"btn btn-danger api-link\"
                    href=\"";
        // line 147
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/client/delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 147), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
        yield "\"
                    data-api-confirm=\"";
        // line 148
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
        yield "\"
                    data-api-redirect=\"";
        // line 149
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
        yield "\">
                    <svg class=\"icon\" width=\"24\" height=\"24\">
                        <use xlink:href=\"#delete\" />
                    </svg>
                    <span>";
        // line 153
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Delete"), "html", null, true);
        yield "</span>
                </a>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-profile\" role=\"tabpanel\">
            <div class=\"card-body\">
                <h5>";
        // line 160
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client profile details"), "html", null, true);
        yield "</h5>
                <form method=\"post\" action=\"";
        // line 161
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/client/update");
        yield "\" class=\"api-form save\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client Profile updated"), "html", null, true);
        yield "\">
                    <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 162
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 164
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioStatusActive\" type=\"radio\" name=\"status\" value=\"active\"";
        // line 167
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "status", [], "any", false, false, false, 167) == "active")) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioStatusActive\">";
        // line 168
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Active"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioStatusSuspended\" type=\"radio\" name=\"status\" value=\"suspended\"";
        // line 171
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "status", [], "any", false, false, false, 171) == "suspended")) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioStatusSuspended\">";
        // line 172
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Suspended"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioStatusCanceled\" type=\"radio\" name=\"status\" value=\"canceled\"";
        // line 175
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "status", [], "any", false, false, false, 175) == "canceled")) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioStatusCanceled\">";
        // line 176
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Canceled"), "html", null, true);
        yield "</label>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 181
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Type"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioTypePersonal\" type=\"radio\" name=\"type\" value=\"individual\"";
        // line 184
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "type", [], "any", false, false, false, 184) == "individual")) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioTypePersonal\">";
        // line 185
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Individual"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioTypeCompany\" type=\"radio\" name=\"type\" value=\"company\"";
        // line 188
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "type", [], "any", false, false, false, 188) == "company")) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioTypeCompany\">";
        // line 189
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" =\"radioTypeOther\" type=\"radio\" name=\"type\" value=\"\"";
        // line 192
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "type", [], "any", false, false, false, 192)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioTypeOther\">";
        // line 193
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Other/Unknown"), "html", null, true);
        yield "</label>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 198
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Mail approved"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioEmailApprovedYes\" type=\"radio\" name=\"email_approved\" value=\"1\"";
        // line 201
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "email_approved", [], "any", false, false, false, 201) == 1)) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioEmailApprovedYes\">";
        // line 202
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioEmailApprovedNo\" type=\"radio\" name=\"email_approved\" value=\"0\"";
        // line 205
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "email_approved", [], "any", false, false, false, 205) != 1)) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioEmailApprovedNo\">";
        // line 206
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "</label>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 211
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Group"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            ";
        // line 213
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 213, $this->getSourceContext())->macro_selectbox(...["group_id", CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_group_get_pairs", [], "any", false, false, false, 213), CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "group_id", [], "any", false, false, false, 213), 0, __trans("Select group")]);
        yield "
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 217
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"email\" name=\"email\" value=\"";
        // line 219
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "email", [], "any", false, false, false, 219), "html", null, true);
        yield "\" required>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 223
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Name"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"row\">
                                <div class=\"col\">
                                    <input class=\"form-control\" type=\"text\" name=\"first_name\" value=\"";
        // line 227
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "first_name", [], "any", false, false, false, 227), "html", null, true);
        yield "\" required>
                                </div>
                                <div class=\"col\">
                                    <input class=\"form-control\" type=\"text\" name=\"last_name\" value=\"";
        // line 230
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "last_name", [], "any", false, false, false, 230), "html", null, true);
        yield "\">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\" for=\"birthday\">";
        // line 236
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Date of birth"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"input-group\">
                                <div class=\"input-icon w-100\">
                                    <input class=\"form-control datepicker\"
                                           id=\"birthday\"
                                           value=\"";
        // line 242
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "birthday", [], "any", false, false, false, 242), "html", null, true);
        yield "\"
                                           name=\"birthday\"
                                           data-pick-year=\"1\"
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
                    <div class=\"mb-3 row\" id=\"company-details\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 262
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company details"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"row\">
                                <div class=\"col\">
                                    <input class=\"form-control\" type=\"text\" name=\"company\" value=\"";
        // line 266
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "company", [], "any", false, false, false, 266), "html", null, true);
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company name"), "html", null, true);
        yield "\">
                                </div>
                                <div class=\"col\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_number\" value=\"";
        // line 269
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "company_number", [], "any", false, false, false, 269), "html", null, true);
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company number"), "html", null, true);
        yield "\">
                                </div>
                                <div class=\"col\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_vat\" value=\"";
        // line 272
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "company_vat", [], "any", false, false, false, 272), "html", null, true);
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company VAT number"), "html", null, true);
        yield "\">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class=\"btn btn-primary w-100\" type=\"submit\">";
        // line 277
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
        yield "</button>
                    <hr>

                    <h5>";
        // line 280
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address and contact details"), "html", null, true);
        yield "</h5>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 282
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address Line 1"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"address_1\" value=\"";
        // line 284
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "address_1", [], "any", false, false, false, 284), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 288
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address Line 2"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"address_2\" value=\"";
        // line 290
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "address_2", [], "any", false, false, false, 290), "html", null, true);
        yield "\">
                        </div>
                    </div>

                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 295
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Country"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            ";
        // line 297
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 297, $this->getSourceContext())->macro_selectbox(...["country", CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_countries", [], "any", false, false, false, 297), CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "country", [], "any", false, false, false, 297), 0, __trans("Select country")]);
        yield "
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 301
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("State"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            ";
        // line 304
        yield "                            <input class=\"form-control\" type=\"text\" name=\"state\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "state", [], "any", false, false, false, 304), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 308
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("City"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"city\" value=\"";
        // line 310
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "city", [], "any", false, false, false, 310), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 314
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Postcode"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"postcode\" value=\"";
        // line 316
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "postcode", [], "any", false, false, false, 316), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 320
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"input-group\">
                                <span class=\"input-group-text\">+</span>
                                <input class=\"form-control\" type=\"text\" name=\"phone_cc\" value=\"";
        // line 324
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "phone_cc", [], "any", false, false, false, 324), "html", null, true);
        yield "\">
                                <input class=\"form-control w-50\" type=\"phone\" name=\"phone\" value=\"";
        // line 325
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "phone", [], "any", false, false, false, 325), "html", null, true);
        yield "\">
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 330
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Passport number"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"document_nr\" value=\"";
        // line 332
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "document_nr", [], "any", false, false, false, 332), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <button class=\"btn btn-primary w-100\" type=\"submit\">";
        // line 335
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
        yield "</button>
                    <hr>

                    <h5>";
        // line 338
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Additional settings"), "html", null, true);
        yield "</h5>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 340
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Alternative ID"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"aid\" value=\"";
        // line 342
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "aid", [], "any", false, false, false, 342), "html", null, true);
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Used to identify client on foreign system. Usually used by importers"), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 346
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            ";
        // line 348
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 348, $this->getSourceContext())->macro_selectbox(...["currency", CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "currency_get_pairs", [], "any", false, false, false, 348), CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "currency", [], "any", false, false, false, 348), 0, __trans("Select currency")]);
        yield "
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 352
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Exempt from tax"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioTaxExemptYes\" type=\"radio\" name=\"tax_exempt\" value=\"1\"";
        // line 355
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "tax_exempt", [], "any", false, false, false, 355)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioTaxExemptYes\">";
        // line 356
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioTaxExemptNo\" type=\"radio\" name=\"tax_exempt\" value=\"0\"";
        // line 359
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "tax_exempt", [], "any", false, false, false, 359)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioTaxExemptNo\">";
        // line 360
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "</label>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\" for=\"created_at\">";
        // line 365
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Signed up time"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"input-group\">
                                <div class=\"input-icon w-100\">
                                    <input class=\"form-control datepicker\"
                                           id=\"created_at\"
                                           value=\"";
        // line 371
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "created_at", [], "any", false, false, false, 371), "Y-m-d"), "html", null, true);
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
                        <label class=\"form-label col-3 col-form-label\">";
        // line 390
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Notes"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <textarea class=\"form-control\" name=\"notes\" rows=\"5\">";
        // line 392
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "notes", [], "any", false, false, false, 392), "html", null, true);
        yield "</textarea>
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"id\" value=\"";
        // line 396
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 396), "html", null, true);
        yield "\">
                    <button class=\"btn btn-primary w-100\" type=\"submit\">";
        // line 397
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update profile"), "html", null, true);
        yield "</button>
                </form>
                <hr>

                <h5>";
        // line 401
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Change password"), "html", null, true);
        yield "</h5>
                <form method=\"post\" action=\"";
        // line 402
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/client/change_password");
        yield "\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Password changed"), "html", null, true);
        yield "\">
                    <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 403
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                    <div class=\"form-group mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 405
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Password"), "html", null, true);
        yield "</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"password\" name=\"password\" value=\"\" required>
                        </div>
                    </div>

                    <div class=\"form-group mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 412
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Password confirm"), "html", null, true);
        yield "</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"password\" name=\"password_confirm\" value=\"\" required>
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"id\" value=\"";
        // line 418
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 418), "html", null, true);
        yield "\">
                    <button class=\"btn btn-primary w-100\" type=\"submit\">";
        // line 419
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Change password"), "html", null, true);
        yield "</button>
                </form>
                <hr>

                <h5>";
        // line 423
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Custom fields"), "html", null, true);
        yield "</h5>
                <p class=\"text-muted\">";
        // line 424
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Use these fields to define custom client details"), "html", null, true);
        yield "</p>
                <form method=\"post\" action=\"";
        // line 425
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/client/update");
        yield "\" class=\"api-form save\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client Profile custom fields updated"), "html", null, true);
        yield "\">
                    <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 426
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                    ";
        // line 427
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(range(1, 10));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 428
            yield "                    ";
            $context["fn"] = ("custom_" . $context["i"]);
            // line 429
            yield "                    <div class=\"form-group mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
            // line 430
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Custom field"), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "</label>
                        <div class=\"col\">
                            <textarea class=\"form-control\" name=\"custom_";
            // line 432
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "\" rows=\"2\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v2 = ($context["client"] ?? null)) && is_array($_v2) || $_v2 instanceof ArrayAccess ? ($_v2[($context["fn"] ?? null)] ?? null) : null), "html", null, true);
            yield "</textarea>
                        </div>
                    </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 436
        yield "
                    <input type=\"hidden\" name=\"id\" value=\"";
        // line 437
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 437), "html", null, true);
        yield "\">
                    <button class=\"btn btn-primary w-100\" type=\"submit\">";
        // line 438
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
        yield "</button>
                </form>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-orders\" role=\"tabpanel\">
            <div class=\"card-body\">
                <h3>";
        // line 445
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client orders"), "html", null, true);
        yield "</h3>
            </div>

            <div class=\"table-responsive\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <thead>
                        <tr>
                            <th class=\"w-1\">#</th>
                            <th>";
        // line 453
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
        yield "</th>
                            <th>";
        // line 454
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Amount"), "html", null, true);
        yield "</th>
                            <th>";
        // line 455
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Period"), "html", null, true);
        yield "</th>
                            <th>";
        // line 456
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield "</th>
                            <th class=\"w-1\"></th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
        // line 461
        $context["orders"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "order_get_list", [["per_page" => "20", "client_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 461)]], "method", false, false, false, 461);
        // line 462
        yield "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["orders"] ?? null), "list", [], "any", false, false, false, 462));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 463
            yield "                        <tr>
                            <td>";
            // line 464
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 464), "html", null, true);
            yield "</td>
                            <td>
                                <a href=\"";
            // line 466
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/order/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 466), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "title", [], "any", false, false, false, 466), "html", null, true);
            yield "</a>
                            </td>
                            <td>";
            // line 468
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 468, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, $context["order"], "total", [], "any", false, false, false, 468), CoreExtension::getAttribute($this->env, $this->source, $context["order"], "currency", [], "any", false, false, false, 468)]);
            yield "</td>
                            <td>";
            // line 469
            yield $macros["mf"]->getTemplateForMacro("macro_period_name", $context, 469, $this->getSourceContext())->macro_period_name(...[CoreExtension::getAttribute($this->env, $this->source, $context["order"], "period", [], "any", false, false, false, 469)]);
            yield "</td>
                            <td>
                                ";
            // line 471
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["order"], "status", [], "any", false, false, false, 471) == "pending_setup")) {
                // line 472
                yield "                                    <span class=\"badge bg-warning me-1\"></span>
                                ";
            }
            // line 474
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["order"], "status", [], "any", false, false, false, 474) == "active")) {
                // line 475
                yield "                                    <span class=\"badge bg-success me-1\"></span>
                                ";
            }
            // line 477
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["order"], "status", [], "any", false, false, false, 477) == "suspended")) {
                // line 478
                yield "                                    <span class=\"badge bg-danger me-1\"></span>
                                ";
            }
            // line 480
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["order"], "status", [], "any", false, false, false, 480) == "canceled")) {
                // line 481
                yield "                                    <span class=\"badge bg-secondary me-1\"></span>
                                ";
            }
            // line 483
            yield "                                ";
            yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 483, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, $context["order"], "status", [], "any", false, false, false, 483)]);
            yield "
                            </td>
                            <td>
                                <a class=\"btn btn-icon\" href=\"";
            // line 486
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/order/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 486), "html", null, true);
            yield "\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#settings\" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        ";
            $context['_iterated'] = true;
        }
        // line 493
        if (!$context['_iterated']) {
            // line 494
            yield "                        <tr>
                            <td class=\"text-muted\" colspan=\"6\">";
            // line 495
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['order'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 498
        yield "                    </tbody>
                </table>
            </div>

            <div class=\"card-body\">
                <a href=\"";
        // line 503
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("order", ["client_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 503)]);
        yield "#tab-new\" class=\"btn btn-primary\">
                    <svg class=\"icon\">
                        <use xlink:href=\"#plus\" />
                    </svg>
                    ";
        // line 507
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("New order"), "html", null, true);
        yield "
                </a>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-invoice\" role=\"tabpanel\">
            <div class=\"card-body\">
                <h5>";
        // line 514
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client invoices"), "html", null, true);
        yield "</h5>
            </div>

            <div class=\"table-responsive\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <thead>
                        <tr>
                            <th class=\"w-1\">#</th>
                            <th>";
        // line 522
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Amount"), "html", null, true);
        yield "</th>
                            <th>";
        // line 523
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Issued on"), "html", null, true);
        yield "</th>
                            <th>";
        // line 524
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid on"), "html", null, true);
        yield "</th>
                            <th>";
        // line 525
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield "</th>
                            <th class=\"w-1\"></th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
        // line 530
        $context["invoices"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "invoice_get_list", [["per_page" => "100", "client_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 530)]], "method", false, false, false, 530);
        // line 531
        yield "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["invoices"] ?? null), "list", [], "any", false, false, false, 531));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 532
            yield "                        <tr>
                            <td>
                                <a href=\"";
            // line 534
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/invoice/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "id", [], "any", false, false, false, 534), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "serie_nr", [], "any", false, false, false, 534), "html", null, true);
            yield "</a>
                            </td>
                            <td>";
            // line 536
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 536, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "total", [], "any", false, false, false, 536), CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "currency", [], "any", false, false, false, 536)]);
            yield "</td>
                            <td>";
            // line 537
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "created_at", [], "any", false, false, false, 537)), "html", null, true);
            yield "</td>
                            <td>";
            // line 538
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "paid_at", [], "any", false, false, false, 538)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "paid_at", [], "any", false, false, false, 538)), "html", null, true);
            } else {
                yield "-";
            }
            yield "</td>
                            <td>
                                ";
            // line 540
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 540) == "paid")) {
                // line 541
                yield "                                    <span class=\"badge bg-success me-1\"></span>
                                ";
            }
            // line 543
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 543) == "unpaid")) {
                // line 544
                yield "                                    <span class=\"badge bg-danger me-1\"></span>
                                ";
            }
            // line 546
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 546) == "refunded")) {
                // line 547
                yield "                                    <span class=\"badge bg-warning me-1\"></span>
                                ";
            }
            // line 549
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 549) == "canceled")) {
                // line 550
                yield "                                    <span class=\"badge bg-secondary me-1\"></span>
                                ";
            }
            // line 552
            yield "                                ";
            yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 552, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 552)]);
            yield "
                            </td>
                            <td>
                                <a class=\"btn btn-icon\" href=\"";
            // line 555
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/invoice/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "id", [], "any", false, false, false, 555), "html", null, true);
            yield "\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#edit\" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        ";
            $context['_iterated'] = true;
        }
        // line 562
        if (!$context['_iterated']) {
            // line 563
            yield "                        <tr>
                            <td colspan=\"6\">";
            // line 564
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['invoice'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 567
        yield "                    </tbody>
                </table>

                <div class=\"card-body\">
                    <a class=\"btn btn-primary api-link\"
                        href=\"";
        // line 572
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/prepare", ["client_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 572), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
        yield "\"
                        data-api-jsonp=\"onAfterInvoicePrepared\">
                        <svg class=\"icon\">
                            <use xlink:href=\"#plus\" />
                        </svg>
                        ";
        // line 577
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("New invoice"), "html", null, true);
        yield "
                    </a>
                </div>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-support\" role=\"tabpanel\" aria-labelledby=\"support-tab\">
            <div class=\"card-body\">
                <h5>";
        // line 585
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client support tickets"), "html", null, true);
        yield "</h5>
            </div>

            <div class=\"table-responsive\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <thead>
                        <tr>
                            <th class=\"w-1\">#</th>
                            <th>";
        // line 593
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Help desk"), "html", null, true);
        yield "</th>
                            <th>";
        // line 594
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Subject"), "html", null, true);
        yield "</th>
                            <th>";
        // line 595
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield "</th>
                            <th class=\"w-1\"></th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
        // line 600
        $context["tickets"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "support_ticket_get_list", [["per_page" => "20", "client_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 600)]], "method", false, false, false, 600);
        // line 601
        yield "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["tickets"] ?? null), "list", [], "any", false, false, false, 601));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["ticket"]) {
            // line 602
            yield "                        <tr>
                            <td>";
            // line 603
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["ticket"], "id", [], "any", false, false, false, 603), "html", null, true);
            yield "</td>
                            <td>";
            // line 604
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["ticket"], "helpdesk", [], "any", false, false, false, 604), "name", [], "any", false, false, false, 604), "html", null, true);
            yield "</td>
                            <td>
                                <a href=\"";
            // line 606
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/support/ticket");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["ticket"], "id", [], "any", false, false, false, 606), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_truncate_filter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["ticket"], "subject", [], "any", false, false, false, 606), 30), "html", null, true);
            yield "</a>
                            </td>
                            <td>
                                ";
            // line 609
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["ticket"], "status", [], "any", false, false, false, 609) == "open")) {
                // line 610
                yield "                                    <span class=\"badge bg-success me-1\"></span>
                                ";
            }
            // line 612
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["ticket"], "status", [], "any", false, false, false, 612) == "on_hold")) {
                // line 613
                yield "                                    <span class=\"badge bg-warning me-1\"></span>
                                ";
            }
            // line 615
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["ticket"], "status", [], "any", false, false, false, 615) == "closed")) {
                // line 616
                yield "                                    <span class=\"badge bg-secondary me-1\"></span>
                                ";
            }
            // line 618
            yield "                                ";
            yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 618, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, $context["ticket"], "status", [], "any", false, false, false, 618)]);
            yield "
                            </td>
                            <td>
                                <a class=\"btn btn-icon\" href=\"";
            // line 621
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/support/ticket");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["ticket"], "id", [], "any", false, false, false, 621), "html", null, true);
            yield "\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#edit\" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        ";
            $context['_iterated'] = true;
        }
        // line 628
        if (!$context['_iterated']) {
            // line 629
            yield "                        <tr>
                            <td class=\"text-muted\" colspan=\"5\">";
            // line 630
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['ticket'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 633
        yield "                    </tbody>
                </table>
            </div>

            <div class=\"card-body\">
                <a href=\"";
        // line 638
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("support", ["client_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 638)]);
        yield "#tab-new\" class=\"btn btn-primary\">
                    <svg class=\"icon\">
                        <use xlink:href=\"#plus\" />
                    </svg>
                    ";
        // line 642
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("New support ticket"), "html", null, true);
        yield "
                </a>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-balance\" role=\"tabpanel\" aria-labelledby=\"balance-tab\">
            <div class=\"card-body\">
                <h5>";
        // line 649
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client payments history"), "html", null, true);
        yield "</h5>
            </div>

            <div class=\"table-responsive\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <thead>
                        <tr>
                            <th>";
        // line 656
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Amount"), "html", null, true);
        yield "</th>
                            <th>";
        // line 657
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Description"), "html", null, true);
        yield "</th>
                            <th>";
        // line 658
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Date"), "html", null, true);
        yield "</th>
                            <th class=\"w-1\"></th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
        // line 663
        $context["payments"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_balance_get_list", [["per_page" => 20, "client_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 663)]], "method", false, false, false, 663);
        // line 664
        yield "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["payments"] ?? null), "list", [], "any", false, false, false, 664));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["i"] => $context["tx"]) {
            // line 665
            yield "                        <tr>
                            <td>";
            // line 666
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 666, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "amount", [], "any", false, false, false, 666), CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "currency", [], "any", false, false, false, 666)]);
            yield "</td>
                            <td>";
            // line 667
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "description", [], "any", false, false, false, 667), "html", null, true);
            yield "</td>
                            <td>";
            // line 668
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "created_at", [], "any", false, false, false, 668)), "html", null, true);
            yield "</td>
                            <td>
                                <a class=\"btn btn-icon api-link\"
                                    href=\"";
            // line 671
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/client/balance_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "id", [], "any", false, false, false, 671), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\"
                                    data-api-confirm=\"";
            // line 672
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
            yield "\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#delete\" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        ";
            $context['_iterated'] = true;
        }
        // line 679
        if (!$context['_iterated']) {
            // line 680
            yield "                        <tr>
                            <td class=\"text-muted\" colspan=\"4\">";
            // line 681
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['i'], $context['tx'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 684
        yield "                    </tbody>
                </table>
            </div>
            <hr>

            <div class=\"card-body\">
                <h5>";
        // line 690
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Add funds for client"), "html", null, true);
        yield "</h5>
                <form class=\"api-form\"
                    method=\"post\"
                    action=\"";
        // line 693
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/client/balance_add_funds");
        yield "\"
                    data-api-msg=\"";
        // line 694
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Funds added"), "html", null, true);
        yield "\">
                    <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 695
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                    <div class=\"form-group mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\" for=\"inputAmount\">";
        // line 697
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Amount"), "html", null, true);
        yield ":</label>
                        <div class=\"col input-group\">
                            <input class=\"form-control\" type=\"text\" id=\"inputAmount\" name=\"amount\" required>
                            <span class=\"input-group-text\">";
        // line 700
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "currency", [], "any", false, false, false, 700), "html", null, true);
        yield "</span>
                        </div>
                    </div>

                    <div class=\"form-group mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\" for=\"inputDescription\">";
        // line 705
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Description"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" id=\"inputDescription\" type=\"text\" name=\"description\" required>
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"id\" value=\"";
        // line 711
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 711), "html", null, true);
        yield "\">

                    <div class=\"text-end\">
                        <button class=\"btn btn-primary\" type=\"submit\">
                            <svg class=\"icon\">
                                <use xlink:href=\"#plus\" />
                            </svg>
                            ";
        // line 718
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Add funds"), "html", null, true);
        yield "
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-history\" role=\"tabpanel\" aria-labelledby=\"history-tab\">
            <div class=\"card-body\">
                <h5>";
        // line 727
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Login history"), "html", null, true);
        yield "</h5>
            </div>

            <div class=\"table-responsive\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <thead>
                        <tr>
                            <th>";
        // line 734
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("IP"), "html", null, true);
        yield "</th>
                            <th>";
        // line 735
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Country"), "html", null, true);
        yield "</th>
                            <th>";
        // line 736
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Date"), "html", null, true);
        yield "</th>
                        </tr>
                    </thead>

                    <tbody>
                        ";
        // line 741
        $context["logins"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_login_history_get_list", [["per_page" => 10, "page" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "page", [], "any", false, false, false, 741), "client_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 741)]], "method", false, false, false, 741);
        // line 742
        yield "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["logins"] ?? null), "list", [], "any", false, false, false, 742));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["i"] => $context["login"]) {
            // line 743
            yield "                        <tr>
                            <td>";
            // line 744
            yield $this->extensions['Box_TwigExtensions']->ipLookupLink(CoreExtension::getAttribute($this->env, $this->source, $context["login"], "ip", [], "any", false, false, false, 744));
            yield "</td>
                            <td>";
            // line 745
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::default($this->extensions['Box_TwigExtensions']->twig_ipcountryname_filter(CoreExtension::getAttribute($this->env, $this->source, $context["login"], "ip", [], "any", false, false, false, 745)), __trans("Unknown")), "html", null, true);
            yield "</td>
                            <td>";
            // line 746
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["login"], "created_at", [], "any", false, false, false, 746)), "html", null, true);
            yield "</td>
                        </tr>
                        ";
            $context['_iterated'] = true;
        }
        // line 748
        if (!$context['_iterated']) {
            // line 749
            yield "                        <tr>
                            <td class=\"text-muted\" colspan=\"3\">";
            // line 750
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['i'], $context['login'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 753
        yield "                    </tbody>
                </table>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-emails\" role=\"tabpanel\" aria-labelledby=\"emails-tab\">
            <div class=\"card-body\">
                <h3>";
        // line 760
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Emails sent to client"), "html", null, true);
        yield "</h3>
            </div>

            <div class=\"table-responsive\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <thead>
                        <tr>
                            <th>";
        // line 767
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email subject"), "html", null, true);
        yield "</th>
                            <th>";
        // line 768
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("To"), "html", null, true);
        yield "</th>
                            <th>";
        // line 769
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Date"), "html", null, true);
        yield "</th>
                            <th class=\"w-1\"></th>
                        </tr>
                    </thead>

                    <tbody>
                        ";
        // line 775
        $context["emails"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "email_email_get_list", [["per_page" => "20", "client_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 775)]], "method", false, false, false, 775);
        // line 776
        yield "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["emails"] ?? null), "list", [], "any", false, false, false, 776));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["i"] => $context["email"]) {
            // line 777
            yield "                        <tr>
                            <td>";
            // line 778
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["email"], "subject", [], "any", false, false, false, 778), "html", null, true);
            yield "</td>
                            <td>";
            // line 779
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["email"], "recipients", [], "any", false, false, false, 779), "html", null, true);
            yield "</td>
                            <td>";
            // line 780
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["email"], "created_at", [], "any", false, false, false, 780)), "html", null, true);
            yield "</td>
                            <td>
                                <a class=\"btn btn-icon\" href=\"";
            // line 782
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("email");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["email"], "id", [], "any", false, false, false, 782), "html", null, true);
            yield "\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#edit\"></use>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        ";
            $context['_iterated'] = true;
        }
        // line 789
        if (!$context['_iterated']) {
            // line 790
            yield "                        <tr>
                            <td class=\"text-muted\" colspan=\"4\">";
            // line 791
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['i'], $context['email'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 794
        yield "                    </tbody>
                </table>
            </div>
            ";
        // line 797
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_pagination.html.twig", ["list" => ($context["emails"] ?? null)]);
        yield "
        </div>

        <div class=\"tab-pane fade\" id=\"tab-transactions\" role=\"tabpanel\" aria-labelledby=\"transactions-tab\">
            <div class=\"card-body\">
                <h5>";
        // line 802
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Transactions received"), "html", null, true);
        yield "</h5>
            </div>

            ";
        // line 805
        $context["transactions"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "invoice_transaction_get_list", [["client_id" => CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "id", [], "any", false, false, false, 805), "per_page" => 100]], "method", false, false, false, 805), "list", [], "any", false, false, false, 805);
        // line 806
        yield "            <div class=\"table-responsive\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <thead>
                        <tr>
                            <th>";
        // line 810
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("ID"), "html", null, true);
        yield "</th>
                            <th>";
        // line 811
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Type"), "html", null, true);
        yield "</th>
                            <th>";
        // line 812
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Gateway"), "html", null, true);
        yield "</th>
                            <th>";
        // line 813
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Amount"), "html", null, true);
        yield "</th>
                            <th>";
        // line 814
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield "</th>
                            <th>";
        // line 815
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Date"), "html", null, true);
        yield "</th>
                            <th class=\"w-1\"></th>
                        </tr>
                    </thead>
                    <tbody>
                    ";
        // line 820
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["transactions"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["i"] => $context["tx"]) {
            // line 821
            yield "                        <tr>
                            <td>";
            // line 822
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "txn_id", [], "any", false, false, false, 822), "html", null, true);
            yield "</td>
                            <td>";
            // line 823
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "type", [], "any", false, false, false, 823), "html", null, true);
            yield "</td>
                            <td>";
            // line 824
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "gateway", [], "any", false, false, false, 824), "html", null, true);
            yield "</td>
                            <td>";
            // line 825
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 825, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "amount", [], "any", false, false, false, 825), CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "currency", [], "any", false, false, false, 825)]);
            yield "</td>
                            <td>";
            // line 826
            yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 826, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "status", [], "any", false, false, false, 826)]);
            yield "</td>
                            <td>";
            // line 827
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "created_at", [], "any", false, false, false, 827)), "html", null, true);
            yield "</td>
                            <td>
                                <a class=\"btn btn-icon\" href=\"";
            // line 829
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/invoice/transaction");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "id", [], "any", false, false, false, 829), "html", null, true);
            yield "\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#edit\" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    ";
            $context['_iterated'] = true;
        }
        // line 836
        if (!$context['_iterated']) {
            // line 837
            yield "                        <tr>
                            <td class=\"text-muted\" colspan=\"7\">";
            // line 838
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['i'], $context['tx'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 841
        yield "                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
";
        yield from [];
    }

    // line 849
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 850
        yield "<script>
    function onAfterInvoicePrepared(id) {
        bb.redirect(\"";
        // line 852
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice/manage/");
        yield "/\" + id);
    }
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "mod_client_manage.html.twig";
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
        return array (  1895 => 852,  1891 => 850,  1884 => 849,  1873 => 841,  1864 => 838,  1861 => 837,  1859 => 836,  1845 => 829,  1840 => 827,  1836 => 826,  1832 => 825,  1828 => 824,  1824 => 823,  1820 => 822,  1817 => 821,  1812 => 820,  1804 => 815,  1800 => 814,  1796 => 813,  1792 => 812,  1788 => 811,  1784 => 810,  1778 => 806,  1776 => 805,  1770 => 802,  1762 => 797,  1757 => 794,  1748 => 791,  1745 => 790,  1743 => 789,  1729 => 782,  1724 => 780,  1720 => 779,  1716 => 778,  1713 => 777,  1707 => 776,  1705 => 775,  1696 => 769,  1692 => 768,  1688 => 767,  1678 => 760,  1669 => 753,  1660 => 750,  1657 => 749,  1655 => 748,  1648 => 746,  1644 => 745,  1640 => 744,  1637 => 743,  1631 => 742,  1629 => 741,  1621 => 736,  1617 => 735,  1613 => 734,  1603 => 727,  1591 => 718,  1581 => 711,  1572 => 705,  1564 => 700,  1558 => 697,  1553 => 695,  1549 => 694,  1545 => 693,  1539 => 690,  1531 => 684,  1522 => 681,  1519 => 680,  1517 => 679,  1505 => 672,  1501 => 671,  1495 => 668,  1491 => 667,  1487 => 666,  1484 => 665,  1478 => 664,  1476 => 663,  1468 => 658,  1464 => 657,  1460 => 656,  1450 => 649,  1440 => 642,  1433 => 638,  1426 => 633,  1417 => 630,  1414 => 629,  1412 => 628,  1398 => 621,  1391 => 618,  1387 => 616,  1384 => 615,  1380 => 613,  1377 => 612,  1373 => 610,  1371 => 609,  1361 => 606,  1356 => 604,  1352 => 603,  1349 => 602,  1343 => 601,  1341 => 600,  1333 => 595,  1329 => 594,  1325 => 593,  1314 => 585,  1303 => 577,  1295 => 572,  1288 => 567,  1279 => 564,  1276 => 563,  1274 => 562,  1260 => 555,  1253 => 552,  1249 => 550,  1246 => 549,  1242 => 547,  1239 => 546,  1235 => 544,  1232 => 543,  1228 => 541,  1226 => 540,  1217 => 538,  1213 => 537,  1209 => 536,  1200 => 534,  1196 => 532,  1190 => 531,  1188 => 530,  1180 => 525,  1176 => 524,  1172 => 523,  1168 => 522,  1157 => 514,  1147 => 507,  1140 => 503,  1133 => 498,  1124 => 495,  1121 => 494,  1119 => 493,  1105 => 486,  1098 => 483,  1094 => 481,  1091 => 480,  1087 => 478,  1084 => 477,  1080 => 475,  1077 => 474,  1073 => 472,  1071 => 471,  1066 => 469,  1062 => 468,  1053 => 466,  1048 => 464,  1045 => 463,  1039 => 462,  1037 => 461,  1029 => 456,  1025 => 455,  1021 => 454,  1017 => 453,  1006 => 445,  996 => 438,  992 => 437,  989 => 436,  977 => 432,  970 => 430,  967 => 429,  964 => 428,  960 => 427,  956 => 426,  950 => 425,  946 => 424,  942 => 423,  935 => 419,  931 => 418,  922 => 412,  912 => 405,  907 => 403,  901 => 402,  897 => 401,  890 => 397,  886 => 396,  879 => 392,  874 => 390,  852 => 371,  843 => 365,  835 => 360,  829 => 359,  823 => 356,  817 => 355,  811 => 352,  804 => 348,  799 => 346,  790 => 342,  785 => 340,  780 => 338,  774 => 335,  768 => 332,  763 => 330,  755 => 325,  751 => 324,  744 => 320,  737 => 316,  732 => 314,  725 => 310,  720 => 308,  712 => 304,  707 => 301,  700 => 297,  695 => 295,  687 => 290,  682 => 288,  675 => 284,  670 => 282,  665 => 280,  659 => 277,  649 => 272,  641 => 269,  633 => 266,  626 => 262,  603 => 242,  594 => 236,  585 => 230,  579 => 227,  572 => 223,  565 => 219,  560 => 217,  553 => 213,  548 => 211,  540 => 206,  534 => 205,  528 => 202,  522 => 201,  516 => 198,  508 => 193,  502 => 192,  496 => 189,  490 => 188,  484 => 185,  478 => 184,  472 => 181,  464 => 176,  458 => 175,  452 => 172,  446 => 171,  440 => 168,  434 => 167,  428 => 164,  423 => 162,  417 => 161,  413 => 160,  403 => 153,  396 => 149,  392 => 148,  388 => 147,  382 => 144,  373 => 140,  363 => 133,  359 => 132,  342 => 128,  336 => 127,  331 => 125,  325 => 122,  321 => 121,  311 => 118,  307 => 116,  300 => 112,  292 => 107,  289 => 106,  287 => 105,  282 => 103,  278 => 102,  272 => 99,  268 => 98,  262 => 95,  258 => 94,  250 => 90,  246 => 88,  243 => 87,  239 => 85,  236 => 84,  232 => 82,  230 => 81,  225 => 79,  219 => 76,  215 => 75,  209 => 72,  205 => 71,  197 => 68,  193 => 67,  187 => 64,  183 => 63,  175 => 58,  164 => 50,  158 => 47,  152 => 44,  146 => 41,  140 => 38,  134 => 35,  128 => 32,  122 => 29,  116 => 26,  112 => 24,  105 => 23,  95 => 19,  88 => 17,  79 => 10,  72 => 9,  59 => 7,  54 => 1,  52 => 5,  50 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_client_manage.html.twig", "/var/www/html/modules/Client/html_admin/mod_client_manage.html.twig");
    }
}
