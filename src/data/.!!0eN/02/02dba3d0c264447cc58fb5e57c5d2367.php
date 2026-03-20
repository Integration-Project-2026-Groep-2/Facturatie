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

/* mobile_menu.html.twig */
class __TwigTemplate_79354b6db749f84fd0eadaa6ccabaaff extends Template
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
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "side_menu_dashboard", [], "any", false, false, false, 1)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 2
            yield "    <li class=\"nav-item\">
        <a class=\"nav-link d-flex align-items-center gap-2\" href=\"";
            // line 3
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/");
            yield "\">
            <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M19,5V7H15V5H19M9,5V11H5V5H9M19,13V19H15V13H19M9,17V19H5V17H9M21,3H13V9H21V3M11,3H3V13H11V3M21,11H13V21H21V11M11,15H3V21H11V15Z\" /></svg>
            ";
            // line 5
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Dashboard"), "html", null, true);
            yield "
        </a>
    </li>
";
        }
        // line 9
        yield "
";
        // line 10
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "side_menu_order", [], "any", false, false, false, 10)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 11
            yield "    <li class=\"nav-item\">
        <a class=\"nav-link d-flex align-items-center gap-2\" href=\"";
            // line 12
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/order");
            yield "\">
            <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M17,18A2,2 0 0,1 19,20A2,2 0 0,1 17,22C15.89,22 15,21.1 15,20C15,18.89 15.89,18 17,18M1,2H4.27L5.21,4H20A1,1 0 0,1 21,5C21,5.17 20.95,5.34 20.88,5.5L17.3,11.97C16.96,12.58 16.3,13 15.55,13H8.1L7.2,14.63L7.17,14.75A0.25,0.25 0 0,0 7.42,15H19V17H7C5.89,17 5,16.1 5,15C5,14.65 5.09,14.32 5.24,14.04L6.6,11.59L3,4H1V2M7,18A2,2 0 0,1 9,20A2,2 0 0,1 7,22C5.89,22 5,21.1 5,20C5,18.89 5.89,18 7,18M16,11L18.78,6H6.14L8.5,11H16Z\" /></svg>
            ";
            // line 14
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Order"), "html", null, true);
            yield "
        </a>
    </li>
";
        }
        // line 18
        yield "
";
        // line 19
        if ((($context["client"] ?? null) ||  !CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "hide_menu", [], "any", false, false, false, 19))) {
            // line 20
            yield "
";
            // line 21
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "side_menu_support", [], "any", false, false, false, 21)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 22
                yield "    <li class=\"nav-item\">
        <a class=\"nav-link d-flex align-items-center gap-2\" href=\"";
                // line 23
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/support");
                yield "\">
            <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M19.79,15.41C20.74,13.24 20.74,10.75 19.79,8.59L17.05,9.83C17.65,11.21 17.65,12.78 17.06,14.17L19.79,15.41M15.42,4.21C13.25,3.26 10.76,3.26 8.59,4.21L9.83,6.94C11.22,6.35 12.79,6.35 14.18,6.95L15.42,4.21M4.21,8.58C3.26,10.76 3.26,13.24 4.21,15.42L6.95,14.17C6.35,12.79 6.35,11.21 6.95,9.82L4.21,8.58M8.59,19.79C10.76,20.74 13.25,20.74 15.42,19.78L14.18,17.05C12.8,17.65 11.22,17.65 9.84,17.06L8.59,19.79M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z\" /></svg>
            ";
                // line 25
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Support"), "html", null, true);
                yield "
        </a>
    </li>
";
            }
            // line 29
            yield "
";
            // line 30
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "side_menu_services", [], "any", false, false, false, 30)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 31
                yield "    <li class=\"nav-item\">
        <a class=\"nav-link d-flex align-items-center gap-2\" href=\"";
                // line 32
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/order/service");
                yield "\">
            <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M16.7 4.5L19.5 7.3L16.7 10.1L13.9 7.3L16.7 4.5M9 5V9H5V5H9M19 15V19H15V15H19M16.7 1.7L11 7.3L16.7 13H13V21H21V13H16.7L22.3 7.3L16.7 1.7M11 3H3V11H11V3M9 15V19H5V15H9M11 13H3V21H11V13Z\" /></svg>
            ";
                // line 34
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Services"), "html", null, true);
                yield "
        </a>
    </li>
";
            }
            // line 38
            yield "
";
            // line 39
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "side_menu_invoices", [], "any", false, false, false, 39)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 40
                yield "    <li class=\"nav-item\">
        <a class=\"nav-link d-flex align-items-center gap-2\" href=\"";
                // line 41
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/invoice");
                yield "\">
            <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M19.5 3.5L18 2L16.5 3.5L15 2L13.5 3.5L12 2L10.5 3.5L9 2L7.5 3.5L6 2L4.5 3.5L3 2V22L4.5 20.5L6 22L7.5 20.5L9 22L10.5 20.5L12 22L13.5 20.5L15 22L16.5 20.5L18 22L19.5 20.5L21 22V2L19.5 3.5M19 19H5V5H19V19M6 15H18V17H6M6 11H18V13H6M6 7H18V9H6V7Z\" /></svg>
            ";
                // line 43
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Invoices"), "html", null, true);
                yield "
        </a>
    </li>
";
            }
            // line 47
            yield "
";
            // line 48
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "side_menu_emails", [], "any", false, false, false, 48)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 49
                yield "    <li class=\"nav-item\">
        <a class=\"nav-link d-flex align-items-center gap-2\" href=\"";
                // line 50
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/email");
                yield "\">
            <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M21.03 6.29L12 .64L2.97 6.29C2.39 6.64 2 7.27 2 8V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V8C22 7.27 21.61 6.64 21.03 6.29M20 18H4V10L12 15L20 10V18M12 13L4 8L12 3L20 8L12 13Z\" /></svg>
            ";
                // line 52
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Email"), "html", null, true);
                yield "
        </a>
    </li>
";
            }
            // line 56
            yield "
";
            // line 57
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "side_menu_payments", [], "any", false, false, false, 57)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 58
                yield "    <li class=\"nav-item\">
        <a class=\"nav-link d-flex align-items-center gap-2\" href=\"";
                // line 59
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/client/balance");
                yield "\">
            <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M15.5 15.5C16.33 15.5 17 14.83 17 14C17 13.17 16.33 12.5 15.5 12.5C14.67 12.5 14 13.17 14 14C14 14.83 14.67 15.5 15.5 15.5M7 3H17C18.11 3 19 3.9 19 5V7C20.11 7 21 7.9 21 9V19C21 20.11 20.11 21 19 21H7C4.79 21 3 19.21 3 17V7C3 4.79 4.79 3 7 3M17 7V5H7C5.9 5 5 5.9 5 7V7.54C5.59 7.2 6.27 7 7 7H17M5 17C5 18.11 5.9 19 7 19H19V9H7C5.9 9 5 9.9 5 11V17Z\" /></svg>
            ";
                // line 61
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Wallet"), "html", null, true);
                yield "
        </a>
    </li>
";
            }
            // line 65
            yield "
";
            // line 66
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "extension_is_on", [["mod" => "news"]], "method", false, false, false, 66) && CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "side_menu_news", [], "any", false, false, false, 66))) {
                // line 67
                yield "    <li class=\"nav-item\">
        <a class=\"nav-link d-flex align-items-center gap-2\" href=\"";
                // line 68
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/news");
                yield "\">
            <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M20 5L20 19L4 19L4 5H20M20 3H4C2.89 3 2 3.89 2 5V19C2 20.11 2.89 21 4 21H20C21.11 21 22 20.11 22 19V5C22 3.89 21.11 3 20 3M18 15H6V17H18V15M10 7H6V13H10V7M12 9H18V7H12V9M18 11H12V13H18V11Z\" /></svg>
            ";
                // line 70
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("News"), "html", null, true);
                yield "
        </a>
    </li>
";
            }
            // line 74
            yield "
";
            // line 75
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "support_kb_enabled", [], "method", false, false, false, 75) && CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "side_menu_kb", [], "any", false, false, false, 75))) {
                // line 76
                yield "    <li class=\"nav-item\">
        <a class=\"nav-link d-flex align-items-center gap-2\" href=\"";
                // line 77
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("support/kb");
                yield "\">
            <svg class=\"svg-icon\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M19 1L14 6V17L19 12.5V1M21 5V18.5C19.9 18.15 18.7 18 17.5 18C15.8 18 13.35 18.65 12 19.5V6C10.55 4.9 8.45 4.5 6.5 4.5C4.55 4.5 2.45 4.9 1 6V20.65C1 20.9 1.25 21.15 1.5 21.15C1.6 21.15 1.65 21.1 1.75 21.1C3.1 20.45 5.05 20 6.5 20C8.45 20 10.55 20.4 12 21.5C13.35 20.65 15.8 20 17.5 20C19.15 20 20.85 20.3 22.25 21.05C22.35 21.1 22.4 21.1 22.5 21.1C22.75 21.1 23 20.85 23 20.6V6C22.4 5.55 21.75 5.25 21 5M10 18.41C8.75 18.09 7.5 18 6.5 18C5.44 18 4.18 18.19 3 18.5V7.13C3.91 6.73 5.14 6.5 6.5 6.5C7.86 6.5 9.09 6.73 10 7.13V18.41Z\" /></svg>
            ";
                // line 79
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Knowledge Base"), "html", null, true);
                yield "
        </a>
    </li>
";
            }
            // line 83
            yield "
";
            // line 84
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "sidebar_balance_enabled", [], "any", false, false, false, 84) && ($context["client"] ?? null))) {
                // line 85
                yield "    <li class=\"pt-3 ps-3\">
        <h5 class=\"text-secondary d-block pb-1\">";
                // line 86
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Account balance"), "html", null, true);
                yield "</h5>
        <h4><strong>";
                // line 87
                yield $this->extensions['Box_TwigExtensions']->twig_money($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "balance", [], "any", false, false, false, 87), CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "currency", [], "any", false, false, false, 87));
                yield "</strong></h4>
    </li>
";
            }
            // line 90
            yield "
";
            // line 91
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "sidebar_note_enabled", [], "any", false, false, false, 91)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 92
                yield "    <li class=\"pt-3 ps-3\">
        <h5 class=\"text-secondary d-block pb-1\">";
                // line 93
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "sidebar_note_title", [], "any", false, false, false, 93), "html", null, true);
                yield "</h5>
        <span>";
                // line 94
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "sidebar_note_content", [], "any", false, false, false, 94), "html", null, true);
                yield "</span>
    </li>
";
            }
            // line 97
            yield "
";
        }
        // line 99
        yield "
";
        // line 100
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "top_menu_signout", [], "any", false, false, false, 100)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 101
            yield "    <li class=\"nav-item\">
        ";
            // line 102
            if ((($tmp = ($context["client"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 103
                yield "            <div class=\"dropdown\">
                <button class=\"btn dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                    <img class=\"img-fluid rounded-circle\" alt=\"";
                // line 105
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "first_name", [], "any", false, false, false, 105), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "last_name", [], "any", false, false, false, 105), "html", null, true);
                yield " gravatar\" src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_gravatar_filter(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "email", [], "any", false, false, false, 105), 60), "html", null, true);
                yield "\" height=\"25px\" width=\"25px\">
                    ";
                // line 106
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "company", [], "any", false, false, false, 106)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 107
                    yield "                        <span>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "first_name", [], "any", false, false, false, 107), "html", null, true);
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "last_name", [], "any", false, false, false, 107), "html", null, true);
                    yield "|";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "company", [], "any", false, false, false, 107), "html", null, true);
                    yield "</span>
                    ";
                } else {
                    // line 109
                    yield "                        <span>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "first_name", [], "any", false, false, false, 109), "html", null, true);
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "last_name", [], "any", false, false, false, 109), "html", null, true);
                    yield "</span>
                    ";
                }
                // line 111
                yield "                </button>
                <ul class=\"dropdown-menu\">
                    <li><a class=\"dropdown-item\"
                           href=\"";
                // line 114
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("client/profile");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Profile"), "html", null, true);
                yield "</a></li>
                    <li><a class=\"dropdown-item\"
                           href=\"";
                // line 116
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("client/logout");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Sign out"), "html", null, true);
                yield "</a></li>
                </ul>
            </div>
        ";
            } else {
                // line 120
                yield "            <div class=\"row pt-2\">
                <div class=\"col\">
                    <a class=\"btn btn-outline-primary mb-2 w-100\"
                       href=\"";
                // line 123
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("login");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Login"), "html", null, true);
                yield "</a>
                </div>
                <div class=\"col\">
                    <a class=\"btn btn-outline-primary mb-2 w-100\"
                       href=\"";
                // line 127
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("signup");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Register"), "html", null, true);
                yield "</a>
                </div>
            </div>
        ";
            }
            // line 131
            yield "    </li>
";
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "mobile_menu.html.twig";
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
        return array (  350 => 131,  341 => 127,  332 => 123,  327 => 120,  318 => 116,  311 => 114,  306 => 111,  298 => 109,  288 => 107,  286 => 106,  278 => 105,  274 => 103,  272 => 102,  269 => 101,  267 => 100,  264 => 99,  260 => 97,  254 => 94,  250 => 93,  247 => 92,  245 => 91,  242 => 90,  236 => 87,  232 => 86,  229 => 85,  227 => 84,  224 => 83,  217 => 79,  212 => 77,  209 => 76,  207 => 75,  204 => 74,  197 => 70,  192 => 68,  189 => 67,  187 => 66,  184 => 65,  177 => 61,  172 => 59,  169 => 58,  167 => 57,  164 => 56,  157 => 52,  152 => 50,  149 => 49,  147 => 48,  144 => 47,  137 => 43,  132 => 41,  129 => 40,  127 => 39,  124 => 38,  117 => 34,  112 => 32,  109 => 31,  107 => 30,  104 => 29,  97 => 25,  92 => 23,  89 => 22,  87 => 21,  84 => 20,  82 => 19,  79 => 18,  72 => 14,  67 => 12,  64 => 11,  62 => 10,  59 => 9,  52 => 5,  47 => 3,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mobile_menu.html.twig", "/var/www/html/themes/huraga/html/mobile_menu.html.twig");
    }
}
