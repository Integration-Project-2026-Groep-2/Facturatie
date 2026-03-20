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

/* error.html.twig */
class __TwigTemplate_19dc7cd0057d795773e917ce06290695 extends Template
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Error"), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["exception"] ?? null), "getCode", [], "any", false, false, false, 3), "html", null, true);
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
        yield "<div class=\"page page-center\">
    <div class=\"container-tight py-4\">
        <div class=\"empty\">
            <h1 class=\"empty-header\">";
        // line 9
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["exception"] ?? null), "getCode", [], "any", false, false, false, 9) == 0)) {
            yield "500";
        } else {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["exception"] ?? null), "getCode", [], "any", false, false, false, 9), "html", null, true);
        }
        yield "</h1>
            <p class=\"empty-title\">";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Oops... You just found an error page"), "html", null, true);
        yield "</p>
            <p class=\"empty-subtitle text-muted\">";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["exception"] ?? null), "getMessage", [], "any", false, false, false, 11), "html", null, true);
        yield "</p>
            <div class=\"empty-action\">
                ";
        // line 13
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["exception"] ?? null), "getCode", [], "any", false, false, false, 13) == 403) &&  !($context["admin"] ?? null))) {
            // line 14
            yield "                    <a href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/staff/login");
            yield "\" class=\"btn btn-primary\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Login"), "html", null, true);
            yield "</a>
                ";
        } else {
            // line 16
            yield "                    <a href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/index");
            yield "\" class=\"btn btn-primary\">
                        <svg class=\"icon\">
                            <use xlink:href=\"#arrow-sm-left\" />
                        </svg>
                        ";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Back to Dashboard"), "html", null, true);
            yield "
                    </a>
                ";
        }
        // line 23
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
        return "error.html.twig";
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
        return array (  118 => 23,  112 => 20,  104 => 16,  96 => 14,  94 => 13,  89 => 11,  85 => 10,  77 => 9,  72 => 6,  65 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "error.html.twig", "/var/www/html/themes/admin_default/html/error.html.twig");
    }
}
