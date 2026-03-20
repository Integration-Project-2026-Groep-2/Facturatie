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

/* mod_system_settings.html.twig */
class __TwigTemplate_6ea42566d0866a61dc7886e6b93c19a2 extends Template
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
            'head' => [$this, 'block_head'],
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("System settings"), "html", null, true);
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
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("system");
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Settings"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("System settings"), "html", null, true);
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
        yield "    ";
        $context["new_params"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "extension_config_get", [["ext" => "mod_system"]], "method", false, false, false, 26);
        // line 27
        yield "    ";
        $context["params"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_get_params", [], "any", false, false, false, 27);
        // line 28
        yield "    ";
        $context["environment"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_env", [], "any", false, false, false, 28);
        // line 29
        yield "    ";
        $context["external_ip"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_env", [["ip" => true]], "method", false, false, false, 29);
        // line 30
        yield "    <div class=\"card-tabs\">
        <ul class=\"nav nav-tabs\" role=\"tablist\">
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link active\" href=\"#tab-index\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company details"), "html", null, true);
        yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#company-legal\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company legal"), "html", null, true);
        yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-countries\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Countries"), "html", null, true);
        yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-cache\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Cache"), "html", null, true);
        yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-about\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("About"), "html", null, true);
        yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-reporting\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Error reporting"), "html", null, true);
        yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#network-interface\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Network interface"), "html", null, true);
        yield "</a>
            </li>
        </ul>

        <div class=\"card\">
            <div class=\"tab-content\">
                <div class=\"tab-pane fade show active\" id=\"tab-index\" role=\"tabpanel\">
                    <form method=\"post\" action=\"";
        // line 58
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/update_params");
        yield "\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company updated"), "html", null, true);
        yield "\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\">
                        <div class=\"card-body\">
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 62
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Name"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_name\" value=\"";
        // line 64
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_name", [], "any", false, false, false, 64), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_email\" value=\"";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_email", [], "any", false, false, false, 70), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_tel\" value=\"";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_tel", [], "any", false, false, false, 76), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control mb-2\" type=\"text\" name=\"company_address_1\" value=\"";
        // line 82
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_address_1", [], "any", false, false, false, 82), "html", null, true);
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address line 1"), "html", null, true);
        yield "\">
                                    <input class=\"form-control mb-2\" type=\"text\" name=\"company_address_2\" value=\"";
        // line 83
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_address_2", [], "any", false, false, false, 83), "html", null, true);
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address line 2"), "html", null, true);
        yield "\">
                                    <input class=\"form-control mb-2\" type=\"text\" name=\"company_address_3\" value=\"";
        // line 84
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_address_3", [], "any", false, false, false, 84), "html", null, true);
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address line 3"), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 88
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Logo URL"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_logo\" value=\"";
        // line 90
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_logo", [], "any", false, false, false, 90), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 94
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Logo URL (dark mode)"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_logo_dark\" value=\"";
        // line 96
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_logo_dark", [], "any", false, false, false, 96), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 100
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Favicon"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_favicon\" value=\"";
        // line 102
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_favicon", [], "any", false, false, false, 102), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 106
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company number, chamber of commerce number"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_number\" value=\"";
        // line 108
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_number", [], "any", false, false, false, 108), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 112
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("VAT number"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_vat_number\" value=\"";
        // line 114
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_vat_number", [], "any", false, false, false, 114), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 118
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Bank Name"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_bank_name\" value=\"";
        // line 120
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_bank_name", [], "any", false, false, false, 120), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 124
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("BIC / SWIFT Code"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_bic\" value=\"";
        // line 126
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_bic", [], "any", false, false, false, 126), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 130
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Bank Account number"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"company_account_number\" value=\"";
        // line 132
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_account_number", [], "any", false, false, false, 132), "html", null, true);
        yield "\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 136
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Display bank account information on documents?"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" type=\"radio\" name=\"company_display_bank_info\" id=\"display_bank_info_yes\" value=\"1\" ";
        // line 139
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_display_bank_info", [], "any", false, false, false, 139) == "1")) {
            yield "checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"display_bank_info_yes\">";
        // line 140
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "</label>
                                    </div>
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" type=\"radio\" name=\"company_display_bank_info\" id=\"display_bank_info_no\" value=\"0\" ";
        // line 143
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_display_bank_info", [], "any", false, false, false, 143) == "0")) {
            yield "checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"display_bank_info_no\">";
        // line 144
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "</label>
                                    </div>
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 149
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Display bank account information on the bottom of every page?"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" type=\"radio\" name=\"company_bank_info_pagebottom\" id=\"company_bank_info_pagebottom_yes\" value=\"1\" ";
        // line 152
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_bank_info_pagebottom", [], "any", false, false, false, 152) == "1")) {
            yield "checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"company_bank_info_pagebottom_yes\">";
        // line 153
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "</label>
                                    </div>
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" type=\"radio\" name=\"company_bank_info_pagebottom\" id=\"company_bank_info_pagebottom_no\" value=\"0\" ";
        // line 156
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_bank_info_pagebottom", [], "any", false, false, false, 156) == "0")) {
            yield "checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"company_bank_info_pagebottom_no\">";
        // line 157
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "</label>
                                    </div>
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"form-label col-3 col-form-label\">
                                    ";
        // line 163
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Disallow guest API to fetch FOSSBilling version"), "html", null, true);
        yield "
                                    <br/>
                                    <small class=\"text-muted\">";
        // line 165
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enabling this functionality may affect modules that depend on it."), "html", null, true);
        yield "</small>
                                </label>
                                <div class=\"col\">
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radio_showPublicYes\" type=\"radio\" name=\"hide_version_public\" value=\"1\" ";
        // line 169
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "hide_version_public", [], "any", false, false, false, 169) == "1")) {
            yield "checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"radio_showPublicYes\">
                                            ";
        // line 171
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "
                                        </label>
                                    </div>
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radio_showPublicNo\" type=\"radio\" name=\"hide_version_public\" value=\"0\" ";
        // line 175
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "hide_version_public", [], "any", false, false, false, 175) == "0")) {
            yield "checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"radio_showPublicNo\">
                                            ";
        // line 177
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"form-label col-3 col-form-label\">
                                    ";
        // line 184
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Hide some company information in the guest API"), "html", null, true);
        yield "
                                    <br/>
                                    <small class=\"text-muted\">";
        // line 186
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enabling this will hide some information from the \"company\" guest API endpoint such as the address, phone number, email, VAT number, and more."), "html", null, true);
        yield "</small>
                                </label>
                                <div class=\"col\">
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radio_showCompanyPublicYes\" type=\"radio\" name=\"hide_company_public\" value=\"1\" ";
        // line 190
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "hide_company_public", [], "any", false, false, false, 190) == "1")) {
            yield "checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"radio_showCompanyublicYes\">
                                            ";
        // line 192
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "
                                        </label>
                                    </div>
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radio_showCompanyPublicNo\" type=\"radio\" name=\"hide_company_public\" value=\"0\" ";
        // line 196
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "hide_company_public", [], "any", false, false, false, 196) == "0")) {
            yield "checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"radio_showCompanyPublicNo\">
                                            ";
        // line 198
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 204
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Signature"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <textarea class=\"form-control\" name=\"company_signature\" rows=\"2\">";
        // line 206
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_signature", [], "any", false, false, false, 206), "html", null, true);
        yield "</textarea>
                                </div>
                            </div>
                        </div>
                        <div class=\"card-footer text-end\">
                            <button class=\"btn btn-primary\" type=\"submit\">";
        // line 211
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update settings"), "html", null, true);
        yield "</button>
                        </div>
                    </form>
                </div>

                <div class=\"tab-pane fade\" id=\"company-legal\" role=\"tabpanel\">
                    <form method=\"post\" action=\"";
        // line 217
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/update_params");
        yield "\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company updated"), "html", null, true);
        yield "\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 218
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\">
                        <div class=\"card-body\">
                            <div class=\"mb-3\">
                                <h3>";
        // line 221
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company terms of service, legal regulation"), "html", null, true);
        yield "</h3>
                                <textarea class=\"form-control bb-textarea\" name=\"company_tos\" rows=\"5\">";
        // line 222
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_tos", [], "any", false, false, false, 222), "html", null, true);
        yield "</textarea>
                            </div>
                            <div class=\"mb-3\">
                                <h3>";
        // line 225
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company privacy policy"), "html", null, true);
        yield "</h3>
                                <textarea class=\"form-control bb-textarea\" name=\"company_privacy_policy\" rows=\"5\">";
        // line 226
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_privacy_policy", [], "any", false, false, false, 226), "html", null, true);
        yield "</textarea>
                            </div>
                            <div class=\"mb-3\">
                                <h3>";
        // line 229
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Notes"), "html", null, true);
        yield "</h3>
                                <textarea class=\"form-control bb-textarea\" name=\"company_note\" rows=\"5\">";
        // line 230
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "company_note", [], "any", false, false, false, 230), "html", null, true);
        yield "</textarea>
                            </div>
                        </div>
                        <div class=\"card-footer text-end\">
                            <button class=\"btn btn-primary\" type=\"submit\">";
        // line 234
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update settings"), "html", null, true);
        yield "</button>
                        </div>
                    </form>
                </div>

                <div class=\"tab-pane fade\" id=\"tab-countries\" role=\"tabpanel\">
                    <form method=\"post\" action=\"";
        // line 240
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/extension/config_save");
        yield "\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Countries updated"), "html", null, true);
        yield "\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 241
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\">
                        <input type=\"hidden\" name=\"ext\" value=\"mod_system\">
                        <div class=\"card-body\">
";
        // line 244
        $context["default_countries"] = new Markup("AF=Afghanistan
AX=Aland Islands
AL=Albania
DZ=Algeria
AS=American Samoa
AD=Andorra
AO=Angola
AI=Anguilla
AQ=Antarctica
AG=Antigua and Barbuda
AR=Argentina
AM=Armenia
AW=Aruba
AU=Australia
AT=Austria
AZ=Azerbaijan
BS=Bahamas
BH=Bahrain
BD=Bangladesh
BB=Barbados
BY=Belarus
BE=Belgium
BZ=Belize
BJ=Benin
BM=Bermuda
BT=Bhutan
BO=Bolivia
BQ=Bonaire, Sint Eustatius and Saba
BA=Bosnia and Herzegovina
BW=Botswana
BR=Brazil
IO=British Indian Ocean Territory
VG=British Virgin Islands
BN=Brunei
BG=Bulgaria
BF=Burkina Faso
BI=Burundi
CV=Cabo Verde
KH=Cambodia
CM=Cameroon
CA=Canada
KY=Cayman Islands
CF=Central African Republic
TD=Chad
CL=Chile
CN=China
CX=Christmas Island
CC=Cocos (Keeling) Islands
CO=Colombia
KM=Comoros
CD=Congo (Democratic Republic of the)
CG=Congo (Republic of the)
CK=Cook Islands
CR=Costa Rica
CI=Cote D'Ivoire
HR=Croatia
CU=Cuba
CW=Curacao
CY=Cyprus
CZ=Czechia
DK=Denmark
DJ=Djibouti
DM=Dominica
DO=Dominican Republic
EC=Ecuador
EG=Egypt
SV=El Salvador
GQ=Equatorial Guinea
ER=Eritrea
EE=Estonia
SZ=Eswatini
ET=Ethiopia
FK=Falkland Islands (Islas Malvinas)
FO=Faroe Islands
FJ=Fiji
FI=Finland
FR=France
GF=French Guiana
PF=French Polynesia
TF=French Southern Territories
GA=Gabon
GM=Gambia
GE=Georgia
DE=Germany
GH=Ghana
GI=Gibraltar
GR=Greece
GL=Greenland
GD=Grenada
GP=Guadeloupe
GU=Guam
GT=Guatemala
GG=Guernsey
GN=Guinea
GW=Guinea-Bissau
GY=Guyana
HT=Haiti
HN=Honduras
HK=Hong Kong
HU=Hungary
IS=Iceland
IN=India
ID=Indonesia
IR=Iran
IQ=Iraq
IE=Ireland
IM=Isle of Man
IL=Israel
IT=Italy
JM=Jamaica
JP=Japan
JE=Jersey
JO=Jordan
KZ=Kazakhstan
KE=Kenya
KI=Kiribati
KW=Kuwait
KG=Kyrgyzstan
LA=Laos
LV=Latvia
LB=Lebanon
LS=Lesotho
LR=Liberia
LY=Libya
LI=Liechtenstein
LT=Lithuania
LU=Luxembourg
MO=Macau
MG=Madagascar
MW=Malawi
MY=Malaysia
MV=Maldives
ML=Mali
MT=Malta
MH=Marshall Islands
MQ=Martinique
MR=Mauritania
MU=Mauritius
YT=Mayotte
MX=Mexico
FM=Micronesia
MD=Moldova
MC=Monaco
MN=Mongolia
ME=Montenegro
MS=Montserrat
MA=Morocco
MZ=Mozambique
MM=Myanmar (Burma)
NA=Namibia
NR=Nauru
NP=Nepal
NL=Netherlands
NC=New Caledonia
NZ=New Zealand
NI=Nicaragua
NE=Niger
NG=Nigeria
NU=Niue
NF=Norfolk Island
KP=North Korea
MK=North Macedonia
MP=Northern Mariana Islands
NO=Norway
OM=Oman
PK=Pakistan
PW=Palau
PS=Palestine
PA=Panama
PG=Papua New Guinea
PY=Paraguay
PE=Peru
PH=Philippines
PN=Pitcairn Islands
PL=Poland
PT=Portugal
PR=Puerto Rico
QA=Qatar
RE=Reunion
RO=Romania
RU=Russia
RW=Rwanda
BL=Saint Barthelemy
SH=Saint Helena, Ascension and Tristan da Cunha
KN=Saint Kitts And Nevis
LC=Saint Lucia
MF=Saint Martin
VC=Saint Vincent and the Grenadines
PM=Saint Pierre And Miquelon
WS=Samoa
SM=San Marino
ST=Sao Tome And Principe
SA=Saudi Arabia
SN=Senegal
RS=Serbia
SC=Seychelles
SL=Sierra Leone
SG=Singapore
SX=Sint Maarten
SK=Slovakia
SI=Slovenia
SB=Solomon Islands
SO=Somalia
ZA=South Africa
KR=South Korea
ES=Spain
LK=Sri Lanka
SD=Sudan
SR=Suriname
SJ=Svalbard and Jan Mayen
SE=Sweden
CH=Switzerland
SY=Syria
TW=Taiwan
TJ=Tajikistan
TZ=Tanzania
TH=Thailand
TP=Timor-Leste
TG=Togo
TK=Tokelau
TO=Tonga
TT=Trinidad and Tobago
TN=Tunisia
TR=Turkey
TM=Turkmenistan
TC=Turks and Caicos Islands
TV=Tuvalu
UG=Uganda
UA=Ukraine
AE=United Arab Emirates
GB=United Kingdom
US=United States
UM=United States Minor Outlying Islands
UY=Uruguay
UZ=Uzbekistan
VU=Vanuatu
VA=Vatican City
VE=Venezuela
VN=Vietnam
VI=Virgin Islands (U.S.)
WF=Wallis and Futuna
EH=Western Sahara
YE=Yemen
ZM=Zambia
ZW=Zimbabwe
", $this->env->getCharset());
        // line 491
        yield "                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 492
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("List of countries"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <textarea class=\"form-control\" name=\"countries\" rows=\"25\" placeholder=\"US=United States\">";
        // line 494
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["new_params"] ?? null), "countries", [], "any", true, true, false, 494)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["new_params"] ?? null), "countries", [], "any", false, false, false, 494), ($context["default_countries"] ?? null))) : (($context["default_countries"] ?? null))), "html", null, true);
        yield "</textarea>
                                </div>
                            </div>
                        </div>
                        <div class=\"card-footer text-end\">
                            <button class=\"btn btn-primary\" type=\"submit\">";
        // line 499
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update settings"), "html", null, true);
        yield "</button>
                        </div>
                    </form>
                </div>

                <div class=\"tab-pane fade\" id=\"tab-cache\" role=\"tabpanel\">
                    <div class=\"card-header\">
                        <h3 class=\"card-title\">";
        // line 506
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Cache control"), "html", null, true);
        yield "</h3>
                        <div class=\"card-actions\">
                            <form method=\"post\" action=\"";
        // line 508
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/clear_cache");
        yield "\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Cache directory is cleared"), "html", null, true);
        yield "\">
                                <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 509
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                                <button class=\"btn btn-danger\" type=\"submit\">";
        // line 510
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invalidate cache"), "html", null, true);
        yield "</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class=\"tab-pane fade\" id=\"tab-about\" role=\"tabpanel\">
                    <div class=\"card-header\">
                        <h3 class=\"card-title\">";
        // line 518
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("About FOSSBilling"), "html", null, true);
        yield "</h3>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"datagrid\">
                            <div class=\"datagrid-item\">
                                <div class=\"datagrid-title\">";
        // line 523
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("FOSSBilling version"), "html", null, true);
        yield "</div>
                                <div class=\"datagrid-content\">";
        // line 524
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["FOSSBillingVersion"] ?? null), "html", null, true);
        yield "</div>
                            </div>
                            <div class=\"datagrid-item\">
                                <div class=\"datagrid-title\">";
        // line 527
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("PHP version"), "html", null, true);
        yield "</div>
                                <div class=\"datagrid-content\">";
        // line 528
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::constant("PHP_VERSION"), "html", null, true);
        yield "</div>
                            </div>
                            <div class=\"datagrid-item\">
                                <div class=\"datagrid-title\">";
        // line 531
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Instance ID"), "html", null, true);
        yield " (<a href=\"https://fossbilling.org/docs/faq/error-reporting#what-is-the-instance-id-and-where-do-i-find-it\" target=\"_blank\">?</a>)</div>
                                <div class=\"datagrid-content\">";
        // line 532
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_instance_id", [], "any", false, false, false, 532), "html", null, true);
        yield "</div>
                            </div>
                            <div class=\"datagrid-item\">
                                <div class=\"datagrid-title\">";
        // line 535
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("License"), "html", null, true);
        yield "</div>
                                <div class=\"datagrid-content\"><a href=\"https://github.com/FOSSBilling/FOSSBilling/blob/main/LICENSE\" target=\"_blank\">Apache 2.0</a></div>
                            </div>
                        </div>

                        <div class=\"accordion mt-4\" id=\"accordion-default\">
                            <div class=\"accordion-item\">
                                <div class=\"accordion-header\">
                                <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#collapse-1-default\" aria-expanded=\"false\">
                                    ";
        // line 544
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enabled modules"), "html", null, true);
        yield "
                                    <div class=\"accordion-button-toggle\">
                                        <svg class=\"icon\">
                                            <use xlink:href=\"#chevron-down\" />
                                        </svg>
                                    </div>
                                </button>
                                </div>
                                <div id=\"collapse-1-default\" class=\"accordion-collapse collapse\" data-bs-parent=\"#accordion-default\">
                                    <div class=\"accordion-body\">
                                        <div class=\"container\">
                                            <div style=\"column-count: 3; column-gap: 2rem;\">
                                                ";
        // line 556
        $context["modules"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "extension_get_list", [["active" => true]], "method", false, false, false, 556);
        // line 557
        yield "                                                ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
            // line 558
            yield "                                                <div class=\"border rounded px-3 py-2 mb-2 d-flex justify-content-between align-items-center\">
                                                    <span>
                                                    ";
            // line 560
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["module"], "status", [], "any", false, false, false, 560) == "core")) {
                // line 561
                yield "                                                        <svg class=\"icon\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("This is a core module included with FOSSBilling and cannot be disabled."), "html", null, true);
                yield "\">
                                                            <use xlink:href=\"#cog\" />
                                                        </svg>
                                                    ";
            }
            // line 565
            yield "                                                    <span title=\"Module ID: ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["module"], "id", [], "any", false, false, false, 565), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 565), "html", null, true);
            yield "</span>
                                                    </span>
                                                    <span class=\"badge bg-default text-default-fg\">";
            // line 567
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["module"], "version", [], "any", false, false, false, 567), "html", null, true);
            yield "</span>
                                                </div>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['module'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 570
        yield "                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class=\"tab-pane fade\" id=\"tab-reporting\" role=\"tabpanel\">
                    <div class=\"card-header\">
                        <h3 class=\"card-title\">";
        // line 582
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Error reporting"), "html", null, true);
        yield "</h3>
                    </div>
                    <div class=\"card-body\">
                        ";
        // line 585
        $context["last_change"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_last_error_reporting_change", [], "any", false, false, false, 585);
        // line 586
        yield "                        ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_error_reporting_enabled", [], "any", false, false, false, 586)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 587
            yield "                            <div class=\"alert alert-success\" role=\"alert\">
                                <p>";
            // line 588
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Error reporting is enabled."), "html", null, true);
            yield "</p>
                                <p>";
            // line 589
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("This FOSSBilling instance is automatically sending error reports which allows us to more easily improve the software and keep it stable. Thanks!"), "html", null, true);
            yield "</p>
                                <a class=\"btn btn-danger api-link\" href=\"";
            // line 590
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/toggle_error_reporting", ["CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\" data-api-msg=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Error reporting is now disabled."), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Disable error reporting"), "html", null, true);
            yield "</a>
                            </div>
                        ";
        } else {
            // line 593
            yield "                            <div class=\"alert alert-danger\" role=\"alert\">
                                <p>";
            // line 594
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Error reporting is disabled."), "html", null, true);
            yield "</p>
                                <p>";
            // line 595
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Please consider enabling error reporting. Doing so allows us to provide you with better technical support and helps us to proactively improve FOSSBilling."), "html", null, true);
            yield "</p>
                                <a class=\"btn btn-success api-link\" href=\"";
            // line 596
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/toggle_error_reporting", ["CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\" data-api-msg=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Error reporting is now enabled."), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enable error reporting"), "html", null, true);
            yield "</a>
                            </div>
                        ";
        }
        // line 599
        yield "                        <p>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("FOSSBilling optionally includes automated error reporting to help aid the project's development and stability. To find the most up-to-date information about it, you should review the links and information below."), "html", null, true);
        yield "</p>
                        <ul>
                            <li><a href=\"https://fossbilling.org/docs/faq/error-reporting\" target=\"_blank\">";
        // line 601
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Learn more about error reporting"), "html", null, true);
        yield "</a></li>
                            <li>
                                <a href=\"https://fossbilling.org/docs/faq/error-reporting#error-reporting-changelog\" target=\"_blank\">";
        // line 603
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Error reporting changelog"), "html", null, true);
        yield "</a>
                                <span class=\"text-muted\">(";
        // line 604
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Last applicable behavior change: "), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["last_change"] ?? null), "html", null, true);
        yield ")</span>
                            </li>
                        </ul>
                        <span class=\"text-muted\">";
        // line 607
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The last applicable behavior change represents the most recent FOSSBilling version that changed error reporting which also applies to this current version. There may have been more recent changes than what's listed."), "html", null, true);
        yield "</span>
                    </div>
                </div>

                <div class=\"tab-pane fade\" id=\"network-interface\" role=\"tabpanel\">
                    <div class=\"card-header\">
                        <h3 class=\"card-title\">";
        // line 613
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Network interface"), "html", null, true);
        yield "</h3>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"alert ";
        // line 616
        if ((($tmp = ($context["external_ip"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "alert-success";
        } else {
            yield "alert-danger";
        }
        yield "\" role=\"alert\" id=\"external-ip\">
                            ";
        // line 617
        if ((($tmp = ($context["external_ip"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 618
            yield "                                ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("With the current settings, your FOSSBilling instance will have an external IP address of: "), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["external_ip"] ?? null), "html", null, true);
            yield "
                            ";
        } else {
            // line 620
            yield "                                ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The currently selected network interface does not appear to be able to reach the internet!"), "html", null, true);
            yield "
                            ";
        }
        // line 622
        yield "                        </div>

                        <form class=\"api-form\" method=\"post\" action=\"";
        // line 624
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/set_interface_ip");
        yield "\" data-api-jsonp=\"onAfterInterfaceSet\">
                            <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 625
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                            <p>";
        // line 626
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("If your server has multiple network interfaces, you may select the default one for FOSSBilling to use when making requests here."), "html", null, true);
        yield "</p>
                            ";
        // line 627
        $context["interface_ips"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_get_interface_ips", [], "any", false, false, false, 627);
        // line 628
        yield "                            
                            <div class=\"col-12 col-lg-3\">
                                <label for=\"interface\">";
        // line 630
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Select the default network interface:"), "html", null, true);
        yield "</label>
                                <select class=\"form-select\" aria-label=\"";
        // line 631
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Available network interfaces"), "html", null, true);
        yield "\" name=\"interface\" id=\"interface\">
                                    <option value=\"0\" ";
        // line 632
        if ((Twig\Extension\CoreExtension::constant("BIND_TO") == 0)) {
            yield " selected ";
        }
        yield ">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("None (Default PHP Behavior)"), "html", null, true);
        yield "</option>
                                    ";
        // line 633
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["interface_ips"] ?? null));
        foreach ($context['_seq'] as $context["i"] => $context["interface"]) {
            // line 634
            yield "                                    <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["interface"], "html", null, true);
            yield "\" ";
            if ((Twig\Extension\CoreExtension::constant("BIND_TO") == $context["interface"])) {
                yield " selected ";
            }
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["interface"], "html", null, true);
            yield "</option>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['i'], $context['interface'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 636
        yield "                                </select>
                            </div>

                            <br>

                            <div class=\"col-12 col-lg-3\">
                                <label for=\"custom_interface\">";
        // line 642
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enter a custom interface to use:"), "html", null, true);
        yield "</label>
                                ";
        // line 643
        if ((!CoreExtension::inFilter(Twig\Extension\CoreExtension::constant("BIND_TO"), ($context["interface_ips"] ?? null)) && (Twig\Extension\CoreExtension::constant("BIND_TO") != 0))) {
            // line 644
            yield "                                    <input class=\"form-control mt-1\" type=\"text\" name=\"custom_interface\" id=\"custom_interface\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::constant("BIND_TO"), "html", null, true);
            yield "\">
                                ";
        } else {
            // line 646
            yield "                                    <input class=\"form-control mt-1\" type=\"text\" name=\"custom_interface\" id=\"custom_interface\">
                                ";
        }
        // line 648
        yield "                            </div>
                            <span class=\"text-muted\">";
        // line 649
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("If the dropdown menu doesn't have the appropriate network interface, please enter the IP address or name (e.g., eth0) of the correct one above."), "html", null, true);
        yield "</span>
                            <br>

                            <input type=\"submit\" class=\"btn btn-primary mt-1\" value=\"";
        // line 652
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
        yield "\">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
        yield from [];
    }

    // line 661
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 662
        yield "<script>
    function onAfterInterfaceSet(result) {
        API.admin.post('system/env', {
            ip: true,
            CSRFToken: \"";
        // line 666
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"
        }, function (ip) {
            FOSSBilling.message(`";
        // line 668
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Network interface updated."), "html", null, true);
        yield "`);
            if(ip){
                document.getElementById('external-ip').innerText = `";
        // line 670
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("With the current settings, your FOSSBilling instance will have an external IP address of: "), "html", null, true);
        yield "` + ip;
                document.getElementById('external-ip').className = 'alert alert-success';
            } else {
                document.getElementById('external-ip').innerText = `";
        // line 673
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The currently selected network interface does not appear to be able to reach the internet!"), "html", null, true);
        yield "`;
                document.getElementById('external-ip').className = 'alert alert-danger';
            }
        });
    }
</script>
";
        yield from [];
    }

    // line 681
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $macros["mf"]->getTemplateForMacro("macro_bb_editor", $context, 681, $this->getSourceContext())->macro_bb_editor(...[".bb-textarea"]);
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "mod_system_settings.html.twig";
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
        return array (  1257 => 681,  1245 => 673,  1239 => 670,  1234 => 668,  1229 => 666,  1223 => 662,  1216 => 661,  1203 => 652,  1197 => 649,  1194 => 648,  1190 => 646,  1184 => 644,  1182 => 643,  1178 => 642,  1170 => 636,  1155 => 634,  1151 => 633,  1143 => 632,  1139 => 631,  1135 => 630,  1131 => 628,  1129 => 627,  1125 => 626,  1121 => 625,  1117 => 624,  1113 => 622,  1107 => 620,  1099 => 618,  1097 => 617,  1089 => 616,  1083 => 613,  1074 => 607,  1066 => 604,  1062 => 603,  1057 => 601,  1051 => 599,  1041 => 596,  1037 => 595,  1033 => 594,  1030 => 593,  1020 => 590,  1016 => 589,  1012 => 588,  1009 => 587,  1006 => 586,  1004 => 585,  998 => 582,  984 => 570,  975 => 567,  967 => 565,  959 => 561,  957 => 560,  953 => 558,  948 => 557,  946 => 556,  931 => 544,  919 => 535,  913 => 532,  909 => 531,  903 => 528,  899 => 527,  893 => 524,  889 => 523,  881 => 518,  870 => 510,  866 => 509,  860 => 508,  855 => 506,  845 => 499,  837 => 494,  832 => 492,  829 => 491,  582 => 244,  576 => 241,  570 => 240,  561 => 234,  554 => 230,  550 => 229,  544 => 226,  540 => 225,  534 => 222,  530 => 221,  524 => 218,  518 => 217,  509 => 211,  501 => 206,  496 => 204,  487 => 198,  480 => 196,  473 => 192,  466 => 190,  459 => 186,  454 => 184,  444 => 177,  437 => 175,  430 => 171,  423 => 169,  416 => 165,  411 => 163,  402 => 157,  396 => 156,  390 => 153,  384 => 152,  378 => 149,  370 => 144,  364 => 143,  358 => 140,  352 => 139,  346 => 136,  339 => 132,  334 => 130,  327 => 126,  322 => 124,  315 => 120,  310 => 118,  303 => 114,  298 => 112,  291 => 108,  286 => 106,  279 => 102,  274 => 100,  267 => 96,  262 => 94,  255 => 90,  250 => 88,  241 => 84,  235 => 83,  229 => 82,  224 => 80,  217 => 76,  212 => 74,  205 => 70,  200 => 68,  193 => 64,  188 => 62,  182 => 59,  176 => 58,  166 => 51,  160 => 48,  154 => 45,  148 => 42,  142 => 39,  136 => 36,  130 => 33,  125 => 30,  122 => 29,  119 => 28,  116 => 27,  113 => 26,  106 => 25,  98 => 21,  91 => 19,  81 => 12,  77 => 10,  70 => 9,  59 => 5,  55 => 1,  53 => 7,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_system_settings.html.twig", "/var/www/html/modules/System/html_admin/mod_system_settings.html.twig");
    }
}
