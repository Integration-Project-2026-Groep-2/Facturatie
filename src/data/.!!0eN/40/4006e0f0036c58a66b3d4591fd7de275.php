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

/* partial_batch_delete.html.twig */
class __TwigTemplate_abe7e0e7c7753d796461bec9f08d3fe7 extends Template
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
        yield "<a class=\"btn btn-danger d-none\" id=\"batch-delete-selected-btn\">
    <svg class=\"icon\">
        <use xlink:href=\"#delete\"/>
    </svg>
    ";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Delete selected"), "html", null, true);
        yield "</a>

<script>
    document.addEventListener(\"DOMContentLoaded\", function () {

        const deleteBtn = document.getElementById('batch-delete-selected-btn');
        const masterCheckbox = document.querySelector('input.batch-delete-master-checkbox');
        const checkboxes = document.querySelectorAll('input.batch-delete-checkbox');

        masterCheckbox.addEventListener('change', toggleDeleteBtn);
        checkboxes.forEach((cb) => {
            cb.addEventListener('change', toggleDeleteBtn)
        });

        function toggleDeleteBtn() {
            const empty = [].filter.call(checkboxes, function (cb) {
                return !cb.checked
            });
            if (empty.length !== checkboxes.length) {
                deleteBtn.classList.remove('d-none');
                deleteBtn.classList.add('d-inline-flex');
                return;
            }
            deleteBtn.classList.remove('d-inline-flex');
            deleteBtn.classList.add('d-none');
        }

        \$('#batch-delete-selected-btn').on('click', function () {
            if (\$('input.batch-delete-checkbox:checked').length) {
                Modals.create({
                    type: 'danger',
                    title: \"";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure?"), "html", null, true);
        yield "\",
                    content: \"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("Are you sure you want to delete the selected items?"), "html", null, true);
        yield "\",
                    confirmCallback: function() {
                        var ids = \$('input.batch-delete-checkbox:checked').map(function() {
                            return \$(this).attr(\"data-item-id\");
                        }).get();
                        bb.post('";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["action"] ?? null), "html", null, true);
        yield "', { ids: ids, CSRFToken: \"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["CSRFToken"] ?? null), "html", null, true);
        yield "\" }, function (result) {
                            bb.reload();
                        })
                    }
                });
            } else {
                Modals.create({
                    type: 'small',
                    title: \"";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("No items selected"), "html", null, true);
        yield "\",
                    content: \"";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__trans("You need to select at least one item to delete"), "html", null, true);
        yield "\",
                });
            }
        });

        \$('input.batch-delete-master-checkbox').on('click', function () {
            \$('input.batch-delete-checkbox').prop('checked', this.checked);
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
        return "partial_batch_delete.html.twig";
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
        return array (  111 => 51,  107 => 50,  94 => 42,  86 => 37,  82 => 36,  48 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "partial_batch_delete.html.twig", "/var/www/html/themes/admin_default/html/partial_batch_delete.html.twig");
    }
}
