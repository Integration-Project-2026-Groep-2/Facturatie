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

/* mod_invoice_tax.html.twig */
class __TwigTemplate_1b35f291d34f05ccc06d4bd964ee6599 extends Template
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
        return "layout_default.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $macros["mf"] = $this->macros["mf"] = $this->load("macro_functions.html.twig", 3)->unwrap();
        // line 7
        $context["params"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_get_params", [], "any", false, false, false, 7);
        // line 9
        $context["active_menu"] = "system";
        // line 1
        $this->parent = $this->load("layout_default.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tax"), "html", null, true);
        yield from [];
    }

    // line 11
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 12
        yield "    <ul class=\"nav nav-tabs\" role=\"tablist\">
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link active\" href=\"#tab-index\" data-bs-toggle=\"tab\">";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tax rules"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link\" href=\"#tab-new\" data-bs-toggle=\"tab\">
                <svg class=\"icon me-2\">
                    <use xlink:href=\"#plus\" />
                </svg>
                ";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("New tax rule"), "html", null, true);
        yield "
            </a>
        </li>
        <li>
            <a class=\"nav-link\" href=\"#tab-settings\" data-bs-toggle=\"tab\">";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tax settings"), "html", null, true);
        yield "</a>
        </li>
    </ul>

<div class=\"card\">
    <div class=\"tab-content\">
        <div class=\"tab-pane fade show active\" id=\"tab-index\" role=\"tabpanel\">
            <table class=\"table card-table table-vcenter table-striped text-nowrap sortable\">
                <thead>
                    <tr>
                        <th class=\"w-1\">
                            <input class=\"form-check-input m-0 align-middle batch-delete-master-checkbox\" type=\"checkbox\">
                        </th>
                        <th>";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
        yield "</th>
                        <th>";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Country"), "html", null, true);
        yield "</th>
                        <th>";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("State/Region"), "html", null, true);
        yield "</th>
                        <th>";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tax rate"), "html", null, true);
        yield "</th>
                        <th class=\"w-1\"></th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "invoice_tax_get_list", [["per_page" => 100]], "method", false, false, false, 46), "list", [], "any", false, false, false, 46));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["tax"]) {
            // line 47
            yield "                    <tr>
                        <td>
                            <input class=\"form-check-input m-0 align-middle batch-delete-checkbox\" type=\"checkbox\" data-item-id=\"";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tax"], "id", [], "any", false, false, false, 49), "html", null, true);
            yield "\">
                        </td>
                        <td>
                            <a href=\"";
            // line 52
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice/tax");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tax"], "id", [], "any", false, false, false, 52), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tax"], "name", [], "any", false, false, false, 52), "html", null, true);
            yield "</a>
                        </td>
                        <td>
                            ";
            // line 55
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["tax"], "country", [], "any", false, false, false, 55)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 56
                yield "                                ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v0 = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_countries", [], "any", false, false, false, 56)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[CoreExtension::getAttribute($this->env, $this->source, $context["tax"], "country", [], "any", false, false, false, 56)] ?? null) : null), "html", null, true);
                yield "
                            ";
            } else {
                // line 58
                yield "                                ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Applies to any country"), "html", null, true);
                yield "
                            ";
            }
            // line 60
            yield "                        </td>
                        <td>
                            ";
            // line 62
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["tax"], "state", [], "any", false, false, false, 62)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 63
                yield "                                ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tax"], "state", [], "any", false, false, false, 63), "html", null, true);
                yield "
                            ";
            } else {
                // line 65
                yield "                                ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Applies to any state"), "html", null, true);
                yield "
                            ";
            }
            // line 67
            yield "                        </td>
                        <td>";
            // line 68
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tax"], "taxrate", [], "any", false, false, false, 68), "html", null, true);
            yield "%</td>
                        <td>
                            <a class=\"btn btn-icon\" href=\"";
            // line 70
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice/tax");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tax"], "id", [], "any", false, false, false, 70), "html", null, true);
            yield "\">
                                <svg class=\"icon\">
                                    <use xlink:href=\"#edit\" />
                                </svg>
                            </a>
                            <a class=\"btn btn-icon api-link\"
                                href=\"";
            // line 76
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/tax_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["tax"], "id", [], "any", false, false, false, 76), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\"
                                data-api-confirm=\"";
            // line 77
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
            yield "\"
                                data-api-reload=\"1\">
                                <svg class=\"icon\">
                                    <use xlink:href=\"#delete\" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
                ";
            $context['_iterated'] = true;
        }
        // line 86
        if (!$context['_iterated']) {
            // line 87
            yield "                <tbody>
                    <tr>
                        <td class=\"text-muted\" colspan=\"5\">";
            // line 89
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                    </tr>
                </tbody>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['tax'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 93
        yield "            </table>

            <div class=\"card-footer d-flex align-items-center\">
                ";
        // line 96
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_batch_delete.html.twig", ["action" => "admin/invoice/batch_delete_tax"]);
        yield "
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-new\" role=\"tabpanel\">
            <div class=\"card-body\">
                <form method=\"post\" action=\"";
        // line 102
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/tax_create");
        yield "\" class=\"api-form\" data-api-reload=\"1\">
                    <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 103
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 105
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tax title"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <input class=\"form-control\" type=\"text\" name=\"name\" value=\"";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "name", [], "any", false, false, false, 107), "html", null, true);
        yield "\" required placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Sales Tax"), "html", null, true);
        yield "\">
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 111
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tax rate"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"input-group\">
                                <input class=\"form-control\" type=\"text\" name=\"taxrate\" value=\"";
        // line 114
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "taxrate", [], "any", false, false, false, 114), "html", null, true);
        yield "\" required placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("18"), "html", null, true);
        yield "\">
                                <span class=\"input-group-text\">%</span>
                            </div>
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 120
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Country"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            ";
        // line 122
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 122, $this->getSourceContext())->macro_selectbox(...["country", CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_countries", [], "any", false, false, false, 122), CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "country", [], "any", false, false, false, 122), 0, __trans("Apply to all countries")]);
        yield "
                        </div>
                    </div>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 126
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("State"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            ";
        // line 129
        yield "                            <input class=\"form-control\" type=\"text\" name=\"state\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "state", [], "any", false, false, false, 129), "html", null, true);
        yield "\" placeholder=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Leave empty to apply to all states"), "html", null, true);
        yield "\">
                        </div>
                    </div>

                    <input type=\"submit\" value=\"";
        // line 133
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Create"), "html", null, true);
        yield "\" class=\"btn btn-primary w-100\">
                </form>
            </div>
        </div>

        <div class=\"tab-pane fade\" id=\"tab-settings\" role=\"tabpanel\">
            <div class=\"card-body\">
                <form method=\"post\" action=\"";
        // line 140
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/update_params");
        yield "\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tax settings updated"), "html", null, true);
        yield "\">
                    <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 141
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                    <div class=\"mb-3 row\">
                        <label class=\"form-label col-3 col-form-label\">";
        // line 143
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enable tax support"), "html", null, true);
        yield ":</label>
                        <div class=\"col\">
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioTexEnabledYes\" type=\"radio\" name=\"tax_enabled\" value=\"1\"";
        // line 146
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "tax_enabled", [], "any", false, false, false, 146)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioTexEnabledYes\">";
        // line 147
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "</label>
                            </div>
                            <div class=\"form-check form-check-inline\">
                                <input class=\"form-check-input\" id=\"radioTexEnabledNo\" type=\"radio\" name=\"tax_enabled\" value=\"0\"";
        // line 150
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "tax_enabled", [], "any", false, false, false, 150)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"radioTexEnabledNo\">";
        // line 151
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "</label>
                            </div>
                        </div>
                    </div>

                    <input type=\"submit\" value=\"";
        // line 156
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update"), "html", null, true);
        yield "\" class=\"btn btn-primary w-100\">
                </form>
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
        return "mod_invoice_tax.html.twig";
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
        return array (  378 => 156,  370 => 151,  364 => 150,  358 => 147,  352 => 146,  346 => 143,  341 => 141,  335 => 140,  325 => 133,  315 => 129,  310 => 126,  303 => 122,  298 => 120,  287 => 114,  281 => 111,  272 => 107,  267 => 105,  262 => 103,  258 => 102,  249 => 96,  244 => 93,  234 => 89,  230 => 87,  228 => 86,  214 => 77,  210 => 76,  199 => 70,  194 => 68,  191 => 67,  185 => 65,  179 => 63,  177 => 62,  173 => 60,  167 => 58,  161 => 56,  159 => 55,  149 => 52,  143 => 49,  139 => 47,  134 => 46,  126 => 41,  122 => 40,  118 => 39,  114 => 38,  98 => 25,  91 => 21,  81 => 14,  77 => 12,  70 => 11,  59 => 5,  54 => 1,  52 => 9,  50 => 7,  48 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_invoice_tax.html.twig", "/var/www/html/modules/Invoice/html_admin/mod_invoice_tax.html.twig");
    }
}
