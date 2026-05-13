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

/* @help_topics/menu_ui.content_type_configuration.html.twig */
class __TwigTemplate_15f4f84ea5b3095567288e869727a6ec extends Template
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
        // line 8
        $context["content_types_text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            yield t("Content types", array());
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 9
        $context["content_types_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink(($context["content_types_text"] ?? null), "entity.node_type.collection"));
        // line 10
        yield "<h2>";
        yield t("Goal", array());
        yield "</h2>
<p>";
        // line 11
        yield t("For an existing content type, configure the available menus that will be shown as options on content editing screens; links to content items of this type can be added to these menus during editing.", array());
        yield "</p>
<h2>";
        // line 12
        yield t("Steps", array());
        yield "</h2>
<ol>
  <li>";
        // line 14
        yield t("In the <em>Manage</em> administrative menu, navigate to <em>Structure</em> &gt; @content_types_link.", array("@content_types_link" => ($context["content_types_link"] ?? null), ));
        yield "</li>
  <li>";
        // line 15
        yield t("Locate the content type you want to configure, and click <em>Edit</em> in the <em>Operations</em> list.", array());
        yield "</li>
  <li>";
        // line 16
        yield t("Under <em>Menu settings</em>, check the menus that you want to be available when editing a content item of this type.", array());
        yield "</li>
  <li>";
        // line 17
        yield t("Optionally, select the <em>Default parent item</em>, to put links to content items under a default location in the menu structure.", array());
        yield "</li>
  <li>";
        // line 18
        yield t("Click <em>Save</em>.", array());
        yield "</li>
</ol>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@help_topics/menu_ui.content_type_configuration.html.twig";
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
        return array (  81 => 18,  77 => 17,  73 => 16,  69 => 15,  65 => 14,  60 => 12,  56 => 11,  51 => 10,  49 => 9,  44 => 8,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% line 8 %}{% set content_types_text %}{% trans %}Content types{% endtrans %}{% endset %}
{% set content_types_link = render_var(help_route_link(content_types_text, 'entity.node_type.collection')) %}
<h2>{% trans %}Goal{% endtrans %}</h2>
<p>{% trans %}For an existing content type, configure the available menus that will be shown as options on content editing screens; links to content items of this type can be added to these menus during editing.{% endtrans %}</p>
<h2>{% trans %}Steps{% endtrans %}</h2>
<ol>
  <li>{% trans %}In the <em>Manage</em> administrative menu, navigate to <em>Structure</em> &gt; {{ content_types_link }}.{% endtrans %}</li>
  <li>{% trans %}Locate the content type you want to configure, and click <em>Edit</em> in the <em>Operations</em> list.{% endtrans %}</li>
  <li>{% trans %}Under <em>Menu settings</em>, check the menus that you want to be available when editing a content item of this type.{% endtrans %}</li>
  <li>{% trans %}Optionally, select the <em>Default parent item</em>, to put links to content items under a default location in the menu structure.{% endtrans %}</li>
  <li>{% trans %}Click <em>Save</em>.{% endtrans %}</li>
</ol>", "@help_topics/menu_ui.content_type_configuration.html.twig", "/Applications/XAMPP/xamppfiles/htdocs/hms/core/modules/menu_ui/help_topics/menu_ui.content_type_configuration.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 8, "trans" => 8];
        static $filters = ["escape" => 14];
        static $functions = ["render_var" => 9, "help_route_link" => 9];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_route_link'],
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
