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

/* mod_client_index.html.twig */
class __TwigTemplate_b26f1c15e4174f920793770986f9c0e5 extends Template
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
        return "layout_default.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $macros["mf"] = $this->macros["mf"] = $this->load("macro_functions.html.twig", 3)->unwrap();
        // line 5
        $context["active_menu"] = "client";
        // line 1
        $this->parent = $this->load("layout_default.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Clients"), "html", null, true);
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
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "show_filter", [], "any", false, false, false, 10)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 11
            yield "    <section class=\"card mb-3\">
        <div class=\"card-body\">
            <h5>";
            // line 13
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Filter clients"), "html", null, true);
            yield "</h5>

            <form method=\"get\">
                <input type=\"hidden\" name=\"CSRFToken\" value=\"";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
            yield "\"/>
                <div class=\"form-group mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\">";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client ID"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        <input class=\"form-control\" type=\"text\" name=\"id\" value=\"";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "id", [], "any", false, false, false, 20), "html", null, true);
            yield "\">
                    </div>
                </div>
                <div class=\"form-group mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\">";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Name"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        <input class=\"form-control\" type=\"text\" name=\"name\" value=\"";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "name", [], "any", false, false, false, 26), "html", null, true);
            yield "\">
                    </div>
                </div>

                <div class=\"form-group mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\">";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company name"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        <input class=\"form-control\" type=\"text\" name=\"company\" value=\"";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "company", [], "any", false, false, false, 33), "html", null, true);
            yield "\">
                    </div>
                </div>

                <div class=\"form-group mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\">";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        <input class=\"form-control\" type=\"text\" name=\"email\" value=\"";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "email", [], "any", false, false, false, 40), "html", null, true);
            yield "\">
                    </div>
                </div>

                <div class=\"form-group mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\">";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Group"), "html", null, true);
            yield ":</label>
                    <div class=\"col\">
                        ";
            // line 47
            yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 47, $this->getSourceContext())->macro_selectbox(...["group_id", CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_group_get_pairs", [], "any", false, false, false, 47), CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "group_id", [], "any", false, false, false, 47), 0, __trans("All groups")]);
            yield "
                    </div>
                </div>

                <div class=\"form-group mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\">";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
            yield ":</label>
                    <div class=\"col\">
                        <div class=\"form-check form-check-inline\">
                            <input class=\"form-check-input\" type=\"radio\" id=\"statusAll\" name=\"status\" value=\"\"";
            // line 55
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "status", [], "any", false, false, false, 55)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " checked";
            }
            yield ">
                            <label class=\"form-check-label\" for=\"statusAll\">";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("All"), "html", null, true);
            yield "</label>
                        </div>
                        <div class=\"form-check form-check-inline\">
                            <input class=\"form-check-input\" type=\"radio\" id=\"statusActive\" name=\"status\" value=\"active\"";
            // line 59
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "status", [], "any", false, false, false, 59) == "active")) {
                yield " checked";
            }
            yield ">
                            <label class=\"form-check-label\" for=\"statusActive\">";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Active"), "html", null, true);
            yield "</label>
                        </div>
                        <div class=\"form-check form-check-inline\">
                            <input class=\"form-check-input\" type=\"radio\" id=\"statusSuspended\" name=\"status\" value=\"suspended\"";
            // line 63
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "status", [], "any", false, false, false, 63) == "suspended")) {
                yield " checked";
            }
            yield ">
                            <label class=\"form-check-label\" for=\"statusSuspended\">";
            // line 64
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Suspended"), "html", null, true);
            yield "</label>
                        </div>
                        <div class=\"form-check form-check-inline\">
                            <input class=\"form-check-input\" type=\"radio\" id=\"statusCanceled\" name=\"status\" value=\"canceled\"";
            // line 67
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "status", [], "any", false, false, false, 67) == "canceled")) {
                yield " checked";
            }
            yield ">
                            <label class=\"form-check-label\" for=\"statusCanceled\">";
            // line 68
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Canceled"), "html", null, true);
            yield "</label>
                        </div>
                    </div>
                </div>

                <div class=\"form-group mb-3 row\">
                    <label class=\"form-label col-3 col-form-label\" for=\"reg_date\">";
            // line 74
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Registration date"), "html", null, true);
            yield "</label>
                    <div class=\"col\">
                        <div class=\"input-group\">
                            <div class=\"input-icon w-100\">
                                <input class=\"form-control datepicker\"
                                       id=\"reg_date\"
                                       value=\"";
            // line 80
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 80)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_from", [], "any", false, false, false, 80), "Y-m-d"), "html", null, true);
            }
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 80)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " to ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "date_to", [], "any", false, false, false, 80), "Y-m-d"), "html", null, true);
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
            // line 100
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "_url", [], "any", false, false, false, 100), "html", null, true);
            yield "\">
                <input type=\"hidden\" name=\"show_filter\" value=\"1\">
                <div class=\"d-flex gap-2\">
                    <button type=\"submit\" class=\"btn btn-primary w-75\">";
            // line 103
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Filter"), "html", null, true);
            yield "</button>
                    <a class=\"btn btn-danger w-25\" href=\"";
            // line 104
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "_url", [], "any", false, false, false, 104), "html", null, true);
            yield "?show_filter=1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Reset"), "html", null, true);
            yield "</a>
                </div>
            </form>
        </div>
    </section>
";
        } else {
            // line 110
            yield "    ";
            $context["count_clients"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_get_statuses", [], "any", false, false, false, 110);
            // line 111
            yield "    <section class=\"row row-cards mb-3\">
        <div class=\"col-sm-6 col-lg-3\">
            <a class=\"card card-sm card-link\" href=\"";
            // line 113
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client", ["status" => "active"]);
            yield "\">
                <div class=\"card-body\">
                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                            <span class=\"bg-success text-white avatar\">";
            // line 117
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["count_clients"] ?? null), "active", [], "any", false, false, false, 117), "html", null, true);
            yield "</span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 120
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Active"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            <a class=\"card card-sm card-link\" href=\"";
            // line 127
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client", ["status" => "suspended"]);
            yield "\">
                <div class=\"card-body\">
                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                            <span class=\"bg-danger text-white avatar\">";
            // line 131
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["count_clients"] ?? null), "suspended", [], "any", false, false, false, 131), "html", null, true);
            yield "</span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 134
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Suspended"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            <a class=\"card card-sm card-link\" href=\"";
            // line 141
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client", ["status" => "canceled"]);
            yield "\">
                <div class=\"card-body\">
                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                            <span class=\"bg-secondary text-white avatar\">";
            // line 145
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["count_clients"] ?? null), "canceled", [], "any", false, false, false, 145), "html", null, true);
            yield "</span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 148
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Canceled"), "html", null, true);
            yield "</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-sm-6 col-lg-3\">
            <a class=\"card card-sm card-link\" href=\"";
            // line 155
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
            yield "\">
                <div class=\"card-body\">
                    <div class=\"row align-items-center\">
                        <div class=\"col-auto\">
                            <span class=\"bg-blue text-white avatar\">";
            // line 159
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["count_clients"] ?? null), "active", [], "any", false, false, false, 159) + CoreExtension::getAttribute($this->env, $this->source, ($context["count_clients"] ?? null), "canceled", [], "any", false, false, false, 159)) + CoreExtension::getAttribute($this->env, $this->source, ($context["count_clients"] ?? null), "suspended", [], "any", false, false, false, 159)), "html", null, true);
            yield "</span>
                        </div>
                        <div class=\"col\">
                            <div class=\"font-weight-medium\">";
            // line 162
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

    // line 172
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 173
        yield "    <ul class=\"nav nav-tabs\" role=\"tablist\">
        <li class=\"nav-item\" role=\"presentation\">
            <a class=\"nav-link active\" href=\"#tab-index\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 175
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Clients"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <button class=\"nav-link\" href=\"#tab-new\" data-bs-toggle=\"tab\" role=\"tab\">
                <svg class=\"icon me-2\">
                    <use xlink:href=\"#plus\" />
                </svg>
                ";
        // line 182
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("New Client"), "html", null, true);
        yield "
            </button>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <button class=\"nav-link\" href=\"#tab-groups\" data-bs-toggle=\"tab\" role=\"tab\">";
        // line 186
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Groups"), "html", null, true);
        yield "</button>
        </li>
        <li class=\"nav-item\" role=\"presentation\">
            <button class=\"nav-link\" href=\"#tab-new-group\" data-bs-toggle=\"tab\" role=\"tab\">
                <svg class=\"icon me-2\">
                    <use xlink:href=\"#plus\" />
                </svg>
                ";
        // line 193
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("New Group"), "html", null, true);
        yield "
            </button>
        </li>
    </ul>

    <div class=\"card\">
        <div class=\"tab-content\">
            <div class=\"tab-pane fade show active\" id=\"tab-index\" role=\"tabpanel\">
                ";
        // line 201
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_search.html.twig");
        yield "
                <div class=\"table-responsive\">
                    <table class=\"table card-table table-vcenter table-striped text-nowrap sortable\">
                        <thead>
                            <tr>
                                <th class=\"w-1 no-sort\">
                                    <input class=\"form-check-input m-0 align-middle batch-delete-master-checkbox\" type=\"checkbox\">
                                </th>
                                <th>";
        // line 209
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Name"), "html", null, true);
        yield "</th>
                                <th>";
        // line 210
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company"), "html", null, true);
        yield "</th>
                                <th>";
        // line 211
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield "</th>
                                <th>";
        // line 212
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Date"), "html", null, true);
        yield "</th>
                                <th class=\"w-1\"></th>
                            </tr>
                        </thead>

                        <tbody>
                            ";
        // line 218
        $context["clients"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_get_list", [Twig\Extension\CoreExtension::merge(["per_page" => 30, "page" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "page", [], "any", false, false, false, 218)], ($context["request"] ?? null))], "method", false, false, false, 218);
        // line 219
        yield "                            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["clients"] ?? null), "list", [], "any", false, false, false, 219));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["client"]) {
            // line 220
            yield "                            <tr>
                                <td>
                                    <input class=\"form-check-input m-0 align-middle batch-delete-checkbox\" type=\"checkbox\" data-item-id=\"";
            // line 222
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "id", [], "any", false, false, false, 222), "html", null, true);
            yield "\">
                                </td>
                                <td>
                                    <div class=\"d-flex py-1 align-items-center\">
                                        <a href=\"";
            // line 226
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "id", [], "any", false, false, false, 226), "html", null, true);
            yield "\">
                                            <span class=\"avatar me-2\" style=\"background-image: url(";
            // line 227
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_gravatar_filter(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "email", [], "any", false, false, false, 227)), "html", null, true);
            yield "&size=40)\"></span>
                                        </a>
                                        <div class=\"flex-fill\">
                                            <div class=\"font-weight-medium\">
                                                <a href=\"";
            // line 231
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "id", [], "any", false, false, false, 231), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "first_name", [], "any", false, false, false, 231), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "last_name", [], "any", false, false, false, 231), "html", null, true);
            yield "</a>
                                                <span class=\"flag flag-country-";
            // line 232
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["client"], "country", [], "any", false, false, false, 232)), "html", null, true);
            yield "\" title=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v0 = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_countries", [], "any", false, false, false, 232)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[CoreExtension::getAttribute($this->env, $this->source, $context["client"], "country", [], "any", false, false, false, 232)] ?? null) : null), "html", null, true);
            yield "\"></span>
                                            </div>
                                            <div class=\"text-muted\">
                                                <a href=\"#\" class=\"text-reset\">";
            // line 235
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "email", [], "any", false, false, false, 235), "html", null, true);
            yield "</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href=\"";
            // line 241
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "id", [], "any", false, false, false, 241), "html", null, true);
            yield "\" title=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "company", [], "any", false, false, false, 241), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_truncate_filter($this->env, ((CoreExtension::getAttribute($this->env, $this->source, $context["client"], "company", [], "any", true, true, false, 241)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "company", [], "any", false, false, false, 241), "-")) : ("-")), 30), "html", null, true);
            yield "</a>
                                </td>
                                <td>
                                    ";
            // line 244
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["client"], "status", [], "any", false, false, false, 244) == "active")) {
                // line 245
                yield "                                        <span class=\"badge bg-success me-1\"></span>
                                    ";
            }
            // line 247
            yield "                                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["client"], "status", [], "any", false, false, false, 247) == "suspended")) {
                // line 248
                yield "                                        <span class=\"badge bg-danger me-1\"></span>
                                    ";
            }
            // line 250
            yield "                                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["client"], "status", [], "any", false, false, false, 250) == "canceled")) {
                // line 251
                yield "                                        <span class=\"badge bg-secondary me-1\"></span>
                                    ";
            }
            // line 253
            yield "                                    ";
            yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 253, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, $context["client"], "status", [], "any", false, false, false, 253)]);
            yield "
                                </td>
                                <td>";
            // line 255
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["client"], "created_at", [], "any", false, false, false, 255)), "html", null, true);
            yield "</td>
                                <td>
                                    <a class=\"btn btn-icon\" href=\"";
            // line 257
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/manage");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "id", [], "any", false, false, false, 257), "html", null, true);
            yield "\">
                                        <svg class=\"icon\">
                                            <use xlink:href=\"#edit\" />
                                        </svg>
                                    </a>
                                    <a class=\"btn btn-icon api-link\" href=\"";
            // line 262
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/client/delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["client"], "id", [], "any", false, false, false, 262), "CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\" data-api-confirm=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
            yield "\" data-api-reload=\"1\">
                                        <svg class=\"icon\">
                                            <use xlink:href=\"#delete\" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            ";
            $context['_iterated'] = true;
        }
        // line 269
        if (!$context['_iterated']) {
            // line 270
            yield "                            <tr>
                                <td class=\"text-muted\" colspan=\"7\">";
            // line 271
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                            </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['client'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 274
        yield "                        </tbody>
                    </table>
                </div>

                <div class=\"card-footer d-flex align-items-center justify-content-between\">
                    <div>
                        ";
        // line 280
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_batch_delete.html.twig", ["action" => "admin/client/batch_delete"]);
        yield "
                        ";
        // line 281
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_pagination.html.twig", ["list" => ($context["clients"] ?? null), "url" => "client"]);
        yield "
                    </div>
                    <div>
                        <a class=\"btn btn-secondary\" href=\"";
        // line 284
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/api/admin/client/export_csv", ["CSRFToken" => ($context["CSRFToken"] ?? null)]);
        yield "\" title=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Export Clients"), "html", null, true);
        yield "\">
                            <svg class=\"icon\">
                                <use xlink:href=\"#download\" />
                            </svg>
                            ";
        // line 288
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Export Clients"), "html", null, true);
        yield "
                        </a>
                    </div>
                </div>
            </div>

            <div class=\"tab-pane fade\" id=\"tab-new\" role=\"tabpanel\">
                <div class=\"card-body\">
                    <form method=\"post\" action=\"";
        // line 296
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/client/create");
        yield "\" class=\"api-form save\" data-api-redirect=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
        yield "\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 297
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 299
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <div class=\"form-check form-check-inline\">
                                    <input class=\"form-check-input\" type=\"radio\" id=\"radioStatusActive\" name=\"status\" value=\"active\" checked>
                                    <label class=\"form-check-label\" for=\"radioStatusActive\">";
        // line 303
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Active"), "html", null, true);
        yield "</label>
                                </div>
                                <div class=\"form-check form-check-inline\">
                                    <input class=\"form-check-input\" type=\"radio\" id=\"radioStatusCanceled\" name=\"status\" value=\"canceled\">
                                    <label class=\"form-check-label\" for=\"radioStatusCanceled\">";
        // line 307
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Canceled"), "html", null, true);
        yield "</label>
                                </div>
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 312
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Group"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                ";
        // line 314
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 314, $this->getSourceContext())->macro_selectbox(...["group_id", CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_group_get_pairs", [], "any", false, false, false, 314), CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "group_id", [], "any", false, false, false, 314), 0, __trans("Select group")]);
        yield "
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 318
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <input class=\"form-control\" type=\"text\" name=\"email\" value=\"";
        // line 320
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "email", [], "any", false, false, false, 320), "html", null, true);
        yield "\" required>
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 324
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Name"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <div class=\"row g-2\">
                                    <div class=\"col\">
                                        <input class=\"form-control\" type=\"text\" name=\"first_name\" value=\"";
        // line 328
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "first_name", [], "any", false, false, false, 328), "html", null, true);
        yield "\" required>
                                    </div>
                                    <div class=\"col\">
                                        <input class=\"form-control\" type=\"text\" name=\"last_name\" value=\"";
        // line 331
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "last_name", [], "any", false, false, false, 331), "html", null, true);
        yield "\">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 337
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <input class=\"form-control\" type=\"text\" name=\"company\" value=\"";
        // line 339
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "company", [], "any", false, false, false, 339), "html", null, true);
        yield "\">
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 343
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address Line 1"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <input class=\"form-control\" type=\"text\" name=\"address_1\" value=\"";
        // line 345
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "address_1", [], "any", false, false, false, 345), "html", null, true);
        yield "\">
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 349
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address Line 2"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <input class=\"form-control\" type=\"text\" name=\"address_2\" value=\"";
        // line 351
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "address_2", [], "any", false, false, false, 351), "html", null, true);
        yield "\">
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 355
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("City"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <input class=\"form-control\" type=\"text\" name=\"city\" value=\"";
        // line 357
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "city", [], "any", false, false, false, 357), "html", null, true);
        yield "\">
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 361
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("State"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                ";
        // line 364
        yield "                                <input class=\"form-control\" type=\"text\" name=\"state\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "state", [], "any", false, false, false, 364), "html", null, true);
        yield "\">
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 368
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Country"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                ";
        // line 370
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 370, $this->getSourceContext())->macro_selectbox(...["country", CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_countries", [], "any", false, false, false, 370), CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "country", [], "any", false, false, false, 370), 0, __trans("Select country")]);
        yield "
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 374
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Postcode"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <input class=\"form-control\" type=\"text\" name=\"postcode\" value=\"";
        // line 376
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "postcode", [], "any", false, false, false, 376), "html", null, true);
        yield "\">
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 380
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <div class=\"input-group\">
                                    <span class=\"input-group-text\">+</span>
                                    <input class=\"form-control\" type=\"text\" name=\"phone_cc\" value=\"";
        // line 384
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "phone_cc", [], "any", false, false, false, 384), "html", null, true);
        yield "\">
                                    ";
        // line 386
        yield "                                    <input class=\"form-control w-50\" type=\"text\" name=\"phone\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "phone", [], "any", false, false, false, 386), "html", null, true);
        yield "\">
                                </div>
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 391
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Currency"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                ";
        // line 393
        yield $macros["mf"]->getTemplateForMacro("macro_selectbox", $context, 393, $this->getSourceContext())->macro_selectbox(...["currency", CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "currency_get_pairs", [], "any", false, false, false, 393), CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "currency", [], "any", false, false, false, 393), 0, __trans("Select currency")]);
        yield "
                            </div>
                        </div>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 397
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Password"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <input class=\"form-control\" type=\"password\" name=\"password\" value=\"\" required>
                            </div>
                        </div>

                        <input type=\"submit\" class=\"btn btn-primary\" value=\"";
        // line 403
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Create"), "html", null, true);
        yield "\">
                    </form>
                </div>
            </div>

            <div class=\"tab-pane fade\" id=\"tab-groups\" role=\"tabpanel\">
                <table class=\"table card-table table-vcenter table-striped text-nowrap\">
                    <thead>
                        <tr>
                            <th>";
        // line 412
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
        yield "</th>
                            <th class=\"w-1\"></th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
        // line 417
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "client_group_get_pairs", [], "any", false, false, false, 417));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["id"] => $context["group"]) {
            // line 418
            yield "                        <tr>
                            <td>
                                <a href=\"";
            // line 420
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/group");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["id"], "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["group"], "html", null, true);
            yield "</a>
                            </td>
                            <td>
                                <a class=\"btn btn-icon\" href=\"";
            // line 423
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client/group");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["id"], "html", null, true);
            yield "\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#edit\" />
                                    </svg>
                                </a>
                                <a class=\"btn btn-icon api-link\" href=\"";
            // line 428
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/client/group_delete", ["id" => $context["id"], "CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\" data-api-reload=\"1\" data-api-confirm=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
            yield "\">
                                    <svg class=\"icon\">
                                        <use xlink:href=\"#delete\" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        ";
            $context['_iterated'] = true;
        }
        // line 435
        if (!$context['_iterated']) {
            // line 436
            yield "                        <tr>
                            <td class=\"text-muted\" colspan=\"2\">";
            // line 437
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                        </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['id'], $context['group'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 440
        yield "                    </tbody>
                </table>
            </div>

            <div class=\"tab-pane fade\" id=\"tab-new-group\" role=\"tabpanel\">
                <div class=\"card-body\">
                    <form method=\"post\" action=\"";
        // line 446
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/client/group_create");
        yield "\" class=\"api-form\" data-api-redirect=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("client");
        yield "\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
        // line 447
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\"/>
                        <div class=\"form-group mb-3 row\">
                            <label class=\"form-label col-3 col-form-label\">";
        // line 449
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
        yield ":</label>
                            <div class=\"col\">
                                <input class=\"form-control\" type=\"text\" name=\"title\" value=\"";
        // line 451
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "title", [], "any", false, false, false, 451), "html", null, true);
        yield "\" required>
                            </div>
                        </div>

                        <button class=\"btn btn-primary w-100\" type=\"submit\">";
        // line 455
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Create"), "html", null, true);
        yield "</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
";
        yield from [];
    }

    // line 463
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
        return "mod_client_index.html.twig";
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
        return array (  961 => 463,  949 => 455,  942 => 451,  937 => 449,  932 => 447,  926 => 446,  918 => 440,  909 => 437,  906 => 436,  904 => 435,  890 => 428,  880 => 423,  870 => 420,  866 => 418,  861 => 417,  853 => 412,  841 => 403,  832 => 397,  825 => 393,  820 => 391,  811 => 386,  807 => 384,  800 => 380,  793 => 376,  788 => 374,  781 => 370,  776 => 368,  768 => 364,  763 => 361,  756 => 357,  751 => 355,  744 => 351,  739 => 349,  732 => 345,  727 => 343,  720 => 339,  715 => 337,  706 => 331,  700 => 328,  693 => 324,  686 => 320,  681 => 318,  674 => 314,  669 => 312,  661 => 307,  654 => 303,  647 => 299,  642 => 297,  636 => 296,  625 => 288,  616 => 284,  610 => 281,  606 => 280,  598 => 274,  589 => 271,  586 => 270,  584 => 269,  570 => 262,  560 => 257,  555 => 255,  549 => 253,  545 => 251,  542 => 250,  538 => 248,  535 => 247,  531 => 245,  529 => 244,  517 => 241,  508 => 235,  500 => 232,  490 => 231,  483 => 227,  477 => 226,  470 => 222,  466 => 220,  460 => 219,  458 => 218,  449 => 212,  445 => 211,  441 => 210,  437 => 209,  426 => 201,  415 => 193,  405 => 186,  398 => 182,  388 => 175,  384 => 173,  377 => 172,  363 => 162,  357 => 159,  350 => 155,  340 => 148,  334 => 145,  327 => 141,  317 => 134,  311 => 131,  304 => 127,  294 => 120,  288 => 117,  281 => 113,  277 => 111,  274 => 110,  263 => 104,  259 => 103,  253 => 100,  224 => 80,  215 => 74,  206 => 68,  200 => 67,  194 => 64,  188 => 63,  182 => 60,  176 => 59,  170 => 56,  164 => 55,  158 => 52,  150 => 47,  145 => 45,  137 => 40,  132 => 38,  124 => 33,  119 => 31,  111 => 26,  106 => 24,  99 => 20,  94 => 18,  89 => 16,  83 => 13,  79 => 11,  77 => 10,  70 => 9,  59 => 7,  54 => 1,  52 => 5,  50 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_client_index.html.twig", "/var/www/html/modules/Client/html_admin/mod_client_index.html.twig");
    }
}
