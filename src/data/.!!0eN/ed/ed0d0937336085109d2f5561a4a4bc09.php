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
class __TwigTemplate_f9d6e643b35f4c91c3cd956fe8c8cc29 extends Template
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
            'page_header' => [$this, 'block_page_header'],
            'body_class' => [$this, 'block_body_class'],
            'breadcrumb' => [$this, 'block_breadcrumb'],
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
        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice management"), "html", null, true);
        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_header(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice management"), "html", null, true);
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "invoice-index";
        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumb(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 8
        yield "    <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
        yield "</li>
";
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
        yield "    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"card mb-4\">
                <div class=\"card-header py-3 py-3\">
                    <div class=\"d-flex justify-content-between align-items-center\">
                        <div>
                            <h1 class=\"mb-1\">";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
        yield "</h1>
                            <span class=\"small text-muted\">
                                ";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("All of your invoices can be found here. You can choose to see either paid or unpaid invoices by clicking corresponding button."), "html", null, true);
        yield "
                            </span>
                        </div>
                    </div>
                </div>
                <div class=\"card-body\">
                    <nav>
                        <div class=\"nav nav-tabs\" id=\"invoice-tab\" role=\"tablist\">
                            <button class=\"nav-link active\" id=\"unpaid-tab\" data-bs-toggle=\"tab\"
                                    data-bs-target=\"#nav-unpaid\" type=\"button\" role=\"tab\" aria-controls=\"nav-unpaid\"
                                    aria-selected=\"true\">";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Unpaid"), "html", null, true);
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["unpaid_invoices"] ?? null), "total", [], "any", false, false, false, 30)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "&nbsp;<span
                                    class=\"badge bg-danger\">";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["unpaid_invoices"] ?? null), "total", [], "any", false, false, false, 31), "html", null, true);
            yield "</span>";
        }
        yield "</button>
                            <button class=\"nav-link\" id=\"paid-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#nav-paid\"
                                    type=\"button\" role=\"tab\" aria-controls=\"nav-paid\"
                                    aria-selected=\"false\">";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid"), "html", null, true);
        yield "&nbsp;<span
                                    class=\"badge bg-secondary\">";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["paid_invoices"] ?? null), "total", [], "any", false, false, false, 35), "html", null, true);
        yield "</span></button>
                        </div>
                    </nav>
                    <div class=\"tab-content\" id=\"nav-tabContent\">
                        <div class=\"tab-pane fade show active table-responsive\" id=\"nav-unpaid\" role=\"tabpanel\"
                             aria-labelledby=\"nav-home-tab\" tabindex=\"0\">
                            <table class=\"table table-bordered table-hover\">
                                <thead>
                                <tr>
                                    <th>";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
        yield "</th>
                                    <th>";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice Date"), "html", null, true);
        yield "</th>
                                    <th>";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Due Date"), "html", null, true);
        yield "</th>
                                    <th>";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
        yield "</th>
                                    <th>";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Actions"), "html", null, true);
        yield "</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
        // line 52
        $context["unpaid_invoices"] = CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "invoice_get_list", [["status" => "unpaid", "per_page" => 10, "page" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "page", [], "any", false, false, false, 52)]], "method", false, false, false, 52);
        // line 53
        yield "                                ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["unpaid_invoices"] ?? null), "list", [], "any", false, false, false, 53));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["i"] => $context["invoice"]) {
            // line 54
            yield "                                    <tr>
                                        <td>";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice"), "html", null, true);
            yield " #";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "serie", [], "any", false, false, false, 55) . Twig\Extension\CoreExtension::sprintf("%05s", CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "nr", [], "any", false, false, false, 55))), "html", null, true);
            yield "</td>
                                        <td>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "created_at", [], "any", false, false, false, 56)), "html", null, true);
            yield "</td>
                                        <td>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "due_at", [], "any", false, false, false, 57)), "html", null, true);
            yield "</td>
                                        <td>";
            // line 58
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "total", [], "any", false, false, false, 58), CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "currency", [], "any", false, false, false, 58));
            yield "</td>
                                        <td><a class=\"btn btn-sm btn-success\"
                                            href=\"";
            // line 60
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("invoice");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "hash", [], "any", false, false, false, 60), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Pay"), "html", null, true);
            yield "</a>
                                        </td>
                                    </tr>
                                ";
            $context['_iterated'] = true;
        }
        // line 63
        if (!$context['_iterated']) {
            // line 64
            yield "                                    <tr>
                                        <td colspan=\"5\">";
            // line 65
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                                    </tr>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['i'], $context['invoice'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        yield "                                </tbody>
                            </table>
                            ";
        // line 70
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_pagination.html.twig", ["list" => ($context["unpaid_invoices"] ?? null)]);
        yield "
                        </div>
                        <div class=\"tab-pane fade table-responsive\" id=\"nav-paid\" role=\"tabpanel\" aria-labelledby=\"nav-profile-tab\"
                             tabindex=\"0\">
                            <table class=\"table table-bordered table-hover\">
                                <thead>
                                <tr>
                                    <th>";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
        yield "</th>
                                    <th>";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice Date"), "html", null, true);
        yield "</th>
                                    <th>";
        // line 79
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Paid Date"), "html", null, true);
        yield "</th>
                                    <th>";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
        yield "</th>
                                    <th>";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Actions"), "html", null, true);
        yield "</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
        // line 85
        $context["paid_invoices"] = CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "invoice_get_list", [["per_page" => 10, "page" => CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "page", [], "any", false, false, false, 85), "status" => "paid"]], "method", false, false, false, 85);
        // line 86
        yield "                                ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["paid_invoices"] ?? null), "list", [], "any", false, false, false, 86));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["i"] => $context["invoice"]) {
            // line 87
            yield "                                    <tr>
                                        <td>";
            // line 88
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice"), "html", null, true);
            yield " #";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "serie", [], "any", false, false, false, 88) . Twig\Extension\CoreExtension::sprintf("%05s", CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "nr", [], "any", false, false, false, 88))), "html", null, true);
            yield "</td>
                                        <td>";
            // line 89
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "created_at", [], "any", false, false, false, 89)), "html", null, true);
            yield "</td>
                                        <td>";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "paid_at", [], "any", false, false, false, 90)), "html", null, true);
            yield "</td>
                                        <td>";
            // line 91
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "total", [], "any", false, false, false, 91), CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "currency", [], "any", false, false, false, 91));
            yield "</td>
                                        <td><a href=\"";
            // line 92
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("invoice");
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invoice"], "hash", [], "any", false, false, false, 92), "html", null, true);
            yield "\"
                                            class=\"btn btn-outline-secondary btn-sm\">";
            // line 93
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("View"), "html", null, true);
            yield "</a></td>
                                    </tr>
                                ";
            $context['_iterated'] = true;
        }
        // line 95
        if (!$context['_iterated']) {
            // line 96
            yield "                                    <tr>
                                        <td colspan=\"7\">";
            // line 97
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The list is empty"), "html", null, true);
            yield "</td>
                                    </tr>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['i'], $context['invoice'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 100
        yield "                                </tbody>
                            </table>
                            ";
        // line 102
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_pagination.html.twig", ["list" => ($context["paid_invoices"] ?? null)]);
        yield "
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
        yield from [];
    }

    // line 110
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 111
        yield "<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const tabParam = urlParams.get('tab');
    const pageParam = urlParams.get('page');

    if (tabParam === 'paid') {
        const paidTab = document.getElementById('paid-tab');
        if (paidTab) {
            const tab = new bootstrap.Tab(paidTab);
            tab.show();
        }
    }

    // Update URL when tabs are clicked.
    document.getElementById('unpaid-tab').addEventListener('shown.bs.tab', function() {
        // Reset to base URL without tab parameter and reload.
        const newUrl = new URL(window.location.href);
        newUrl.searchParams.delete('tab');
        newUrl.searchParams.delete('page');
        window.location.href = newUrl.toString();
    });

    document.getElementById('paid-tab').addEventListener('shown.bs.tab', function() {
        // Set tab to 'paid', reset page parameter and reload.
        const newUrl = new URL(window.location.href);
        newUrl.searchParams.set('tab', 'paid');
        newUrl.searchParams.delete('page');
        window.location.href = newUrl.toString();
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
        return array (  361 => 111,  354 => 110,  341 => 102,  337 => 100,  328 => 97,  325 => 96,  323 => 95,  316 => 93,  310 => 92,  306 => 91,  302 => 90,  298 => 89,  292 => 88,  289 => 87,  283 => 86,  281 => 85,  274 => 81,  270 => 80,  266 => 79,  262 => 78,  258 => 77,  248 => 70,  244 => 68,  235 => 65,  232 => 64,  230 => 63,  218 => 60,  213 => 58,  209 => 57,  205 => 56,  199 => 55,  196 => 54,  190 => 53,  188 => 52,  181 => 48,  177 => 47,  173 => 46,  169 => 45,  165 => 44,  153 => 35,  149 => 34,  141 => 31,  136 => 30,  123 => 20,  118 => 18,  110 => 12,  103 => 11,  95 => 8,  88 => 7,  77 => 6,  66 => 4,  55 => 3,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_invoice_index.html.twig", "/var/www/html/modules/Invoice/html_client/mod_invoice_index.html.twig");
    }
}
