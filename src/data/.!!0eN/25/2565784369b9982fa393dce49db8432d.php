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

/* mod_currency_settings.html.twig */
class __TwigTemplate_35eb4487d48a303ca72e85065af2fc69 extends Template
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
        return $this->load((((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "ajax", [], "any", false, false, false, 1)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("layout_blank.html.twig") : ("layout_default.html.twig")), 1);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $macros["mf"] = $this->macros["mf"] = $this->load("macro_functions.html.twig", 3)->unwrap();
        // line 5
        $context["active_menu"] = "system";
        // line 6
        $context["params"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "extension_config_get", [["ext" => "mod_currency"]], "method", false, false, false, 6);
        // line 1
        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency settings"), "html", null, true);
        yield from [];
    }

    // line 10
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 11
        yield "    <ol class=\"breadcrumb\">
        <li class=\"breadcrumb-item\">
            <a href=\"";
        // line 13
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/");
        yield "\">
                <svg class=\"icon\">
                    <use xlink:href=\"#home\" />
                </svg>
            </a>
        </li>
        <li class=\"breadcrumb-item\">
            <a href=\"";
        // line 20
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("system");
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Settings"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency settings"), "html", null, true);
        yield "</li>
    </ol>
";
        yield from [];
    }

    // line 26
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 27
        yield "    <div class=\"card-tabs\">
        <ul class=\"nav nav-tabs\" role=\"tablist\">
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link active\" href=\"#tab-currencies\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currencies"), "html", null, true);
        yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-new-currency\" data-bs-toggle=\"tab\" role=\"tab\">
                    <svg class=\"icon me-2\">
                        <use xlink:href=\"#plus\" />
                    </svg>
                    ";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Add new currency"), "html", null, true);
        yield "
                </a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-api-settings\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Integrations / Automation"), "html", null, true);
        yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-converter\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Converter"), "html", null, true);
        yield "</a>
            </li>
        </ul>
        <div class=\"card\">
            <div class=\"tab-content\">
                <div class=\"tab-pane fade show active\" id=\"tab-currencies\" role=\"tabpanel\">
                    <div class=\"card-body border-bottom\">
                        <h3 class=\"card-title\">";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Manage currencies"), "html", null, true);
        yield "</h3>
                        <p class=\"card-subtitle\">";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The default currency is the one you define product pricing in. If your client chooses a different currency, pricing will be recalculated according to the conversion rate. Changing the default currency after orders have been placed may have unexpected issues. Nothing is recalculated on default currency change. Your income is calculated in the default currency. Changing the default currency after you have paid invoices will distort income statistics."), "html", null, true);
        yield "</p>
                    </div>
                    ";
        // line 54
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "sync_rate", [], "any", false, false, false, 54) != "never")) {
            // line 55
            yield "                        <div class=\"alert alert-success\" role=\"alert\">
                            ";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("FOSSBilling is configured to automatically sync currency exchange rates."), "html", null, true);
            yield "
                        </div>
                    ";
        } else {
            // line 59
            yield "                        <div class=\"alert alert-warning\" role=\"alert\">
                            ";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("FOSSBilling is not configured to automatically sync currency exchange rates."), "html", null, true);
            yield "
                        </div>
                    ";
        }
        // line 63
        yield "                    <div class=\"table-responsive\">
                        <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                            <thead>
                            <tr>
                                <th>";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("ISO code"), "html", null, true);
        yield "</th>
                                <th>";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
        yield "</th>
                                <th>";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Conversion rate"), "html", null, true);
        yield "</th>
                                <th>";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Example price"), "html", null, true);
        yield "</th>
                                <th class=\"w-1\"></th>
                            </tr>
                            </thead>
                            <tbody>
                            ";
        // line 75
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "currency_get_list", [], "any", false, false, false, 75), "list", [], "any", false, false, false, 75));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
            // line 76
            yield "                                <tr>
                                    <td>";
            // line 77
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "default", [], "any", false, false, false, 77)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<strong>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 77), "html", null, true);
                yield "</strong>";
            } else {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 77), "html", null, true);
            }
            yield "</td>
                                    <td>
                                        <a href=\"";
            // line 79
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/currency/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 79), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "title", [], "any", false, false, false, 79), "html", null, true);
            yield "</a>
                                    </td>
                                    <td>";
            // line 81
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "conversion_rate", [], "any", false, false, false, 81), "html", null, true);
            yield "</td>
                                    <td>";
            // line 82
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 82, $this->getSourceContext())->macro_currency_format(...[1]);
            yield " = ";
            yield $macros["mf"]->getTemplateForMacro("macro_currency", $context, 82, $this->getSourceContext())->macro_currency(...[1, CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 82)]);
            yield "</td>
                                    <td>
                                        <a class=\"btn btn-icon\" href=\"";
            // line 84
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/currency/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 84), "html", null, true);
            yield "\"
                                           data-bs-toggle=\"tooltip\" data-bs-title=\"";
            // line 85
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Edit"), "html", null, true);
            yield "\">
                                            <svg class=\"icon\">
                                                <use xlink:href=\"#edit\" />
                                            </svg>
                                        </a>
                                        <a class=\"btn btn-icon api-link\"
                                           href=\"";
            // line 91
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/currency/delete", ["code" => CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 91), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\"
                                           data-api-redirect=\"";
            // line 92
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("extension/settings/currency");
            yield "\"
                                           data-api-type=\"danger\"
                                           data-api-confirm=\"";
            // line 94
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure you want to delete?"), "html", null, true);
            yield "\"
                                           data-api-confirm-btn=\"";
            // line 95
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Delete"), "html", null, true);
            yield "\"
                                           data-bs-toggle=\"tooltip\" data-bs-title=\"";
            // line 96
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Delete"), "html", null, true);
            yield "\">
                                            <svg class=\"icon\">
                                                <use xlink:href=\"#delete\" />
                                            </svg>
                                        </a>
                                        ";
            // line 101
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "default", [], "any", false, false, false, 101)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 102
                yield "                                            <a class=\"btn btn-icon api-link\"
                                               data-api-redirect=\"";
                // line 103
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("extension/settings/currency");
                yield "\"
                                               href=\"";
                // line 104
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/currency/set_default", ["code" => CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 104), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
                yield "\"
                                               data-bs-toggle=\"tooltip\" data-bs-title=\"";
                // line 105
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Set as default"), "html", null, true);
                yield "\">
                                                <svg class=\"icon\">
                                                    <use xlink:href=\"#check\" />
                                                </svg>
                                            </a>
                                        ";
            }
            // line 111
            yield "                                    </td>
                                </tr>
                            ";
            $context['_iterated'] = true;
        }
        // line 113
        if (!$context['_iterated']) {
            // line 114
            yield "                                <tr>
                                    <td colspan=\"5\" class=\"text-muted\">";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                                </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['currency'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 118
        yield "                            </tbody>
                        </table>
                    </div>

                    <div class=\"card-footer text-center\">
                        <a class=\"btn btn-primary api-link\" href=\"";
        // line 123
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/currency/update_rates", ["CSRFToken" => ($context["CSRFToken"] ?? null)]);
        yield "\" data-api-redirect=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("extension/settings/currency");
        yield "\">
                            <svg class=\"icon icon-tabler\" width=\"24\" height=\"24\">
                                <use xlink:href=\"#refresh\" />
                            </svg>
                            <span>";
        // line 127
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update Rates"), "html", null, true);
        yield "</span>
                        </a>
                        ";
        // line 129
        if (((((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "provider", [], "any", true, true, false, 129)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "provider", [], "any", false, false, false, 129), "exchangerate-api")) : ("exchangerate-api")) == "exchangerate-api") &&  !CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "exchangerate_api_key", [], "any", false, false, false, 129))) {
            // line 130
            yield "                            <a href=\"https://www.exchangerate-api.com\" target=\"_blank\"><p class=\"mt-1 mb-0\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency exchange rates By ExchangeRate-API."), "html", null, true);
            yield "</p></a>
                        ";
        }
        // line 132
        yield "                    </div>
                </div>

                <div class=\"tab-pane fade\" id=\"tab-new-currency\" role=\"tabpanel\">
                    <form method=\"post\" action=\"";
        // line 136
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/currency/create");
        yield "\" class=\"api-form\" data-api-redirect=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("extension/settings/currency");
        yield "\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 137
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\">
                        <div class=\"card-body\">
                            <div class=\"form-group mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 140
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Code"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    ";
        // line 142
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 142, $this->getSourceContext())->macro_selectbox(...["code", CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "currency_get_pairs", [], "any", false, false, false, 142), "USD", 1]);
        yield "
                                </div>
                            </div>
                            <div class=\"form-group mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 146
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"title\" value=\"\" placeholder=\"";
        // line 148
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Leave blank to automatically set"), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"form-group mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 152
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Conversion rate"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"conversion_rate\" value=\"\" placeholder=\"";
        // line 154
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Leave blank to automatically set"), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"form-group mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 158
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Format"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"format\" value=\"\$ ";
        // line 160
        yield "{{price}}";
        yield "\" required>
                                </div>
                            </div>
                        </div>
                        <div class=\"card-footer text-end\">
                            <button class=\"btn btn-primary\" type=\"submit\">";
        // line 165
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Add"), "html", null, true);
        yield "</button>
                        </div>
                    </form>
                </div>

                <div class=\"tab-pane fade\" id=\"tab-api-settings\" role=\"tabpanel\">
                    <form method=\"post\" action=\"";
        // line 171
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/extension/config_save");
        yield "\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Successfully updated settings"), "html", null, true);
        yield "\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 172
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\">
                        <input type=\"hidden\" name=\"ext\" value=\"mod_currency\">
                        <div class=\"card-body\">
                            <h3 class=\"card-title\">";
        // line 175
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Available exchange rate data providers"), "html", null, true);
        yield "</h3>
                            <p>";
        // line 176
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("FOSSBilling provides integration with various currency exchange rate data providers, allowing you to choose whichever one best suits your needs. By default, FOSSBilling will use the ExchangeRate-API \"Open Access Endpoint\" which does not require any configuration."), "html", null, true);
        yield "</p>
                            <table class=\"table\">
                                <thead>
                                    <tr>
                                        <th>";
        // line 180
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Provider"), "html", null, true);
        yield "</th>
                                        <th>";
        // line 181
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Authentication Required"), "html", null, true);
        yield "</th>
                                        <th>";
        // line 182
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update Frequency"), "html", null, true);
        yield "</th>
                                        <th>";
        // line 183
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Supported Currencies"), "html", null, true);
        yield "</th>
                                        <th>";
        // line 184
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Pricing"), "html", null, true);
        yield "</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th><a href=\"https://www.exchangerate-api.com/docs/free\" target=\"_blank\">";
        // line 189
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("ExchangeRate-API (Open Access Endpoint)"), "html", null, true);
        yield "</a></th>
                                      <th>✖️</th>
                                      <th>";
        // line 191
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("1D"), "html", null, true);
        yield "</th>
                                      <th><a href=\"https://www.exchangerate-api.com/docs/supported-currencies\" target=\"_blank\">";
        // line 192
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Supported currencies"), "html", null, true);
        yield "</a></th>
                                      <th>";
        // line 193
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Free"), "html", null, true);
        yield "</th>
                                    </tr>
                                    <tr>
                                      <th><a href=\"https://www.exchangerate-api.com/#pricing\" target=\"_blank\">ExchangeRate-API</a></th>
                                      <th>☑️</th>
                                      <th>";
        // line 198
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("1D / 1H / 5M"), "html", null, true);
        yield "</th>
                                      <th><a href=\"https://www.exchangerate-api.com/docs/supported-currencies\" target=\"_blank\">";
        // line 199
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Supported currencies"), "html", null, true);
        yield "</a></th>
                                      <th>";
        // line 200
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Free / paid"), "html", null, true);
        yield "</th>
                                    </tr>
                                    <tr>
                                        <th><a href=\"https://apilayer.com/marketplace/currency_data-api\" target=\"_blank\">Currency Data API</a></th>
                                        <th>☑️</th>
                                        <th>";
        // line 205
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("1D / 1H / 10M / 1M"), "html", null, true);
        yield "</th>
                                        <th><a href=\"https://currencylayer.com/currencies\" target=\"_blank\">";
        // line 206
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Supported currencies"), "html", null, true);
        yield "</a></th>
                                        <th>";
        // line 207
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Free / paid"), "html", null, true);
        yield "</th>
                                    </tr>
                                    <tr>
                                        <th><a href=\"https://currencylayer.com/\" target=\"_blank\">currencylayer</a></th>
                                        <th>☑️</th>
                                        <th>";
        // line 212
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("1D / 1H / 10M / 1M"), "html", null, true);
        yield "</th>
                                        <th><a href=\"https://currencylayer.com/currencies\" target=\"_blank\">";
        // line 213
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Supported currencies"), "html", null, true);
        yield "</a></th>
                                        <th>";
        // line 214
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Free / paid"), "html", null, true);
        yield "</th>
                                    </tr>
                                  </tbody>                                    
                            </table>
                            <span class=\"text-muted\">";
        // line 218
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("When using ExchangeRate-API, their API informs FOSSBilling when the next update will occur which makes it more efficient for automated exchange rate syncing."), "html", null, true);
        yield "</span>
                            <br/>
                            <span class=\"text-muted\">";
        // line 220
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("To the best of our knowledge, \"Currency Data API\" and \"currencylayer\" are both owned by APILayer and provide the same data, but through a different API."), "html", null, true);
        yield "</span>
                            <div class=\"form-group mb-3 mt-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 222
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency exchange rate data provider"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <select class=\"form-select\" aria-label=\"";
        // line 224
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency data provider selection"), "html", null, true);
        yield "\" name=\"provider\" id=\"provider_select\">
                                        <option value=\"exchangerate-api\" selected>ExchangeRate-API</option>
                                        <option value=\"currency_data_api\">Currency Data API</option>
                                        <option value=\"currencylayer\">currencylayer</option>
                                    </select>
                                </div>
                            </div>
                            <div class=\"form-group mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 232
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("API key"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"exchangerate_api_key\" id=\"exchangerate_api\" value=\"";
        // line 234
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "exchangerate_api_key", [], "any", false, false, false, 234), "html", null, true);
        yield "\" hidden=\"true\">
                                    <input class=\"form-control\" type=\"text\" name=\"currencydata_key\" id=\"currencydata\" value=\"";
        // line 235
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "currencydata_key", [], "any", false, false, false, 235), "html", null, true);
        yield "\" hidden=\"true\">
                                    <input class=\"form-control\" type=\"text\" name=\"currencylayer_key\" id=\"currencylayer\" value=\"";
        // line 236
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "currencylayer_key", [], "any", false, false, false, 236), "html", null, true);
        yield "\"  hidden=\"true\">
                                    <span class=\"text-muted\" id=\"exchangerate_api_help_text\" hidden=\"true\">";
        // line 237
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Leave this blank to use the ExchangeRate-API \"Open Access Endpoint\"."), "html", null, true);
        yield "</span>
                                </div>
                            </div>
                            <div class=\"form-group mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 241
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Automatic sync rate"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <select class=\"form-select\" aria-label=\"";
        // line 243
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency data provider selection"), "html", null, true);
        yield "\" name=\"sync_rate\" id=\"sync_rate\">
                                        <option value=\"auto\" id=\"auto-sync\" selected>";
        // line 244
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Auto"), "html", null, true);
        yield "</option>
                                        <option value=\"never\">";
        // line 245
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Never"), "html", null, true);
        yield "</option>
                                        <option value=\"1d\">";
        // line 246
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Daily"), "html", null, true);
        yield "</option>
                                        <option value=\"1h\">";
        // line 247
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Hourly"), "html", null, true);
        yield "</option>
                                        <option value=\"10m\">";
        // line 248
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Every 10 minutes"), "html", null, true);
        yield "</option>
                                        <option value=\"5m\">";
        // line 249
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Every 5 minutes"), "html", null, true);
        yield "</option>
                                        <option value=\"1m\" id=\"1m-sync\">";
        // line 250
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Every minute"), "html", null, true);
        yield "</option>
                                    </select>
                                <p class=\"text-muted\">";
        // line 252
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("\"Auto\" is only available for ExchangeRate-API and when used will cause API requests to be made only when new data is made available, preventing excess requests."), "html", null, true);
        yield "</p>
                                <p class=\"text-muted\">";
        // line 253
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Exchange rate syncing runs via the cronjob and as such is limited by the frequency of your cron schedule (typically 5 minutes)."), "html", null, true);
        yield "</p>
                                </div>
                            </div>
                        </div>
                        <div class=\"card-footer text-end\">
                            <button class=\"btn btn-primary\" type=\"submit\">";
        // line 258
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
        yield "</button>
                        </div>
                    </form>
                </div>

                <div class=\"tab-pane fade\" id=\"tab-converter\" role=\"tabpanel\">
                    <form method=\"post\" action=\"\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 265
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                        <div class=\"card-body\">
                            <div class=\"input-group\">
                                <span class=\"input-group-text\">";
        // line 268
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "currency_get", [], "any", false, false, false, 268), "code", [], "any", false, false, false, 268), "html", null, true);
        yield "</span>
                                <input class=\"form-control\" type=\"text\" name=\"amount\" value=\"\" required placeholder=\"";
        // line 269
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Amount"), "html", null, true);
        yield "\" onkeyup=\"doConvert();\">
                                <span class=\"input-group-text\">=</span>
                                <input class=\"form-control\" type=\"text\" id=\"converted_result\" value=\"\" placeholder=\"";
        // line 271
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Result"), "html", null, true);
        yield "\" readonly>
                                <div>";
        // line 272
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 272, $this->getSourceContext())->macro_selectbox(...["to", CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "currency_get_pairs", [], "any", false, false, false, 272)]);
        yield "</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
";
        yield from [];
    }

    // line 282
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 283
        yield "<script>
    function doConvert() {
        var price = \$('input[name=\"amount\"]').val();
        var code = \$('select[name=\"to\"]').val();

        bb.post('guest/currency/format', { price: price, code: code, CSRFToken: \"";
        // line 288
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\" }, function(result) {
            \$('#converted_result').val(result);
        });

        return false;
    };

    function switchKeyBox(value){
        if(value === 'currencylayer'){
            document.getElementById(\"currencydata\").hidden = true;
            document.getElementById(\"currencylayer\").hidden = false;
            document.getElementById(\"exchangerate_api\").hidden = true;
            document.getElementById(\"exchangerate_api_help_text\").hidden = true;
            document.getElementById(\"auto-sync\").disabled = true;
            document.getElementById(\"1m-sync\").disabled = false;
        } else if(value === 'currency_data_api'){
            document.getElementById(\"currencydata\").hidden = false;
            document.getElementById(\"currencylayer\").hidden = true;
            document.getElementById(\"exchangerate_api\").hidden = true;
            document.getElementById(\"exchangerate_api_help_text\").hidden = true;
            document.getElementById(\"auto-sync\").disabled = true;
            document.getElementById(\"1m-sync\").disabled = false;
        } else {
            document.getElementById(\"currencydata\").hidden = true;
            document.getElementById(\"currencylayer\").hidden = true;
            document.getElementById(\"exchangerate_api\").hidden = false;
            document.getElementById(\"exchangerate_api_help_text\").hidden = false;
            document.getElementById(\"auto-sync\").disabled = false;
            document.getElementById(\"1m-sync\").disabled = true;
        }

        if(value === 'exchangerate-api'){
            if(document.getElementById(\"sync_rate\").value === '1m'){
                document.getElementById(\"sync_rate\").value = 'auto';
            }
        } else {
            if(document.getElementById(\"sync_rate\").value === 'auto'){
                document.getElementById(\"sync_rate\").value = '1d';
            }
        }
    }

    document.getElementById(\"provider_select\").onchange = function() {
        switchKeyBox(this.value);
    };
    document.addEventListener(\"DOMContentLoaded\", (event) => {
        document.getElementById(\"sync_rate\").value = \"";
        // line 334
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "sync_rate", [], "any", false, false, false, 334), "html", null, true);
        yield "\";
        document.getElementById(\"provider_select\").value = \"";
        // line 335
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "provider", [], "any", false, false, false, 335), "html", null, true);
        yield "\";
        switchKeyBox(\"";
        // line 336
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "provider", [], "any", false, false, false, 336), "html", null, true);
        yield "\");
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
        return "mod_currency_settings.html.twig";
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
        return array (  762 => 336,  758 => 335,  754 => 334,  705 => 288,  698 => 283,  691 => 282,  677 => 272,  673 => 271,  668 => 269,  664 => 268,  658 => 265,  648 => 258,  640 => 253,  636 => 252,  631 => 250,  627 => 249,  623 => 248,  619 => 247,  615 => 246,  611 => 245,  607 => 244,  603 => 243,  598 => 241,  591 => 237,  587 => 236,  583 => 235,  579 => 234,  574 => 232,  563 => 224,  558 => 222,  553 => 220,  548 => 218,  541 => 214,  537 => 213,  533 => 212,  525 => 207,  521 => 206,  517 => 205,  509 => 200,  505 => 199,  501 => 198,  493 => 193,  489 => 192,  485 => 191,  480 => 189,  472 => 184,  468 => 183,  464 => 182,  460 => 181,  456 => 180,  449 => 176,  445 => 175,  439 => 172,  433 => 171,  424 => 165,  416 => 160,  411 => 158,  404 => 154,  399 => 152,  392 => 148,  387 => 146,  380 => 142,  375 => 140,  369 => 137,  363 => 136,  357 => 132,  351 => 130,  349 => 129,  344 => 127,  335 => 123,  328 => 118,  319 => 115,  316 => 114,  314 => 113,  308 => 111,  299 => 105,  295 => 104,  291 => 103,  288 => 102,  286 => 101,  278 => 96,  274 => 95,  270 => 94,  265 => 92,  261 => 91,  252 => 85,  246 => 84,  239 => 82,  235 => 81,  226 => 79,  215 => 77,  212 => 76,  207 => 75,  199 => 70,  195 => 69,  191 => 68,  187 => 67,  181 => 63,  175 => 60,  172 => 59,  166 => 56,  163 => 55,  161 => 54,  156 => 52,  152 => 51,  142 => 44,  136 => 41,  129 => 37,  119 => 30,  114 => 27,  107 => 26,  99 => 22,  92 => 20,  82 => 13,  78 => 11,  71 => 10,  60 => 8,  56 => 1,  54 => 6,  52 => 5,  50 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_currency_settings.html.twig", "/var/www/html/modules/Currency/html_admin/mod_currency_settings.html.twig");
    }
}
