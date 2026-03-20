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

/* partial_search.html.twig */
class __TwigTemplate_68ae7f5639f11640b1a969852fccb066 extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<div class=\"card-body border-bottom py-3\">
    <div class=\"d-flex\">
        <div class=\"ms-auto text-muted\">
            <div class=\"ms-2 d-inline-block\">
                <div class=\"d-flex\">
                    <form method=\"get\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                        <input type=\"hidden\" name=\"_url\" value=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "_url", [], "any", false, false, false, 8), "html", null, true);
        yield "\">
                        <div class=\"input-group input-group-flat\">
                            <input class=\"form-control\"
                                type=\"search\"
                                name=\"search\"
                                value=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "search", [], "any", false, false, false, 13), "html", null, true);
        yield "\"
                                placeholder=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enter search text..."), "html", null, true);
        yield "\"
                                aria-label=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Search"), "html", null, true);
        yield "\">
                            <span class=\"input-group-text\">
                                <a class=\"link-secondary\"
                                    href=\"";
        // line 18
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "_url", [], "any", false, false, false, 18), ["show_filter" => 1]);
        yield "\"
                                    data-bs-toggle=\"tooltip\"
                                    data-bs-original-title=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Search settings"), "html", null, true);
        yield "\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#settings\" />
                                    </svg>
                                </a>
                            </span>
                            <button class=\"btn btn-icon\">
                                <svg class=\"icon\">
                                    <use xlink:href=\"#search\" />
                                </svg>
                            </button>
                        </div>
                    </form>
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
        return "partial_search.html.twig";
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
        return array (  81 => 20,  76 => 18,  70 => 15,  66 => 14,  62 => 13,  54 => 8,  50 => 7,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "partial_search.html.twig", "/var/www/html/themes/admin_default/html/partial_search.html.twig");
    }
}
