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

/* core/themes/olivero/templates/form/fieldset.html.twig */
class __TwigTemplate_e779e4a1045c2ce0f448799e67559e01 extends Template
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
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 33
        $context["classes"] = ["fieldset", (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 35
($context["attributes"] ?? null), "hasClass", ["fieldgroup"], "method", false, false, true, 35)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("fieldset--group") : ("")), "js-form-item", "form-item", "js-form-wrapper", "form-wrapper"];
        // line 43
        $context["wrapper_classes"] = ["fieldset__wrapper", (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 45
($context["attributes"] ?? null), "hasClass", ["fieldgroup"], "method", false, false, true, 45)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("fieldset__wrapper--group") : (""))];
        // line 49
        $context["legend_span_classes"] = ["fieldset__label", (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 51
($context["attributes"] ?? null), "hasClass", ["fieldgroup"], "method", false, false, true, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("fieldset__label--group") : ("")), (((($tmp =         // line 52
($context["required"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("js-form-required") : ("")), (((($tmp =         // line 53
($context["required"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("form-required") : (""))];
        // line 57
        $context["legend_classes"] = ["fieldset__legend", (((CoreExtension::getAttribute($this->env, $this->source,         // line 59
($context["attributes"] ?? null), "hasClass", ["fieldgroup"], "method", false, false, true, 59) &&  !CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "hasClass", ["form-composite"], "method", false, false, true, 59))) ? ("fieldset__legend--group") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 60
($context["attributes"] ?? null), "hasClass", ["form-composite"], "method", false, false, true, 60)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("fieldset__legend--composite") : ("")), (((        // line 61
($context["title_display"] ?? null) == "invisible")) ? ("fieldset__legend--invisible") : ("fieldset__legend--visible"))];
        // line 65
        $context["description_classes"] = ["fieldset__description"];
        // line 69
        yield "
<fieldset";
        // line 70
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 70), "html", null, true);
        yield ">
  ";
        // line 72
        yield "  ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["legend"] ?? null), "title", [], "any", false, false, true, 72)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 73
            yield "  <legend";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["legend"] ?? null), "attributes", [], "any", false, false, true, 73), "addClass", [($context["legend_classes"] ?? null)], "method", false, false, true, 73), "html", null, true);
            yield ">
    <span";
            // line 74
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["legend_span"] ?? null), "attributes", [], "any", false, false, true, 74), "addClass", [($context["legend_span_classes"] ?? null)], "method", false, false, true, 74), "html", null, true);
            yield ">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["legend"] ?? null), "title", [], "any", false, false, true, 74), "html", null, true);
            yield "</span>
  </legend>
  ";
        }
        // line 77
        yield "
  <div";
        // line 78
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [($context["wrapper_classes"] ?? null)], "method", false, false, true, 78), "html", null, true);
        yield ">
    ";
        // line 79
        if ((($tmp = ($context["inline_items"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 80
            yield "      <div class=\"container-inline\">
    ";
        }
        // line 82
        yield "
    ";
        // line 83
        if (((($context["description_display"] ?? null) == "before") && CoreExtension::getAttribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 83))) {
            // line 84
            yield "      <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 84), "addClass", [($context["description_classes"] ?? null)], "method", false, false, true, 84), "html", null, true);
            yield ">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 84), "html", null, true);
            yield "</div>
    ";
        }
        // line 86
        yield "    ";
        if ((($tmp = ($context["prefix"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 87
            yield "      <span class=\"fieldset__prefix\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["prefix"] ?? null), "html", null, true);
            yield "</span>
    ";
        }
        // line 89
        yield "    ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["children"] ?? null), "html", null, true);
        yield "
    ";
        // line 90
        if ((($tmp = ($context["suffix"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 91
            yield "      <span class=\"fieldset__suffix\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["suffix"] ?? null), "html", null, true);
            yield "</span>
    ";
        }
        // line 93
        yield "    ";
        if ((($tmp = ($context["errors"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 94
            yield "      <div class=\"fieldset__error-message\">
        ";
            // line 95
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["errors"] ?? null), "html", null, true);
            yield "
      </div>
    ";
        }
        // line 98
        yield "    ";
        if ((CoreExtension::inFilter(($context["description_display"] ?? null), ["after", "invisible"]) && CoreExtension::getAttribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 98))) {
            // line 99
            yield "      <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 99), "addClass", [($context["description_classes"] ?? null)], "method", false, false, true, 99), "html", null, true);
            yield ">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 99), "html", null, true);
            yield "</div>
    ";
        }
        // line 101
        yield "
    ";
        // line 102
        if ((($tmp = ($context["inline_items"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 103
            yield "      </div>
    ";
        }
        // line 105
        yield "  </div>
</fieldset>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "required", "title_display", "legend", "legend_span", "content_attributes", "inline_items", "description_display", "description", "prefix", "children", "suffix", "errors"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/themes/olivero/templates/form/fieldset.html.twig";
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
        return array (  165 => 105,  161 => 103,  159 => 102,  156 => 101,  148 => 99,  145 => 98,  139 => 95,  136 => 94,  133 => 93,  127 => 91,  125 => 90,  120 => 89,  114 => 87,  111 => 86,  103 => 84,  101 => 83,  98 => 82,  94 => 80,  92 => 79,  88 => 78,  85 => 77,  77 => 74,  72 => 73,  69 => 72,  65 => 70,  62 => 69,  60 => 65,  58 => 61,  57 => 60,  56 => 59,  55 => 57,  53 => 53,  52 => 52,  51 => 51,  50 => 49,  48 => 45,  47 => 43,  45 => 35,  44 => 33,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{#
/**
 * @file
 * Theme override for a fieldset element and its children.
 *
 * Available variables:
 * - attributes: HTML attributes for the <fieldset> element.
 * - errors: (optional) Any errors for this <fieldset> element, may not be set.
 * - required: Boolean indicating whether the <fieldset> element is required.
 * - legend: The <legend> element containing the following properties:
 *   - title: Title of the <fieldset>, intended for use as the text
       of the <legend>.
 *   - attributes: HTML attributes to apply to the <legend> element.
 * - description: The description element containing the following properties:
 *   - content: The description content of the <fieldset>.
 *   - attributes: HTML attributes to apply to the description container.
 * - description_display: Description display setting. It can have these values:
 *   - before: The description is output before the element.
 *   - after: The description is output after the element (default).
 *   - invisible: The description is output after the element, hidden visually
 *     but available to screen readers.
 * - children: The rendered child elements of the <fieldset>.
 * - prefix: The content to add before the <fieldset> children.
 * - suffix: The content to add after the <fieldset> children.
 * - title_display: Title display setting.
 * - inline_items: Boolean indicating whether the <fieldset> items are inline.
 *
 * @see template_preprocess_fieldset()
 * @see olivero_preprocess_fieldset()
 */
#}
{%
  set classes = [
    'fieldset',
    attributes.hasClass('fieldgroup') ? 'fieldset--group',
    'js-form-item',
    'form-item',
    'js-form-wrapper',
    'form-wrapper',
  ]
%}
{%
  set wrapper_classes = [
    'fieldset__wrapper',
    attributes.hasClass('fieldgroup') ? 'fieldset__wrapper--group',
  ]
%}
{%
  set legend_span_classes = [
    'fieldset__label',
    attributes.hasClass('fieldgroup') ? 'fieldset__label--group',
    required ? 'js-form-required',
    required ? 'form-required',
  ]
%}
{%
  set legend_classes = [
    'fieldset__legend',
    attributes.hasClass('fieldgroup') and not attributes.hasClass('form-composite') ? 'fieldset__legend--group',
    attributes.hasClass('form-composite') ? 'fieldset__legend--composite',
    title_display == 'invisible' ? 'fieldset__legend--invisible' : 'fieldset__legend--visible',
  ]
%}
{%
  set description_classes = [
   'fieldset__description',
  ]
%}

<fieldset{{ attributes.addClass(classes) }}>
  {# Always wrap fieldset legends in a <span> for CSS positioning. #}
  {% if legend.title %}
  <legend{{ legend.attributes.addClass(legend_classes) }}>
    <span{{ legend_span.attributes.addClass(legend_span_classes) }}>{{ legend.title }}</span>
  </legend>
  {% endif %}

  <div{{ content_attributes.addClass(wrapper_classes) }}>
    {% if inline_items %}
      <div class=\"container-inline\">
    {% endif %}

    {% if description_display == 'before' and description.content %}
      <div{{ description.attributes.addClass(description_classes) }}>{{ description.content }}</div>
    {% endif %}
    {% if prefix %}
      <span class=\"fieldset__prefix\">{{ prefix }}</span>
    {% endif %}
    {{ children }}
    {% if suffix %}
      <span class=\"fieldset__suffix\">{{ suffix }}</span>
    {% endif %}
    {% if errors %}
      <div class=\"fieldset__error-message\">
        {{ errors }}
      </div>
    {% endif %}
    {% if description_display in ['after', 'invisible'] and description.content %}
      <div{{ description.attributes.addClass(description_classes) }}>{{ description.content }}</div>
    {% endif %}

    {% if inline_items %}
      </div>
    {% endif %}
  </div>
</fieldset>
", "core/themes/olivero/templates/form/fieldset.html.twig", "/Applications/XAMPP/xamppfiles/htdocs/hms/core/themes/olivero/templates/form/fieldset.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 33, "if" => 72];
        static $filters = ["escape" => 70];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
