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

/* mod_invoice_index.html.twig */
class __TwigTemplate_e5b7715e6baf708d9a865ac6085dda21 extends Template
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
            'top_content' => [$this, 'block_top_content'],
            'content' => [$this, 'block_content'],
            'js' => [$this, 'block_js'],
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
        $context["active_menu"] = "invoice";
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_top_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 10
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "show_filter", [], "any", false, false, false, 10)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 11
            yield "    <section class=\"card mb-3\">
        <div class=\"card-body\">
            <h5>";
            // line 13
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Filter invoices"), "html", null, true);
            yield "</h5>
            <form method=\"get\">
                <input type=\"hidden\" name=\"CSRFToken\" value=\"";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
            yield "\"/>
                <div class=\"mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\">";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("ID"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        <input class=\"form-control\" type=\"text\" name=\"id\" value=\"";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "id", [], "any", false, false, false, 19), "html", null, true);
            yield "\">
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\">";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Number"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        <input class=\"form-control\" type=\"text\" name=\"nr\" value=\"";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "nr", [], "any", false, false, false, 25), "html", null, true);
            yield "\">
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\" for=\"client_id\">";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        <select class=\"form-control autocomplete-selector\"
                                placeholder=\"";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Start typing the client name or ID"), "html", null, true);
            yield "\"
                                id=\"client_id\"
                                name=\"client_id\"
                                data-resturl=\"admin/client/get_pairs\"
                                data-csrf=\"";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
            yield "\">
                        ";
            // line 37
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "client_id", [], "any", false, false, false, 37)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 38
                yield "                        ";
            } else {
                // line 39
                yield "                            ";
                $context["client"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_get", [["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "client_id", [], "any", false, false, false, 39)]], "method", false, false, false, 39);
                // line 40
                yield "                            <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "client_id", [], "any", false, false, false, 40), "html", null, true);
                yield "\" selected>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "first_name", [], "any", false, false, false, 40), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "last_name", [], "any", false, false, false, 40), "html", null, true);
                yield "</option>
                        ";
            }
            // line 42
            yield "                        </select>
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\">";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        ";
            // line 48
            yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 48, $this->getSourceContext())->macro_selectbox(...["currency", CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "currency_get_pairs", [], "any", false, false, false, 48), CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "currency", [], "any", false, false, false, 48), 0, __trans("All currencies")]);
            yield "
                    </div>
                </div>
                <div class=\"mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\">";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        <div class=\"form-check form-check-inline\">
                            <input class=\"form-check-input\" id=\"radioStatusAll\" type=\"radio\" name=\"status\" value=\"0\"";
            // line 55
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "status", [], "any", false, false, false, 55)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " checked";
            }
            yield ">
                            <label class=\"form-check-label\" for=\"radioStatusAll\">";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("All statuses"), "html", null, true);
            yield "</label>
                        </div>
                        <div class=\"form-check form-check-inline\">
                            <input class=\"form-check-input\" id=\"radioStatusPaid\" type=\"radio\" name=\"status\" value=\"paid\"";
            // line 59
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "status", [], "any", false, false, false, 59) == "paid")) {
                yield " checked";
            }
            yield ">
                            <label class=\"form-check-label\" for=\"radioStatusPaid\">";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid"), "html", null, true);
            yield "</label>
                        </div>
                        <div class=\"form-check form-check-inline\">
                            <input class=\"form-check-input\" id=\"radioStatusUnpaid\" type=\"radio\" name=\"status\" value=\"unpaid\"";
            // line 63
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "status", [], "any", false, false, false, 63) == "unpaid")) {
                yield " checked";
            }
            yield ">
                            <label class=\"form-check-label\" for=\"radioStatusUnpaid\">";
            // line 64
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Unpaid"), "html", null, true);
            yield "</label>
                        </div>
                        <div class=\"form-check form-check-inline\">
                            <input class=\"form-check-input\" id=\"radioStatusRefunded\" type=\"radio\" name=\"status\" value=\"refunded\"";
            // line 67
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "status", [], "any", false, false, false, 67) == "refunded")) {
                yield " checked";
            }
            yield ">
                            <label class=\"form-check-label\" for=\"radioStatusRefunded\">";
            // line 68
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Refunded"), "html", null, true);
            yield "</label>
                        </div>
                    </div>
                </div>
                ";
            // line 83
            yield "                <div class=\"mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\" for=\"issue_date\">";
            // line 84
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Issue date"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        <div class=\"input-group\">
                            <div class=\"input-icon w-100\">
                                <input class=\"form-control datepicker\"
                                       id=\"issue_date\"
                                       value=\"";
            // line 90
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 90)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 90), "Y-m-d"), "html", null, true);
            }
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 90)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " to ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 90), "Y-m-d"), "html", null, true);
            }
            yield "\"
                                       data-name-from=\"date_from\"
                                       data-name-to=\"date_to\"
                                >
                                <span class=\"input-icon-addon\">
                                    <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                        <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>
                                        <path d=\"M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z\"></path>
                                        <path d=\"M16 3l0 4\"></path>
                                        <path d=\"M8 3l0 4\"></path>
                                        <path d=\"M4 11l16 0\"></path>
                                        <path d=\"M11 15l1 0\"></path>
                                        <path d=\"M12 15l0 3\"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <input type=\"hidden\" name=\"_url\" value=\"";
            // line 110
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "_url", [], "any", false, false, false, 110), "html", null, true);
            yield "\">
                <input type=\"hidden\" name=\"show_filter\" value=\"1\">
                <div class=\"d-flex gap-2\">
                    <button class=\"btn btn-primary w-75\" type=\"submit\">";
            // line 113
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Filter"), "html", null, true);
            yield "</button>
                    <a class=\"btn btn-danger w-25\" href=\"";
            // line 114
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "_url", [], "any", false, false, false, 114), "html", null, true);
            yield "?show_filter=1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Reset"), "html", null, true);
            yield "</a>
                </div>
            </form>
        </div>
    </section>
";
        } else {
            // line 120
            yield "    ";
            $context["statuses"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "invoice_get_statuses", [], "any", false, false, false, 120);
            // line 121
            yield "    <section class=\"row row-cards mb-3\">
        <div class=\"col-sm-6 col-lg-3\">
            <a class=\"card card-sm card-link\" href=\"";
            // line 123
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice", ["status" => "unpaid"]);
            yield "\">
                <div class=\"card-body\">
                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                            <span class=\"bg-danger text-white avatar\">";
            // line 127
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["statuses"] ?? null), "unpaid", [], "any", false, false, false, 127), "html", null, true);
            yield "</span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 130
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Unpaid"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            <a class=\"card card-sm card-link\" href=\"";
            // line 137
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice", ["status" => "paid"]);
            yield "\">
                <div class=\"card-body\">
                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                            <span class=\"bg-green text-white avatar\">";
            // line 141
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["statuses"] ?? null), "paid", [], "any", false, false, false, 141), "html", null, true);
            yield "</span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 144
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            <a class=\"card card-sm card-link\" href=\"";
            // line 151
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice", ["status" => "refunded"]);
            yield "\">
                <div class=\"card-body\">
                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                            <span class=\"bg-secondary text-white avatar\">";
            // line 155
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["statuses"] ?? null), "refunded", [], "any", false, false, false, 155), "html", null, true);
            yield "</span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 158
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Refunded"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            <a class=\"card card-sm card-link\" href=\"";
            // line 165
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice");
            yield "\">
                <div class=\"card-body\">
                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                            <span class=\"bg-blue text-white avatar\">";
            // line 169
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["statuses"] ?? null), "paid", [], "any", false, false, false, 169) + CoreExtension::getAttribute($this->env, $this->source, ($context["statuses"] ?? null), "unpaid", [], "any", false, false, false, 169)) + CoreExtension::getAttribute($this->env, $this->source, ($context["statuses"] ?? null), "refunded", [], "any", false, false, false, 169)), "html", null, true);
            yield "</span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 172
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </section>
    ";
        }
        yield from [];
    }

    // line 182
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 183
        yield "    <ul class=\"nav nav-tabs\" role=\"tablist\">
        <li class=\"nav-item\" role=\"presentation\">
            <button class=\"nav-link active\" data-bs-toggle=\"tab\" data-bs-target=\"#tab-index\" role=\"tab\">";
        // line 185
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
        yield "</button>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <button class=\"nav-link\" data-bs-toggle=\"tab\" data-bs-target=\"#tab-new\" role=\"tab\">
                <svg class=\"icon me-2\">
                    <use xlink:href=\"#plus\" />
                </svg>
                ";
        // line 192
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("New Invoice"), "html", null, true);
        yield "
            </button>
        </li>
    </ul>

    <div class=\"card\">
        <div class=\"tab-content\">
            <div class=\"tab-pane show active\" id=\"tab-index\" role=\"tabpanel\">
                ";
        // line 200
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_search.html.twig");
        yield "
              <div class=\"table-responsive\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap sortable\">
                    <thead>
                        <tr>
                            <th class=\"w-1 no-sort\">
                                <input type=\"checkbox\" class=\"form-check-input m-0 align-middle batch-delete-master-checkbox\">
                            </th>
                            <th class=\"w-1\">#</th>
                            <th class=\"w-1\"></th>
                            <th>";
        // line 210
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Name"), "html", null, true);
        yield "</th>
                            <th class=\"text-center\">";
        // line 211
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Amount"), "html", null, true);
        yield "</th>
                            <th class=\"text-center\">";
        // line 212
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Issued at"), "html", null, true);
        yield "</th>
                            <th class=\"text-center\">";
        // line 213
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid at"), "html", null, true);
        yield "</th>
                            <th>";
        // line 214
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield "</th>
                            <th class=\"w-1\"></th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
        // line 219
        $context["invoices"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "invoice_get_list", [Twig\Extension\CoreExtension::merge(["per_page" => 30, "page" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "page", [], "any", false, false, false, 219)], ($context["request"] ?? null))], "method", false, false, false, 219);
        // line 220
        yield "                        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["invoices"] ?? null), "list", [], "any", false, false, false, 220));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 221
            yield "                        <tr>
                            <td>
                                <input type=\"checkbox\" class=\"form-check-input m-0 align-middle batch-delete-checkbox\" data-item-id=\"";
            // line 223
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "id", [], "any", false, false, false, 223), "html", null, true);
            yield "\">
                            </td>
                            <td>
                                <a href=\"";
            // line 226
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/invoice/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "id", [], "any", false, false, false, 226), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "serie_nr", [], "any", false, false, false, 226), "html", null, true);
            yield "</a>
                            </td>
                            <td>
                                <a href=\"";
            // line 229
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
            yield "/manage/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "client", [], "any", false, false, false, 229), "id", [], "any", false, false, false, 229), "html", null, true);
            yield "\">
                                    <span class=\"avatar avatar-xs\" style=\"background-image: url(";
            // line 230
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_gravatar_filter(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "buyer", [], "any", false, false, false, 230), "email", [], "any", false, false, false, 230)), "html", null, true);
            yield "&size=24\"></span>
                                </a>
                            </td>
                            <td>
                                <a href=\"";
            // line 234
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
            yield "/manage/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "client", [], "any", false, false, false, 234), "id", [], "any", false, false, false, 234), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "buyer", [], "any", false, false, false, 234), "first_name", [], "any", false, false, false, 234), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "buyer", [], "any", false, false, false, 234), "last_name", [], "any", false, false, false, 234), "html", null, true);
            yield "</a>
                            </td>
                            <td class=\"text-center\">";
            // line 236
            yield $macros["mf"]->getTemplateForMacro("macro_currency_format", $context, 236, $this->getSourceContext())->macro_currency_format(...[CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "total", [], "any", false, false, false, 236), CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "currency", [], "any", false, false, false, 236)]);
            yield "</td>
                            <td class=\"text-center\">";
            // line 237
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "created_at", [], "any", false, false, false, 237), "Y-m-d"), "html", null, true);
            yield "</td>
                            <td class=\"text-center\">";
            // line 238
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "paid_at", [], "any", false, false, false, 238)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "paid_at", [], "any", false, false, false, 238), "Y-m-d"), "html", null, true);
            } else {
                yield "-";
            }
            yield "</td>
                            <td>
                                ";
            // line 240
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 240) == "paid")) {
                // line 241
                yield "                                    <span class=\"badge bg-success me-1\"></span>
                                ";
            }
            // line 243
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 243) == "unpaid")) {
                // line 244
                yield "                                    <span class=\"badge bg-danger me-1\"></span>
                                ";
            }
            // line 246
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 246) == "refunded")) {
                // line 247
                yield "                                    <span class=\"badge bg-warning me-1\"></span>
                                ";
            }
            // line 249
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 249) == "canceled")) {
                // line 250
                yield "                                    <span class=\"badge bg-secondary me-1\"></span>
                                ";
            }
            // line 252
            yield "                                ";
            yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 252, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 252)]);
            yield "
                            </td>
                            <td>
                                <a class=\"btn btn-icon\" href=\"";
            // line 255
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/invoice/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "id", [], "any", false, false, false, 255), "html", null, true);
            yield "\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#edit\" />
                                    </svg>
                                </a>
                                <a class=\"btn btn-icon api-link\"
                                    href=\"";
            // line 261
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "id", [], "any", false, false, false, 261), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\"
                                    data-api-confirm=\"";
            // line 262
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
            yield "\"
                                    data-api-reload=\"1\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#delete\" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        ";
            $context['_iterated'] = true;
        }
        // line 270
        if (!$context['_iterated']) {
            // line 271
            yield "                        <tr>
                            <td class=\"text-muted\" colspan=\"8\">";
            // line 272
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['invoice'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 275
        yield "                    </tbody>
                </table>
              </div>
                <div class=\"card-footer d-flex align-items-center justify-content-between\">
                    <div>
                        ";
        // line 280
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_batch_delete.html.twig", ["action" => "admin/invoice/batch_delete"]);
        yield "
                        ";
        // line 281
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_pagination.html.twig", ["list" => ($context["invoices"] ?? null), "url" => "invoice"]);
        yield "
                    </div>
                    <div>
                        <a class=\"btn btn-secondary\" href=\"";
        // line 284
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/api/admin/invoice/export_csv", ["CSRFToken" => ($context["CSRFToken"] ?? null)]);
        yield "\" title=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Export Invoices"), "html", null, true);
        yield "\">
                            <svg class=\"icon\">
                                <use xlink:href=\"#download\" />
                            </svg>
                            ";
        // line 288
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Export Invoices"), "html", null, true);
        yield "
                        </a>
                    </div>
                </div>
            </div>

            <div class=\"tab-pane show\" id=\"tab-new\" role=\"tabpanel\">
                <div class=\"card-body\">
                    <form method=\"post\" action=\"";
        // line 296
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/invoice/prepare");
        yield "\" class=\"api-form\" data-api-jsonp=\"onAfterInvoicePrepared\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 297
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\" for=\"client_id\">";
        // line 299
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client"), "html", null, true);
        yield "</label>
                            <div class=\"col\">
                                ";
        // line 301
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "client_id", [], "any", false, false, false, 301)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 302
            yield "                                    <select class=\"form-control autocomplete-selector\"
                                            placeholder=\"";
            // line 303
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Start typing the client name or ID"), "html", null, true);
            yield "\"
                                            id=\"client_id\"
                                            name=\"client_id\"
                                            data-resturl=\"admin/client/get_pairs\"
                                            data-csrf=\"";
            // line 307
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
            yield "\">
                                    </select>
                                ";
        } else {
            // line 310
            yield "                                    ";
            $context["client"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_get", [["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "client_id", [], "any", false, false, false, 310)]], "method", false, false, false, 310);
            // line 311
            yield "                                    <input type=\"text\" id=\"client_id\" class=\"form-control\" disabled value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "first_name", [], "any", false, false, false, 311), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "last_name", [], "any", false, false, false, 311), "html", null, true);
            yield "\" />
                                    <input type=\"hidden\" name=\"client_id\" value=\"";
            // line 312
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "client_id", [], "any", false, false, false, 312), "html", null, true);
            yield "\" />
                                ";
        }
        // line 314
        yield "                            </div>
                        </div>
                        <input type=\"submit\" value=\"";
        // line 316
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Prepare"), "html", null, true);
        yield "\" class=\"btn btn-primary\">
                    </form>
                </div>
            </div>
        </div>
    </div>
";
        yield from [];
    }

    // line 324
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 325
        yield "<script>
    function onAfterInvoicePrepared(id) {
        bb.redirect(\"";
        // line 327
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("invoice/manage/");
        yield "/\" + id);
    }
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "mod_invoice_index.html.twig";
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
        return array (  715 => 327,  711 => 325,  704 => 324,  692 => 316,  688 => 314,  683 => 312,  676 => 311,  673 => 310,  667 => 307,  660 => 303,  657 => 302,  655 => 301,  650 => 299,  645 => 297,  641 => 296,  630 => 288,  621 => 284,  615 => 281,  611 => 280,  604 => 275,  595 => 272,  592 => 271,  590 => 270,  577 => 262,  573 => 261,  562 => 255,  555 => 252,  551 => 250,  548 => 249,  544 => 247,  541 => 246,  537 => 244,  534 => 243,  530 => 241,  528 => 240,  519 => 238,  515 => 237,  511 => 236,  500 => 234,  493 => 230,  487 => 229,  477 => 226,  471 => 223,  467 => 221,  461 => 220,  459 => 219,  451 => 214,  447 => 213,  443 => 212,  439 => 211,  435 => 210,  422 => 200,  411 => 192,  401 => 185,  397 => 183,  390 => 182,  376 => 172,  370 => 169,  363 => 165,  353 => 158,  347 => 155,  340 => 151,  330 => 144,  324 => 141,  317 => 137,  307 => 130,  301 => 127,  294 => 123,  290 => 121,  287 => 120,  276 => 114,  272 => 113,  266 => 110,  237 => 90,  228 => 84,  225 => 83,  218 => 68,  212 => 67,  206 => 64,  200 => 63,  194 => 60,  188 => 59,  182 => 56,  176 => 55,  170 => 52,  163 => 48,  158 => 46,  152 => 42,  142 => 40,  139 => 39,  136 => 38,  134 => 37,  130 => 36,  123 => 32,  117 => 29,  110 => 25,  105 => 23,  98 => 19,  93 => 17,  88 => 15,  83 => 13,  79 => 11,  76 => 10,  69 => 9,  58 => 5,  54 => 1,  52 => 7,  50 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_invoice_index.html.twig", "/var/www/html/modules/Invoice/html_admin/mod_invoice_index.html.twig");
    }
}
