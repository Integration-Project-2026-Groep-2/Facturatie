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

/* partial_pagination.html.twig */
class __TwigTemplate_374fdc954c24e8dae72c169af68c9598 extends Template
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
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["list"] ?? null), "pages", [], "any", false, false, false, 1) > 1)) {
            // line 2
            yield "    ";
            $context["pageParam"] = ((array_key_exists("page_param", $context)) ? (Twig\Extension\CoreExtension::default(($context["page_param"] ?? null), "page")) : ("page"));
            // line 3
            yield "    ";
            $context["currentPageRaw"] = ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), ($context["pageParam"] ?? null), [], "any", true, true, false, 3)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), ($context["pageParam"] ?? null), [], "any", false, false, false, 3), 1)) : (1));
            // line 4
            yield "    ";
            if (CoreExtension::matches("/^\\d+\$/", ($context["currentPageRaw"] ?? null))) {
                // line 5
                yield "        ";
                $context["currentPage"] = ($context["currentPageRaw"] ?? null);
                // line 6
                yield "    ";
            } else {
                // line 7
                yield "        ";
                $context["currentPage"] = 1;
                // line 8
                yield "    ";
            }
            // line 9
            yield "
    ";
            // line 10
            $context["paginator"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_paginator", [["total" => CoreExtension::getAttribute($this->env, $this->source, ($context["list"] ?? null), "total", [], "any", false, false, false, 10), "page_param" => ($context["pageParam"] ?? null),  (string)($context["pageParam"] ?? null) => ($context["currentPage"] ?? null), "per_page" => CoreExtension::getAttribute($this->env, $this->source, ($context["list"] ?? null), "per_page", [], "any", false, false, false, 10)]], "method", false, false, false, 10);
            // line 11
            yield "
    ";
            // line 13
            yield "    ";
            $context["safeRequest"] = Twig\Extension\CoreExtension::merge(($context["request"] ?? null), [ (string)($context["pageParam"] ?? null) => null]);
            // line 14
            yield "    ";
            $context["filteredRequest"] = $this->extensions['Box_TwigExtensions']->filteredFilter(($context["safeRequest"] ?? null), function ($__v__) use ($context, $macros) { $context["v"] = $__v__; return  !(null === ($context["v"] ?? null)); });
            // line 15
            yield "    <nav aria-label=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Pagination"), "html", null, true);
            yield "\">
        <ul class=\"pagination justify-content-center mb-0\">
            <li class=\"page-item";
            // line 17
            if (( !($context["currentPage"] ?? null) || (($context["currentPage"] ?? null) == 1))) {
                yield " disabled";
            }
            yield "\">
                <a class=\"page-link\"
                   href=\"";
            // line 19
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(($context["url"] ?? null), Twig\Extension\CoreExtension::merge(($context["filteredRequest"] ?? null), [ (string)($context["pageParam"] ?? null) => 1]));
            yield "\"
                   aria-label=\"";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("First"), "html", null, true);
            yield "\">
                    <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\">
                        <path d=\"M18.41,7.41L17,6L11,12L17,18L18.41,16.59L13.83,12L18.41,7.41M12.41,7.41L11,6L5,12L11,18L12.41,16.59L7.83,12L12.41,7.41Z\"/>
                    </svg>
                </a>
            </li>

            <li class=\"page-item";
            // line 27
            if (( !($context["currentPage"] ?? null) || (($context["currentPage"] ?? null) == 1))) {
                yield " disabled";
            }
            yield "\">
                <a class=\"page-link\"
                   href=\"";
            // line 29
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(($context["url"] ?? null), Twig\Extension\CoreExtension::merge(($context["filteredRequest"] ?? null), [ (string)($context["pageParam"] ?? null) => (($context["currentPage"] ?? null) - 1)]));
            yield "\"
                   aria-label=\"";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Previous"), "html", null, true);
            yield "\" rel=\"prev\">
                    <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\">
                        <path d=\"M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z\"/>
                    </svg>
                </a>
            </li>

            ";
            // line 37
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(1, CoreExtension::getAttribute($this->env, $this->source, ($context["list"] ?? null), "pages", [], "any", false, false, false, 37)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 38
                yield "                <li class=\"page-item";
                if (($context["i"] == ($context["currentPage"] ?? null))) {
                    yield " active";
                }
                yield "\">
                    ";
                // line 39
                if ((($context["i"] == ($context["currentPage"] ?? null)) || ( !($context["currentPage"] ?? null) && ($context["i"] == 1)))) {
                    // line 40
                    yield "                        <span class=\"page-link\" aria-current=\"page\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                    yield "</span>
                    ";
                } else {
                    // line 42
                    yield "                        <a class=\"page-link\"
                           href=\"";
                    // line 43
                    yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(($context["url"] ?? null), Twig\Extension\CoreExtension::merge(($context["filteredRequest"] ?? null), [ (string)($context["pageParam"] ?? null) => $context["i"]]));
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                    yield "</a>
                    ";
                }
                // line 45
                yield "                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            yield "
            <li class=\"page-item";
            // line 48
            if ((($context["currentPage"] ?? null) == CoreExtension::getAttribute($this->env, $this->source, ($context["list"] ?? null), "pages", [], "any", false, false, false, 48))) {
                yield " disabled";
            }
            yield "\">
                <a class=\"page-link\"
                   href=\"";
            // line 50
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(($context["url"] ?? null), Twig\Extension\CoreExtension::merge(($context["filteredRequest"] ?? null), [ (string)($context["pageParam"] ?? null) => (($context["currentPage"] ?? null) + 1)]));
            yield "\"
                   aria-label=\"";
            // line 51
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Next"), "html", null, true);
            yield "\" rel=\"next\">
                    <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\">
                        <path d=\"M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z\"/>
                    </svg>
                </a>
            </li>

            <li class=\"page-item";
            // line 58
            if ((($context["currentPage"] ?? null) == CoreExtension::getAttribute($this->env, $this->source, ($context["list"] ?? null), "pages", [], "any", false, false, false, 58))) {
                yield " disabled";
            }
            yield "\">
                <a class=\"page-link\"
                   href=\"";
            // line 60
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(($context["url"] ?? null), Twig\Extension\CoreExtension::merge(($context["filteredRequest"] ?? null), [ (string)($context["pageParam"] ?? null) => CoreExtension::getAttribute($this->env, $this->source, ($context["list"] ?? null), "pages", [], "any", false, false, false, 60)]));
            yield "\"
                   aria-label=\"";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Last"), "html", null, true);
            yield "\">
                    <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\">
                        <path d=\"M5.59,7.41L7,6L13,12L7,18L5.59,16.59L10.17,12L5.59,7.41M11.59,7.41L13,6L19,12L13,18L11.59,16.59L16.17,12L11.59,7.41Z\"/>
                    </svg>
                </a>
            </li>
        </ul>
    </nav>
";
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partial_pagination.html.twig";
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
        return array (  198 => 61,  194 => 60,  187 => 58,  177 => 51,  173 => 50,  166 => 48,  163 => 47,  156 => 45,  149 => 43,  146 => 42,  140 => 40,  138 => 39,  131 => 38,  127 => 37,  117 => 30,  113 => 29,  106 => 27,  96 => 20,  92 => 19,  85 => 17,  79 => 15,  76 => 14,  73 => 13,  70 => 11,  68 => 10,  65 => 9,  62 => 8,  59 => 7,  56 => 6,  53 => 5,  50 => 4,  47 => 3,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "partial_pagination.html.twig", "/var/www/html/themes/huraga/html/partial_pagination.html.twig");
    }
}
