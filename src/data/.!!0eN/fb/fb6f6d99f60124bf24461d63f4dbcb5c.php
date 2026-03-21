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

/* mod_invoice_invoice.html.twig */
class __TwigTemplate_20f7d92091501895eee0528ffad2e714 extends Template
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
        // line 3
        $macros["mf"] = $this->macros["mf"] = $this->load("macro_functions.html.twig", 3)->unwrap();
        // line 5
        $context["nr"] = (CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "serie", [], "any", false, false, false, 5) . Twig\Extension\CoreExtension::sprintf("%05s", CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "nr", [], "any", false, false, false, 5)));
        // line 1
        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice"), "html", null, true);
        yield " #";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nr"] ?? null), "html", null, true);
        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "invoice-invoice";
        yield from [];
    }

    // line 11
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumb(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 12
        yield "    <li class=\"breadcrumb-item\"><a href=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/invoice");
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
        yield "</a></li>
    <li class=\"breadcrumb-item active\" aria-current=\"page\">#";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nr"] ?? null), "html", null, true);
        yield "</li>
";
        yield from [];
    }

    // line 16
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 17
        $context["seller"] = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "seller", [], "any", false, false, false, 17);
        // line 18
        $context["buyer"] = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "buyer", [], "any", false, false, false, 18);
        // line 19
        $context["company"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 19);
        // line 20
        yield "    <div class=\"row mb-3\">
        <div class=\"col-md-12\">
            ";
        // line 22
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 22) == "unpaid")) {
            // line 23
            yield "                <div class=\"card\">
                <div class=\"card-body\">
                    <h5 class=\"mb-1\">";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Payment methods"), "html", null, true);
            yield "</h5>
                    <p class=\"small text-muted\">";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Please choose a payment type and pay for your chosen products."), "html", null, true);
            yield "</p>
                    <form method=\"post\" action=\"";
            // line 27
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/guest/invoice/payment");
            yield "\" class=\"api-form\" data-api-redirect=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(("invoice/" . CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "hash", [], "any", false, false, false, 27)), ["auto_redirect" => 1]);
            yield "\">
                        <input type=\"hidden\" name=\"CSRFToken\" value=\"";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
            yield "\"/>
                        <input type=\"hidden\" name=\"hash\" value=\"";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "hash", [], "any", false, false, false, 29), "html", null, true);
            yield "\"/>
                        <div class=\"d-flex gap-3\">
                            ";
            // line 31
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "invoice_gateways", [], "any", false, false, false, 31));
            foreach ($context['_seq'] as $context["_key"] => $context["gtw"]) {
                // line 32
                yield "                                ";
                if (CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 32), CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "accepted_currencies", [], "any", false, false, false, 32))) {
                    // line 33
                    yield "                                ";
                    $context["banklink"] = $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("invoice/banklink");
                    // line 34
                    yield "                                <div class=\"invoice-gateway rounded-2 p-2\">
                                    <input type=\"radio\" class=\"btn-check border-0\" name=\"gateway_id\" gateway_id=\"";
                    // line 35
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "id", [], "any", false, false, false, 35), "html", null, true);
                    yield "\" id=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "id", [], "any", false, false, false, 35), "html", null, true);
                    yield "\" autocomplete=\"off\">
                                    <label class=\"btn\" for=\"";
                    // line 36
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "id", [], "any", false, false, false, 36), "html", null, true);
                    yield "\"
                                        style=\"background: transparent url('";
                    // line 37
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "logo", [], "any", false, false, false, 37), "logo", [], "any", false, false, false, 37), "html", null, true);
                    yield "') no-repeat center center; background-size: contain; height:";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "logo", [], "any", false, false, false, 37), "height", [], "any", false, false, false, 37), "html", null, true);
                    yield "; width:";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "logo", [], "any", false, false, false, 37), "width", [], "any", false, false, false, 37), "html", null, true);
                    yield ";\"
                                        onclick=\"paymentPrompt('";
                    // line 38
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "id", [], "any", false, false, false, 38), "html", null, true);
                    yield "', ";
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "allow_recurrent", [], "any", false, false, false, 38)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("true") : ("false"));
                    yield ", `";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "title", [], "any", false, false, false, 38), "html", null, true);
                    yield "`)\"
                                        data-bs-toggle=\"tooltip\" data-bs-title=\"";
                    // line 39
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "title", [], "any", false, false, false, 39), "html", null, true);
                    yield "\"></label>
                                    </div>
                                ";
                }
                // line 42
                yield "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['gtw'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            yield "                        </div>
                        <input type=\"hidden\" name=\"gateway_id\" id=\"gateway_id\">
                    </form>
                </div>
            </div>
            ";
        }
        // line 49
        yield "        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"card mb-4\">
                <div class=\"card-header py-3 py-3\">
                    <div class=\"d-flex justify-content-between\">
                        <div class=\"d-flex flex-column\">
                            <h5 class=\"mb-1 d-flex align-items-center\">";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice"), "html", null, true);
        yield "</h5>
                            <span class=\"small text-muted\">";
        // line 58
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("You can print this invoice or export it to a PDF file by clicking on the corresponding button."), "html", null, true);
        yield "</span>
                        </div>
                        <div class=\"d-flex align-items-center\">
                            <div class=\"d-flex gap-2 align-items-center justify-content-end\">
                                <a href=\"";
        // line 62
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("invoice/pdf");
        yield "/";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "hash", [], "any", false, false, false, 62), "html", null, true);
        yield "\" target=\"_blank\" class=\"btn btn-sm btn-danger\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("PDF"), "html", null, true);
        yield "</a>
                                <a href=\"";
        // line 63
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("invoice/print");
        yield "/";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "hash", [], "any", false, false, false, 63), "html", null, true);
        yield "\" target=\"_blank\" class=\"btn btn-sm btn-dark\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Print"), "html", null, true);
        yield "</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=\"card-body\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col-md-6 mb-4\">
                                <div class=\"well small\">
                                    <h4 class=\"fw-light mt-2 mb-3\">";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice"), "html", null, true);
        yield " #";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nr"] ?? null), "html", null, true);
        yield "</h4>
                                    <dl class=\"row\">
                                        <dt class=\"col-sm-4 text-muted\">";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoice Date"), "html", null, true);
        yield "</dt>
                                        <dd class=\"col-sm-8\">
                                            ";
        // line 78
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "paid_at", [], "any", false, false, false, 78))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 79
            yield "                                                ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "paid_at", [], "any", false, false, false, 79)), "html", null, true);
            yield "
                                            ";
        } else {
            // line 81
            yield "                                                ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "created_at", [], "any", false, false, false, 81)), "html", null, true);
            yield "
                                            ";
        }
        // line 83
        yield "                                        </dd>
                                        <dt class=\"col-sm-4 text-muted\">";
        // line 84
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Due Date"), "html", null, true);
        yield "</dt>
                                        <dd class=\"col-sm-8\">
                                            ";
        // line 86
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "due_at", [], "any", false, false, false, 86))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 87
            yield "                                                ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "due_at", [], "any", false, false, false, 87)), "html", null, true);
            yield "
                                            ";
        } else {
            // line 89
            yield "                                                -----
                                            ";
        }
        // line 91
        yield "                                        </dd>
                                        <dt class=\"col-sm-4 text-muted\">";
        // line 92
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Status"), "html", null, true);
        yield "</dt>
                                        <dd class=\"col-sm-8\">
                                        <span class=\"badge fs-7 ";
        // line 94
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 94) == "paid")) {
            yield " bg-success";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 94) == "unpaid")) {
            yield "bg-warning";
        }
        yield "\">
                                            ";
        // line 95
        yield $macros["mf"]->getTemplateForMacro("macro_status_name", $context, 95, $this->getSourceContext())->macro_status_name(...[CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "status", [], "any", false, false, false, 95)]);
        yield "
                                        </span>
                                        </dd>
                                    </dl>
                                </div>
                            </div>

                            <div class=\"col-md-6 mb-4\">
                                <div class=\"well small\">
                                    <h5>";
        // line 104
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company"), "html", null, true);
        yield "</h5>
                                        <dl class=\"row\">
                                            ";
        // line 106
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "company", [], "any", false, false, false, 106))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 107
            yield "                                                <dt class=\"col-sm-3 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Name"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-9\">";
            // line 108
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "company", [], "any", false, false, false, 108), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 110
        yield "
                                            ";
        // line 111
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "company_vat", [], "any", false, false, false, 111))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 112
            yield "                                                <dt class=\"col-sm-3 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("VAT"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-9\">";
            // line 113
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "company_vat", [], "any", false, false, false, 113), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 115
        yield "
                                            ";
        // line 116
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "address", [], "any", false, false, false, 116))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 117
            yield "                                                <dt class=\"col-sm-3 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-9\">";
            // line 118
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "address", [], "any", false, false, false, 118), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 120
        yield "
                                            ";
        // line 121
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "phone", [], "any", false, false, false, 121))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 122
            yield "                                                <dt class=\"col-sm-3 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-9\">";
            // line 123
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "phone", [], "any", false, false, false, 123), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 125
        yield "
                                            ";
        // line 126
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "email", [], "any", false, false, false, 126))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 127
            yield "                                                <dt class=\"col-sm-3 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-9\">";
            // line 128
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "email", [], "any", false, false, false, 128), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 130
        yield "
                                            ";
        // line 131
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "account_number", [], "any", false, false, false, 131))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 132
            yield "                                                <dt class=\"col-sm-3 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Account"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-9\">";
            // line 133
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "account_number", [], "any", false, false, false, 133), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 135
        yield "
                                            ";
        // line 136
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "note", [], "any", false, false, false, 136))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 137
            yield "                                                <dt class=\"col-sm-3 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Note"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-9\">";
            // line 138
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["seller"] ?? null), "note", [], "any", false, false, false, 138), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 140
        yield "                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"col-md-6\">
                                    <div class=\"well small\">
                                        <h5>";
        // line 148
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Client"), "html", null, true);
        yield "</h5>
                                        <dl class=\"row\">
                                            ";
        // line 150
        if ((Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "first_name", [], "any", false, false, false, 150)) || Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "last_name", [], "any", false, false, false, 150)))) {
            // line 151
            yield "                                                <dt class=\"col-sm-4 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Name"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-8\">";
            // line 152
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "first_name", [], "any", false, false, false, 152), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "last_name", [], "any", false, false, false, 152), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 154
        yield "
                                            ";
        // line 155
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "company", [], "any", false, false, false, 155))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 156
            yield "                                                <dt class=\"col-sm-4 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-8\">";
            // line 157
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "company", [], "any", false, false, false, 157), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 159
        yield "
                                            ";
        // line 160
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "company_number", [], "any", false, false, false, 160))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 161
            yield "                                                <dt class=\"col-sm-4 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company number"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-8\">";
            // line 162
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "company_number", [], "any", false, false, false, 162), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 164
        yield "
                                            ";
        // line 165
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "company_vat", [], "any", false, false, false, 165))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 166
            yield "                                                <dt class=\"col-sm-4 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Company VAT"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-8\">";
            // line 167
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "company_vat", [], "any", false, false, false, 167), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 169
        yield "
                                            ";
        // line 170
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "address", [], "any", false, false, false, 170))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 171
            yield "                                                <dt class=\"col-sm-4 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Address"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-8\">";
            // line 172
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "address", [], "any", false, false, false, 172), "html", null, true);
            yield "</dd>
                                                <dd class=\"col-sm-4\">";
            // line 173
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "city", [], "any", false, false, false, 173), "html", null, true);
            yield ", ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "state", [], "any", false, false, false, 173), "html", null, true);
            yield "</dd>
                                                <dd class=\"col-sm-8\">";
            // line 174
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "zip", [], "any", false, false, false, 174), "html", null, true);
            yield ", ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v0 = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_countries", [], "any", false, false, false, 174)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "country", [], "any", false, false, false, 174)] ?? null) : null), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 176
        yield "
                                            ";
        // line 177
        if ((($tmp = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "phone", [], "any", false, false, false, 177))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 178
            yield "                                                <dt class=\"col-sm-4 text-muted\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Phone"), "html", null, true);
            yield "</dt>
                                                <dd class=\"col-sm-8\">";
            // line 179
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["buyer"] ?? null), "phone", [], "any", false, false, false, 179), "html", null, true);
            yield "</dd>
                                            ";
        }
        // line 181
        yield "                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>

                        ";
        // line 187
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "text_1", [], "any", false, false, false, 187)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 188
            yield "                            <div class=\"well mt-3\">
                                ";
            // line 189
            yield $this->extensions['Box_TwigExtensions']->twig_markdown_filter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "text_1", [], "any", false, false, false, 189));
            yield "
                            </div>
                        ";
        }
        // line 192
        yield "
                        <table class=\"table table-hover mt-3 mb-0\">
                            <thead>
                            <tr>
                                <th>";
        // line 196
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("#"), "html", null, true);
        yield "</th>
                                <th>";
        // line 197
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Title"), "html", null, true);
        yield "</th>
                                <th>";
        // line 198
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Price"), "html", null, true);
        yield "</th>
                                <th class=\"text-end\">";
        // line 199
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
        yield "</th>
                            </tr>
                            </thead>
                            <tbody>
                            ";
        // line 203
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "lines", [], "any", false, false, false, 203));
        foreach ($context['_seq'] as $context["i"] => $context["item"]) {
            // line 204
            yield "                                <tr>
                                    <td>";
            // line 205
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["i"] + 1), "html", null, true);
            yield "</td>
                                    <td>
                                        ";
            // line 207
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "order_id", [], "any", false, false, false, 207)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 208
                yield "                                            <a href=\"";
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/order/service");
                yield "/manage/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "order_id", [], "any", false, false, false, 208), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 208), "html", null, true);
                yield "</a>
                                        ";
            } else {
                // line 210
                yield "                                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 210), "html", null, true);
                yield "
                                        ";
            }
            // line 212
            yield "                                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "quantity", [], "any", false, false, false, 212) > 1)) {
                // line 213
                yield "                                            x ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "quantity", [], "any", false, false, false, 213), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "unit", [], "any", false, false, false, 213), "html", null, true);
                yield "
                                        ";
            }
            // line 215
            yield "                                    </td>
                                    <td>";
            // line 216
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "price", [], "any", false, false, false, 216), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 216));
            yield "</td>
                                    <td class=\"text-end\">";
            // line 217
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "total", [], "any", false, false, false, 217), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 217));
            yield "</td>
                                </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['i'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 220
        yield "                            </tbody>
                        </table>

                        <div class=\"row\">
                            <div class=\"col-md-4 offset-md-8\">
                                <table class=\"table table-striped\">
                                    ";
        // line 226
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "tax", [], "any", false, false, false, 226) > 0)) {
            // line 227
            yield "                                        <tr class=\"text-end\">
                                            <td>";
            // line 228
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxname", [], "any", false, false, false, 228), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "taxrate", [], "any", false, false, false, 228), "html", null, true);
            yield "%</td>
                                            <td>";
            // line 229
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "tax", [], "any", false, false, false, 229), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 229));
            yield "</td>
                                        </tr>
                                    ";
        }
        // line 232
        yield "                                    ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "discount", [], "any", false, false, false, 232) > 0)) {
            // line 233
            yield "                                        <tr class=\"text-end\">
                                            <td>";
            // line 234
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Discount"), "html", null, true);
            yield "</td>
                                            <td>";
            // line 235
            yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "discount", [], "any", false, false, false, 235), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 235));
            yield "</td>
                                        </tr>
                                    ";
        }
        // line 238
        yield "                                    <tr class=\"text-end\">
                                        <td><strong>";
        // line 239
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Total"), "html", null, true);
        yield "</strong></td>
                                        <td><strong>";
        // line 240
        yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "total", [], "any", false, false, false, 240), CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "currency", [], "any", false, false, false, 240));
        yield "</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        ";
        // line 246
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "text_2", [], "any", false, false, false, 246)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 247
            yield "                            <div class=\"well mt-3\">
                                ";
            // line 248
            yield $this->extensions['Box_TwigExtensions']->twig_markdown_filter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "text_2", [], "any", false, false, false, 248));
            yield "
                            </div>
                        ";
        }
        // line 251
        yield "                    </div>
                </div>
            </div>
        </div>

        <div class=\"modal modal-lg fade\" id=\"paymentPrompt\" tabindex=\"-1\" aria-labelledby=\"paymentPromptLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h4 class=\"modal-title\" id=\"paymentPromptLabel\"></h4>
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"";
        // line 261
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Close"), "html", null, true);
        yield "\"></button>
                    </div>
                    <div class=\"modal-body\">
                        <p id=\"bodyText\"></p>
                        <a href=\"#\" class=\"btn btn-primary\" id=\"single\">";
        // line 265
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Pay now with a one-time payment"), "html", null, true);
        yield "</a>
                        <a href=\"#\" class=\"btn btn-primary\" id=\"subscription\" hidden=\"true\">";
        // line 266
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Pay now and create a subscription"), "html", null, true);
        yield "</a>
                        <a href=\"#\" class=\"btn btn-primary\" id=\"pay-nondescript\" hidden=\"true\">";
        // line 267
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Pay now"), "html", null, true);
        yield "</a>
                    </div>
                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"modal\">";
        // line 270
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Cancel"), "html", null, true);
        yield "</button>
                    </div>
                </div>
            </div>
        </div>
";
        yield from [];
    }

    // line 276
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 277
        yield "<script>
    \$(function() {
        \$(\".hover-popover\").tooltip({
            placement: 'top'
        });
    });

    function paymentPrompt(id, supportsSubscription, title){
        invoiceHash = \"";
        // line 285
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "hash", [], "any", false, false, false, 285), "html", null, true);
        yield "\";
        backLink    = \"";
        // line 286
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("invoice/banklink");
        yield "\";
        paymentLink = new URL(backLink.concat('/', invoiceHash, '/', id));
        invoiceSubscribable = ";
        // line 288
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["invoice"] ?? null), "subscribable", [], "any", false, false, false, 288)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("true") : ("false"));
        yield ";

        ";
        // line 290
        $context["anyGatewayDoesSubscriptions"] = false;
        // line 291
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "invoice_gateways", [], "any", false, false, false, 291));
        foreach ($context['_seq'] as $context["_key"] => $context["gtw"]) {
            // line 292
            yield "            ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["gtw"], "allow_recurrent", [], "any", false, false, false, 292)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 293
                yield "                ";
                $context["anyGatewayDoesSubscriptions"] = true;
                // line 294
                yield "            ";
            }
            // line 295
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['gtw'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 296
        yield "
        canAnyGatewayDoSubs = ";
        // line 297
        yield (((($tmp = ($context["anyGatewayDoesSubscriptions"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("true") : ("false"));
        yield ";

        ";
        // line 299
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "prompt_subscription", [], "any", false, false, false, 299)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 300
            yield "            if(supportsSubscription && invoiceSubscribable){
                document.getElementById('bodyText').textContent = `";
            // line 301
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("The invoice you are paying and your chosen payment gateway both support subscription payments. What type of payment would you like to continue with?"), "html", null, true);
            yield "`;
                document.getElementById('subscription').hidden = false;
            } else if (!invoiceSubscribable) {
                document.getElementById('bodyText').textContent = `";
            // line 304
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("If you are happy with the selected payment gateway, please use the button below to continue with it."), "html", null, true);
            yield "`;
                document.getElementById('subscription').hidden = true;
            } else {
                if(canAnyGatewayDoSubs){
                    document.getElementById('bodyText').textContent = `";
            // line 308
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("If you are happy with the selected payment gateway, please use the button below to continue with it. Optionally, you may choose a different payment gateway if you wish to pay using a subscription."), "html", null, true);
            yield "`;
                } else {
                    document.getElementById('bodyText').textContent = `";
            // line 310
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("If you are happy with the selected payment gateway, please use the button below to continue with it."), "html", null, true);
            yield "`;
                }
                document.getElementById('subscription').hidden = true;
            }
        ";
        } else {
            // line 315
            yield "            document.getElementById('bodyText').textContent = `";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("If you are happy with the selected payment gateway, please use the button below to continue with it."), "html", null, true);
            yield "`;
            document.getElementById('subscription').hidden = true;
            document.getElementById('single').hidden = true;
            document.getElementById('pay-nondescript').hidden = false;
        ";
        }
        // line 320
        yield "
        document.getElementById('paymentPromptLabel').textContent = `";
        // line 321
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Pay with"), "html", null, true);
        yield "`.concat(` `, title);
        document.getElementById('subscription').href = paymentLink;
        document.getElementById('pay-nondescript').href = paymentLink;
        paymentLink.searchParams.append('allow_subscription', 0); 
        document.getElementById('single').href = paymentLink;

        modal = new bootstrap.Modal('#paymentPrompt');
        modal.show();
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
        return "mod_invoice_invoice.html.twig";
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
        return array (  870 => 321,  867 => 320,  858 => 315,  850 => 310,  845 => 308,  838 => 304,  832 => 301,  829 => 300,  827 => 299,  822 => 297,  819 => 296,  813 => 295,  810 => 294,  807 => 293,  804 => 292,  799 => 291,  797 => 290,  792 => 288,  787 => 286,  783 => 285,  773 => 277,  766 => 276,  755 => 270,  749 => 267,  745 => 266,  741 => 265,  734 => 261,  722 => 251,  716 => 248,  713 => 247,  711 => 246,  702 => 240,  698 => 239,  695 => 238,  689 => 235,  685 => 234,  682 => 233,  679 => 232,  673 => 229,  667 => 228,  664 => 227,  662 => 226,  654 => 220,  645 => 217,  641 => 216,  638 => 215,  630 => 213,  627 => 212,  621 => 210,  611 => 208,  609 => 207,  604 => 205,  601 => 204,  597 => 203,  590 => 199,  586 => 198,  582 => 197,  578 => 196,  572 => 192,  566 => 189,  563 => 188,  561 => 187,  553 => 181,  548 => 179,  543 => 178,  541 => 177,  538 => 176,  531 => 174,  525 => 173,  521 => 172,  516 => 171,  514 => 170,  511 => 169,  506 => 167,  501 => 166,  499 => 165,  496 => 164,  491 => 162,  486 => 161,  484 => 160,  481 => 159,  476 => 157,  471 => 156,  469 => 155,  466 => 154,  459 => 152,  454 => 151,  452 => 150,  447 => 148,  437 => 140,  432 => 138,  427 => 137,  425 => 136,  422 => 135,  417 => 133,  412 => 132,  410 => 131,  407 => 130,  402 => 128,  397 => 127,  395 => 126,  392 => 125,  387 => 123,  382 => 122,  380 => 121,  377 => 120,  372 => 118,  367 => 117,  365 => 116,  362 => 115,  357 => 113,  352 => 112,  350 => 111,  347 => 110,  342 => 108,  337 => 107,  335 => 106,  330 => 104,  318 => 95,  310 => 94,  305 => 92,  302 => 91,  298 => 89,  292 => 87,  290 => 86,  285 => 84,  282 => 83,  276 => 81,  270 => 79,  268 => 78,  263 => 76,  256 => 74,  238 => 63,  230 => 62,  223 => 58,  219 => 57,  209 => 49,  201 => 43,  195 => 42,  189 => 39,  181 => 38,  173 => 37,  169 => 36,  163 => 35,  160 => 34,  157 => 33,  154 => 32,  150 => 31,  145 => 29,  141 => 28,  135 => 27,  131 => 26,  127 => 25,  123 => 23,  121 => 22,  117 => 20,  115 => 19,  113 => 18,  111 => 17,  104 => 16,  97 => 13,  90 => 12,  83 => 11,  72 => 9,  59 => 7,  55 => 1,  53 => 5,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_invoice_invoice.html.twig", "/var/www/html/modules/Invoice/html_client/mod_invoice_invoice.html.twig");
    }
}
