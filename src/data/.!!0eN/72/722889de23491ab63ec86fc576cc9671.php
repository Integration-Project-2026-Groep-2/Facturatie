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

/* mod_currency_manage.html.twig */
class __TwigTemplate_6a138bc73960e6a5ba0d81bffedb2828 extends Template
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
        // line 5
        $context["active_menu"] = "system";
        // line 1
        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency management"), "html", null, true);
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
        <li class=\"breadcrumb-item\">
            <a href=\"";
        // line 22
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("extension/settings/currency");
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency settings"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "code", [], "any", false, false, false, 24), "html", null, true);
        yield "</li>
    </ol>
";
        yield from [];
    }

    // line 28
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 29
        yield "<div class=\"card\">
    <form method=\"post\" action=\"";
        // line 30
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/currency/update");
        yield "\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency updated"), "html", null, true);
        yield "\">
        <div class=\"card-body\">
            <h3 class=\"card-title\">";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Edit currency information"), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "code", [], "any", false, false, false, 32), "html", null, true);
        yield "</h3>
            <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\">
            <input type=\"hidden\" name=\"code\" value=\"";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "code", [], "any", false, false, false, 34), "html", null, true);
        yield "\">
            <div class=\"mb-3 row\">
                <label class=\"col-md-3 col-form-label\">";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
        yield "</label>
                <div class=\"col-md-6\">
                    <input class=\"form-control\" type=\"text\" name=\"title\" value=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "title", [], "any", false, false, false, 38), "html", null, true);
        yield "\" required>
                </div>
            </div>
            <div class=\"mb-3 row\">
                <label class=\"col-md-3 col-form-label\">";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Conversion rate"), "html", null, true);
        yield "</label>
                <div class=\"col-md-6\">
                    <input class=\"form-control\" type=\"text\" name=\"conversion_rate\" value=\"";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "conversion_rate", [], "any", false, false, false, 44), "html", null, true);
        yield "\" required>
                </div>
            </div>
            <div class=\"mb-3 row\">
                <label class=\"col-md-3 col-form-label\">";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Format"), "html", null, true);
        yield "</label>
                <div class=\"col-md-6\">
                    <input class=\"form-control\" type=\"text\" name=\"format\" value=\"";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "format", [], "any", false, false, false, 50), "html", null, true);
        yield "\" required placeholder=\"\$ ";
        yield ($context["price"] ?? null);
        yield "\">
                </div>
            </div>
            <div class=\"mb-3 row\">
                <label class=\"col-md-3 form-label\">";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Price format"), "html", null, true);
        yield "</label>
                <div class=\"col-md-6\">
                    <div class=\"form-check form-check-inline\">
                        <input class=\"form-check-input\" id=\"radioPriceFormat1\" type=\"radio\" name=\"price_format\" value=\"1\"";
        // line 57
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "price_format", [], "any", false, false, false, 57) == 1)) {
            yield " checked";
        }
        yield ">
                        <label class=\"form-check-label\" for=\"radioPriceFormat1\">1234.56</label>
                    </div>
                    <div class=\"form-check form-check-inline\">
                        <input class=\"form-check-input\" id=\"radioPriceFormat2\" type=\"radio\" name=\"price_format\" value=\"2\"";
        // line 61
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "price_format", [], "any", false, false, false, 61) == 2)) {
            yield " checked";
        }
        yield ">
                        <label class=\"form-check-label\" for=\"radioPriceFormat2\">1,234.56</label>
                    </div>
                    <div class=\"form-check form-check-inline\">
                        <input class=\"form-check-input\" id=\"radioPriceFormat3\" type=\"radio\" name=\"price_format\" value=\"3\"";
        // line 65
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "price_format", [], "any", false, false, false, 65) == 3)) {
            yield " checked";
        }
        yield ">
                        <label class=\"form-check-label\" for=\"radioPriceFormat3\">1.234,56</label>
                    </div>
                    <div class=\"form-check form-check-inline\">
                        <input class=\"form-check-input\" id=\"radioPriceFormat4\" type=\"radio\" name=\"price_format\" value=\"4\"";
        // line 69
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "price_format", [], "any", false, false, false, 69) == 4)) {
            yield " checked";
        }
        yield ">
                        <label class=\"form-check-label\" for=\"radioPriceFormat4\">1,234</label>
                    </div>
                    <div class=\"form-check form-check-inline\">
                        <input class=\"form-check-input\" id=\"radioPriceFormat5\" type=\"radio\" name=\"price_format\" value=\"5\"";
        // line 73
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["currency"] ?? null), "price_format", [], "any", false, false, false, 73) == 5)) {
            yield " checked";
        }
        yield ">
                        <label class=\"form-check-label\" for=\"radioPriceFormat5\">1234</label>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"card-footer text-end\">
            <button class=\"btn btn-primary\" type=\"submit\">";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
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
        return "mod_currency_manage.html.twig";
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
        return array (  236 => 80,  224 => 73,  215 => 69,  206 => 65,  197 => 61,  188 => 57,  182 => 54,  173 => 50,  168 => 48,  161 => 44,  156 => 42,  149 => 38,  144 => 36,  139 => 34,  135 => 33,  129 => 32,  122 => 30,  119 => 29,  112 => 28,  104 => 24,  97 => 22,  89 => 19,  79 => 12,  75 => 10,  68 => 9,  57 => 7,  53 => 1,  51 => 5,  49 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_currency_manage.html.twig", "/var/www/html/modules/Currency/html_admin/mod_currency_manage.html.twig");
    }
}
