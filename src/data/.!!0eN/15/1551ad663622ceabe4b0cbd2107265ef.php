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
class __TwigTemplate_0532542c6e2f16dbc03740645418d965 extends Template
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
            yield "
    <nav aria-label=\"";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Pagination"), "html", null, true);
            yield "\">
        <ul class=\"pagination m-0\">
            ";
            // line 18
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "currentpage", [], "any", false, false, false, 18) != 1)) {
                // line 19
                yield "            <li class=\"page-item\">
                <a class=\"page-link\" href=\"";
                // line 20
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter(($context["url"] ?? null), Twig\Extension\CoreExtension::merge(($context["filteredRequest"] ?? null), [ (string)($context["pageParam"] ?? null) => (($context["currentPage"] ?? null) - 1)]));
                yield "\">
                    <svg class=\"icon\">
                        <use xlink:href=\"#chevron-left\" />
                    </svg>
                </a>
            </li>
            ";
            }
            // line 27
            yield "            ";
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "range", [], "any", false, false, false, 27), 0, [], "any", false, false, false, 27) != 1)) {
                // line 28
                yield "                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"";
                // line 29
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter(($context["url"] ?? null), Twig\Extension\CoreExtension::merge(($context["filteredRequest"] ?? null), [ (string)($context["pageParam"] ?? null) => 1]));
                yield "\">1</a>
                </li>
            ";
            }
            // line 32
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "start", [], "any", false, false, false, 32), CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "end", [], "any", false, false, false, 32)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 33
                yield "                ";
                if (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "range", [], "any", false, false, false, 33), 0, [], "any", false, false, false, 33) > 2) && ($context["i"] == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "range", [], "any", false, false, false, 33), 0, [], "any", false, false, false, 33)))) {
                    // line 34
                    yield "                    ...
                ";
                }
                // line 36
                yield "
                ";
                // line 37
                if (($context["i"] == CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "currentpage", [], "any", false, false, false, 37))) {
                    // line 38
                    yield "                    <li class=\"page-item active\">
                        <span class=\"page-link\" aria-current=\"page\">";
                    // line 39
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                    yield "</span>
                    </li>
                ";
                } else {
                    // line 42
                    yield "                    <li class=\"page-item\">
                        <a class=\"page-link\" href=\"";
                    // line 43
                    yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter(($context["url"] ?? null), Twig\Extension\CoreExtension::merge(($context["filteredRequest"] ?? null), [ (string)($context["pageParam"] ?? null) => $context["i"]]));
                    yield "\"> ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                    yield "</a>
                    </li>
                ";
                }
                // line 46
                yield "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            yield "
            ";
            // line 48
            if ((((($_v0 = CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "range", [], "any", false, false, false, 48)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[(CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "midrange", [], "any", false, false, false, 48) - 1)] ?? null) : null) < (CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "numpages", [], "any", false, false, false, 48) - 1)) && (CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "end", [], "any", false, false, false, 48) == (($_v1 = CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "range", [], "any", false, false, false, 48)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1[(CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "midrange", [], "any", false, false, false, 48) - 1)] ?? null) : null)))) {
                // line 49
                yield "                ...
                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"";
                // line 51
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter(($context["url"] ?? null), Twig\Extension\CoreExtension::merge(($context["filteredRequest"] ?? null), [ (string)($context["pageParam"] ?? null) => CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "numpages", [], "any", false, false, false, 51)]));
                yield "\"> ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "numpages", [], "any", false, false, false, 51), "html", null, true);
                yield "</a>
                </li>
            ";
            }
            // line 54
            yield "
            ";
            // line 55
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "currentpage", [], "any", false, false, false, 55) != CoreExtension::getAttribute($this->env, $this->source, ($context["paginator"] ?? null), "numpages", [], "any", false, false, false, 55))) {
                // line 56
                yield "            <li class=\"page-item\">
                <a class=\"page-link\" href=\"";
                // line 57
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter(($context["url"] ?? null), Twig\Extension\CoreExtension::merge(($context["filteredRequest"] ?? null), [ (string)($context["pageParam"] ?? null) => (($context["currentPage"] ?? null) + 1)]));
                yield "\">
                    <svg class=\"icon\">
                        <use xlink:href=\"#chevron-right\" />
                    </svg>
                </a>
            </li>
            ";
            }
            // line 64
            yield "        </ul>
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
        return array (  192 => 64,  182 => 57,  179 => 56,  177 => 55,  174 => 54,  166 => 51,  162 => 49,  160 => 48,  157 => 47,  151 => 46,  143 => 43,  140 => 42,  134 => 39,  131 => 38,  129 => 37,  126 => 36,  122 => 34,  119 => 33,  114 => 32,  108 => 29,  105 => 28,  102 => 27,  92 => 20,  89 => 19,  87 => 18,  82 => 16,  79 => 15,  76 => 14,  73 => 13,  70 => 11,  68 => 10,  65 => 9,  62 => 8,  59 => 7,  56 => 6,  53 => 5,  50 => 4,  47 => 3,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "partial_pagination.html.twig", "/var/www/html/themes/admin_default/html/partial_pagination.html.twig");
    }
}
