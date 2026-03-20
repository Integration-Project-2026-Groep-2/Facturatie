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

/* layout_default.html.twig */
class __TwigTemplate_d4d30410225ea37d1123e661e71b005c extends Template
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
            'meta_title' => [$this, 'block_meta_title'],
            'meta_description' => [$this, 'block_meta_description'],
            'opengraph' => [$this, 'block_opengraph'],
            'head' => [$this, 'block_head'],
            'js' => [$this, 'block_js'],
            'body_class' => [$this, 'block_body_class'],
            'body' => [$this, 'block_body'],
            'content_before' => [$this, 'block_content_before'],
            'breadcrumbs' => [$this, 'block_breadcrumbs'],
            'breadcrumb' => [$this, 'block_breadcrumb'],
            'content' => [$this, 'block_content'],
            'content_after' => [$this, 'block_content_after'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" data-bs-theme=\"";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "theme", [], "any", true, true, false, 2)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "theme", [], "any", false, false, false, 2), "light")) : ("light")), "html", null, true);
        yield "\">
<head>
    <meta charset=\"utf-8\">
   <title>";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_title_prefix", [], "any", false, false, false, 5), "html", null, true);
        yield " ";
        yield from $this->unwrap()->yieldBlock('meta_title', $context, $blocks);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_title_suffix", [], "any", false, false, false, 5), "html", null, true);
        yield "</title>

    <meta property=\"bb:url\" content=\"";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::constant("SYSTEM_URL"), "html", null, true);
        yield "\">
    <meta property=\"bb:client_area\" content=\"";
        // line 8
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/");
        yield "\">
    <meta name=\"csrf-token\" content=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\">

    <meta name=\"description\" content=\"";
        // line 11
        yield from $this->unwrap()->yieldBlock('meta_description', $context, $blocks);
        yield "\">
    <meta name=\"keywords\" content=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_keywords", [], "any", false, false, false, 12), "html", null, true);
        yield "\">
    <meta name=\"robots\" content=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_robots", [], "any", false, false, false, 13), "html", null, true);
        yield "\">
    <meta name=\"author\" content=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_author", [], "any", false, false, false, 14), "html", null, true);
        yield "\">
    <meta name=\"generator\" content=\"FOSSBilling\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">

    ";
        // line 18
        yield from $this->unwrap()->yieldBlock('opengraph', $context, $blocks);
        // line 19
        yield "    <link rel='stylesheet' type='text/css' href=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_asset_url($this->env, "css/font-awesome.css");
        yield "\">
    ";
        // line 20
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("huraga");
        yield "
    <link rel=\"shortcut icon\" href=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 21), "favicon_url", [], "any", false, false, false, 21), "html", null, true);
        yield "\">

    ";
        // line 23
        yield $this->extensions['Box_TwigExtensions']->twig_script_tag($this->extensions['Box_TwigExtensions']->twig_library_url("Api/API.js"));
        yield "
    ";
        // line 24
        yield $this->env->getFunction('encore_entry_script_tags')->getCallable()("huraga");
        yield "

    ";
        // line 26
        yield $this->extensions['FOSSBilling\TwigExtensions\DebugBar']->renderHead();
        yield "

    ";
        // line 28
        yield from $this->unwrap()->yieldBlock('head', $context, $blocks);
        // line 29
        yield "    ";
        yield from $this->unwrap()->yieldBlock('js', $context, $blocks);
        // line 30
        yield "</head>

<body class=\"";
        // line 32
        yield from $this->unwrap()->yieldBlock('body_class', $context, $blocks);
        yield "\">

";
        // line 34
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 266
        yield "
    ";
        // line 267
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "inject_javascript", [], "any", false, false, false, 267)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 268
            yield "        ";
            yield CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "inject_javascript", [], "any", false, false, false, 268);
            yield "
    ";
        }
        // line 270
        yield "    ";
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_pending_messages.html.twig", [], true, true);
        yield "
    ";
        // line 271
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "extension_is_on", [["mod" => "cookieconsent"]], "method", false, false, false, 271)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 272
            yield "        ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "mod_cookieconsent_index.html.twig", [], true, true);
            yield "
    ";
        }
        // line 274
        yield "</div>
";
        // line 275
        yield $this->extensions['FOSSBilling\TwigExtensions\DebugBar']->render();
        yield "
</body>
</html>
";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 11
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_meta_description(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "meta_description", [], "any", false, false, false, 11), "html", null, true);
        yield from [];
    }

    // line 18
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_opengraph(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 28
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 29
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 32
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 34
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 35
        if (( !($context["client"] ?? null) && CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "require_login", [], "any", false, false, false, 35))) {
            // line 36
            yield "    <script>
        document.addEventListener(\"DOMContentLoaded\", function () {
            const publicPaths = [
                '/news',
                '/tos',
                '/privacy-policy'
            ];
            const currentPath = window.location.pathname;

            const isAllowed = publicPaths.some(path => currentPath.startsWith(path));
            if (!isAllowed) {
                window.location.href = '";
            // line 47
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("login");
            yield "';
            }
        });
    </script>
";
        }
        // line 52
        yield "
";
        // line 53
        if ((($tmp = ($context["client"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 54
            yield "    ";
            $context["profile"] = CoreExtension::getAttribute($this->env, $this->source, ($context["client"] ?? null), "profile_get", [], "any", false, false, false, 54);
        }
        // line 56
        $context["company"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "system_company", [], "any", false, false, false, 56);
        // line 57
        yield "
";
        // line 58
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "theme", [], "any", false, false, false, 58) == "dark")) {
            // line 59
            yield "    ";
            $context["logo_url"] = CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "logo_url_dark", [], "any", false, false, false, 59);
        } else {
            // line 61
            yield "    ";
            $context["logo_url"] = CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "logo_url", [], "any", false, false, false, 61);
        }
        // line 63
        yield "<div class=\"container\">
    <header>
        <nav class=\"navbar navbar-expand-md py-4\">
            <div class=\"container-fluid\">
                ";
        // line 67
        if ((($context["logo_url"] ?? null) && CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "show_company_logo", [], "any", false, false, false, 67))) {
            // line 68
            yield "                    <a class=\"navbar-brand\" href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/");
            yield "\">
                        <img class=\"d-none d-sm-block\" src=\"";
            // line 69
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["logo_url"] ?? null), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "name", [], "any", false, false, false, 69), "html", null, true);
            yield "\" height=\"45px\"
                             title=\"";
            // line 70
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "name", [], "any", false, false, false, 70), "html", null, true);
            yield "\">
                        <span class=\"d-sm-none\">";
            // line 71
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "name", [], "any", false, false, false, 71), "html", null, true);
            yield "</span>
                    </a>
                ";
        } else {
            // line 74
            yield "                    <a class=\"navbar-brand\" href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/");
            yield "\">
                        <span>";
            // line 75
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "name", [], "any", false, false, false, 75), "html", null, true);
            yield "</span>
                    </a>
                ";
        }
        // line 78
        yield "                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\"
                        data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\"
                        aria-expanded=\"false\" aria-label=\"";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Toggle navigation"), "html", null, true);
        yield "\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
                <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
                    <div class=\"navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-end\">


                        ";
        // line 87
        $context["languages"] = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "extension_languages", [true], "method", false, false, false, 87);
        // line 88
        yield "                        ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["languages"] ?? null)) > 1)) {
            // line 89
            yield "                            <li class=\"nav-item\">
                                <select name=\"lang\" class=\"form-select js-language-selector\">
                                    ";
            // line 91
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["lang"]) {
                // line 92
                yield "                                        <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["lang"], "locale", [], "any", false, false, false, 92), "html", null, true);
                yield "\" data-custom-properties=\"&lt;span class=&quot;fi fi-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), (($_v0 = Twig\Extension\CoreExtension::split($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["lang"], "locale", [], "any", false, false, false, 92), "_")) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[1] ?? null) : null)), "html", null, true);
                yield "&quot;&gt;&lt;/span&gt;\">&nbsp;";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["lang"], "title", [], "any", false, false, false, 92), "html", null, true);
                yield "</option>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['lang'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 94
            yield "                                </select>
                            </li>
                        ";
        }
        // line 97
        yield "
                        ";
        // line 98
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "top_menu_dashboard", [], "any", false, false, false, 98)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 99
            yield "                            <li class=\"nav-item d-none d-md-block\">
                                <a class=\"nav-link\" href=\"";
            // line 100
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("");
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Dashboard"), "html", null, true);
            yield "</a>
                            </li>
                        ";
        }
        // line 103
        yield "
                        ";
        // line 104
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "top_menu_order", [], "any", false, false, false, 104)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 105
            yield "                            <li class=\"nav-item d-none d-md-block\">
                                <a class=\"nav-link\" href=\"";
            // line 106
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/order");
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Order"), "html", null, true);
            yield "</a>
                            </li>
                        ";
        }
        // line 109
        yield "
                        ";
        // line 110
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "top_menu_profile", [], "any", false, false, false, 110)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 111
            yield "                            <li class=\"nav-item d-none d-md-block\">
                                ";
            // line 112
            if ((($tmp =  !($context["client"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 113
                yield "                                    <a class=\"nav-link\" href=\"";
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("login");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Login"), "html", null, true);
                yield "</a>
                                ";
            }
            // line 115
            yield "                            </li>
                        ";
        }
        // line 117
        yield "
                        ";
        // line 118
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "top_menu_signout", [], "any", false, false, false, 118)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 119
            yield "                            <li class=\"nav-item d-none d-md-block\">
                                ";
            // line 120
            if ((($tmp = ($context["client"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 121
                yield "                                    <div class=\"dropdown\">
                                        <button class=\"btn dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                            <img class=\"img-fluid rounded-circle\" alt=\"";
                // line 123
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "first_name", [], "any", false, false, false, 123), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "last_name", [], "any", false, false, false, 123), "html", null, true);
                yield " gravatar\" src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Box_TwigExtensions']->twig_gravatar_filter(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "email", [], "any", false, false, false, 123), 60), "html", null, true);
                yield "\" height=\"25px\" width=\"25px\">
                                            ";
                // line 124
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "company", [], "any", false, false, false, 124)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 125
                    yield "                                                <span>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "first_name", [], "any", false, false, false, 125), "html", null, true);
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "last_name", [], "any", false, false, false, 125), "html", null, true);
                    yield " (";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "company", [], "any", false, false, false, 125), "html", null, true);
                    yield ")</span>
                                            ";
                } else {
                    // line 127
                    yield "                                                <span>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "first_name", [], "any", false, false, false, 127), "html", null, true);
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["profile"] ?? null), "last_name", [], "any", false, false, false, 127), "html", null, true);
                    yield "</span>
                                            ";
                }
                // line 129
                yield "                                        </button>
                                        <ul class=\"dropdown-menu\">
                                            <li><a class=\"dropdown-item\"
                                                   href=\"";
                // line 132
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("client/profile");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Profile"), "html", null, true);
                yield "</a></li>
                                            <li><a class=\"dropdown-item\"
                                                   href=\"";
                // line 134
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("client/logout");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Sign out"), "html", null, true);
                yield "</a></li>
                                        </ul>
                                    </div>
                                ";
            } else {
                // line 138
                yield "                                    <a class=\"ms-2 btn btn-outline-primary d-none d-md-block\"
                                       href=\"";
                // line 139
                yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("signup");
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Register"), "html", null, true);
                yield "</a>
                                ";
            }
            // line 141
            yield "                            </li>
                        ";
        }
        // line 143
        yield "
                        <div class=\"d-md-none\">
                            ";
        // line 145
        yield Twig\Extension\CoreExtension::include($this->env, $context, "mobile_menu.html.twig");
        yield "
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class=\"container\">
        <div class=\"row\">
        ";
        // line 154
        if ((($context["client"] ?? null) ||  !CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "hide_menu", [], "any", false, false, false, 154))) {
            // line 155
            yield "            <div class=\"col-3 d-none d-md-block\">
                ";
            // line 156
            yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_menu.html.twig");
            yield "
            </div>
        ";
        }
        // line 159
        yield "            <div class=\"col-12 col-md-9\" ";
        if (( !($context["client"] ?? null) && CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "hide_menu", [], "any", false, false, false, 159))) {
            yield " style=\"margin-left: auto; margin-right: auto;\" ";
        }
        yield ">
                <div id=\"wrapper\">
                    <section role=\"main\">
                        ";
        // line 162
        yield from $this->unwrap()->yieldBlock('content_before', $context, $blocks);
        // line 163
        yield "                        <div class=\"content-block\" role=\"main\">
                            ";
        // line 164
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "show_breadcrumb", [], "any", false, false, false, 164)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 165
            yield "                                ";
            yield from $this->unwrap()->yieldBlock('breadcrumbs', $context, $blocks);
            // line 176
            yield "                            ";
        }
        // line 177
        yield "
                            ";
        // line 178
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 179
        yield "
                            ";
        // line 180
        yield Twig\Extension\CoreExtension::include($this->env, $context, "partial_message.html.twig");
        yield "

                            ";
        // line 182
        yield from $this->unwrap()->yieldBlock('content_after', $context, $blocks);
        // line 183
        yield "                        </div>
                    </section>
                    <div id=\"push\"></div>
                </div>

                ";
        // line 188
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_enabled", [], "any", false, false, false, 188)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 189
            yield "                    <footer id=\"footer\" class=\"small text-muted mt-2 mb-3\">
                        <div class=\"d-flex flex-column\">
                            <div class=\"d-flex justify-content-center\">
                                <span>&copy; ";
            // line 192
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDate($this->env, ($context["now"] ?? null), "medium", "yyyy"), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_signature", [], "any", true, true, false, 192)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_signature", [], "any", false, false, false, 192), CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "signature", [], "any", false, false, false, 192))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "signature", [], "any", false, false, false, 192))), "html", null, true);
            yield "
                                    ";
            // line 193
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "bank_info_pagebottom", [], "any", false, false, false, 193) == 1)) {
                // line 194
                yield "                                        <br/>
                                        <b>";
                // line 195
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Payment Information"), "html", null, true);
                yield "</b> - ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Bank Name"), "html", null, true);
                yield ": ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "bank_name", [], "any", false, false, false, 195), "html", null, true);
                yield " | ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("BIC / SWIFT Code"), "html", null, true);
                yield ": ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "bic", [], "any", false, false, false, 195), "html", null, true);
                yield " | ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Account Number"), "html", null, true);
                yield ": ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["company"] ?? null), "account_number", [], "any", false, false, false, 195), "html", null, true);
                yield "
                                    ";
            }
            // line 197
            yield "                                </span>
                            </div>
                            <div class=\"d-flex justify-content-center\">
                                ";
            // line 200
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_1_enabled", [], "any", false, false, false, 200)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 201
                yield "                                    ";
                if ((CoreExtension::inFilter("http://", CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_1_page", [], "any", false, false, false, 201)) || CoreExtension::inFilter("https://", CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_1_page", [], "any", false, false, false, 201)))) {
                    // line 202
                    yield "                                        <a class=\"link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover\"
                                           href=\"";
                    // line 203
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_1_page", [], "any", false, false, false, 203), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_1_title", [], "any", false, false, false, 203), "html", null, true);
                    yield "</a>
                                    ";
                } else {
                    // line 205
                    yield "                                        <a class=\"link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover\"
                                           href=\"";
                    // line 206
                    yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_1_page", [], "any", false, false, false, 206));
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_1_title", [], "any", false, false, false, 206), "html", null, true);
                    yield "</a>
                                    ";
                }
                // line 208
                yield "                                ";
            }
            // line 209
            yield "                                ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_2_enabled", [], "any", false, false, false, 209)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 210
                yield "                                    &nbsp;&#x2022;&nbsp;
                                    ";
                // line 211
                if ((CoreExtension::inFilter("http://", CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_2_page", [], "any", false, false, false, 211)) || CoreExtension::inFilter("https://", CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_2_page", [], "any", false, false, false, 211)))) {
                    // line 212
                    yield "                                        <a class=\"link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover\"
                                           href=\"";
                    // line 213
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_2_page", [], "any", false, false, false, 213), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_2_title", [], "any", false, false, false, 213), "html", null, true);
                    yield "</a>
                                    ";
                } else {
                    // line 215
                    yield "                                        <a class=\"link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover\"
                                           href=\"";
                    // line 216
                    yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_2_page", [], "any", false, false, false, 216));
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_2_title", [], "any", false, false, false, 216), "html", null, true);
                    yield "</a>
                                    ";
                }
                // line 218
                yield "                                ";
            }
            // line 219
            yield "                                ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_3_enabled", [], "any", false, false, false, 219)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 220
                yield "                                    &nbsp;&#x2022;&nbsp;
                                    ";
                // line 221
                if ((CoreExtension::inFilter("http://", CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_3_page", [], "any", false, false, false, 221)) || CoreExtension::inFilter("https://", CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_3_page", [], "any", false, false, false, 221)))) {
                    // line 222
                    yield "                                        <a class=\"link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover\"
                                           href=\"";
                    // line 223
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_3_page", [], "any", false, false, false, 223), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_3_title", [], "any", false, false, false, 223), "html", null, true);
                    yield "</a>
                                    ";
                } else {
                    // line 225
                    yield "                                        <a class=\"link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover\"
                                           href=\"";
                    // line 226
                    yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_3_page", [], "any", false, false, false, 226));
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_3_title", [], "any", false, false, false, 226), "html", null, true);
                    yield "</a>
                                    ";
                }
                // line 228
                yield "                                ";
            }
            // line 229
            yield "                                ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_4_enabled", [], "any", false, false, false, 229)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 230
                yield "                                    &nbsp;&#x2022;&nbsp;
                                    ";
                // line 231
                if ((CoreExtension::inFilter("http://", CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_4_page", [], "any", false, false, false, 231)) || CoreExtension::inFilter("https://", CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_4_page", [], "any", false, false, false, 231)))) {
                    // line 232
                    yield "                                        <a class=\"link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover\"
                                           href=\"";
                    // line 233
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_4_page", [], "any", false, false, false, 233), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_4_title", [], "any", false, false, false, 233), "html", null, true);
                    yield "</a>
                                    ";
                } else {
                    // line 235
                    yield "                                        <a class=\"link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover\"
                                           href=\"";
                    // line 236
                    yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_4_page", [], "any", false, false, false, 236));
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_link_4_title", [], "any", false, false, false, 236), "html", null, true);
                    yield "</a>
                                    ";
                }
                // line 238
                yield "                                ";
            }
            // line 239
            yield "                            </div>
                            ";
            // line 240
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["guest"] ?? null), "extension_is_on", [["mod" => "branding"]], "method", false, false, false, 240)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 241
                yield "                                <div class=\"d-flex justify-content-center\">
                                    <span>";
                // line 242
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Powered by the"), "html", null, true);
                yield "&nbsp;</span>
                                    <a class=\"link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover\"
                                        href=\"https://fossbilling.org\" title=\"Billing Software\"
                                       target=\"_blank\">";
                // line 245
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("FOSSBilling Community"), "html", null, true);
                yield "</a>
                                </div>
                            ";
            }
            // line 248
            yield "                        </div>
                    </footer>
                ";
        }
        // line 251
        yield "            </div>
        </div>
    </div>
    <div class=\"toast-container position-fixed bottom-0 end-0 p-3\" style=\"z-index: 1070;\"></div>
    ";
        // line 255
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "footer_to_top_enabled", [], "any", false, false, false, 255)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 256
            yield "        <a href=\"#top\" class=\"position-fixed btn btn-primary bottom-0 end-0 m-3\">
            <span class=\"awe-arrow-up\"></span> ";
            // line 257
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Top"), "html", null, true);
            yield "</a>
    ";
        }
        // line 259
        yield "    <div class=\"wait\" style=\"display:none\" onclick=\"\$(this).hide();\">
        <div class=\"spinner-border\"
             style=\"width: 4rem; height: 4rem; top: 50%; left: 50%; position: fixed; z-index: 999\"></div>
    </div>
    <noscript>";
        // line 263
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("NOTE: Many features on FOSSBilling require Javascript and cookies. You can enable both in your browser's preference settings."), "html", null, true);
        yield "</noscript>

    ";
        yield from [];
    }

    // line 162
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_before(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 165
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumbs(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 166
        yield "                                    <nav aria-label=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("breadcrumb"), "html", null, true);
        yield "\">
                                        <ol class=\"breadcrumb d-none d-md-flex\">
                                            <li class=\"breadcrumb-item\"><a href=\"";
        // line 168
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("/");
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Home"), "html", null, true);
        yield "</a>
                                            </li>
                                            ";
        // line 170
        yield from $this->unwrap()->yieldBlock('breadcrumb', $context, $blocks);
        // line 173
        yield "                                        </ol>
                                    </nav>
                                ";
        yield from [];
    }

    // line 170
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumb(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 171
        yield "                                                <li class=\"active breadcrumb-item\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Dashboard"), "html", null, true);
        yield "</li>
                                            ";
        yield from [];
    }

    // line 178
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 182
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content_after(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layout_default.html.twig";
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
        return array (  868 => 182,  858 => 178,  850 => 171,  843 => 170,  836 => 173,  834 => 170,  827 => 168,  821 => 166,  814 => 165,  804 => 162,  796 => 263,  790 => 259,  785 => 257,  782 => 256,  780 => 255,  774 => 251,  769 => 248,  763 => 245,  757 => 242,  754 => 241,  752 => 240,  749 => 239,  746 => 238,  739 => 236,  736 => 235,  729 => 233,  726 => 232,  724 => 231,  721 => 230,  718 => 229,  715 => 228,  708 => 226,  705 => 225,  698 => 223,  695 => 222,  693 => 221,  690 => 220,  687 => 219,  684 => 218,  677 => 216,  674 => 215,  667 => 213,  664 => 212,  662 => 211,  659 => 210,  656 => 209,  653 => 208,  646 => 206,  643 => 205,  636 => 203,  633 => 202,  630 => 201,  628 => 200,  623 => 197,  606 => 195,  603 => 194,  601 => 193,  595 => 192,  590 => 189,  588 => 188,  581 => 183,  579 => 182,  574 => 180,  571 => 179,  569 => 178,  566 => 177,  563 => 176,  560 => 165,  558 => 164,  555 => 163,  553 => 162,  544 => 159,  538 => 156,  535 => 155,  533 => 154,  521 => 145,  517 => 143,  513 => 141,  506 => 139,  503 => 138,  494 => 134,  487 => 132,  482 => 129,  474 => 127,  464 => 125,  462 => 124,  454 => 123,  450 => 121,  448 => 120,  445 => 119,  443 => 118,  440 => 117,  436 => 115,  428 => 113,  426 => 112,  423 => 111,  421 => 110,  418 => 109,  410 => 106,  407 => 105,  405 => 104,  402 => 103,  394 => 100,  391 => 99,  389 => 98,  386 => 97,  381 => 94,  368 => 92,  364 => 91,  360 => 89,  357 => 88,  355 => 87,  345 => 80,  341 => 78,  335 => 75,  330 => 74,  324 => 71,  320 => 70,  314 => 69,  309 => 68,  307 => 67,  301 => 63,  297 => 61,  293 => 59,  291 => 58,  288 => 57,  286 => 56,  282 => 54,  280 => 53,  277 => 52,  269 => 47,  256 => 36,  254 => 35,  247 => 34,  237 => 32,  227 => 29,  217 => 28,  207 => 18,  196 => 11,  186 => 5,  177 => 275,  174 => 274,  168 => 272,  166 => 271,  161 => 270,  155 => 268,  153 => 267,  150 => 266,  148 => 34,  143 => 32,  139 => 30,  136 => 29,  134 => 28,  129 => 26,  124 => 24,  120 => 23,  115 => 21,  111 => 20,  106 => 19,  104 => 18,  97 => 14,  93 => 13,  89 => 12,  85 => 11,  80 => 9,  76 => 8,  72 => 7,  63 => 5,  57 => 2,  54 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "layout_default.html.twig", "/var/www/html/themes/huraga/html/layout_default.html.twig");
    }
}
