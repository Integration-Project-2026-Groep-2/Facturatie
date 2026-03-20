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

/* mod_wysiwyg_js.html.twig */
class __TwigTemplate_57fd2c648faf4fdde54a91a30d87a6af extends Template
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
        yield $this->extensions['Box_TwigExtensions']->twig_script_tag($this->extensions['Box_TwigExtensions']->twig_mod_asset_url("ckeditor/ckeditor.js", "wysiwyg"));
        yield "
<script type=\"text/javascript\">
    const editors = [];
    document.addEventListener(\"DOMContentLoaded\", function () {
        document.querySelectorAll('.";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["class"] ?? null), "html", null, true);
        yield "').forEach(function (element) {
            let required = false;
            CKEditor
                .create(element, {
                    licenseKey: 'GPL'
                })
                .then(editor => {
                    if (element.hasAttribute('required')) {
                        element.removeAttribute('required');
                        required = true;
                    }
                    editors[element.name] = { editor, 'required': required };
                })
                .catch(error => { console.error(error) });
        });

        if (localStorage.getItem('theme') === 'dark') {
            setTimeout(() => {
                document.querySelectorAll('.ck-editor__main').forEach(function (element) {
                    element.style.color=\"#1d273b\";
                });
            }, 1000);
        }
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
        return "mod_wysiwyg_js.html.twig";
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
        return array (  49 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "mod_wysiwyg_js.html.twig", "/var/www/html/modules/Wysiwyg/html_admin/mod_wysiwyg_js.html.twig");
    }
}
