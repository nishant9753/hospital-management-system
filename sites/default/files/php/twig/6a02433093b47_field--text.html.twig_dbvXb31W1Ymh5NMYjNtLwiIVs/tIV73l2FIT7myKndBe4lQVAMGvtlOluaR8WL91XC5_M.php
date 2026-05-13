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

/* field--text.html.twig */
class __TwigTemplate_54f629c4132d59dc214b02d7b0ca99a9 extends Template
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
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 28
        $context["attributes"] = CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["clearfix", "text-formatted"], "method", false, false, true, 28);
        // line 1
        $this->parent = $this->load("field.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "field--text.html.twig";
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
        return array (  50 => 1,  48 => 28,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"field.html.twig\" %}
{#
/**
 * @file
 * Default theme implementation for a text field.
 *
 * A 'clearfix' class is added, because 'text' fields have a 'format' property
 * that allows a Text Format to be associated with the entered text, which then
 * applies filtering on output. A common use case is to align images to the left
 * or right, and without this 'clearfix' class, such aligned images may be
 * rendered outside of the 'text' field formatter's boundaries, and hence
 * overlap with other fields. By setting the 'clearfix' class on all 'text'
 * fields, we prevent that.
 *
 * @see https://www.drupal.org/node/2358529
 *
 * A 'text-formatted' class is added to assist with default styling of base
 * elements such as paragraphs and lists that may not have classes assigned to
 * them. This allows user entered content to have default styling without
 * interfering with the styles of other UI components such as system generated
 * lists or other dynamic content.
 *
 * @see https://www.drupal.org/node/2539860
 *
 * @ingroup themeable
 */
#}
{% set attributes = attributes.addClass('clearfix', 'text-formatted') %}
", "field--text.html.twig", "themes/contrib/bootstrap/templates/field/field--text.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["extends" => 1, "set" => 28];
        static $filters = [];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['extends', 'set'],
                [],
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
