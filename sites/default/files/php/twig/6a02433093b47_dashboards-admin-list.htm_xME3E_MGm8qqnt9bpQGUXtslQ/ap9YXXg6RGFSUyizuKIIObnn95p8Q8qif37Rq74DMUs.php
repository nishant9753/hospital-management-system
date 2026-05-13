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

/* modules/contrib/dashboards/templates/dashboards-admin-list.html.twig */
class __TwigTemplate_90b465d1f43ad2209a12aaec7b4b4615 extends Template
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
        // line 1
        $context["classes"] = ["admin-list--panel", "admin-list"];
        // line 5
        yield "
<dl ";
        // line 6
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 6), "html", null, true);
        yield ">
  ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["list"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 8
            yield "  <div class=\"admin-item";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, true, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " admin-item-with-image";
            }
            yield "\">
    ";
            // line 9
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, true, 9)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 10
                yield "      <div class=\"image\"><img src=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, true, 10), "html", null, true);
                yield "\" /></div>
      <div class=\"content\">
    ";
            }
            // line 13
            yield "    <dt class=\"admin-item__title\">
      <a ";
            // line 14
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "link_attributes", [], "any", false, false, true, 14), "addClass", ["admin-item__link"], "method", false, false, true, 14), "html", null, true);
            yield ">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 14), "html", null, true);
            yield "</a>
    </dt>
    ";
            // line 16
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "description", [], "any", false, false, true, 16)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 17
                yield "    <dd class=\"admin-item__description\">
      ";
                // line 18
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "description", [], "any", false, false, true, 18), "html", null, true);
                yield "
    </dd>
    ";
            }
            // line 21
            yield "    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, true, 21)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 22
                yield "      </div>
    ";
            }
            // line 24
            yield "  </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        yield "</dl>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "list"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/dashboards/templates/dashboards-admin-list.html.twig";
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
        return array (  108 => 26,  101 => 24,  97 => 22,  94 => 21,  88 => 18,  85 => 17,  83 => 16,  76 => 14,  73 => 13,  66 => 10,  64 => 9,  57 => 8,  53 => 7,  49 => 6,  46 => 5,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% set classes = [
  'admin-list--panel',
  'admin-list'
] %}

<dl {{ attributes.addClass(classes) }}>
  {% for item in list %}
  <div class=\"admin-item{% if item.image %} admin-item-with-image{% endif %}\">
    {% if item.image %}
      <div class=\"image\"><img src=\"{{ item.image }}\" /></div>
      <div class=\"content\">
    {% endif %}
    <dt class=\"admin-item__title\">
      <a {{ item.link_attributes.addClass('admin-item__link') }}>{{ item.title }}</a>
    </dt>
    {% if item.description %}
    <dd class=\"admin-item__description\">
      {{ item.description }}
    </dd>
    {% endif %}
    {%if item.image %}
      </div>
    {% endif %}
  </div>
  {% endfor %}
</dl>
", "modules/contrib/dashboards/templates/dashboards-admin-list.html.twig", "/Applications/XAMPP/xamppfiles/htdocs/hms/modules/contrib/dashboards/templates/dashboards-admin-list.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 1, "for" => 7, "if" => 8];
        static $filters = ["escape" => 6];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for', 'if'],
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
