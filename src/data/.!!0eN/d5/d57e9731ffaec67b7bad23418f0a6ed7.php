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

/* __string_template__2ed20876efb832c7914599b3e64ee209 */
class __TwigTemplate_db53c496f196910757ea8a29523aa005 extends Template
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
        yield "
<!DOCTYPE html>
<html>
<head>
\t<meta charset=\"utf-8\">
\t<style type=\"text/css\">
\t\tbody {
\t\t\tfont-family: Arial, sans-serif;
\t\t\tfont-size: 14px;
\t\t\tcolor: #333333;
\t\t}

\t\th1 {
\t\t\tfont-size: 24px;
\t\t\tfont-weight: bold;
\t\t\tmargin: 0 0 20px;
\t\t}

\t\tp {
\t\t\tmargin: 0 0 10px;
\t\t}

\t\tstrong {
\t\t\tfont-weight: bold;
\t\t}

\t\t.signature {
\t\t\tfont-style: italic;
\t\t\tcolor: #999999;
\t\t\tmargin-top: 20px;
\t\t\tborder-top: 1px solid #cccccc;
\t\t\tpadding-top: 10px;
\t\t}
\t</style>
</head>
<body>
\t<h1>Invoice created</h1>
\t<p>Hello ";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "first_name", [], "any", false, false, false, 38), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "last_name", [], "any", false, false, false, 38), "html", null, true);
        yield ",</p>
\t<p>This is to notify that invoice ";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "id", [], "any", false, false, false, 39), "html", null, true);
        yield " was generated on ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "created_at", [], "any", false, false, false, 39)), "html", null, true);
        yield ".</p>
    <ul>
        <li><strong>Amount Due:</strong> ";
        // line 41
        yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "total", [], "any", false, false, false, 41), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 41));
        yield "</li>
        <li><strong>Due Date:</strong>  ";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "due_at", [], "any", false, false, false, 42)), "html", null, true);
        yield "</li>
    </ul>

    <p>You may view and pay the invoice <a href=\"";
        // line 45
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("invoice");
        yield "/";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "hash", [], "any", false, false, false, 45), "html", null, true);
        yield "\" target=\"_blank\">here.</a>
    <p>You may also <a href=\"";
        // line 46
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("login", ["email" => CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "email", [], "any", false, false, false, 46)]);
        yield "\" target=\"_blank\">login</a> or <a href=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("client/profile");
        yield "\" target=\"_blank\">edit your profile.</a>

\t<p class=\"signature\">";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 48), "signature", [], "any", false, false, false, 48), "html", null, true);
        yield "</p>
</body>
</html>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "__string_template__2ed20876efb832c7914599b3e64ee209";
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
        return array (  117 => 48,  110 => 46,  104 => 45,  98 => 42,  94 => 41,  87 => 39,  81 => 38,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "__string_template__2ed20876efb832c7914599b3e64ee209", "");
    }
}
