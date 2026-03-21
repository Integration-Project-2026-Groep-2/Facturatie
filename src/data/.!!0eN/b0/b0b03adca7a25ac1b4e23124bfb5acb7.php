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

/* mod_page_login.html.twig */
class __TwigTemplate_e937bc98df79c4f0d091c2702cf8f044 extends Template
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
        $context["company"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 3);
        // line 5
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "theme", [], "any", false, false, false, 5) == "dark")) {
            // line 6
            $context["logo_url"] = CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "logo_url_dark", [], "any", false, false, false, 6);
        } else {
            // line 8
            $context["logo_url"] = CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "logo_url", [], "any", false, false, false, 8);
        }
        // line 1
        $this->parent = $this->load("layout_public.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 11
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Login"), "html", null, true);
        yield from [];
    }

    // line 13
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "page-login";
        yield from [];
    }

    // line 14
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 15
        yield "<div class=\"container h-100\">
    <div class=\"row h-75 justify-content-center align-items-center\">
        <div class=\"col-md-6 col-lg-4\">
            ";
        // line 18
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "login_page_show_logo", [], "any", false, false, false, 18)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 19
            yield "                <div class=\"d-flex justify-content-center\">
                    <a href=\"";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "login_page_logo_url", [], "any", true, true, false, 20)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "login_page_logo_url", [], "any", false, false, false, 20), "/")) : ("/")), "html", null, true);
            yield "\" target=\"_blank\">
                        <img class=\"my-4\" height=\"50px\" src=\"";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["logo_url"] ?? null), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "name", [], "any", false, false, false, 21), "html", null, true);
            yield "\"/>
                    </a>
                </div>
            ";
        }
        // line 25
        yield "            <div class=\"card\">
                <div class=\"card-body\">
                    <h1 class=\"text-center m-4\">";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Login to your account"), "html", null, true);
        yield "</h1>
                    <form class=\"api-form auth\" action=\"";
        // line 28
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/guest/client/login");
        yield "\" method=\"post\" data-api-redirect=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(((array_key_exists("redirect_uri", $context)) ? (Twig\Extension\CoreExtension::default(($context["redirect_uri"] ?? null), "/")) : ("/")));
        yield "\">
                        <div class=\"mb-3\">
                            <label class=\"form-label\" for=\"email\">";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
        yield "</label>
                            <input class=\"form-control\" id=\"email\" type=\"text\" placeholder=\"";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enter your email address"), "html", null, true);
        yield "\" name=\"email\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "email", [], "any", false, false, false, 31), "html", null, true);
        yield "\" required=\"required\" autofocus>
                        </div>
                        <div class=\"mb-3\">
                            <label class=\"form-label\" for=\"password\">";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Password"), "html", null, true);
        yield "</label>
                            <input class=\"form-control\" id=\"password\" type=\"password\" placeholder=\"";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enter your password"), "html", null, true);
        yield "\" name=\"password\" required=\"required\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "password", [], "any", false, false, false, 35), "html", null, true);
        yield "\">
                        </div>
                        <button type=\"submit\" class=\"btn btn-primary w-100 mb-3\">";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Login"), "html", null, true);
        yield "</button>
                    </form>
                    ";
        // line 39
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "show_password_reset_link", [], "any", false, false, false, 39) || CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "show_signup_link", [], "any", false, false, false, 39))) {
            // line 40
            yield "                        <div class=\"row\">
                            ";
            // line 41
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "show_signup_link", [], "any", false, false, false, 41)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 42
                yield "                                <div class=\"col\">
                                    <a class=\"btn btn-outline-primary mb-2 w-100\" href=\"";
                // line 43
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("signup");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Create account"), "html", null, true);
                yield "</a>
                                </div>
                            ";
            }
            // line 46
            yield "                            ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "show_password_reset_link", [], "any", false, false, false, 46)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 47
                yield "                                <div class=\"col\">
                                    <a class=\"btn btn-outline-primary mb-2 w-100\" href=\"";
                // line 48
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("password-reset");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Forgot password?"), "html", null, true);
                yield "</a>
                                </div>
                            ";
            }
            // line 51
            yield "                        </div>
                    ";
        }
        // line 53
        yield "                </div>
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
        return "mod_page_login.html.twig";
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
        return array (  195 => 53,  191 => 51,  183 => 48,  180 => 47,  177 => 46,  169 => 43,  166 => 42,  164 => 41,  161 => 40,  159 => 39,  154 => 37,  147 => 35,  143 => 34,  135 => 31,  131 => 30,  124 => 28,  120 => 27,  116 => 25,  107 => 21,  103 => 20,  100 => 19,  98 => 18,  93 => 15,  86 => 14,  75 => 13,  64 => 11,  59 => 1,  56 => 8,  53 => 6,  51 => 5,  49 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_page_login.html.twig", "/var/www/html/modules/Page/html_client/mod_page_login.html.twig");
    }
}
