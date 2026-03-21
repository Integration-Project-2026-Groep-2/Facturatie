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

/* mod_page_signup.html.twig */
class __TwigTemplate_8ff7b94c117da2934e3928ab06af2893 extends Template
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
            'body_class' => [$this, 'block_body_class'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layout_public.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $macros["mf"] = $this->macros["mf"] = $this->load("macro_functions.html.twig", 3)->unwrap();
        // line 7
        $context["company"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 7);
        // line 9
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "theme", [], "any", false, false, false, 9) == "dark")) {
            // line 10
            $context["logo_url"] = CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "logo_url_dark", [], "any", false, false, false, 10);
        } else {
            // line 12
            $context["logo_url"] = CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "logo_url", [], "any", false, false, false, 12);
        }
        // line 1
        $this->parent = $this->load("layout_public.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Register"), "html", null, true);
        yield from [];
    }

    // line 15
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "page-signup";
        yield from [];
    }

    // line 16
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 17
        yield "    <div class=\"container h-100\">
        <div class=\"row h-75 justify-content-center align-items-center\">
            <div class=\"col-md-6 col-lg-4\">
                ";
        // line 20
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "login_page_show_logo", [], "any", false, false, false, 20)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 21
            yield "                    <div class=\"d-flex justify-content-center\">
                        <a href=\"";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "login_page_logo_url", [], "any", true, true, false, 22)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "login_page_logo_url", [], "any", false, false, false, 22), "/")) : ("/")), "html", null, true);
            yield "\" target=\"_blank\">
                            <img class=\"my-4\" height=\"50px\" src=\"";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["logo_url"] ?? null), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "name", [], "any", false, false, false, 23), "html", null, true);
            yield "\"/>
                        </a>
                    </div>
                ";
        }
        // line 27
        yield "                <div class=\"card\">
                    <div class=\"card-body\">
                        <h1 class=\"text-center m-4\">";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Create a new account"), "html", null, true);
        yield "</h1>
                        <form class=\"api-form auth\" action=\"";
        // line 30
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/guest/client/create");
        yield "\" method=\"post\" data-api-redirect=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/");
        yield "\">
                            <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                            ";
        // line 32
        $context["r"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "client_required", [], "any", false, false, false, 32);
        // line 33
        yield "
                            <div class=\"mb-3\">
                                <label class=\"form-label\" for=\"first-name\">";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("First Name"), "html", null, true);
        yield "</label>
                                <input class=\"form-control\" id=\"first-name\" type=\"text\" name=\"first_name\"
                                       value=\"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "first_name", [], "any", false, false, false, 37), "html", null, true);
        yield "\" required=\"required\"/>
                            </div>

                            ";
        // line 40
        if (CoreExtension::inFilter("last_name", ($context["r"] ?? null))) {
            // line 41
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"last_name\">";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Last Name"), "html", null, true);
            yield "</label>
                                    <input class=\"form-control\" id=\"last_name\" type=\"text\" name=\"last_name\"
                                           value=\"";
            // line 44
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "last_name", [], "any", false, false, false, 44), "html", null, true);
            yield "\" required=\"required\"/>
                                </div>
                            ";
        }
        // line 47
        yield "
                            <div class=\"mb-3\">
                                <label class=\"form-label\" for=\"reg-email\">";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email Address"), "html", null, true);
        yield "</label>
                                <input class=\"form-control\" id=\"reg-email\" type=\"email\" name=\"email\"
                                       value=\"";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "email", [], "any", false, false, false, 51), "html", null, true);
        yield "\" required=\"required\"/>
                            </div>

                            ";
        // line 54
        if (CoreExtension::inFilter("company", ($context["r"] ?? null))) {
            // line 55
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"company\">";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company"), "html", null, true);
            yield "</label>
                                    <input class=\"form-control\" id=\"company\" type=\"text\" name=\"company\"
                                           value=\"";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "company", [], "any", false, false, false, 58), "html", null, true);
            yield "\" required=\"required\"/>
                                </div>
                            ";
        }
        // line 61
        yield "
                            ";
        // line 62
        if (CoreExtension::inFilter("birthday", ($context["r"] ?? null))) {
            // line 63
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"birthday\">";
            // line 64
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Birthday"), "html", null, true);
            yield "</label>
                                    <input class=\"form-control\" id=\"birthday\" type=\"date\" name=\"birthday\" value=\"\"/>
                                </div>
                            ";
        }
        // line 68
        yield "
                            ";
        // line 69
        if (CoreExtension::inFilter("gender", ($context["r"] ?? null))) {
            // line 70
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"gender\">";
            // line 71
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Gender"), "html", null, true);
            yield "</label>
                                    <select class=\"form-select\" id=\"gender\" name=\"gender\">
                                        <option value=\"male\">";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Male"), "html", null, true);
            yield "</option>
                                        <option value=\"female\">";
            // line 74
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Female"), "html", null, true);
            yield "</option>
                                        <option value=\"nonbinary\">";
            // line 75
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Non-binary"), "html", null, true);
            yield "</option>
                                        <option value=\"other\">";
            // line 76
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Other"), "html", null, true);
            yield "Other</option>
                                    </select>
                                </div>
                            ";
        }
        // line 80
        yield "
                            ";
        // line 81
        if (CoreExtension::inFilter("address_1", ($context["r"] ?? null))) {
            // line 82
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"address_1\">";
            // line 83
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address"), "html", null, true);
            yield "</label>
                                    <input class=\"form-control\" id=\"address_1\" type=\"text\" name=\"address_1\"
                                           value=\"";
            // line 85
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "address_1", [], "any", false, false, false, 85), "html", null, true);
            yield "\"/>
                                </div>
                            ";
        }
        // line 88
        yield "
                            ";
        // line 89
        if (CoreExtension::inFilter("address_2", ($context["r"] ?? null))) {
            // line 90
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"address_2\">";
            // line 91
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address 2"), "html", null, true);
            yield "</label>
                                    <input class=\"form-control\" id=\"address_2\" type=\"text\" name=\"address_2\"
                                           value=\"";
            // line 93
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "address_2", [], "any", false, false, false, 93), "html", null, true);
            yield "\"/>
                                </div>
                            ";
        }
        // line 96
        yield "
                            ";
        // line 97
        if (CoreExtension::inFilter("city", ($context["r"] ?? null))) {
            // line 98
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"city\">";
            // line 99
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("City"), "html", null, true);
            yield "</label>
                                    <input class=\"form-control\" id=\"city\" type=\"text\" name=\"city\"
                                           value=\"";
            // line 101
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "city", [], "any", false, false, false, 101), "html", null, true);
            yield "\"/>
                                </div>
                            ";
        }
        // line 104
        yield "
                            ";
        // line 105
        if (CoreExtension::inFilter("country", ($context["r"] ?? null))) {
            // line 106
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"country\">";
            // line 107
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Country"), "html", null, true);
            yield "</label>
                                    <select class=\"form-select\" id=\"country\" name=\"country\" required=\"required\">
                                        <option value=\"\">";
            // line 109
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("-- Select country --"), "html", null, true);
            yield "</option>
                                        ";
            // line 110
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_countries", [], "any", false, false, false, 110));
            foreach ($context['_seq'] as $context["val"] => $context["label"]) {
                // line 111
                yield "                                            <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["val"], "html", null, true);
                yield "\" label=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"]);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"]);
                yield "</option>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['val'], $context['label'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 113
            yield "                                    </select>
                                </div>
                            ";
        }
        // line 116
        yield "
                            ";
        // line 117
        if (CoreExtension::inFilter("state", ($context["r"] ?? null))) {
            // line 118
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"state\">";
            // line 119
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("State"), "html", null, true);
            yield "</label>
                                    <input class=\"form-control\" id=\"state\" type=\"text\" name=\"state\"
                                           value=\"";
            // line 121
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "state", [], "any", false, false, false, 121), "html", null, true);
            yield "\"/>
                                </div>
                            ";
        }
        // line 124
        yield "
                            ";
        // line 125
        if (CoreExtension::inFilter("postcode", ($context["r"] ?? null))) {
            // line 126
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"postcode\">";
            // line 127
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Zip/Postal Code"), "html", null, true);
            yield "</label>
                                    <input class=\"form-control\" id=\"postcode\" type=\"text\" name=\"postcode\"
                                           value=\"";
            // line 129
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "postcode", [], "any", false, false, false, 129), "html", null, true);
            yield "\"/>
                                </div>
                            ";
        }
        // line 132
        yield "
                            ";
        // line 133
        if (CoreExtension::inFilter("phone", ($context["r"] ?? null))) {
            // line 134
            yield "                                <div class=\"mb-3\">
                                    <label class=\"form-label\" for=\"phone\">";
            // line 135
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone Number"), "html", null, true);
            yield "</label>
                                    <div class=\"input-group\">
                                        <input class=\"form-control\" id=\"phone\" type=\"text\" name=\"phone_cc\" value=\"\"
                                               style=\"width: 20%\"/>
                                        <input class=\"form-control\" id=\"phone\" type=\"text\" name=\"phone\"
                                               value=\"";
            // line 140
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "phone", [], "any", false, false, false, 140), "html", null, true);
            yield "\" style=\"width: 70%\"/>
                                    </div>
                                </div>
                            ";
        }
        // line 144
        yield "
                            ";
        // line 145
        $context["custom_fields"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "client_custom_fields", [], "any", false, false, false, 145);
        // line 146
        yield "                            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["custom_fields"] ?? null));
        foreach ($context['_seq'] as $context["field_name"] => $context["field"]) {
            // line 147
            yield "                                ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["field"], "active", [], "any", false, false, false, 147)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 148
                yield "                                    <div class=\"mb-3\">
                                        <label class=\"form-label\"
                                               for=\"";
                // line 150
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["field_name"], "html", null, true);
                yield "\">";
                yield (((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "title", [], "any", false, false, false, 150))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["field"], "title", [], "any", false, false, false, 150), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), $context["field_name"]), "html", null, true)));
                yield "</label>
                                        <input class=\"form-control\" id=\"";
                // line 151
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["field_name"], "html", null, true);
                yield "\" type=\"text\"
                                               name=\"";
                // line 152
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["field_name"], "html", null, true);
                yield "\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), $context["field_name"], [], "any", false, false, false, 152), "html", null, true);
                yield "\"
                                               ";
                // line 153
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["field"], "required", [], "any", false, false, false, 153)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "required=\"required\"";
                }
                yield " />
                                    </div>
                                ";
            }
            // line 156
            yield "                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['field_name'], $context['field'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 157
        yield "
                            <div class=\"mb-3\">
                                <label class=\"form-label\" for=\"reg-password\">";
        // line 159
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Password"), "html", null, true);
        yield "</label>
                                <input class=\"form-control\" id=\"reg-password\" type=\"password\" name=\"password\" value=\"\"
                                       required=\"required\"/>
                            </div>

                            <div class=\"mb-3\">
                                <label class=\"form-label\" for=\"password-confirm\">";
        // line 165
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Password confirm"), "html", null, true);
        yield "</label>
                                <input class=\"form-control\" id=\"password-confirm\" type=\"password\" name=\"password_confirm\" value=\"\" required=\"required\"/>
                            </div>

                            ";
        // line 169
        yield $macros["mf"]->getTemplateForMacro("macro_recaptcha", $context, 169, $this->getSourceContext())->macro_recaptcha(...[]);
        yield "

                            ";
        // line 171
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "signup_tos", [], "any", false, false, false, 171) == "explicit")) {
            // line 172
            yield "                                <div class=\"form-check mb-1\">
                                    <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\" required>
                                    <label class=\"form-check-label\" for=\"flexCheckDefault\">
                                        ";
            // line 176
            yield "                                        <span>I agree to the <a href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/tos");
            yield "\" target=\"_blank\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("terms of service"), "html", null, true);
            yield "</a> and <a href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/privacy-policy");
            yield "\" target=\"_blank\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("privacy policy"), "html", null, true);
            yield ".</span>
                                    </label>
                                </div>
                            ";
        }
        // line 180
        yield "
                            <div class=\"form-actions mb-3\">
                                <button class=\"btn btn-primary w-100\" type=\"submit\">";
        // line 182
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Register"), "html", null, true);
        yield "</button>
                            </div>

                            ";
        // line 185
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "signup_tos", [], "any", false, false, false, 185) == "implicit")) {
            // line 186
            yield "                                <div class=\"mb-1\">
                                    ";
            // line 188
            yield "                                    <span class=\"text-muted mb-1\">By creating an account, you agree to our <a href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/tos");
            yield "\" target=\"_blank\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("terms of service"), "html", null, true);
            yield "</a> and <a href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/privacy-policy");
            yield "\" target=\"_blank\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("privacy policy"), "html", null, true);
            yield "</a>.</span>
                                </div>
                            ";
        }
        // line 191
        yield "                        </form>
                        <div class=\"row\">
                            <div class=\"col\">
                                <a class=\"btn btn-outline-primary mb-2 w-100\"
                                   href=\"";
        // line 195
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("login");
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Already a user?"), "html", null, true);
        yield "</a>
                            </div>
                            ";
        // line 197
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "show_password_reset_link", [], "any", false, false, false, 197)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 198
            yield "                                <div class=\"col\">
                                    <a class=\"btn btn-outline-primary mb-2 w-100\" href=\"";
            // line 199
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("password-reset");
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Forgot password?"), "html", null, true);
            yield "</a>
                                </div>
                            ";
        }
        // line 202
        yield "                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "mod_page_signup.html.twig";
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
        return array (  551 => 202,  543 => 199,  540 => 198,  538 => 197,  531 => 195,  525 => 191,  512 => 188,  509 => 186,  507 => 185,  501 => 182,  497 => 180,  483 => 176,  478 => 172,  476 => 171,  471 => 169,  464 => 165,  455 => 159,  451 => 157,  445 => 156,  437 => 153,  431 => 152,  427 => 151,  421 => 150,  417 => 148,  414 => 147,  409 => 146,  407 => 145,  404 => 144,  397 => 140,  389 => 135,  386 => 134,  384 => 133,  381 => 132,  375 => 129,  370 => 127,  367 => 126,  365 => 125,  362 => 124,  356 => 121,  351 => 119,  348 => 118,  346 => 117,  343 => 116,  338 => 113,  325 => 111,  321 => 110,  317 => 109,  312 => 107,  309 => 106,  307 => 105,  304 => 104,  298 => 101,  293 => 99,  290 => 98,  288 => 97,  285 => 96,  279 => 93,  274 => 91,  271 => 90,  269 => 89,  266 => 88,  260 => 85,  255 => 83,  252 => 82,  250 => 81,  247 => 80,  240 => 76,  236 => 75,  232 => 74,  228 => 73,  223 => 71,  220 => 70,  218 => 69,  215 => 68,  208 => 64,  205 => 63,  203 => 62,  200 => 61,  194 => 58,  189 => 56,  186 => 55,  184 => 54,  178 => 51,  173 => 49,  169 => 47,  163 => 44,  158 => 42,  155 => 41,  153 => 40,  147 => 37,  142 => 35,  138 => 33,  136 => 32,  132 => 31,  126 => 30,  122 => 29,  118 => 27,  109 => 23,  105 => 22,  102 => 21,  100 => 20,  95 => 17,  88 => 16,  77 => 15,  66 => 5,  61 => 1,  58 => 12,  55 => 10,  53 => 9,  51 => 7,  49 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_page_signup.html.twig", "/var/www/html/modules/Page/html_client/mod_page_signup.html.twig");
    }
}
