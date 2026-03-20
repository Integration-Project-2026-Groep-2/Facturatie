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

/* mod_staff_login.html.twig */
class __TwigTemplate_2296bbc1b0f4dddef29350851399aedd extends Template
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
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layout_login.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("layout_login.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Login"), "html", null, true);
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "
<div class=\"page page-center\">
    <div class=\"container-tight py-4\">
        <div class=\"text-center mb-4\">
            <a href=\"";
        // line 10
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/");
        yield "\" class=\"navbar-brand\">
                <img class=\"navbar-brand-image hide-theme-light\" src=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 11), "logo_url_dark", [], "any", false, false, false, 11), "html", null, true);
        yield "\" style=\"height: 50px; width: auto;\" alt=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 11), "name", [], "any", false, false, false, 11), "html", null, true);
        yield " logo\">
                <img class=\"navbar-brand-image hide-theme-dark\" src=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 12), "logo_url", [], "any", false, false, false, 12), "html", null, true);
        yield "\" style=\"height: 50px; width: auto;\" alt=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 12), "name", [], "any", false, false, false, 12), "html", null, true);
        yield " logo\">
            </a>
        </div>
        <div class=\"card card-md\">
            <div class=\"card-body\">
                ";
        // line 17
        if ((($tmp = ($context["create_admin"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 18
            yield "                    <h2 class=\"card-title text-center mb-4\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Create main administrator account"), "html", null, true);
            yield "</h2>
                    <form class=\"api-form\" action=\"";
            // line 19
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/guest/staff/create");
            yield "\" method=\"post\" data-api-redirect=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("index");
            yield "\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
            yield "\"/>
                        <div class=\"mb-3\">
                            <label class=\"form-label\" for=\"inputEmail\">";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
            yield "</label>
                            <div class=\"col\">
                                <input class=\"form-control\" id=\"inputEmail\" type=\"email\" name=\"email\" value=\"";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "email", [], "any", false, false, false, 24), "html", null, true);
            yield "\" placeholder=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enter your email address"), "html", null, true);
            yield "\">
                            </div>
                        </div>
                        <div class=\"mb-3\">
                            <label class=\"form-label\" for=\"inputPassword\">";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Password"), "html", null, true);
            yield "</label>
                            <div class=\"col\">
                                <input class=\"form-control\" id=\"inputPassword\" type=\"password\" name=\"password\" value=\"";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "password", [], "any", false, false, false, 30), "html", null, true);
            yield "\" placeholder=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enter your password"), "html", null, true);
            yield "\">
                            </div>
                        </div>
                        <div class=\"mb-3\">
                            <button class=\"btn btn-primary w-100\" type=\"submit\">";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Create administrator account"), "html", null, true);
            yield "</button>
                        </div>
                    </form>
                ";
        } else {
            // line 38
            yield "                ";
            $context["params"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "extension_settings", [["ext" => "mod_staff"]], "method", false, false, false, 38);
            // line 39
            yield "                    <h2 class=\"h2 text-center mb-4\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Log into your account"), "html", null, true);
            yield "</h2>
                    <form class=\"api-form\" action=\"";
            // line 40
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/guest/staff/login");
            yield "\" method=\"post\" data-api-redirect=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter(((array_key_exists("redirect_uri", $context)) ? (Twig\Extension\CoreExtension::default(($context["redirect_uri"] ?? null), "/")) : ("/")));
            yield "\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
            yield "\"/>
                        <div class=\"mb-3\">
                            <label class=\"form-label\" for=\"inputEmail\">";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
            yield "</label>
                            <input class=\"form-control\"
                                id=\"inputEmail\"
                                type=\"email\"
                                name=\"email\"
                                value=\"";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "email", [], "any", false, false, false, 48), "html", null, true);
            yield "\"
                                placeholder=\"";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enter your email address"), "html", null, true);
            yield "\"
                                required
                                autofocus>
                        </div>
                        <div class=\"mb-3\">
                            <label class=\"form-label\" for=\"inputPassword\">
                                ";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Password"), "html", null, true);
            yield "
                                ";
            // line 56
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "reset_pw", [], "any", false, false, false, 56) == 1)) {
                // line 57
                yield "                                <span class=\"form-label-description\">
                                    <a href=\"";
                // line 58
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("staff/passwordreset");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Forgot your password?"), "html", null, true);
                yield "</a>
                                </span>
                                ";
            }
            // line 61
            yield "                            </label>
                            <input class=\"form-control\"
                                id=\"inputPassword\"
                                type=\"password\"
                                name=\"password\"
                                value=\"";
            // line 66
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "password", [], "any", false, false, false, 66), "html", null, true);
            yield "\"
                                placeholder=\"";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enter your password"), "html", null, true);
            yield "\"
                                required>
                        </div>
                        <div class=\"form-footer\">
                            <button class=\"btn btn-primary w-100\" type=\"submit\">";
            // line 71
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Login"), "html", null, true);
            yield "</button>
                        </div>
                    </form>
                ";
        }
        // line 75
        yield "            </div>
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
        return "mod_staff_login.html.twig";
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
        return array (  231 => 75,  224 => 71,  217 => 67,  213 => 66,  206 => 61,  198 => 58,  195 => 57,  193 => 56,  189 => 55,  180 => 49,  176 => 48,  168 => 43,  163 => 41,  157 => 40,  152 => 39,  149 => 38,  142 => 34,  133 => 30,  128 => 28,  119 => 24,  114 => 22,  109 => 20,  103 => 19,  98 => 18,  96 => 17,  86 => 12,  80 => 11,  76 => 10,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_staff_login.html.twig", "/var/www/html/modules/Staff/html_admin/mod_staff_login.html.twig");
    }
}
