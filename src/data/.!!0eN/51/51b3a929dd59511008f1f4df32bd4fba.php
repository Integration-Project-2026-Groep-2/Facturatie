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

/* layout_public.html.twig */
class __TwigTemplate_8a2d1e4b1362f080fb911398d70b3e65 extends Template
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
            'meta_title' => [$this, 'block_meta_title'],
            'meta_description' => [$this, 'block_meta_description'],
            'opengraph' => [$this, 'block_opengraph'],
            'head' => [$this, 'block_head'],
            'js' => [$this, 'block_js'],
            'body_class' => [$this, 'block_body_class'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html class=\"no-js\" lang=\"en\" data-bs-theme=\"";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "theme", [], "any", true, true, false, 2)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "theme", [], "any", false, false, false, 2), "light")) : ("light")), "html", null, true);
        yield "\">
<head>
    <meta charset=\"utf-8\">
    <title>";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_title_prefix", [], "any", false, false, false, 5), "html", null, true);
        yield " ";
        yield from $this->unwrap()->yieldBlock('meta_title', $context, $blocks);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_title_suffix", [], "any", false, false, false, 5), "html", null, true);
        yield "</title>

    <meta property=\"bb:url\" content=\"";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::constant("SYSTEM_URL"), "html", null, true);
        yield "\">
    <meta property=\"bb:client_area\" content=\"";
        // line 8
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/");
        yield "\">
    <meta name=\"csrf-token\" content=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\">

    <meta name=\"description\" content=\"";
        // line 11
        yield from $this->unwrap()->yieldBlock('meta_description', $context, $blocks);
        yield "\">
    <meta name=\"keywords\" content=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_keywords", [], "any", false, false, false, 12), "html", null, true);
        yield "\">
    <meta name=\"robots\" content=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_robots", [], "any", false, false, false, 13), "html", null, true);
        yield "\">
    <meta name=\"author\" content=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_author", [], "any", false, false, false, 14), "html", null, true);
        yield "\">
    <meta name=\"generator\" content=\"FOSSBilling\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">

    ";
        // line 18
        yield from $this->unwrap()->yieldBlock('opengraph', $context, $blocks);
        // line 19
        yield "
    <link rel='stylesheet' type='text/css' href=\"";
        // line 20
        yield $this->extensions['Box_TwigExtensions']->twig_asset_url($this->env, "css/font-awesome.css");
        yield "\">
    ";
        // line 21
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("huraga");
        yield "

    <link rel=\"shortcut icon\" href=\"";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 23), "favicon_url", [], "any", false, false, false, 23), "html", null, true);
        yield "\">

    ";
        // line 25
        yield $this->extensions['Box_TwigExtensions']->twig_script_tag($this->extensions['Box_TwigExtensions']->twig_library_url("Api/API.js"));
        yield "
    ";
        // line 26
        yield $this->env->getFunction('encore_entry_script_tags')->getCallable()("huraga");
        yield "
    ";
        // line 27
        yield from $this->unwrap()->yieldBlock('head', $context, $blocks);
        // line 28
        yield "    ";
        yield from $this->unwrap()->yieldBlock('js', $context, $blocks);
        // line 29
        yield "</head>
<body class=\"";
        // line 30
        yield from $this->unwrap()->yieldBlock('body_class', $context, $blocks);
        yield "\">
    ";
        // line 31
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 32
        yield "    <div aria-live=\"polite\" aria-atomic=\"true\" class=\"position-relative\">
        <div class=\"toast-container position-fixed bottom-0 end-0 p-3\" style=\"z-index: 1070;\"></div>
    </div>
    ";
        // line 35
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_pending_messages.html.twig", [], true, true);
        yield "
</body>
</html>
";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 11
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_description(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_description", [], "any", false, false, false, 11), "html", null, true);
        yield from [];
    }

    // line 18
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_opengraph(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 27
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 28
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 30
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 31
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layout_public.html.twig";
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
        return array (  215 => 31,  205 => 30,  195 => 28,  185 => 27,  175 => 18,  164 => 11,  154 => 5,  145 => 35,  140 => 32,  138 => 31,  134 => 30,  131 => 29,  128 => 28,  126 => 27,  122 => 26,  118 => 25,  113 => 23,  108 => 21,  104 => 20,  101 => 19,  99 => 18,  92 => 14,  88 => 13,  84 => 12,  80 => 11,  75 => 9,  71 => 8,  67 => 7,  58 => 5,  52 => 2,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "layout_public.html.twig", "/var/www/html/themes/huraga/html/layout_public.html.twig");
    }
}
