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

/* mod_email_settings.html.twig */
class __TwigTemplate_c842fc8709ed996ab092eb4debcac94a extends Template
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
            'breadcrumbs' => [$this, 'block_breadcrumbs'],
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
        // line 22
        $context["active_menu"] = "system";
        // line 1
        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "    <ul class=\"breadcrumb\">
        <li class=\"breadcrumb-item\">
            <a href=\"";
        // line 9
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/");
        yield "\">
                <svg class=\"icon\">
                    <use xlink:href=\"#home\" />
                </svg>
            </a>
        </li>
        <li class=\"breadcrumb-item\">
            <a href=\"";
        // line 16
        yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("system");
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Settings"), "html", null, true);
        yield "</a>
        </li>
        <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
        yield "</li>
    </ul>
";
        yield from [];
    }

    // line 23
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 24
        yield "    ";
        $context["params"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "extension_config_get", [["ext" => "mod_email"]], "method", false, false, false, 24);
        // line 25
        yield "    <div class=\"card-tabs\">

        <ul class=\"nav nav-tabs\" role=\"tablist\">
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link active\" href=\"#tab-index\" data-bs-toggle=\"tab\">";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email templates"), "html", null, true);
        yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-new\" data-bs-toggle=\"tab\">
                    <svg class=\"icon me-2\">
                        <use xlink:href=\"#plus\" />
                    </svg>
                    ";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("New template"), "html", null, true);
        yield "
                </a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-queue\" data-bs-toggle=\"tab\">";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email queue"), "html", null, true);
        yield "</a>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link\" href=\"#tab-email\" data-bs-toggle=\"tab\">";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email settings"), "html", null, true);
        yield "</a>
            </li>
        </ul>
        <div class=\"card\">
            <div class=\"tab-content\">
                <div class=\"tab-pane fade show active\" id=\"tab-index\" role=\"tabpanel\">

                    <div class=\"card-footer text-center\">
                        <a href=\"";
        // line 51
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/email/batch_template_generate");
        yield "\" class=\"btn btn-primary api-link\" data-api-reload=\"1\">
                            <svg class=\"icon icon-tabler\" width=\"24\" height=\"24\">
                                <use xlink:href=\"#mail\" />
                            </svg>
                            <span>";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Regenerate templates"), "html", null, true);
        yield "</span>
                        </a>
                        <a href=\"";
        // line 57
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/email/batch_template_enable");
        yield "\" class=\"btn btn-primary api-link\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("All email templates enabled"), "html", null, true);
        yield "\">
                            <svg class=\"icon icon-tabler\" width=\"24\" height=\"24\">
                                <use xlink:href=\"#play\" />
                            </svg>
                            <span>";
        // line 61
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enable all"), "html", null, true);
        yield "</span>
                        </a>
                        <a href=\"";
        // line 63
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/email/batch_template_disable");
        yield "\" class=\"btn btn-primary api-link\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("All email templates disabled"), "html", null, true);
        yield "\">
                            <svg class=\"icon icon-tabler\" width=\"24\" height=\"24\">
                                <use xlink:href=\"#close\" />
                            </svg>
                            <span>";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Disable all"), "html", null, true);
        yield "</span>
                        </a>
                    </div>
                    ";
        // line 70
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_search.html.twig");
        yield "
                    <div class=\"table-responsive\">
                        <table class=\"table card-table table-vcenter table-striped text-nowrap sortable\">
                            <thead>
                            <tr>
                                <th class=\"w-1\">";
        // line 75
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Subject"), "html", null, true);
        yield "</th>
                                <th>";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Extension"), "html", null, true);
        yield "</th>
                                <th>";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Code"), "html", null, true);
        yield "</th>
                                <th>";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enabled"), "html", null, true);
        yield "</th>
                                <th class=\"w-1\"></th>
                            </tr>
                            </thead>

                            <tbody>
                            ";
        // line 84
        $context["templates"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "email_template_get_list", [Twig\Extension\CoreExtension::merge(["per_page" => 100, "page" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "page", [], "any", false, false, false, 84)], ($context["request"] ?? null))], "method", false, false, false, 84);
        // line 85
        yield "                            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["templates"] ?? null), "list", [], "any", false, false, false, 85));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["i"] => $context["template"]) {
            // line 86
            yield "                                <tr>
                                    <td>
                                        <a href=\"";
            // line 88
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/email/template");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["template"], "id", [], "any", false, false, false, 88), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["template"], "subject", [], "any", false, false, false, 88), "html", null, true);
            yield "</a>
                                    </td>
                                    <td>";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["template"], "category", [], "any", false, false, false, 90), "html", null, true);
            yield "</td>
                                    <td>";
            // line 91
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["template"], "action_code", [], "any", false, false, false, 91), "html", null, true);
            yield "</td>
                                    <td>
                                        ";
            // line 93
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["template"], "enabled", [], "any", false, false, false, 93) == 1)) {
                // line 94
                yield "                                            <span class=\"badge bg-success me-1\"></span>
                                        ";
            }
            // line 96
            yield "                                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["template"], "enabled", [], "any", false, false, false, 96) == 0)) {
                // line 97
                yield "                                            <span class=\"badge bg-danger me-1\"></span>
                                        ";
            }
            // line 99
            yield "                                        ";
            yield $macros["mf"]->getTemplateForMacro("macro_q", $context, 99, $this->getSourceContext())->macro_q(...[CoreExtension::getAttribute($this->env, $this->source, $context["template"], "enabled", [], "any", false, false, false, 99)]);
            yield "
                                    </td>
                                    <td>
                                        <a class=\"btn btn-icon\" href=\"";
            // line 102
            yield $this->extensions['Box_TwigExtensions']->twig_bb_admin_link_filter("/email/template");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["template"], "id", [], "any", false, false, false, 102), "html", null, true);
            yield "\"
                                           data-bs-toggle=\"tooltip\" data-bs-title=\"";
            // line 103
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Edit"), "html", null, true);
            yield "\">
                                            <svg class=\"icon\">
                                                <use xlink:href=\"#edit\" />
                                            </svg>
                                        </a>
                                        <a class=\"btn btn-icon api-link\"
                                           href=\"";
            // line 109
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/email/template_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["template"], "id", [], "any", false, false, false, 109)]);
            yield "\"
                                           data-api-confirm=\"";
            // line 110
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
            yield "\"
                                           data-api-confirm-content=\"";
            // line 111
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure you want to delete this template?"), "html", null, true);
            yield "\"
                                           data-api-type=\"danger\"
                                           data-api-confirm-btn=\"";
            // line 113
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Delete"), "html", null, true);
            yield "\"
                                           data-api-reload=\"1\"
                                           data-bs-toggle=\"tooltip\" data-bs-title=\"";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Delete"), "html", null, true);
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
        // line 122
        if (!$context['_iterated']) {
            // line 123
            yield "                                <tr>
                                    <td class=\"text-muted\" colspan=\"5\">";
            // line 124
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty. Depending on modules enabled email templates will be inserted after first event occurrence."), "html", null, true);
            yield "</td>
                                </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['i'], $context['template'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 127
        yield "                            </tbody>
                        </table>
                    </div>
                </div>

                <div class=\"tab-pane fade\" id=\"tab-new\" role=\"tabpanel\">
                    <form method=\"post\" action=\"";
        // line 133
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/email/template_create");
        yield "\" class=\"api-form\" data-api-reload=\"1\">
                        <div class=\"card-body\">
                            <h3 class=\"card-title\">";
        // line 135
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Where I can use new email template?"), "html", null, true);
        yield "</h3>
                            <p class=\"card-subtitle\">";
        // line 136
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Newly created email templates can be used in custom event hooks."), "html", null, true);
        yield "</p>

                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 form-label\">";
        // line 139
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Enabled"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radioEnabledYes\" type=\"radio\" name=\"enabled\" value=\"1\">
                                        <label class=\"form-check-label\" for=\"radioEnabledYes\">";
        // line 143
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "</label>
                                    </div>
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radioEnabledNo\" type=\"radio\" name=\"enabled\" value=\"0\" checked>
                                        <label class=\"form-check-label\" for=\"radioEnabledNo\">";
        // line 147
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "</label>
                                    </div>
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 152
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Category"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"category\" value=\"";
        // line 154
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["requests"] ?? null), "category", [], "any", false, false, false, 154), "html", null, true);
        yield "\" required placeholder=\"General\">
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 158
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Action code"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"action_code\" value=\"";
        // line 160
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["requests"] ?? null), "action_code", [], "any", false, false, false, 160), "html", null, true);
        yield "\" required>
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 164
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Subject"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <input class=\"form-control\" type=\"text\" name=\"subject\" value=\"";
        // line 166
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["requests"] ?? null), "subject", [], "any", false, false, false, 166), "html", null, true);
        yield "\" required>
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 170
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Content"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <textarea class=\"form-control\" name=\"content\" rows=\"5\">";
        // line 172
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["requests"] ?? null), "content", [], "any", false, false, false, 172), "html", null, true);
        yield "</textarea>
                                </div>
                            </div>
                        </div>
                        <div class=\"card-footer text-end\">
                            <input type=\"submit\" value=\"";
        // line 177
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Create"), "html", null, true);
        yield "\" class=\"btn btn-primary\">
                        </div>
                    </form>
                </div>

                <div class=\"tab-pane fade show\" id=\"tab-queue\" role=\"tabpanel\">
                    ";
        // line 183
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_search.html.twig");
        yield "
                    <div class=\"ms-1 mt-1 mb-1\">
                        <p>";
        // line 185
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("FOSSBilling queues emails to have them be sent via cron in the background. Here you may find the list of queued emails and how many times the system has tried to send them."), "html", null, true);
        yield "</p>
                        <p>";
        // line 186
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Emails that have been sent or that failed to be sent will not be listed here."), "html", null, true);
        yield "</p>
                    </div>
                    <div class=\"table-responsive\">
                        <table class=\"table card-table table-vcenter table-striped text-nowrap sortable\">
                            <thead>
                            <tr>
                                <th class=\"w-1\">";
        // line 192
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Subject"), "html", null, true);
        yield "</th>
                                <th>";
        // line 193
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("To"), "html", null, true);
        yield "</th>
                                <th>";
        // line 194
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("To (Email)"), "html", null, true);
        yield "</th>
                                <th>";
        // line 195
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield "</th>
                                <th>";
        // line 196
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Tries"), "html", null, true);
        yield "</th>
                                <th>";
        // line 197
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Created at"), "html", null, true);
        yield "</th>
                                <th>";
        // line 198
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Updated at"), "html", null, true);
        yield "</th>
                            </tr>
                            </thead>
                            <tbody>
                            ";
        // line 202
        $context["queue"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "email_get_queue", [Twig\Extension\CoreExtension::merge(["per_page" => 100, "page" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "page", [], "any", false, false, false, 202)], ($context["request"] ?? null))], "method", false, false, false, 202);
        // line 203
        yield "                            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["queue"] ?? null), "list", [], "any", false, false, false, 203));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["i"] => $context["queuedEmail"]) {
            // line 204
            yield "                                <tr>
                                    <td>
                                        ";
            // line 206
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["queuedEmail"], "subject", [], "any", false, false, false, 206), "html", null, true);
            yield "
                                    </td>
                                    <td>
                                        ";
            // line 209
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["queuedEmail"], "to_name", [], "any", false, false, false, 209), "html", null, true);
            yield "
                                    </td>
                                    <td>
                                        <a href=\"mailto:";
            // line 212
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["queuedEmail"], "recipient", [], "any", false, false, false, 212), "html", null, true);
            yield "\"> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["queuedEmail"], "recipient", [], "any", false, false, false, 212), "html", null, true);
            yield "</a>
                                    </td>
                                    <td>
                                        ";
            // line 215
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["queuedEmail"], "status", [], "any", false, false, false, 215) == "unsent")) {
                // line 216
                yield "                                            <span class=\"badge bg-danger me-1\"></span>
                                        ";
            } else {
                // line 218
                yield "                                            <span class=\"badge bg-success me-1\"></span>
                                        ";
            }
            // line 220
            yield "                                        <span class=\"text-capitalize\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["queuedEmail"], "status", [], "any", false, false, false, 220), "html", null, true);
            yield "</span>
                                    </td>
                                    <td>
                                        ";
            // line 223
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["queuedEmail"], "tries", [], "any", false, false, false, 223), "html", null, true);
            yield " / ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "cancel_after", [], "any", true, true, false, 223)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "cancel_after", [], "any", false, false, false, 223), "5")) : ("5")), "html", null, true);
            yield "
                                    </td>
                                    <td>
                                        ";
            // line 226
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["queuedEmail"], "created_at", [], "any", false, false, false, 226)), "html", null, true);
            yield "
                                    </td>
                                    <td>
                                        ";
            // line 229
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["queuedEmail"], "updated_at", [], "any", false, false, false, 229)), "html", null, true);
            yield "
                                    </td>
                                </tr>
                            ";
            $context['_iterated'] = true;
        }
        // line 232
        if (!$context['_iterated']) {
            // line 233
            yield "                                <tr>
                                    <td class=\"text-muted\" colspan=\"5\">";
            // line 234
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty."), "html", null, true);
            yield "</td>
                                </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['i'], $context['queuedEmail'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 237
        yield "                            </tbody>
                        </table>
                    </div>
                </div>

                <div class=\"tab-pane fade\" id=\"tab-email\" role=\"tabpanel\">
                    <form method=\"post\" action=\"";
        // line 243
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/extension/config_save");
        yield "\" class=\"api-form\" data-api-msg=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email settings updated"), "html", null, true);
        yield "\">
                        <div class=\"card-body\">
                            <h3 class=\"card-title\">";
        // line 245
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Configure email options"), "html", null, true);
        yield "</h3>
                            <p class=\"card-subtitle\">";
        // line 246
        yield __trans("FOSSBilling sends emails using <em>sendmail</em> by default or you can configure your own SMTP server");
        yield "</p>

                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 col-form-label\">";
        // line 249
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Queue options"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <div class=\"mb-2\">
                                        <small class=\"form-hint\">";
        // line 252
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Send emails per cron run (0 = unlimited)"), "html", null, true);
        yield "</small>
                                        <input class=\"form-control\" type=\"text\" name=\"queue_once\" placeholder=\"0\" value=\"";
        // line 253
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "queue_once", [], "any", true, true, false, 253)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "queue_once", [], "any", false, false, false, 253), "0")) : ("0")), "html", null, true);
        yield "\">
                                    </div>
                                    <div class=\"mb-2\">
                                        <small class=\"form-hint\">";
        // line 256
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Max email sending time in minutes (0 = unlimited, default 5 min.)"), "html", null, true);
        yield "</small>
                                        <input class=\"form-control\" type=\"text\" name=\"time_limit\" placeholder=\"5\" value=\"";
        // line 257
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "time_limit", [], "any", true, true, false, 257)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "time_limit", [], "any", false, false, false, 257), "5")) : ("5")), "html", null, true);
        yield "\">
                                    </div>
                                    <div class=\"mb-2\">
                                        <small class=\"form-hint\">";
        // line 260
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Cancel sending email after unsuccessful tries (0 = do not cancel)"), "html", null, true);
        yield "</small>
                                        <input class=\"form-control\" type=\"text\" name=\"cancel_after\" placeholder=\"5\" value=\"";
        // line 261
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "cancel_after", [], "any", true, true, false, 261)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "cancel_after", [], "any", false, false, false, 261), "5")) : ("5")), "html", null, true);
        yield "\">
                                    </div>
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 form-label\">";
        // line 266
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Log sent emails to database"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\">
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radioLogEnabledYes\" type=\"radio\" name=\"log_enabled\" value=\"1\"";
        // line 269
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "log_enabled", [], "any", false, false, false, 269)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"radioLogEnabledYes\">";
        // line 270
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Yes"), "html", null, true);
        yield "</label>
                                    </div>
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radioLogEnabledNo\" type=\"radio\" name=\"log_enabled\" value=\"0\"";
        // line 273
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "log_enabled", [], "any", false, false, false, 273)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield " checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"radioLogEnabledNo\">";
        // line 274
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No"), "html", null, true);
        yield "</label>
                                    </div>
                                </div>
                            </div>
                            <div class=\"mb-3 row\">
                                <label class=\"col-md-3 form-label\">";
        // line 279
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email transport"), "html", null, true);
        yield "</label>
                                <div class=\"col-md-6\" id=\"mailer\">
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radioSendMail\" type=\"radio\" name=\"mailer\" value=\"sendmail\"";
        // line 282
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "mailer", [], "any", false, false, false, 282) == "sendmail") ||  !CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "mailer", [], "any", false, false, false, 282))) {
            yield " checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"radioSendMail\">";
        // line 283
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("SendMail"), "html", null, true);
        yield "</label>
                                    </div>
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radioSMTP\" type=\"radio\" name=\"mailer\" value=\"smtp\"";
        // line 286
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "mailer", [], "any", false, false, false, 286) == "smtp")) {
            yield " checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"radioSMTP\">";
        // line 287
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("SMTP"), "html", null, true);
        yield "</label>
                                    </div>
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radioSendGrid\" type=\"radio\" name=\"mailer\" value=\"sendgrid\"";
        // line 290
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "mailer", [], "any", false, false, false, 290) == "sendgrid")) {
            yield " checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"radioSendGrid\">";
        // line 291
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("SendGrid"), "html", null, true);
        yield "</label>
                                    </div>
                                    <div class=\"form-check form-check-inline\">
                                        <input class=\"form-check-input\" id=\"radioCustom\" type=\"radio\" name=\"mailer\" value=\"custom\"";
        // line 294
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "mailer", [], "any", false, false, false, 294) == "custom")) {
            yield " checked";
        }
        yield ">
                                        <label class=\"form-check-label\" for=\"radioCustom\">";
        // line 295
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Custom"), "html", null, true);
        yield "</label>
                                    </div>
                                </div>
                            </div>

                            <fieldset class=\"smtp\"";
        // line 300
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "mailer", [], "any", false, false, false, 300) != "smtp")) {
            yield " style=\"display:none;\"";
        }
        yield " >
                                <div class=\"mb-3 row\">
                                    <label class=\"col-md-3 col-form-label\">";
        // line 302
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("SMTP Hostname"), "html", null, true);
        yield "</label>
                                    <div class=\"col-md-6\">
                                        <input class=\"form-control\" type=\"text\" name=\"smtp_host\" value=\"";
        // line 304
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "smtp_host", [], "any", false, false, false, 304), "html", null, true);
        yield "\" placeholder=\"smtp.gmail.com\">
                                    </div>
                                </div>
                                <div class=\"mb-3 row\">
                                    <label class=\"col-md-3 col-form-label\">";
        // line 308
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("SMTP Port"), "html", null, true);
        yield "</label>
                                    <div class=\"col-md-6\">
                                        <input class=\"form-control\" type=\"text\" name=\"smtp_port\" value=\"";
        // line 310
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "smtp_port", [], "any", false, false, false, 310), "html", null, true);
        yield "\" placeholder=\"587\">
                                    </div>
                                </div>
                                <div class=\"mb-3 row\">
                                    <label class=\"col-md-3 col-form-label\">";
        // line 314
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("SMTP Username"), "html", null, true);
        yield "</label>
                                    <div class=\"col-md-6\">
                                        <input class=\"form-control\" type=\"text\" name=\"smtp_username\" value=\"";
        // line 316
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "smtp_username", [], "any", false, false, false, 316), "html", null, true);
        yield "\" placeholder=\"my.email@gmail.com\">
                                    </div>
                                </div>
                                <div class=\"mb-3 row\">
                                    <label class=\"col-md-3 col-form-label\">";
        // line 320
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("SMTP Password"), "html", null, true);
        yield "</label>
                                    <div class=\"col-md-6\">
                                        <input class=\"form-control\" type=\"password\" name=\"smtp_password\" value=\"";
        // line 322
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "smtp_password", [], "any", false, false, false, 322), "html", null, true);
        yield "\">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class=\"sendgrid\"";
        // line 327
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "mailer", [], "any", false, false, false, 327) != "sendgrid")) {
            yield " style=\"display:none;\"";
        }
        yield " >
                                <div class=\"mb-3 row\">
                                    <label class=\"col-md-3 col-form-label\">";
        // line 329
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("SendGrid API Key"), "html", null, true);
        yield "</label>
                                    <div class=\"col-md-6\">
                                        <input class=\"form-control\" type=\"text\" name=\"sendgrid_key\" value=\"";
        // line 331
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "sendgrid_key", [], "any", false, false, false, 331), "html", null, true);
        yield "\">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class=\"custom\"";
        // line 336
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "mailer", [], "any", false, false, false, 336) != "custom")) {
            yield " style=\"display:none;\"";
        }
        yield " >
                                <div class=\"mb-3 row\">
                                    <label class=\"col-md-3 col-form-label\" for=\"custom_dsn\">";
        // line 338
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Custom DSN"), "html", null, true);
        yield "</label>
                                    <div class=\"col-md-6\">
                                        <p>";
        // line 340
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("If none of the available options exactly meet your needs, you can define a custom DSN. Please keep in mind that usernames, passwords, and hostnames with special characters need to be URL-encoded."), "html", null, true);
        yield "</p>
                                        <p>";
        // line 341
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("More information"), "html", null, true);
        yield ": <a href=\"https://symfony.com/doc/current/mailer.html#using-built-in-transports\">";
        yield "Symfony Documentation";
        yield "</a></p>
                                        <p class=\"fw-light\">";
        // line 342
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Example"), "html", null, true);
        yield ": smtp://user:pass@smtp.example.com?verify_peer=0</p>
                                        <input class=\"form-control\" type=\"text\" name=\"custom_dsn\" value=\"";
        // line 343
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "custom_dsn", [], "any", false, false, false, 343), "html", null, true);
        yield "\">
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <input type=\"hidden\" name=\"ext\" value=\"mod_email\">
                        <div class=\"card-footer d-flex justify-content-between\">
                            <button class=\"btn btn-secondary\" id=\"emailTest\">
                                <svg class=\"icon\">
                                    <use xlink:href=\"#wifi\" />
                                </svg>
                                ";
        // line 355
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Send a test email to yourself"), "html", null, true);
        yield "
                            </button>
                            <input type=\"submit\" value=\"";
        // line 357
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update email settings"), "html", null, true);
        yield "\" class=\"btn btn-primary\">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
";
        yield from [];
    }

    // line 366
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 367
        yield "<script>
\$(function() {
    \$('#emailTest').on('click', function() {
        API.admin.post('email/send_test', {}, function(result) {
            FOSSBilling.message(\"";
        // line 371
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email was successfully sent"), "html", null, true);
        yield "\");
        },
        function(result){
            FOSSBilling.message(result.message, 'error');
        });

        return false;
    });

    \$(\"#mailer input\").on('click', function() {
        if (\$(this).val() == 'smtp') {
            \$('fieldset.smtp').slideDown();
        } else {
            \$('fieldset.smtp').slideUp();
        }

        if (\$(this).val() == 'sendgrid') {
            \$('fieldset.sendgrid').slideDown();
        } else {
            \$('fieldset.sendgrid').slideUp();
        }

        if (\$(this).val() == 'custom') {
            \$('fieldset.custom').slideDown();
        } else {
            \$('fieldset.custom').slideUp();
        }
    });
});
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "mod_email_settings.html.twig";
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
        return array (  870 => 371,  864 => 367,  857 => 366,  844 => 357,  839 => 355,  824 => 343,  820 => 342,  814 => 341,  810 => 340,  805 => 338,  798 => 336,  790 => 331,  785 => 329,  778 => 327,  770 => 322,  765 => 320,  758 => 316,  753 => 314,  746 => 310,  741 => 308,  734 => 304,  729 => 302,  722 => 300,  714 => 295,  708 => 294,  702 => 291,  696 => 290,  690 => 287,  684 => 286,  678 => 283,  672 => 282,  666 => 279,  658 => 274,  652 => 273,  646 => 270,  640 => 269,  634 => 266,  626 => 261,  622 => 260,  616 => 257,  612 => 256,  606 => 253,  602 => 252,  596 => 249,  590 => 246,  586 => 245,  579 => 243,  571 => 237,  562 => 234,  559 => 233,  557 => 232,  549 => 229,  543 => 226,  535 => 223,  528 => 220,  524 => 218,  520 => 216,  518 => 215,  510 => 212,  504 => 209,  498 => 206,  494 => 204,  488 => 203,  486 => 202,  479 => 198,  475 => 197,  471 => 196,  467 => 195,  463 => 194,  459 => 193,  455 => 192,  446 => 186,  442 => 185,  437 => 183,  428 => 177,  420 => 172,  415 => 170,  408 => 166,  403 => 164,  396 => 160,  391 => 158,  384 => 154,  379 => 152,  371 => 147,  364 => 143,  357 => 139,  351 => 136,  347 => 135,  342 => 133,  334 => 127,  325 => 124,  322 => 123,  320 => 122,  308 => 115,  303 => 113,  298 => 111,  294 => 110,  290 => 109,  281 => 103,  275 => 102,  268 => 99,  264 => 97,  261 => 96,  257 => 94,  255 => 93,  250 => 91,  246 => 90,  237 => 88,  233 => 86,  227 => 85,  225 => 84,  216 => 78,  212 => 77,  208 => 76,  204 => 75,  196 => 70,  190 => 67,  181 => 63,  176 => 61,  167 => 57,  162 => 55,  155 => 51,  144 => 43,  138 => 40,  131 => 36,  121 => 29,  115 => 25,  112 => 24,  105 => 23,  97 => 18,  90 => 16,  80 => 9,  76 => 7,  69 => 6,  58 => 4,  54 => 1,  52 => 22,  50 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_email_settings.html.twig", "/var/www/html/modules/Email/html_admin/mod_email_settings.html.twig");
    }
}
