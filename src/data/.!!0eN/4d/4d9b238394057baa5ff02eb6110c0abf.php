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

/* mod_index_dashboard.html.twig */
class __TwigTemplate_67e5658d671348f5d18fc2aa355772f6 extends Template
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
            'js' => [$this, 'block_js'],
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Dashboard"), "html", null, true);
        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 8
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_cas_messages", [], "method", false, false, false, 8));
        foreach ($context['_seq'] as $context["_key"] => $context["alert"]) {
            // line 9
            yield "    <div class=\"alert alert-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["alert"], "type", [], "any", false, false, false, 9), "html", null, true);
            yield " ";
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["alert"], "dismissible", [], "any", false, false, false, 9)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("alert-dismissible") : (""));
            yield "\" role=\"alert\">
        <h3 class=\"mb-1\">";
            // line 10
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["alert"], "title", [], "any", false, false, false, 10), "html", null, true);
            yield "</h3>
        <p>";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["alert"], "message", [], "any", false, false, false, 11), "html", null, true);
            yield "</p>
        ";
            // line 12
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["alert"], "buttons", [], "any", false, false, false, 12)) > 0)) {
                // line 13
                yield "            <div class=\"btn-list\">
            ";
                // line 14
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["alert"], "buttons", [], "any", false, false, false, 14));
                foreach ($context['_seq'] as $context["_key"] => $context["button"]) {
                    // line 15
                    yield "                <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["button"], "link", [], "any", false, false, false, 15), "html", null, true);
                    yield "\" class=\"btn ";
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["button"], "type", [], "any", false, false, false, 15)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("btn-" . CoreExtension::getAttribute($this->env, $this->source, $context["button"], "type", [], "any", false, false, false, 15)), "html", null, true)) : (""));
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["button"], "text", [], "any", false, false, false, 15), "html", null, true);
                    yield "</a>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['button'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 17
                yield "            </div>
        ";
            }
            // line 19
            yield "        ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["alert"], "dismissible", [], "any", false, false, false, 19)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 20
                yield "            <a class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Close"), "html", null, true);
                yield "\"></a>
        ";
            }
            // line 22
            yield "    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['alert'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_messages", [["type" => "danger"]], "method", false, false, false, 24));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 25
            yield "    <div class=\"alert alert-danger alert-dismissible fade show mb-3\" role=\"alert\">
        <strong>";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Danger!"), "html", null, true);
            yield "</strong> ";
            if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "url", [], "any", false, false, false, 26))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "url", [], "any", false, false, false, 26), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "text", [], "any", false, false, false, 26), "html", null, true);
                yield "</a>";
            } else {
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "text", [], "any", false, false, false, 26), "html", null, true);
                yield " ";
            }
            // line 27
            yield "        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Close"), "html", null, true);
            yield "\"></button>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_messages", [["type" => "warning"]], "method", false, false, false, 30));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 31
            yield "    <div class=\"alert alert-warning alert-dismissible fade show mb-3\" role=\"alert\">
        <strong>";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Warning"), "html", null, true);
            yield ":</strong> ";
            if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "url", [], "any", false, false, false, 32))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "url", [], "any", false, false, false, 32), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "text", [], "any", false, false, false, 32), "html", null, true);
                yield "</a>";
            } else {
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "text", [], "any", false, false, false, 32), "html", null, true);
                yield " ";
            }
            // line 33
            yield "        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Close"), "html", null, true);
            yield "\"></button>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_messages", [["type" => "info"]], "method", false, false, false, 36));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 37
            yield "    <div class=\"alert alert-primary alert-dismissible fade show mb-3\" role=\"alert\">
        <strong>";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Information"), "html", null, true);
            yield ":</strong> ";
            if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "url", [], "any", false, false, false, 38))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "url", [], "any", false, false, false, 38), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "text", [], "any", false, false, false, 38), "html", null, true);
                yield "</a>";
            } else {
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["msg"], "text", [], "any", false, false, false, 38), "html", null, true);
                yield " ";
            }
            // line 39
            yield "        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Close"), "html", null, true);
            yield "\"></button>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        yield "
<div class=\"row row-deck row-cards\">
    ";
        // line 44
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_is_allowed", [["mod" => "stats"]], "method", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 45
            yield "        ";
            $context["stats"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "stats_get_summary", [], "any", false, false, false, 45);
            // line 46
            yield "        ";
            $context["income"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "stats_get_summary_income", [], "any", false, false, false, 46);
            // line 47
            yield "        ";
            $context["client_statuses"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_get_statuses", [], "any", false, false, false, 47);
            // line 48
            yield "        ";
            $context["order_statuses"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "order_get_statuses", [], "any", false, false, false, 48);
            // line 49
            yield "        ";
            $context["invoice_statuses"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "invoice_get_statuses", [], "any", false, false, false, 49);
            // line 50
            yield "        ";
            $context["support_statuses"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "support_ticket_get_statuses", [], "any", false, false, false, 50);
            // line 51
            yield "
        <div class=\"col-sm-6 col-lg-3\">
            <a href=\"";
            // line 53
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
            yield "\" class=\"card card-sm\">
                <div class=\"card-body\">
                    ";
            // line 55
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["client_statuses"] ?? null), "suspended", [], "any", false, false, false, 55) > 0)) {
                // line 56
                yield "                    <span class=\"position-absolute top-0 translate-middle badge rounded-pill bg-danger text-light\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client_statuses"] ?? null), "suspended", [], "any", false, false, false, 56), "html", null, true);
                yield "</span>
                    ";
            }
            // line 58
            yield "                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                            <span class=\"bg-blue text-white avatar\">
                                <svg class=\"icon\">
                                    <use xlink:href=\"#contacts\" />
                                </svg>
                            </span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "clients_total", [], "any", false, false, false, 67), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("clients"), "html", null, true);
            yield "</div>
                            <div class=\"text-muted\">";
            // line 68
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client_statuses"] ?? null), "suspended", [], "any", false, false, false, 68), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("suspended"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            <a href=\"";
            // line 75
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("order");
            yield "\" class=\"card card-sm\">
                <div class=\"card-body\">
                    ";
            // line 77
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["order_statuses"] ?? null), "suspended", [], "any", false, false, false, 77) > 0)) {
                // line 78
                yield "                    <span class=\"position-absolute top-0 translate-middle badge rounded-pill bg-danger text-light\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["order_statuses"] ?? null), "suspended", [], "any", false, false, false, 78), "html", null, true);
                yield "</span>
                    ";
            }
            // line 80
            yield "                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                        <span class=\"bg-green text-white avatar\">
                            <svg class=\"icon\">
                                <use xlink:href=\"#orders\" />
                            </svg>
                        </span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 89
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "orders_total", [], "any", false, false, false, 89), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("orders"), "html", null, true);
            yield "</div>
                            <div class=\"text-muted\">";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["order_statuses"] ?? null), "suspended", [], "any", false, false, false, 90), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("suspended"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            <a href=\"";
            // line 97
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
            yield "\" class=\"card card-sm\">
                <div class=\"card-body\">
                    ";
            // line 99
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice_statuses"] ?? null), "unpaid", [], "any", false, false, false, 99) > 0)) {
                // line 100
                yield "                    <span class=\"position-absolute top-0 translate-middle badge rounded-pill bg-danger text-light\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice_statuses"] ?? null), "unpaid", [], "any", false, false, false, 100), "html", null, true);
                yield "</span>
                    ";
            }
            // line 102
            yield "                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                            <span class=\"bg-danger text-white avatar\">
                                <svg class=\"icon\">
                                    <use xlink:href=\"#currency-dollar\" />
                                </svg>
                            </span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 111
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "invoices_total", [], "any", false, false, false, 111), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("invoices"), "html", null, true);
            yield "</div>
                            <div class=\"text-muted\">";
            // line 112
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice_statuses"] ?? null), "unpaid", [], "any", false, false, false, 112), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("unpaid"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            <a href=\"";
            // line 119
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("support");
            yield "\" class=\"card card-sm\">
                <div class=\"card-body\">
                    ";
            // line 121
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["support_statuses"] ?? null), "open", [], "any", false, false, false, 121) > 0)) {
                // line 122
                yield "                    <span class=\"position-absolute top-0 translate-middle badge rounded-pill bg-danger text-light\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["support_statuses"] ?? null), "open", [], "any", false, false, false, 122), "html", null, true);
                yield "</span>
                    ";
            }
            // line 124
            yield "                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                        <span class=\"bg-warning text-white avatar\">
                            <svg class=\"icon\">
                                <use xlink:href=\"#support\" />
                            </svg>
                        </span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 133
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "tickets_total", [], "any", false, false, false, 133), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("tickets"), "html", null, true);
            yield "</div>
                            <div class=\"text-muted\">";
            // line 134
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["support_statuses"] ?? null), "open", [], "any", false, false, false, 134), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("waiting for staff reply"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class=\"col-12\">
            <div class=\"card overflow-x-auto\">
                <div class=\"card-header\">
                    <h3 class=\"card-title\">";
            // line 144
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Statistics"), "html", null, true);
            yield "</h3>
                </div>
                <div class=\"table-responsive\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <thead>
                        <tr>
                            <th></th>
                            <th class=\"text-center\">";
            // line 151
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Today"), "html", null, true);
            yield "</th>
                            <th class=\"text-center\">";
            // line 152
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yesterday"), "html", null, true);
            yield "</th>
                            <th class=\"text-center\">";
            // line 153
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("This month so far"), "html", null, true);
            yield "</th>
                            <th class=\"text-center\">";
            // line 154
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Last month"), "html", null, true);
            yield "</th>
                            <th class=\"text-center\">";
            // line 155
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
            yield "</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>";
            // line 160
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Income"), "html", null, true);
            yield "</td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 162
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice", ["paid_at" => $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y-m-d")]);
            yield "\" class=\"text-danger\">";
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 162, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["income"] ?? null), "today", [], "any", false, false, false, 162)]);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 165
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice", ["paid_at" => $this->extensions['Twig\Extension\CoreExtension']->formatDate("yesterday", "Y-m-d")]);
            yield "\" class=\"text-danger\">";
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 165, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["income"] ?? null), "yesterday", [], "any", false, false, false, 165)]);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 168
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
            yield "\" class=\"text-danger\">";
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 168, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["income"] ?? null), "this_month", [], "any", false, false, false, 168)]);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 171
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
            yield "\" class=\"text-danger\">";
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 171, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["income"] ?? null), "last_month", [], "any", false, false, false, 171)]);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 174
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
            yield "\" class=\"text-danger\">";
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 174, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, ($context["income"] ?? null), "total", [], "any", false, false, false, 174)]);
            yield "</a>
                            </td>
                        </tr>
                        <tr>
                            <td>";
            // line 178
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Clients"), "html", null, true);
            yield "</td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 180
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client", ["created_at" => $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y-m-d")]);
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "clients_today", [], "any", false, false, false, 180), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 183
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client", ["created_at" => $this->extensions['Twig\Extension\CoreExtension']->formatDate("yesterday", "Y-m-d")]);
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "clients_yesterday", [], "any", false, false, false, 183), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 186
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "clients_this_month", [], "any", false, false, false, 186), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 189
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "clients_last_month", [], "any", false, false, false, 189), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 192
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "clients_total", [], "any", false, false, false, 192), "html", null, true);
            yield "</a>
                            </td>
                        </tr>
                        <tr>
                            <td>";
            // line 196
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Orders"), "html", null, true);
            yield "</td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 198
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("order", ["created_at" => $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y-m-d")]);
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "orders_today", [], "any", false, false, false, 198), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 201
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("order", ["created_at" => $this->extensions['Twig\Extension\CoreExtension']->formatDate("yesterday", "Y-m-d")]);
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "orders_yesterday", [], "any", false, false, false, 201), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 204
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("order");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "orders_this_month", [], "any", false, false, false, 204), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 207
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("order");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "orders_last_month", [], "any", false, false, false, 207), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 210
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("order");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "orders_total", [], "any", false, false, false, 210), "html", null, true);
            yield "</a>
                            </td>
                        </tr>
                        <tr>
                            <td>";
            // line 214
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
            yield "</td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 216
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice", ["created_at" => $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y-m-d")]);
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "invoices_today", [], "any", false, false, false, 216), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 219
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice", ["created_at" => $this->extensions['Twig\Extension\CoreExtension']->formatDate("yesterday", "Y-m-d")]);
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "invoices_yesterday", [], "any", false, false, false, 219), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 222
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "invoices_this_month", [], "any", false, false, false, 222), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 225
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "invoices_last_month", [], "any", false, false, false, 225), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 228
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "invoices_total", [], "any", false, false, false, 228), "html", null, true);
            yield "</a>
                            </td>
                        </tr>
                        <tr>
                            <td>";
            // line 232
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tickets"), "html", null, true);
            yield "</td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 234
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("support", ["created_at" => $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y-m-d")]);
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "tickets_today", [], "any", false, false, false, 234), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 237
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("support", ["created_at" => $this->extensions['Twig\Extension\CoreExtension']->formatDate("yesterday", "Y-m-d")]);
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "tickets_yesterday", [], "any", false, false, false, 237), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 240
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("support");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "tickets_this_month", [], "any", false, false, false, 240), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 243
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("support");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "tickets_last_month", [], "any", false, false, false, 243), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">
                                <a href=\"";
            // line 246
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("support");
            yield "\" class=\"text-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["stats"] ?? null), "tickets_total", [], "any", false, false, false, 246), "html", null, true);
            yield "</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    ";
        }
        // line 255
        yield "
    ";
        // line 256
        $context["invoicesUnpaid"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "invoice_get_list", [["status" => "unpaid"]], "method", false, false, false, 256);
        // line 257
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["invoicesUnpaid"] ?? null), "list", [], "any", false, false, false, 257)) > 0)) {
            // line 258
            yield "    <div class=\"col-12\">
        <div class=\"card\">
            <div class=\"card-header\">
                <h3 class=\"card-title\">";
            // line 261
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
            yield "</h3>
                <div class=\"card-actions\">
                    <a href=\"";
            // line 263
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/invoice");
            yield "\" class=\"btn-action\">
                        <svg class=\"icon\">
                            <use xlink:href=\"#dots-vertical\" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class=\"table-responsive\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <tbody>
                        ";
            // line 274
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["invoicesUnpaid"] ?? null), "list", [], "any", false, false, false, 274));
            foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
                // line 275
                yield "                        <tr>
                            <td class=\"w-1\">
                                <a href=\"";
                // line 277
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/invoice/manage");
                yield "/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "id", [], "any", false, false, false, 277), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "serie_nr", [], "any", false, false, false, 277), "html", null, true);
                yield "</a>
                            </td>
                            <td class=\"w-1\">
                                <a href=\"";
                // line 280
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
                yield "/manage/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "client", [], "any", false, false, false, 280), "id", [], "any", false, false, false, 280), "html", null, true);
                yield "\">
                                    <span class=\"avatar avatar-xs\" style=\"background-image: url(";
                // line 281
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_gravatar_filter(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "buyer", [], "any", false, false, false, 281), "email", [], "any", false, false, false, 281)), "html", null, true);
                yield "&size=24\"></span>
                                </a>
                            </td>
                            <td>
                                <a href=\"";
                // line 285
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
                yield "/manage/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "client", [], "any", false, false, false, 285), "id", [], "any", false, false, false, 285), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "buyer", [], "any", false, false, false, 285), "first_name", [], "any", false, false, false, 285), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "buyer", [], "any", false, false, false, 285), "last_name", [], "any", false, false, false, 285), "html", null, true);
                yield "</a>
                            </td>
                            <td class=\"text-center\">";
                // line 287
                yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 287, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "total", [], "any", false, false, false, 287), CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "currency", [], "any", false, false, false, 287)]);
                yield "</td>
                            <td class=\"text-center\">";
                // line 288
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "created_at", [], "any", false, false, false, 288)), "html", null, true);
                yield "</td>
                            <td>
                                ";
                // line 290
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 290) == "paid")) {
                    // line 291
                    yield "                                    <span class=\"badge bg-success me-1\"></span>
                                ";
                }
                // line 293
                yield "                                ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 293) == "unpaid")) {
                    // line 294
                    yield "                                    <span class=\"badge bg-danger me-1\"></span>
                                ";
                }
                // line 296
                yield "                                ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 296) == "refunded")) {
                    // line 297
                    yield "                                    <span class=\"badge bg-warning me-1\"></span>
                                ";
                }
                // line 299
                yield "                                ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 299) == "canceled")) {
                    // line 300
                    yield "                                    <span class=\"badge bg-secondary me-1\"></span>
                                ";
                }
                // line 302
                yield "                                ";
                yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 302, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 302)]);
                yield "
                            </td>
                        </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['invoice'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 306
            yield "                    </tbody>
                </table>
            </div>
        </div>
    </div>
    ";
        }
        // line 312
        yield "
    ";
        // line 313
        $context["orders"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "order_get_list", [["per_page" => "5", "status" => "active"]], "method", false, false, false, 313);
        // line 314
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["orders"] ?? null), "list", [], "any", false, false, false, 314)) > 0)) {
            // line 315
            yield "        <div class=\"col-lg-6\">
            <div class=\"card\">
                <div class=\"card-header\">
                    <h3 class=\"card-title\">";
            // line 318
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Latest orders"), "html", null, true);
            yield "</h3>
                    <span class=\"ms-2 badge bg-success\">
                        <a href=\"";
            // line 320
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("order");
            yield "\" class=\"text-white\">+";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["orders"] ?? null), "total", [], "any", false, false, false, 320), "html", null, true);
            yield "</a>
                    </span>
                    <div class=\"card-actions\">
                        <a href=\"";
            // line 323
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/order");
            yield "\" class=\"btn-action\">
                            <svg class=\"icon\">
                                <use xlink:href=\"#dots-vertical\" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class=\"table-responsive\">
                    <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                        <tbody>
                        ";
            // line 334
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["orders"] ?? null), "list", [], "any", false, false, false, 334));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
                // line 335
                yield "                            <tr title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_timeago_filter(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "created_at", [], "any", false, false, false, 335)), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("ago"), "html", null, true);
                yield "\">
                                <td>
                                    <a href=\"";
                // line 337
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/manage");
                yield "/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "client_id", [], "any", false, false, false, 337), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["order"], "client", [], "any", false, false, false, 337), "first_name", [], "any", false, false, false, 337), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["order"], "client", [], "any", false, false, false, 337), "last_name", [], "any", false, false, false, 337), "html", null, true);
                yield "</a>
                                </td>
                                <td>
                                    <a href=\"";
                // line 340
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("order/manage");
                yield "/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 340), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_truncate_filter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["order"], "title", [], "any", false, false, false, 340), 35), "html", null, true);
                yield "</a>
                                </td>
                            </tr>
                        ";
                $context['_iterated'] = true;
            }
            // line 343
            if (!$context['_iterated']) {
                // line 344
                yield "                        <tr>
                            <td colspan=\"2\" align=\"center\">";
                // line 345
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
                yield "</td>
                        </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['order'], $context['_parent'], $context['_iterated']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 348
            yield "                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        ";
            // line 385
            yield "    ";
        }
        // line 386
        yield "
    ";
        // line 387
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_is_allowed", [["mod" => "stats"]], "method", false, false, false, 387)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 388
            yield "    <div class=\"col-12\">
        <div class=\"card\">
            <div class=\"card-header\">
                <h3 class=\"card-title\">";
            // line 391
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Income"), "html", null, true);
            yield "</h3>
                <div class=\"card-actions\">
                    <form method=\"get\" action=\"\">
                        <input type=\"hidden\" name=\"_url\" value=\"";
            // line 394
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "_url", [], "any", false, false, false, 394), "html", null, true);
            yield "\">
                        <div class=\"d-flex align-items-center gap-2\">
                            <h5 class=\"mb-0 text-nowrap\">";
            // line 396
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Define date interval for graphs"), "html", null, true);
            yield "</h5>
                            <div class=\"input-group\">
                                <div class=\"input-icon\">
                                    <input class=\"form-control datepicker\" style=\"width: 16rem\" id=\"graph_interval\"
                                        value=\"";
            // line 400
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 400)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 400), "Y-m-d"), "html", null, true);
            }
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 400)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " to ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 400), "Y-m-d"), "html", null, true);
            }
            yield "\"
                                        data-name-from=\"date_from\" data-name-to=\"date_to\">
                                    <span class=\"input-icon-addon\">
                                        <svg class=\"icon\">
                                            <use xlink:href=\"#calendar\" />
                                        </svg>
                                    </span>
                                </div>
                                <input type=\"submit\" value=\"";
            // line 408
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update graphs"), "html", null, true);
            yield "\" class=\"btn btn-primary\">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id=\"chart-income\" style=\"width: 100%; height: 200px;\"></div>
        </div>
    </div>

    <div class=\"col-sm-6 col-lg-3\">
        <div class=\"card\">
            <div class=\"card-body\">
                <div class=\"subheader\">";
            // line 421
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Orders"), "html", null, true);
            yield "</div>
            </div>
            <div id=\"chart-orders\" class=\"chart-sm\" style=\"min-height: 40px;\"></div>
        </div>
    </div>

    <div class=\"col-sm-6 col-lg-3\">
        <div class=\"card\">
            <div class=\"card-body\">
                <div class=\"subheader\">";
            // line 430
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
            yield "</div>
            </div>
            <div id=\"chart-invoices\" class=\"chart-sm\" style=\"min-height: 40px;\"></div>
        </div>
    </div>

    <div class=\"col-sm-6 col-lg-3\">
        <div class=\"card\">
            <div class=\"card-body\">
                <div class=\"subheader\">";
            // line 439
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Clients"), "html", null, true);
            yield "</div>
            </div>
            <div id=\"chart-clients\" class=\"chart-sm\" style=\"min-height: 40px;\"></div>
        </div>
    </div>

    <div class=\"col-sm-6 col-lg-3\">
        <div class=\"card\">
            <div class=\"card-body\">
                <div class=\"subheader\">";
            // line 448
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tickets"), "html", null, true);
            yield "</div>
            </div>
            <div id=\"chart-tickets\" class=\"chart-sm\" style=\"min-height: 40px;\"></div>
        </div>
    </div>
    ";
        }
        // line 454
        yield "
    ";
        // line 455
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_is_allowed", [["mod" => "activity"]], "method", false, false, false, 455)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 456
            yield "    <div class=\"col-12 d-block\">
        <ul class=\"nav nav-tabs\" role=\"tablist\">
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link active\" href=\"#tab-index\" role=\"tab\" data-bs-toggle=\"tab\">";
            // line 459
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Recent client activity"), "html", null, true);
            yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-staff\" role=\"tab\" data-bs-toggle=\"tab\">";
            // line 462
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Recent staff activity"), "html", null, true);
            yield "</a>
            </li>
        </ul>

        <div class=\"card\">
            <div class=\"tab-content\" id=\"tabs\">
                <div class=\"tab-pane fade show active\" id=\"tab-index\" role=\"tabpanel\">
                    <table class=\"table table-vcenter card-table table-striped\">
                        <tbody>
                            ";
            // line 471
            $context["events"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "activity_log_get_list", [["per_page" => 10, "only_clients" => 1]], "method", false, false, false, 471);
            // line 472
            yield "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["events"] ?? null), "list", [], "any", false, false, false, 472));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["i"] => $context["event"]) {
                // line 473
                yield "                            <tr>
                                <td class=\"w-1\">
                                    <a href=\"";
                // line 475
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/manage");
                yield "/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "client", [], "any", false, false, false, 475), "id", [], "any", false, false, false, 475), "html", null, true);
                yield "\">
                                        <span class=\"avatar avatar-xs\" style=\"background-image: url(";
                // line 476
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_gravatar_filter(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "client", [], "any", false, false, false, 476), "email", [], "any", false, false, false, 476)), "html", null, true);
                yield "&size=24\"></span>
                                    </a>
                                </td>
                                <td>
                                    <a href=\"";
                // line 480
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/manage");
                yield "/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "client", [], "any", false, false, false, 480), "id", [], "any", false, false, false, 480), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_truncate_filter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "client", [], "any", false, false, false, 480), "name", [], "any", false, false, false, 480), 40), "html", null, true);
                yield "</a>
                                </td>
                                <td>";
                // line 482
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_truncate_filter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "message", [], "any", false, false, false, 482), 50), "html", null, true);
                yield "</td>
                                <td>";
                // line 483
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "created_at", [], "any", false, false, false, 483)), "html", null, true);
                yield "</td>
                                <td>";
                // line 484
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_timeago_filter(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "created_at", [], "any", false, false, false, 484)), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("ago"), "html", null, true);
                yield "</td>
                            </tr>
                            ";
                $context['_iterated'] = true;
            }
            // line 486
            if (!$context['_iterated']) {
                // line 487
                yield "                            <tr>
                                <td class=\"text-muted\" colspan=\"4\">";
                // line 488
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
                yield "</td>
                            </tr>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['i'], $context['event'], $context['_parent'], $context['_iterated']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 491
            yield "                        </tbody>
                    </table>
                </div>

                <div class=\"tab-pane fade\" id=\"tab-staff\" role=\"tabpanel\">
                    <table class=\"table table-vcenter card-table table-striped\">
                        <tbody>
                            ";
            // line 498
            $context["events"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "activity_log_get_list", [["per_page" => 10, "only_staff" => 1]], "method", false, false, false, 498);
            // line 499
            yield "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["events"] ?? null), "list", [], "any", false, false, false, 499));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["i"] => $context["event"]) {
                // line 500
                yield "                            <tr>
                                <td class=\"w-1\">
                                    <a href=\"";
                // line 502
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("staff/manage");
                yield "/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "staff", [], "any", false, false, false, 502), "id", [], "any", false, false, false, 502), "html", null, true);
                yield "\">
                                        <span class=\"avatar avatar-xs\" style=\"background-image: url(";
                // line 503
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_gravatar_filter(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "staff", [], "any", false, false, false, 503), "email", [], "any", false, false, false, 503)), "html", null, true);
                yield "&size=24\"></span>
                                    </a>
                                </td>
                                <td>
                                    <a href=\"";
                // line 507
                yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("staff/manage");
                yield "/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "staff", [], "any", false, false, false, 507), "id", [], "any", false, false, false, 507), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "staff", [], "any", false, false, false, 507), "name", [], "any", false, false, false, 507), "html", null, true);
                yield "</a>
                                </td>
                                <td>";
                // line 509
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_truncate_filter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "message", [], "any", false, false, false, 509), 50), "html", null, true);
                yield "</td>
                                <td>";
                // line 510
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "created_at", [], "any", false, false, false, 510)), "html", null, true);
                yield "</td>
                                <td>";
                // line 511
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_timeago_filter(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "created_at", [], "any", false, false, false, 511)), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("ago"), "html", null, true);
                yield "</td>
                            </tr>
                            ";
                $context['_iterated'] = true;
            }
            // line 513
            if (!$context['_iterated']) {
                // line 514
                yield "                            <tr>
                                <td class=\"text-muted\" colspan=\"4\">";
                // line 515
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
                yield "</td>
                            </tr>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['i'], $context['event'], $context['_parent'], $context['_iterated']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 518
            yield "                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    ";
        }
        // line 525
        yield "</div>
";
        yield from [];
    }

    // line 528
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 529
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_is_allowed", [["mod" => "stats"]], "method", false, false, false, 529)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 530
            yield "        <script>
            \$(function() {
                setPlotDataData('chart-income', ";
            // line 532
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(json_encode(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "stats_get_income", [["date_from" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 532), "date_to" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 532)]], "method", false, false, false, 532)), "html", null, true);
            yield ", \"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Income"), "html", null, true);
            yield "\" );
                setPlotDataData('chart-orders', ";
            // line 533
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(json_encode(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "stats_get_orders", [["date_from" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 533), "date_to" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 533)]], "method", false, false, false, 533)), "html", null, true);
            yield ", \"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Orders"), "html", null, true);
            yield "\" );
                setPlotDataData('chart-invoices', ";
            // line 534
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(json_encode(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "stats_get_invoices", [["date_from" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 534), "date_to" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 534)]], "method", false, false, false, 534)), "html", null, true);
            yield ",\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
            yield "\" );
                setPlotDataData('chart-clients', ";
            // line 535
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(json_encode(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "stats_get_clients", [["date_from" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 535), "date_to" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 535)]], "method", false, false, false, 535)), "html", null, true);
            yield ", \"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Clients"), "html", null, true);
            yield "\" );
                setPlotDataData('chart-tickets', ";
            // line 536
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(json_encode(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "stats_get_tickets", [["date_from" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 536), "date_to" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 536)]], "method", false, false, false, 536)), "html", null, true);
            yield ", \"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tickets"), "html", null, true);
            yield "\");
            });

            function setPlotDataData(elementId, data, displayName=\"Name Placeholder\") {
                new ApexCharts(document.getElementById(elementId), {
                    chart: {
                        type: 'area',
                        fontFamily: 'inherit',
                        height: 140,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: .16,
                        type: 'solid'
                    },
                    stroke: {
                        width: 2,
                        lineCap: \"round\",
                        curve: \"smooth\",
                    },
                    series: [{
                        name: displayName,
                        data: data
                    }],
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            show: false
                        },
                        type: 'datetime',
                    },
                    yaxis: {
                        labels: {
                            show: false
                        },
                    },
                    labels: {
                        show: false,
                    },
                    colors:  (localStorage.getItem('theme') === 'dark') ? [\"#91bbed\"] : [\"#206bc4\"] ,
                    theme : {
                        mode: (localStorage.getItem('theme') === 'dark') ? 'dark' : 'light',
                        monochrome: {
                            enabled: false,
                        }
                    }
                }).render();
            }
        </script>
    ";
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "mod_index_dashboard.html.twig";
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
        return array (  1257 => 536,  1251 => 535,  1245 => 534,  1239 => 533,  1233 => 532,  1229 => 530,  1226 => 529,  1219 => 528,  1213 => 525,  1204 => 518,  1195 => 515,  1192 => 514,  1190 => 513,  1181 => 511,  1177 => 510,  1173 => 509,  1164 => 507,  1157 => 503,  1151 => 502,  1147 => 500,  1141 => 499,  1139 => 498,  1130 => 491,  1121 => 488,  1118 => 487,  1116 => 486,  1107 => 484,  1103 => 483,  1099 => 482,  1090 => 480,  1083 => 476,  1077 => 475,  1073 => 473,  1067 => 472,  1065 => 471,  1053 => 462,  1047 => 459,  1042 => 456,  1040 => 455,  1037 => 454,  1028 => 448,  1016 => 439,  1004 => 430,  992 => 421,  976 => 408,  959 => 400,  952 => 396,  947 => 394,  941 => 391,  936 => 388,  934 => 387,  931 => 386,  928 => 385,  920 => 348,  911 => 345,  908 => 344,  906 => 343,  894 => 340,  882 => 337,  874 => 335,  869 => 334,  855 => 323,  847 => 320,  842 => 318,  837 => 315,  834 => 314,  832 => 313,  829 => 312,  821 => 306,  810 => 302,  806 => 300,  803 => 299,  799 => 297,  796 => 296,  792 => 294,  789 => 293,  785 => 291,  783 => 290,  778 => 288,  774 => 287,  763 => 285,  756 => 281,  750 => 280,  740 => 277,  736 => 275,  732 => 274,  718 => 263,  713 => 261,  708 => 258,  705 => 257,  703 => 256,  700 => 255,  686 => 246,  678 => 243,  670 => 240,  662 => 237,  654 => 234,  649 => 232,  640 => 228,  632 => 225,  624 => 222,  616 => 219,  608 => 216,  603 => 214,  594 => 210,  586 => 207,  578 => 204,  570 => 201,  562 => 198,  557 => 196,  548 => 192,  540 => 189,  532 => 186,  524 => 183,  516 => 180,  511 => 178,  502 => 174,  494 => 171,  486 => 168,  478 => 165,  470 => 162,  465 => 160,  457 => 155,  453 => 154,  449 => 153,  445 => 152,  441 => 151,  431 => 144,  416 => 134,  410 => 133,  399 => 124,  393 => 122,  391 => 121,  386 => 119,  374 => 112,  368 => 111,  357 => 102,  351 => 100,  349 => 99,  344 => 97,  332 => 90,  326 => 89,  315 => 80,  309 => 78,  307 => 77,  302 => 75,  290 => 68,  284 => 67,  273 => 58,  267 => 56,  265 => 55,  260 => 53,  256 => 51,  253 => 50,  250 => 49,  247 => 48,  244 => 47,  241 => 46,  238 => 45,  236 => 44,  232 => 42,  222 => 39,  208 => 38,  205 => 37,  200 => 36,  190 => 33,  176 => 32,  173 => 31,  168 => 30,  158 => 27,  144 => 26,  141 => 25,  136 => 24,  129 => 22,  123 => 20,  120 => 19,  116 => 17,  103 => 15,  99 => 14,  96 => 13,  94 => 12,  90 => 11,  86 => 10,  79 => 9,  74 => 8,  67 => 7,  56 => 5,  51 => 1,  49 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_index_dashboard.html.twig", "/var/www/html/themes/admin_default/html/mod_index_dashboard.html.twig");
    }
}
