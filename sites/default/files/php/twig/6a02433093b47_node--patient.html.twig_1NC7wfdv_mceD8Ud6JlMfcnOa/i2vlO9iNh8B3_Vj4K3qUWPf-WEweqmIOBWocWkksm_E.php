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

/* themes/custom/bootstrap_subtheme/templates/node--patient.html.twig */
class __TwigTemplate_34dd0101369f8820047c69897ed3c92e extends Template
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
            'submitted' => [$this, 'block_submitted'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 62
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("bootstrap/node"), "html", null, true);
        yield "

";
        // line 65
        $context["classes"] = ["node", ("node--type-" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source,         // line 67
($context["node"] ?? null), "bundle", [], "any", false, false, true, 67))), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 68
($context["node"] ?? null), "isPromoted", [], "method", false, false, true, 68)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("node--promoted") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 69
($context["node"] ?? null), "isSticky", [], "method", false, false, true, 69)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("node--sticky") : ("")), (((($tmp =  !CoreExtension::getAttribute($this->env, $this->source,         // line 70
($context["node"] ?? null), "isPublished", [], "method", false, false, true, 70)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("node--unpublished") : ("")), (((($tmp =         // line 71
($context["view_mode"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("node--view-mode-" . \Drupal\Component\Utility\Html::getClass(($context["view_mode"] ?? null)))) : ("")), "clearfix"];
        // line 75
        yield "<article";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 75), "html", null, true);
        yield ">
  <header>
    ";
        // line 77
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title_prefix"] ?? null), "html", null, true);
        yield "
    ";
        // line 78
        if ((($context["label"] ?? null) &&  !($context["page"] ?? null))) {
            // line 79
            yield "      <h2";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", ["node__title"], "method", false, false, true, 79), "html", null, true);
            yield ">
        <a href=\"";
            // line 80
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["url"] ?? null), "html", null, true);
            yield "\" rel=\"bookmark\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
            yield "</a>
      </h2>
    ";
        }
        // line 83
        yield "    ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title_suffix"] ?? null), "html", null, true);
        yield "
    ";
        // line 84
        if ((($tmp = ($context["display_submitted"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 85
            yield "      <div class=\"node__meta\">
        ";
            // line 86
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["author_picture"] ?? null), "html", null, true);
            yield "
        ";
            // line 87
            yield from $this->unwrap()->yieldBlock('submitted', $context, $blocks);
            // line 92
            yield "        ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["metadata"] ?? null), "html", null, true);
            yield "
      </div>
    ";
        }
        // line 95
        yield "  </header>
  <div";
        // line 96
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", ["node__content", "clearfix"], "method", false, false, true, 96), "html", null, true);
        yield ">
    <div class=\"container py-5\">
    
    <div class=\"d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 border-bottom pb-3\">
        <div>
            <span class=\"badge text-bg-danger mb-2 px-3 py-2 rounded-pill\"><i class=\"bi bi-file-medical me-1\"></i> Patient Record</span>
            <h1 class=\"text-danger fw-bold mb-1 display-6\">";
        // line 102
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
        yield "</h1>
        </div>
        <div class=\"text-md-end mt-3 mt-md-0\">
            <p class=\"text-muted small mb-0\">
                <i class=\"bi bi-clock-history me-1\"></i> Submitted by 
                <span class=\"text-decoration-none fw-semibold\">";
        // line 107
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["author_name"] ?? null), "html", null, true);
        yield "</span>
            </p>
            <p class=\"text-muted small mb-0\">";
        // line 109
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["date"] ?? null), "html", null, true);
        yield "</p>
        </div>
    </div>

    <div class=\"row g-4\">
        <div class=\"col-12\">
            <div class=\"card shadow-sm border-0 rounded-3\">
                <div class=\"card-header bg-white border-bottom py-3 d-flex align-items-center\">
                    <i class=\"bi bi-person-bounding-box fs-5 text-primary me-2\"></i>
                    <h5 class=\"mb-0 fw-semibold text-secondary\">Patient Demographics</h5>
                </div>
                <div class=\"card-body p-4 cs-iconsize\">
                    <div class=\"row g-4 align-items-center\">
                        
                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-person text-muted me-2\" title=\"First Name\"></i> 
                                ";
        // line 126
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_first_name", [], "any", false, false, true, 126), "html", null, true);
        yield "
                            </div>
                        </div>
                        
                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-person-lines-fill text-muted me-2\" title=\"Last Name\"></i> 
                                ";
        // line 133
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_last_name", [], "any", false, false, true, 133), "html", null, true);
        yield "
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-calendar3 text-muted me-2\" title=\"Date of Birth\"></i> 
                                ";
        // line 140
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date_of_birth", [], "any", false, false, true, 140), "html", null, true);
        yield "
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-gender-ambiguous text-muted me-2\" title=\"Gender\"></i> 
                                ";
        // line 147
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_gender", [], "any", false, false, true, 147), "html", null, true);
        yield "
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-bold text-danger\">
                                <i class=\"bi bi-droplet-fill me-2\" title=\"Blood Type\"></i> 
                                ";
        // line 154
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_blood_group", [], "any", false, false, true, 154), "html", null, true);
        yield "
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-people text-muted me-2\" title=\"Marital Status\"></i> 
                                ";
        // line 161
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_marital_status", [], "any", false, false, true, 161), "html", null, true);
        yield "
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-telephone text-muted me-2\" title=\"Phone Number\"></i> 
                                ";
        // line 168
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_phone_number", [], "any", false, false, true, 168), "html", null, true);
        yield "
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-briefcase text-muted me-2\" title=\"Occupation\"></i> 
                                ";
        // line 175
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_occupation", [], "any", false, false, true, 175), "html", null, true);
        yield "
                            </div>
                        </div>

                        <div class=\"col-12\">
                            <div class=\"d-flex align-items-start fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-geo-alt text-muted me-2 mt-1\" title=\"Address\"></i> 
                                <div>";
        // line 182
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_address", [], "any", false, false, true, 182), "html", null, true);
        yield "</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
    </div>
</div>
  </div>
</article>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["node", "view_mode", "attributes", "title_prefix", "label", "page", "title_attributes", "url", "title_suffix", "display_submitted", "author_picture", "metadata", "content_attributes", "author_name", "date", "content", "author_attributes"]);        yield from [];
    }

    // line 87
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_submitted(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 88
        yield "          <em";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["author_attributes"] ?? null), "html", null, true);
        yield ">
            ";
        // line 89
        yield t("Submitted by @author_name on @date", array("@author_name" => ($context["author_name"] ?? null), "@date" => ($context["date"] ?? null), ));
        // line 90
        yield "          </em>
        ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/bootstrap_subtheme/templates/node--patient.html.twig";
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
        return array (  263 => 90,  261 => 89,  256 => 88,  249 => 87,  230 => 182,  220 => 175,  210 => 168,  200 => 161,  190 => 154,  180 => 147,  170 => 140,  160 => 133,  150 => 126,  130 => 109,  125 => 107,  117 => 102,  108 => 96,  105 => 95,  98 => 92,  96 => 87,  92 => 86,  89 => 85,  87 => 84,  82 => 83,  74 => 80,  69 => 79,  67 => 78,  63 => 77,  57 => 75,  55 => 71,  54 => 70,  53 => 69,  52 => 68,  51 => 67,  50 => 65,  45 => 62,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{#
/**
 * @file
 * Bootstrap's theme implementation to display a node.
 *
 * Available variables:
 * - node: The node entity with limited access to object properties and methods.
     Only \"getter\" methods (method names starting with \"get\", \"has\", or \"is\")
     and a few common methods such as \"id\" and \"label\" are available. Calling
     other methods (such as node.delete) will result in an exception.
 * - label: The title of the node.
 * - content: All node items. Use {{ content }} to print them all,
 *   or print a subset such as {{ content.field_example }}. Use
 *   {{ content|without('field_example') }} to temporarily suppress the printing
 *   of a given child element.
 * - author_picture: The node author user entity, rendered using the \"compact\"
 *   view mode.
 * - metadata: Metadata for this node.
 * - date: Themed creation date field.
 * - author_name: Themed author name field.
 * - url: Direct URL of the current node.
 * - display_submitted: Whether submission information should be displayed.
 * - attributes: HTML attributes for the containing element.
 *   The attributes.class element may contain one or more of the following
 *   classes:
 *   - node: The current template type (also known as a \"theming hook\").
 *   - node--type-[type]: The current node type. For example, if the node is an
 *     \"Article\" it would result in \"node--type-article\". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node--view-mode-[view_mode]: The View Mode of the node; for example, a
 *     teaser would result in: \"node--view-mode-teaser\", and
 *     full: \"node--view-mode-full\".
 *   The following are controlled through the node publishing options.
 *   - node--promoted: Appears on nodes promoted to the front page.
 *   - node--sticky: Appears on nodes ordered above other non-sticky nodes in
 *     teaser listings.
 *   - node--unpublished: Appears on unpublished nodes visible only to site
 *     admins.
 * - title_attributes: Same as attributes, except applied to the main title
 *   tag that appears in the template.
 * - content_attributes: Same as attributes, except applied to the main
 *   content tag that appears in the template.
 * - author_attributes: Same as attributes, except applied to the author of
 *   the node tag that appears in the template.
 * - title_prefix: Additional output populated by modules, intended to be
 *   displayed in front of the main title tag that appears in the template.
 * - title_suffix: Additional output populated by modules, intended to be
 *   displayed after the main title tag that appears in the template.
 * - view_mode: View mode; for example, \"teaser\" or \"full\".
 * - teaser: Flag for the teaser state. Will be true if view_mode is 'teaser'.
 * - page: Flag for the full page state. Will be true if view_mode is 'full'.
 * - readmore: Flag for more state. Will be true if the teaser content of the
 *   node cannot hold the main body content.
 * - logged_in: Flag for authenticated user status. Will be true when the
 *   current user is a logged-in member.
 * - is_admin: Flag for admin user status. Will be true when the current user
 *   is an administrator.
 *
 * @see template_preprocess_node()
 */
#}
{{ attach_library('bootstrap/node') }}

{%
  set classes = [
    'node',
    'node--type-' ~ node.bundle|clean_class,
    node.isPromoted() ? 'node--promoted',
    node.isSticky() ? 'node--sticky',
    not node.isPublished() ? 'node--unpublished',
    view_mode ? 'node--view-mode-' ~ view_mode|clean_class,
    'clearfix',
  ]
%}
<article{{ attributes.addClass(classes) }}>
  <header>
    {{ title_prefix }}
    {% if label and not page %}
      <h2{{ title_attributes.addClass('node__title') }}>
        <a href=\"{{ url }}\" rel=\"bookmark\">{{ label }}</a>
      </h2>
    {% endif %}
    {{ title_suffix }}
    {% if display_submitted %}
      <div class=\"node__meta\">
        {{ author_picture }}
        {% block submitted %}
          <em{{ author_attributes }}>
            {% trans %}Submitted by {{ author_name }} on {{ date }}{% endtrans %}
          </em>
        {% endblock %}
        {{ metadata }}
      </div>
    {% endif %}
  </header>
  <div{{ content_attributes.addClass('node__content', 'clearfix') }}>
    <div class=\"container py-5\">
    
    <div class=\"d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 border-bottom pb-3\">
        <div>
            <span class=\"badge text-bg-danger mb-2 px-3 py-2 rounded-pill\"><i class=\"bi bi-file-medical me-1\"></i> Patient Record</span>
            <h1 class=\"text-danger fw-bold mb-1 display-6\">{{ label }}</h1>
        </div>
        <div class=\"text-md-end mt-3 mt-md-0\">
            <p class=\"text-muted small mb-0\">
                <i class=\"bi bi-clock-history me-1\"></i> Submitted by 
                <span class=\"text-decoration-none fw-semibold\">{{ author_name }}</span>
            </p>
            <p class=\"text-muted small mb-0\">{{ date }}</p>
        </div>
    </div>

    <div class=\"row g-4\">
        <div class=\"col-12\">
            <div class=\"card shadow-sm border-0 rounded-3\">
                <div class=\"card-header bg-white border-bottom py-3 d-flex align-items-center\">
                    <i class=\"bi bi-person-bounding-box fs-5 text-primary me-2\"></i>
                    <h5 class=\"mb-0 fw-semibold text-secondary\">Patient Demographics</h5>
                </div>
                <div class=\"card-body p-4 cs-iconsize\">
                    <div class=\"row g-4 align-items-center\">
                        
                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-person text-muted me-2\" title=\"First Name\"></i> 
                                {{ content.field_first_name }}
                            </div>
                        </div>
                        
                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-person-lines-fill text-muted me-2\" title=\"Last Name\"></i> 
                                {{ content.field_last_name }}
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-calendar3 text-muted me-2\" title=\"Date of Birth\"></i> 
                                {{ content.field_date_of_birth }}
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-gender-ambiguous text-muted me-2\" title=\"Gender\"></i> 
                                {{ content.field_gender }}
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-bold text-danger\">
                                <i class=\"bi bi-droplet-fill me-2\" title=\"Blood Type\"></i> 
                                {{ content.field_blood_group }}
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-people text-muted me-2\" title=\"Marital Status\"></i> 
                                {{ content.field_marital_status }}
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-telephone text-muted me-2\" title=\"Phone Number\"></i> 
                                {{ content.field_phone_number }}
                            </div>
                        </div>

                        <div class=\"col-sm-6 col-md-3\">
                            <div class=\"d-flex align-items-center fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-briefcase text-muted me-2\" title=\"Occupation\"></i> 
                                {{ content.field_occupation }}
                            </div>
                        </div>

                        <div class=\"col-12\">
                            <div class=\"d-flex align-items-start fs-6 fw-medium text-dark\">
                                <i class=\"bi bi-geo-alt text-muted me-2 mt-1\" title=\"Address\"></i> 
                                <div>{{ content.field_address }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
    </div>
</div>
  </div>
</article>
", "themes/custom/bootstrap_subtheme/templates/node--patient.html.twig", "/Applications/XAMPP/xamppfiles/htdocs/hms/themes/custom/bootstrap_subtheme/templates/node--patient.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 65, "if" => 78, "block" => 87, "trans" => 89];
        static $filters = ["escape" => 62, "clean_class" => 67];
        static $functions = ["attach_library" => 62];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block', 'trans'],
                ['escape', 'clean_class'],
                ['attach_library'],
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
