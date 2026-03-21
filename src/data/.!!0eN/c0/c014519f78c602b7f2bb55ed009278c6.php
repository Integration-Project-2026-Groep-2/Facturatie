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

/* layout_login.html.twig */
class __TwigTemplate_c1fc8f13ed7b1048dd4305ee9a6af5b8 extends Template
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
            'content' => [$this, 'block_content'],
            'js' => [$this, 'block_js'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" data-bs-theme=\"dark\">
<head>
    <title>";
        // line 4
        yield from $this->unwrap()->yieldBlock('meta_title', $context, $blocks);
        yield "</title>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"csrf-token\" content=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\">

    <link rel=\"shortcut icon\" href=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 10), "favicon_url", [], "any", false, false, false, 10), "html", null, true);
        yield "\">

    ";
        // line 12
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_bb_meta.html.twig");
        yield "

    ";
        // line 14
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("fossbilling");
        yield "
    ";
        // line 15
        yield $this->extensions['Box_TwigExtensions']->twig_script_tag($this->extensions['Box_TwigExtensions']->twig_library_url("Api/API.js"));
        yield "
    ";
        // line 16
        yield $this->env->getFunction('encore_entry_script_tags')->getCallable()("fossbilling");
        yield "
</head>

<body class=\"border-top-wide border-primary d-flex flex-column\">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute(\"data-bs-theme\", localStorage.getItem('theme'));
        } else {
            document.documentElement.removeAttribute(\"data-bs-theme\");
        }
    </script>

    ";
        // line 28
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 29
        yield "    ";
        yield from $this->unwrap()->yieldBlock('js', $context, $blocks);
        // line 30
        yield "
    <div class=\"d-none\">
        ";
        // line 32
        yield Twig\Extension\CoreExtension::include($this->env, $context, "../build/symbol/icons-sprite.svg");
        yield "
    </div>
    <div class=\"toast-container position-fixed bottom-0 end-0 p-3\" style=\"z-index: 1070;\">
    </div>
</body>
</html>
";
        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 28
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 29
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layout_login.html.twig";
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
        return array (  136 => 29,  126 => 28,  116 => 4,  104 => 32,  100 => 30,  97 => 29,  95 => 28,  80 => 16,  76 => 15,  72 => 14,  67 => 12,  62 => 10,  57 => 8,  50 => 4,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "layout_login.html.twig", "/var/www/html/themes/admin_default/html/layout_login.html.twig");
    }
}
