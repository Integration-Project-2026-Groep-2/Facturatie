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

/* mod_system_index.html.twig */
class __TwigTemplate_0f3ffa87668957d2e1f6e014c073342a extends Template
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
        return $this->load((((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "ajax", [], "any", false, false, false, 1)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("layout_blank.html.twig") : ("layout_default.html.twig")), 1);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $macros["mf"] = $this->macros["mf"] = $this->load("macro_functions.html.twig", 3)->unwrap();
        // line 7
        $context["active_menu"] = "system";
        // line 8
        $context["params"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_get_params", [], "any", false, false, false, 8);
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Settings"), "html", null, true);
        yield from [];
    }

    // line 10
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 11
        yield "    <div class=\"card\">
        <div class=\"card-header\">
            <h3 class=\"card-title\">";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Settings"), "html", null, true);
        yield "</h3>
        </div>
        <div class=\"card-body\">
            <div class=\"datagrid\">
                ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "extension_get_list", [Twig\Extension\CoreExtension::merge(["active" => 1, "has_settings" => 1], ($context["request"] ?? null))], "method", false, false, false, 17));
        foreach ($context['_seq'] as $context["_key"] => $context["ext"]) {
            // line 18
            yield "                    <div class=\"datagrid-item\">
                        <div class=\"datagrid-title\">
                            <a href=\"";
            // line 20
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("extension/settings");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["ext"], "id", [], "any", false, false, false, 20), "html", null, true);
            yield "\">
                                ";
            // line 21
            $context["icon_filename"] = Twig\Extension\CoreExtension::last($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["ext"], "icon_url", [], "any", false, false, false, 21), "/"));
            // line 22
            yield "                                ";
            if (((($context["icon_filename"] ?? null) != "cog.svg") && ((Twig\Extension\CoreExtension::last($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), ($context["icon_filename"] ?? null), ".")) == "svg") && CoreExtension::getAttribute($this->env, $this->source, $context["ext"], "icon_path", [], "any", false, false, false, 22)))) {
                // line 23
                yield "                                    <div class=\"d-flex align-items-center gap-2\">
                                        <div class=\"text-primary\" style=\"width: 24px; height: 24px;\">
                                            ";
                // line 25
                yield Twig\Extension\CoreExtension::source($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["ext"], "icon_path", [], "any", false, false, false, 25), true);
                yield "
                                        </div>
                                        <span>";
                // line 27
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["ext"], "name", [], "any", false, false, false, 27), "html", null, true);
                yield "</span>
                                    </div>
                                ";
            } else {
                // line 30
                yield "                                    <div class=\"d-flex align-items-center gap-2\">
                                        <img src=\"";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["ext"], "icon_url", [], "any", false, false, false, 31), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["ext"], "name", [], "any", false, false, false, 31), "html", null, true);
                yield "\" style=\"width: 32px; height: 32px;\">
                                        <span>";
                // line 32
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["ext"], "name", [], "any", false, false, false, 32), "html", null, true);
                yield "</span>
                                    </div>
                                ";
            }
            // line 35
            yield "                            </a>
                        </div>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['ext'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        yield "            </div>
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
        return "mod_system_index.html.twig";
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
        return array (  145 => 39,  136 => 35,  130 => 32,  124 => 31,  121 => 30,  115 => 27,  110 => 25,  106 => 23,  103 => 22,  101 => 21,  95 => 20,  91 => 18,  87 => 17,  80 => 13,  76 => 11,  69 => 10,  58 => 5,  54 => 1,  52 => 8,  50 => 7,  48 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_system_index.html.twig", "/var/www/html/modules/System/html_admin/mod_system_index.html.twig");
    }
}
