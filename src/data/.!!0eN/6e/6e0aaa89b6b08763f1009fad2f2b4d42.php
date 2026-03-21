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
class __TwigTemplate_d1273d065871d4f9551376e83c9d33e3 extends Template
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
        // line 8
        yield "
";
        // line 17
        yield "
";
        // line 25
        yield "
";
        // line 71
        yield "
";
        // line 88
        yield "
";
        // line 112
        yield "
";
        // line 137
        yield "
";
        // line 141
        yield "
";
        // line 148
        yield "
";
        // line 156
        yield "
";
        yield from [];
    }

    // line 1
    public function macro_q($bool = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "bool" => $bool,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 2
            yield "    ";
            if ((($tmp = ($context["bool"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 3
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
                yield "
    ";
            } else {
                // line 5
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
                yield "
    ";
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 9
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
            // line 10
            yield "    <select class=\"form-select\" name=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] ?? null), "html", null, true);
            yield "\" id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] ?? null), "html", null, true);
            yield "\"";
            if ((($tmp = ($context["required"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " required";
            }
            yield ">
        ";
            // line 11
            if ((($tmp = ($context["nullOption"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<option value=\"\">-- ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nullOption"] ?? null), "html", null, true);
                yield " --</option>";
            }
            // line 12
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["options"] ?? null));
            foreach ($context['_seq'] as $context["val"] => $context["label"]) {
                // line 13
                yield "        <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["val"], "html", null, true);
                yield "\" label=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"]);
                yield "\" ";
                if ((($context["selected"] ?? null) == $context["val"])) {
                    yield "selected=\"selected\"";
                }
                yield ">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"]);
                yield "</option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['val'], $context['label'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            yield "    </select>
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 18
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
            // line 19
            yield "    <select class=\"form-select\" name=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] ?? null), "html", null, true);
            yield "\"";
            if ((($tmp = ($context["required"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " required";
            }
            yield ">
        ";
            // line 20
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["options"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["data"]) {
                // line 21
                yield "        <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "tld", [], "any", false, false, false, 21), "html", null, true);
                yield "\" label=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "tld", [], "any", false, false, false, 21), "html", null, true);
                yield "\"";
                if ((($context["selected"] ?? null) == CoreExtension::getAttribute($this->env, $this->source, $context["data"], "tld", [], "any", false, false, false, 21))) {
                    yield " selected";
                }
                yield ">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["data"], "tld", [], "any", false, false, false, 21), "html", null, true);
                yield "</option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['data'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            yield "    </select>
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 26
    public function macro_build_form($elements = null, $values = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "elements" => $elements,
            "values" => $values,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 27
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["elements"] ?? null));
            foreach ($context['_seq'] as $context["name"] => $context["element"]) {
                // line 28
                yield "    <div class=\"mb-3 row\">
        ";
                // line 29
                if (((($_v0 = $context["element"]) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[0] ?? null) : null) == "select")) {
                    // line 30
                    yield "        <label class=\"form-label col-3 col-form-label\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v1 = $context["element"]) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1[1] ?? null) : null), "label", [], "any", false, false, false, 30), "html", null, true);
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (($_v2 = $context["element"]) && is_array($_v2) || $_v2 instanceof ArrayAccess ? ($_v2[1] ?? null) : null), "description", [], "any", false, false, false, 30)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield " - ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v3 = $context["element"]) && is_array($_v3) || $_v3 instanceof ArrayAccess ? ($_v3[1] ?? null) : null), "description", [], "any", false, false, false, 30), "html", null, true);
                    }
                    yield "</label>
        <div class=\"col\">
            <select class=\"form-select\" name=\"config[";
                    // line 32
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
                    yield "]\">
            ";
                    // line 33
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (($_v4 = $context["element"]) && is_array($_v4) || $_v4 instanceof ArrayAccess ? ($_v4[1] ?? null) : null), "multiOptions", [], "any", false, false, false, 33));
                    foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                        // line 34
                        yield "                <option value=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["k"], "html", null, true);
                        yield "\"";
                        if (($context["k"] == (($_v5 = ($context["values"] ?? null)) && is_array($_v5) || $_v5 instanceof ArrayAccess ? ($_v5[$context["name"]] ?? null) : null))) {
                            yield " selected";
                        }
                        yield "/><label>";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["v"], "html", null, true);
                        yield "</label>
            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['k'], $context['v'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 36
                    yield "            </select>
        </div>
        ";
                } elseif (((($_v6 =                 // line 38
$context["element"]) && is_array($_v6) || $_v6 instanceof ArrayAccess ? ($_v6[0] ?? null) : null) == "multiselect")) {
                    // line 39
                    yield "        <label class=\"form-label col-3 col-form-label\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v7 = $context["element"]) && is_array($_v7) || $_v7 instanceof ArrayAccess ? ($_v7[1] ?? null) : null), "label", [], "any", false, false, false, 39), "html", null, true);
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (($_v8 = $context["element"]) && is_array($_v8) || $_v8 instanceof ArrayAccess ? ($_v8[1] ?? null) : null), "description", [], "any", false, false, false, 39)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield " - ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v9 = $context["element"]) && is_array($_v9) || $_v9 instanceof ArrayAccess ? ($_v9[1] ?? null) : null), "description", [], "any", false, false, false, 39), "html", null, true);
                    }
                    yield "</label>
        <div class=\"col\">
            <select class=\"form-select\" name=\"config[";
                    // line 41
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
                    yield "]\" multiple>
            ";
                    // line 42
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (($_v10 = $context["element"]) && is_array($_v10) || $_v10 instanceof ArrayAccess ? ($_v10[1] ?? null) : null), "multiOptions", [], "any", false, false, false, 42));
                    foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                        // line 43
                        yield "                <option value=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["k"], "html", null, true);
                        yield "\"";
                        if (($context["k"] == (($_v11 = ($context["values"] ?? null)) && is_array($_v11) || $_v11 instanceof ArrayAccess ? ($_v11[$context["name"]] ?? null) : null))) {
                            yield " selected";
                        }
                        yield "/><label>";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["v"], "html", null, true);
                        yield "</label>
            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['k'], $context['v'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 45
                    yield "            </select>
        </div>
        ";
                } elseif (((($_v12 =                 // line 47
$context["element"]) && is_array($_v12) || $_v12 instanceof ArrayAccess ? ($_v12[0] ?? null) : null) == "radio")) {
                    // line 48
                    yield "        <label class=\"form-label col-3 col-form-label\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v13 = $context["element"]) && is_array($_v13) || $_v13 instanceof ArrayAccess ? ($_v13[1] ?? null) : null), "label", [], "any", false, false, false, 48), "html", null, true);
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (($_v14 = $context["element"]) && is_array($_v14) || $_v14 instanceof ArrayAccess ? ($_v14[1] ?? null) : null), "description", [], "any", false, false, false, 48)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield " - ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v15 = $context["element"]) && is_array($_v15) || $_v15 instanceof ArrayAccess ? ($_v15[1] ?? null) : null), "description", [], "any", false, false, false, 48), "html", null, true);
                    }
                    yield "</label>
        <div class=\"col\">
            ";
                    // line 50
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (($_v16 = $context["element"]) && is_array($_v16) || $_v16 instanceof ArrayAccess ? ($_v16[1] ?? null) : null), "multiOptions", [], "any", false, false, false, 50));
                    foreach ($context['_seq'] as $context["k"] => $context["v"]) {
                        // line 51
                        yield "                <div class=\"form-check form-check-inline\">
                    <input class=\"form-check-input\" id=\"el-";
                        // line 52
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] . $context["k"]), "html", null, true);
                        yield "\" type=\"radio\" name=\"config[";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
                        yield "]\" value=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["k"], "html", null, true);
                        yield "\"";
                        if (($context["k"] == (($_v17 = ($context["values"] ?? null)) && is_array($_v17) || $_v17 instanceof ArrayAccess ? ($_v17[$context["name"]] ?? null) : null))) {
                            yield " checked";
                        }
                        yield ">
                    <label class=\"form-check-label\" for=\"el-";
                        // line 53
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] . $context["k"]), "html", null, true);
                        yield "\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["v"], "html", null, true);
                        yield "</label>
                </div>
            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['k'], $context['v'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 56
                    yield "        </div>
        ";
                } elseif (((($_v18 =                 // line 57
$context["element"]) && is_array($_v18) || $_v18 instanceof ArrayAccess ? ($_v18[0] ?? null) : null) == "textarea")) {
                    // line 58
                    yield "        <label class=\"form-label col-3 col-form-label\" for=\"el-";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v19 = $context["element"]) && is_array($_v19) || $_v19 instanceof ArrayAccess ? ($_v19[1] ?? null) : null), "label", [], "any", false, false, false, 58), "html", null, true);
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (($_v20 = $context["element"]) && is_array($_v20) || $_v20 instanceof ArrayAccess ? ($_v20[1] ?? null) : null), "description", [], "any", false, false, false, 58)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield " - ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v21 = $context["element"]) && is_array($_v21) || $_v21 instanceof ArrayAccess ? ($_v21[1] ?? null) : null), "description", [], "any", false, false, false, 58), "html", null, true);
                    }
                    yield "</label>
        <div class=\"col\">
            <textarea class=\"form-control\" id=\"el-";
                    // line 60
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
                    yield "\" name=\"config[";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
                    yield "]\" rows=\"20\" required>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v22 = ($context["values"] ?? null)) && is_array($_v22) || $_v22 instanceof ArrayAccess ? ($_v22[$context["name"]] ?? null) : null), "html", null, true);
                    yield "</textarea>
        </div>
        ";
                } else {
                    // line 63
                    yield "        <label class=\"form-label col-3 col-form-label\" for=\"el-";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v23 = $context["element"]) && is_array($_v23) || $_v23 instanceof ArrayAccess ? ($_v23[1] ?? null) : null), "label", [], "any", false, false, false, 63), "html", null, true);
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (($_v24 = $context["element"]) && is_array($_v24) || $_v24 instanceof ArrayAccess ? ($_v24[1] ?? null) : null), "description", [], "any", false, false, false, 63)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield " - ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v25 = $context["element"]) && is_array($_v25) || $_v25 instanceof ArrayAccess ? ($_v25[1] ?? null) : null), "description", [], "any", false, false, false, 63), "html", null, true);
                    }
                    yield "</label>
        <div class=\"col\">
            <input class=\"form-control\" id=\"el-";
                    // line 65
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
                    yield "\" type=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v26 = $context["element"]) && is_array($_v26) || $_v26 instanceof ArrayAccess ? ($_v26[0] ?? null) : null), "html", null, true);
                    yield "\" name=\"config[";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["name"], "html", null, true);
                    yield "]\" value=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v27 = ($context["values"] ?? null)) && is_array($_v27) || $_v27 instanceof ArrayAccess ? ($_v27[$context["name"]] ?? null) : null), "html", null, true);
                    yield "\"";
                    if (( !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["element"], 1, [], "array", false, true, false, 65), "required", [], "any", true, true, false, 65) && ( !CoreExtension::getAttribute($this->env, $this->source, (($_v28 = $context["element"]) && is_array($_v28) || $_v28 instanceof ArrayAccess ? ($_v28[1] ?? null) : null), "required", [], "any", false, false, false, 65) == "false"))) {
                        yield " required";
                    }
                    yield ">
        </div>
        ";
                }
                // line 68
                yield "    </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['name'], $context['element'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 72
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
            // line 73
            yield "    ";
            $context["c"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "currency_get", [["code" => ($context["currency"] ?? null)]], "method", false, false, false, 73);
            // line 74
            yield "    ";
            $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["price"] ?? null));
            // line 75
            yield "    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "price_format", [], "any", false, false, false, 75) == 1)) {
                // line 76
                yield "        ";
                $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["p"] ?? null), "2", ".", "");
                // line 77
                yield "    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "price_format", [], "any", false, false, false, 77) == 2)) {
                // line 78
                yield "        ";
                $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["p"] ?? null), "2", ".", ",");
                // line 79
                yield "    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "price_format", [], "any", false, false, false, 79) == 3)) {
                // line 80
                yield "        ";
                $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["p"] ?? null), "2", ",", ".");
                // line 81
                yield "    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "price_format", [], "any", false, false, false, 81) == 4)) {
                // line 82
                yield "        ";
                $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["p"] ?? null), "0", "", ",");
                // line 83
                yield "    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "price_format", [], "any", false, false, false, 83) == 5)) {
                // line 84
                yield "        ";
                $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["p"] ?? null), 0, "", "");
                // line 85
                yield "    ";
            }
            // line 86
            yield "    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "format", [], "any", false, false, false, 86), ["{{price}}" => ($context["p"] ?? null)]), "html", null, true);
            yield "
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 89
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
            // line 90
            yield "    ";
            if ((($context["currency"] ?? null) == null)) {
                // line 91
                yield "        ";
                $context["c"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "cart_get_currency", [], "any", false, false, false, 91);
                // line 92
                yield "    ";
            } else {
                // line 93
                yield "        ";
                $context["c"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "currency_get", [["code" => ($context["currency"] ?? null)]], "method", false, false, false, 93);
                // line 94
                yield "    ";
            }
            // line 95
            yield "
    ";
            // line 96
            $context["p"] = (($context["price"] ?? null) * CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "conversion_rate", [], "any", false, false, false, 96));
            // line 97
            yield "
    ";
            // line 98
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "price_format", [], "any", false, false, false, 98) == 1)) {
                // line 99
                yield "        ";
                $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["p"] ?? null), "2", ".", "");
                // line 100
                yield "    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "price_format", [], "any", false, false, false, 100) == 2)) {
                // line 101
                yield "        ";
                $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["p"] ?? null), "2", ".", ",");
                // line 102
                yield "    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "price_format", [], "any", false, false, false, 102) == 3)) {
                // line 103
                yield "        ";
                $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["p"] ?? null), "2", ",", ".");
                // line 104
                yield "    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "price_format", [], "any", false, false, false, 104) == 4)) {
                // line 105
                yield "        ";
                $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["p"] ?? null), "0", "", ",");
                // line 106
                yield "    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "price_format", [], "any", false, false, false, 106) == 5)) {
                // line 107
                yield "        ";
                $context["p"] = $this->extensions['Box_TwigExtensions']->twig_number_filter(($context["p"] ?? null), 0, "", "");
                // line 108
                yield "    ";
            }
            // line 109
            yield "
    ";
            // line 110
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, ($context["c"] ?? null), "format", [], "any", false, false, false, 110), ["{{price}}" => ($context["p"] ?? null)]), "html", null, true);
            yield "
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 113
    public function macro_status_name($status = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "status" => $status,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 114
            yield "    ";
            $context["status"] = Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::titleCase($this->env->getCharset(), Twig\Extension\CoreExtension::replace(($context["status"] ?? null), ["_" => " "])));
            // line 115
            yield "    ";
            if ((($context["status"] ?? null) == "Active")) {
                // line 116
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Active"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 117
($context["status"] ?? null) == "Pending Setup")) {
                // line 118
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Pending Setup"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 119
($context["status"] ?? null) == "Failed Setup")) {
                // line 120
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Failed Setup"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 121
($context["status"] ?? null) == "Failed Renew")) {
                // line 122
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Failed Renewal"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 123
($context["status"] ?? null) == "Suspended")) {
                // line 124
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Suspended"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 125
($context["status"] ?? null) == "Canceled")) {
                // line 126
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Canceled"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 127
($context["status"] ?? null) == "Paid")) {
                // line 128
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 129
($context["status"] ?? null) == "Unpaid")) {
                // line 130
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Unpaid"), "html", null, true);
                yield "
    ";
            } elseif ((            // line 131
($context["status"] ?? null) == "Refunded")) {
                // line 132
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Refunded"), "html", null, true);
                yield "
    ";
            } else {
                // line 134
                yield "        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans(($context["status"] ?? null)), "html", null, true);
                yield "
    ";
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 138
    public function macro_period_name($period = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "period" => $period,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 139
            yield "    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_period_title", [["code" => ($context["period"] ?? null)]], "method", false, false, false, 139), "html", null, true);
            yield "
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 142
    public function macro_markdown_quote($text = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "text" => $text,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 143
            yield "
";
            // line 144
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::split($this->env->getCharset(), ($context["text"] ?? null), "
"));
            foreach ($context['_seq'] as $context["_key"] => $context["line"]) {
                // line 145
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

    // line 149
    public function macro_bb_editor($selector = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "selector" => $selector,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 150
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "extension_is_on", [["mod" => "wysiwyg"]], "method", false, false, false, 150)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 151
                yield Twig\Extension\CoreExtension::include($this->env, $context, "mod_wysiwyg_js.html.twig", ["class" => Twig\Extension\CoreExtension::trim(($context["selector"] ?? null), ".#")]);
                yield "
";
            } else {
                // line 153
                yield "<!-- No WYSIWYG, no fancy stuff. Enable the WYSIWYG extension for a better management experience. -->
";
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 157
    public function macro_table_search(...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 158
            yield "<div style=\"position: relative;\">
    <div class=\"dataTables_filter\">
        <form method=\"get\" action=\"\">
            <input type=\"hidden\" name=\"CSRFToken\" value=\"";
            // line 161
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
            yield "\"/>
            <input type=\"hidden\" name=\"_url\" value=\"";
            // line 162
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "_url", [], "any", false, false, false, 162), "html", null, true);
            yield "\"/>
            <label>";
            // line 163
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Search:"), "html", null, true);
            yield " <input type=\"text\" name=\"search\" placeholder=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enter search text..."), "html", null, true);
            yield "\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "search", [], "any", false, false, false, 163), "html", null, true);
            yield "\"><div class=\"srch\"></div></label>
        </form>
    </div>
</div>
";
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
        return array (  762 => 163,  758 => 162,  754 => 161,  749 => 158,  738 => 157,  730 => 153,  725 => 151,  723 => 150,  711 => 149,  698 => 145,  693 => 144,  690 => 143,  678 => 142,  669 => 139,  657 => 138,  647 => 134,  641 => 132,  639 => 131,  634 => 130,  632 => 129,  627 => 128,  625 => 127,  620 => 126,  618 => 125,  613 => 124,  611 => 123,  606 => 122,  604 => 121,  599 => 120,  597 => 119,  592 => 118,  590 => 117,  585 => 116,  582 => 115,  579 => 114,  567 => 113,  559 => 110,  556 => 109,  553 => 108,  550 => 107,  547 => 106,  544 => 105,  541 => 104,  538 => 103,  535 => 102,  532 => 101,  529 => 100,  526 => 99,  524 => 98,  521 => 97,  519 => 96,  516 => 95,  513 => 94,  510 => 93,  507 => 92,  504 => 91,  501 => 90,  488 => 89,  479 => 86,  476 => 85,  473 => 84,  470 => 83,  467 => 82,  464 => 81,  461 => 80,  458 => 79,  455 => 78,  452 => 77,  449 => 76,  446 => 75,  443 => 74,  440 => 73,  427 => 72,  416 => 68,  400 => 65,  388 => 63,  378 => 60,  366 => 58,  364 => 57,  361 => 56,  350 => 53,  338 => 52,  335 => 51,  331 => 50,  321 => 48,  319 => 47,  315 => 45,  300 => 43,  296 => 42,  292 => 41,  282 => 39,  280 => 38,  276 => 36,  261 => 34,  257 => 33,  253 => 32,  243 => 30,  241 => 29,  238 => 28,  233 => 27,  220 => 26,  213 => 23,  196 => 21,  192 => 20,  183 => 19,  168 => 18,  161 => 15,  144 => 13,  139 => 12,  133 => 11,  122 => 10,  106 => 9,  96 => 5,  90 => 3,  87 => 2,  75 => 1,  69 => 156,  66 => 148,  63 => 141,  60 => 137,  57 => 112,  54 => 88,  51 => 71,  48 => 25,  45 => 17,  42 => 8,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "macro_functions.html.twig", "/var/www/html/themes/admin_default/html/macro_functions.html.twig");
    }
}
