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

/* macro_functions.html.twig */
class __TwigTemplate_20b29ba0d56d57be9c14a5b0a23454ad extends Template
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
        // line 9
        yield "
";
        // line 17
        yield "
";
        // line 22
        yield "
";
        // line 27
        yield "
";
        // line 52
        yield "
";
        // line 57
        yield "
";
        // line 66
        yield "

";
        // line 80
        yield "
";
        yield from [];
    }

    // line 1
    public function macro_selectbox($name = null, $options = null, $selected = null, $required = null, $nullOption = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "name" => $name,
            "options" => $options,
            "selected" => $selected,
            "required" => $required,
            "nullOption" => $nullOption,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 2
            yield "    <select name=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] ?? null), "html", null, true);
            yield "\" class=\"form-control";
            if ((($tmp = ($context["required"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " is-required";
            }
            yield "\">
        ";
            // line 3
            if ((($tmp = ($context["nullOption"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<option value=\"\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nullOption"] ?? null), "html", null, true);
                yield "</option>";
            }
            // line 4
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["options"] ?? null));
            foreach ($context['_seq'] as $context["val"] => $context["label"]) {
                // line 5
                yield "        <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["val"], "html", null, true);
                yield "\" ";
                if ((($context["selected"] ?? null) == $context["val"])) {
                    yield "selected";
                }
                yield ">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield "</option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['val'], $context['label'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 7
            yield "    </select>
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 10
    public function macro_selectboxtld($name = null, $options = null, $selected = null, $required = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "name" => $name,
            "options" => $options,
            "selected" => $selected,
            "required" => $required,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 11
            yield "    <select name=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] ?? null), "html", null, true);
            yield "\" class=\"form-control";
            if ((($tmp = ($context["required"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " is-required";
            }
            yield "\" style=\"width: 80px;\">
        ";
            // line 12
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["options"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["data"]) {
                // line 13
                yield "        <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "tld", [], "any", false, false, false, 13), "html", null, true);
                yield "\" ";
                if ((($context["selected"] ?? null) == CoreExtension::getAttribute($this->env, $this->source, $context["data"], "tld", [], "any", false, false, false, 13))) {
                    yield "selected";
                }
                yield ">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "tld", [], "any", false, false, false, 13), "html", null, true);
                yield "</option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['data'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            yield "    </select>
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 19
    public function macro_currency_format($price = null, $currency = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "price" => $price,
            "currency" => $currency,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 20
            yield "    ";
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, ($context["price"] ?? null), ($context["currency"] ?? null));
            yield "
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 24
    public function macro_currency($price = null, $currency = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "price" => $price,
            "currency" => $currency,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 25
            yield "    ";
            yield $this->extensions['Box_TwigExtensions']->twig_money_convert($this->env, ($context["price"] ?? null), ($context["currency"] ?? null));
            yield "
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 28
    public function macro_status_name($status = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "status" => $status,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 29
            yield "    ";
            $context["status"] = Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::titleCase($this->env->getCharset(), Twig\Extension\CoreExtension::replace(($context["status"] ?? null), ["_" => " "])));
            // line 30
            yield "    ";
            if ((($context["status"] ?? null) == "Active")) {
                // line 31
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Active"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 32
($context["status"] ?? null) == "Pending Setup")) {
                // line 33
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Pending Setup"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 34
($context["status"] ?? null) == "Failed Setup")) {
                // line 35
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Failed Setup"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 36
($context["status"] ?? null) == "Failed Renew")) {
                // line 37
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Failed Renewal"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 38
($context["status"] ?? null) == "Suspended")) {
                // line 39
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Suspended"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 40
($context["status"] ?? null) == "Canceled")) {
                // line 41
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Canceled"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 42
($context["status"] ?? null) == "Paid")) {
                // line 43
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 44
($context["status"] ?? null) == "Unpaid")) {
                // line 45
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Unpaid"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 46
($context["status"] ?? null) == "Refunded")) {
                // line 47
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Refunded"), "html", null, true);
                yield "
    ";
            } else {
                // line 49
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans(($context["status"] ?? null)), "html", null, true);
                yield "
    ";
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 54
    public function macro_period_name($period = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "period" => $period,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 55
            yield "    ";
            yield $this->extensions['Box_TwigExtensions']->twig_period_title($this->env, ($context["period"] ?? null));
            yield "
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 58
    public function macro_markdown_quote($text = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "text" => $text,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 59
            yield "


";
            // line 62
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::split($this->env->getCharset(), ($context["text"] ?? null), "
"));
            foreach ($context['_seq'] as $context["_key"] => $context["line"]) {
                // line 63
                yield "> ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["line"], "html", null, true);
                yield "
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['line'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 68
    public function macro_recaptcha(...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 69
            yield "
";
            // line 70
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "extension_is_on", [["mod" => "spamchecker"]], "method", false, false, false, 70)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 71
                $context["rc"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "spamchecker_recaptcha", [], "any", false, false, false, 71);
                // line 72
                yield "    ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["rc"] ?? null), "enabled", [], "any", false, false, false, 72)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 73
                    yield "        ";
                    if ((CoreExtension::getAttribute($this->env, $this->source, ($context["rc"] ?? null), "version", [], "any", false, false, false, 73) == 2)) {
                        // line 74
                        yield "            <script src='https://www.google.com/recaptcha/api.js' async defer></script>
            <div class=\"g-recaptcha\" data-sitekey=\"";
                        // line 75
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["rc"] ?? null), "publickey", [], "any", false, false, false, 75), "html", null, true);
                        yield "\"></div>
        ";
                    }
                    // line 77
                    yield "    ";
                }
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 81
    public function macro_wysiwyg($selector = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "selector" => $selector,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 82
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "extension_is_on", [["mod" => "wysiwyg"]], "method", false, false, false, 82)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 83
                yield Twig\Extension\CoreExtension::include($this->env, $context, "mod_wysiwyg_js.html.twig", ["class" => Twig\Extension\CoreExtension::trim(($context["selector"] ?? null), ".#")]);
                yield "
";
            } else {
                // line 85
                yield "<!-- No WYSIWYG, no fancy stuff. Enable the WYSIWYG extension for a better management experience. -->
";
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "macro_functions.html.twig";
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
        return array (  427 => 85,  422 => 83,  420 => 82,  408 => 81,  400 => 77,  395 => 75,  392 => 74,  389 => 73,  386 => 72,  384 => 71,  382 => 70,  379 => 69,  368 => 68,  355 => 63,  350 => 62,  345 => 59,  333 => 58,  324 => 55,  312 => 54,  302 => 49,  296 => 47,  294 => 46,  289 => 45,  287 => 44,  282 => 43,  280 => 42,  275 => 41,  273 => 40,  268 => 39,  266 => 38,  261 => 37,  259 => 36,  254 => 35,  252 => 34,  247 => 33,  245 => 32,  240 => 31,  237 => 30,  234 => 29,  222 => 28,  213 => 25,  200 => 24,  191 => 20,  178 => 19,  171 => 15,  156 => 13,  152 => 12,  143 => 11,  128 => 10,  121 => 7,  106 => 5,  101 => 4,  95 => 3,  86 => 2,  70 => 1,  64 => 80,  60 => 66,  57 => 57,  54 => 52,  51 => 27,  48 => 22,  45 => 17,  42 => 9,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "macro_functions.html.twig", "/var/www/html/themes/huraga/html/macro_functions.html.twig");
    }
}
