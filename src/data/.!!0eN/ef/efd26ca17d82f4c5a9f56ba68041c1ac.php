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

/* mod_system_update.html.twig */
class __TwigTemplate_b1afb9c9a832c968853f250b91d4d7e5 extends Template
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
        return $this->load((((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["request"] ?? null), "ajax", [], "any", false, false, false, 1)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("layout_blank.html.twig") : ("layout_default.html.twig")), 1);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $macros["mf"] = $this->macros["mf"] = $this->load("macro_functions.html.twig", 3)->unwrap();
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update FOSSBilling"), "html", null, true);
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
        $context["update_info"] = CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_update_info", [], "any", false, false, false, 8);
        // line 9
        yield "    <div class=\"card\">
        <div class=\"card-header\">
            <h1 class=\"card-title\">";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update FOSSBilling"), "html", null, true);
        yield "</h1>
        </div>
        <div class=\"card-body\">
            ";
        // line 14
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_update_available", [], "any", false, false, false, 14) || ((($_v0 = ($context["update_info"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0["branch"] ?? null) : null) == "preview"))) {
            // line 15
            yield "                ";
            if (((($_v1 = ($context["update_info"] ?? null)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1["branch"] ?? null) : null) == "preview")) {
                // line 16
                yield "                    <h2 class=\"card-title\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update release notes"), "html", null, true);
                yield "</h2>
                ";
            } else {
                // line 18
                yield "                    <h2 class=\"card-title mb-0\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update release notes"), "html", null, true);
                yield " (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["FOSSBillingVersion"] ?? null), "html", null, true);
                yield " => ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v2 = ($context["update_info"] ?? null)) && is_array($_v2) || $_v2 instanceof ArrayAccess ? ($_v2["version"] ?? null) : null), "html", null, true);
                yield ")</h2>
                    <span>";
                // line 19
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Required PHP version:"), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v3 = ($context["update_info"] ?? null)) && is_array($_v3) || $_v3 instanceof ArrayAccess ? ($_v3["minimum_php_version"] ?? null) : null), "html", null, true);
                yield "</span>
                ";
            }
            // line 21
            yield "                ";
            if (((($_v4 = ($context["update_info"] ?? null)) && is_array($_v4) || $_v4 instanceof ArrayAccess ? ($_v4["update_type"] ?? null) : null) == 2)) {
                // line 22
                yield "                    <div class=\"alert alert-danger\" role=\"alert\">
                        <span>";
                // line 23
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("This update is considered to be a major update, you should check the release notes for any breaking changes."), "html", null, true);
                yield "</span>
                    </div>
                ";
            }
            // line 26
            yield "                
                ";
            // line 27
            if (((($_v5 = ($context["update_info"] ?? null)) && is_array($_v5) || $_v5 instanceof ArrayAccess ? ($_v5["update_type"] ?? null) : null) == 1)) {
                // line 28
                yield "                    <div class=\"alert alert-warning\" role=\"alert\">
                        <span>";
                // line 29
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("This update is considered to be a minor update, there are low chances of incompatibilities."), "html", null, true);
                yield "</span>
                    </div>
                ";
            }
            // line 32
            yield "                    
                ";
            // line 33
            yield $this->extensions['Box_TwigExtensions']->twig_markdown_filter($this->env, (($_v6 = ($context["update_info"] ?? null)) && is_array($_v6) || $_v6 instanceof ArrayAccess ? ($_v6["release_notes"] ?? null) : null));
            yield "
            ";
        } else {
            // line 35
            yield "                <h2 class=\"card-title\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("There is no update available"), "html", null, true);
            yield "</h2>
                <p>";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("You appear to be running the latest version of FOSSBilling, so no action is needed at the moment. If you think this is a mistake, you may use the button below to check again."), "html", null, true);
            yield "</p>
            ";
        }
        // line 38
        yield "        </div>
        <div class=\"card-footer\">
            ";
        // line 40
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "system_update_available", [], "any", false, false, false, 40) || ((($_v7 = ($context["update_info"] ?? null)) && is_array($_v7) || $_v7 instanceof ArrayAccess ? ($_v7["branch"] ?? null) : null) == "preview"))) {
            // line 41
            yield "                <a href=\"";
            yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/update_core", ["CSRFToken" => ($context["CSRFToken"] ?? null)]);
            yield "\"
                    class=\"btn btn-primary api-link\"
                    data-api-reload=\"1\"
                    data-api-confirm=\"Proceed with automatic update?\"
                    data-api-confirm-btn=\"Update\"
                    data-api-confirm-content=\"Make sure that you have made database and files backups before proceeding with automatic update. You will automatically be redirected once the update is complete.\">
                    <svg class=\"icon\">
                        <use xlink:href=\"#download\" />
                    </svg>
                    ";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update FOSSBilling"), "html", null, true);
            yield "
                </a>
            ";
        } else {
            // line 53
            yield "                <a
                    class=\"btn btn-primary disabled\"
                    aria-disabled=\"true\">
                    <svg class=\"icon\">
                        <use xlink:href=\"#download\" />
                    </svg>
                    ";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Update FOSSBilling"), "html", null, true);
            yield "
                </a>
            ";
        }
        // line 62
        yield "            <a href=\"";
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/recheck_update", ["CSRFToken" => ($context["CSRFToken"] ?? null)]);
        yield "\"
                class=\"btn btn-primary api-link\"
                data-api-reload=\"1\">
                <svg class=\"icon\">
                    <use xlink:href=\"#refresh\" />
                </svg>
                ";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Check for Updates"), "html", null, true);
        yield "
            </a>
            <a href=\"";
        // line 70
        yield $this->extensions['Box_TwigExtensions']->twig_bb_client_link_filter("api/admin/system/manual_update", ["CSRFToken" => ($context["CSRFToken"] ?? null)]);
        yield "\" class=\"btn btn-primary api-link\" data-api-confirm=\"If you run into any issues, you can revert to the old config which will be saved as config.old.php.\" data-api-msg=\"Patches applied and configuration updated.\">
                <svg class=\"icon\">
                    <use xlink:href=\"#cog-play\" />
                </svg>
                ";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Apply Patches & Update Configuration"), "html", null, true);
        yield "
            </a>
            <br />
            <span class=\"text-muted\">";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Applying patches and updating the configuration should be performed automatically, you don't need to use that button unless you are experiencing issues."), "html", null, true);
        yield "<br />
            <span class=\"text-muted\">";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Last update check:"), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, (($_v8 = ($context["update_info"] ?? null)) && is_array($_v8) || $_v8 instanceof ArrayAccess ? ($_v8["last_check"] ?? null) : null)), "html", null, true);
        yield ".</span><br />
            <span class=\"text-muted\"> ";
        // line 79
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Next update check:"), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extra\Intl\IntlExtension']->formatDateTime($this->env, (($_v9 = ($context["update_info"] ?? null)) && is_array($_v9) || $_v9 instanceof ArrayAccess ? ($_v9["next_check"] ?? null) : null)), "html", null, true);
        yield ".</span>
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
        return "mod_system_update.html.twig";
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
        return array (  233 => 79,  227 => 78,  223 => 77,  217 => 74,  210 => 70,  205 => 68,  195 => 62,  189 => 59,  181 => 53,  175 => 50,  162 => 41,  160 => 40,  156 => 38,  151 => 36,  146 => 35,  141 => 33,  138 => 32,  132 => 29,  129 => 28,  127 => 27,  124 => 26,  118 => 23,  115 => 22,  112 => 21,  105 => 19,  96 => 18,  90 => 16,  87 => 15,  85 => 14,  79 => 11,  75 => 9,  72 => 8,  65 => 7,  54 => 5,  50 => 1,  48 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_system_update.html.twig", "/var/www/html/modules/System/html_admin/mod_system_update.html.twig");
    }
}
