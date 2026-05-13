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

/* @help_topics/announcements_feed.overview.html.twig */
class __TwigTemplate_0d8f4292c2c42066c64a1783c8f57dfc extends Template
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
        // line 5
        $context["actions_link_text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 6
            yield t("Announcements", array());
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["actions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink(($context["actions_link_text"] ?? null), "announcements_feed.announcement"));
        // line 9
        $context["permissions_link_text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 10
            yield t("View official announcements related to Drupal", array());
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 12
        $context["permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink(($context["permissions_link_text"] ?? null), "user.admin_permissions.module", ["modules" => "announcements_feed"]));
        // line 13
        yield "<h2>";
        yield t("What are Drupal announcements?", array());
        yield "</h2>
<p>";
        // line 14
        yield t("A feed of announcements about the Drupal project and Drupal Association programs.", array());
        yield "</p>
<p>";
        // line 15
        yield t("The purpose of this feed is to provide a channel for outreach directly to Drupal site owners. This content must be highly relevant to site owners interests, serve the strategic goals of the project, and/or promote the sustainability of the project and the Drupal Association.", array());
        yield "</p>
<p>";
        // line 16
        yield t("The module sources its content from a JSON feed generated from <a href=\"https://www.drupal.org/about/announcements\">here</a>. The governance policy for the content is documented <a href=\"https://www.drupal.org/node/3274085\">here</a>.", array());
        yield "</p>
<h2>";
        // line 17
        yield t("How can I see the Announcements in my site?", array());
        yield "</h2>
<p>";
        // line 18
        yield t("If you have the toolbar module enabled, you will see a direct link to them in the toolbar. If the toolbar module is not enabled, the content can always be accessed in the <em>@actions_link</em> page.", array("@actions_link" => ($context["actions_link"] ?? null), ));
        yield "</p>
<h2>";
        // line 19
        yield t("Who can see the Announcements?", array());
        yield "</h2>
<p>";
        // line 20
        yield t("Users with the <em>@permissions_link</em> permission can view Drupal announcements.", array("@permissions_link" => ($context["permissions_link"] ?? null), ));
        yield "</p>
<h2>";
        // line 21
        yield t("Additional resources", array());
        yield "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/core-modules-and-themes/core-modules/announcements-feed/announcements-feed-module-overview\">";
        // line 23
        yield t("Announcement module overview", array());
        yield "</a></li>
</ul>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@help_topics/announcements_feed.overview.html.twig";
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
        return array (  98 => 23,  93 => 21,  89 => 20,  85 => 19,  81 => 18,  77 => 17,  73 => 16,  69 => 15,  65 => 14,  60 => 13,  58 => 12,  54 => 10,  52 => 9,  50 => 8,  46 => 6,  44 => 5,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% line 5 %}{% set actions_link_text %}
{% trans %}Announcements{% endtrans %}
{% endset %}
{% set actions_link = render_var(help_route_link(actions_link_text, 'announcements_feed.announcement')) %}
{% set permissions_link_text %}
{% trans %}View official announcements related to Drupal{% endtrans %}
{% endset %}
{% set permissions_link = render_var(help_route_link(permissions_link_text, 'user.admin_permissions.module', {'modules': 'announcements_feed'})) %}
<h2>{% trans %}What are Drupal announcements?{% endtrans %}</h2>
<p>{% trans %}A feed of announcements about the Drupal project and Drupal Association programs.{% endtrans %}</p>
<p>{% trans %}The purpose of this feed is to provide a channel for outreach directly to Drupal site owners. This content must be highly relevant to site owners interests, serve the strategic goals of the project, and/or promote the sustainability of the project and the Drupal Association.{% endtrans %}</p>
<p>{% trans %}The module sources its content from a JSON feed generated from <a href=\"https://www.drupal.org/about/announcements\">here</a>. The governance policy for the content is documented <a href=\"https://www.drupal.org/node/3274085\">here</a>.{% endtrans %}</p>
<h2>{% trans %}How can I see the Announcements in my site?{% endtrans %}</h2>
<p>{% trans %}If you have the toolbar module enabled, you will see a direct link to them in the toolbar. If the toolbar module is not enabled, the content can always be accessed in the <em>{{ actions_link }}</em> page.{% endtrans %}</p>
<h2>{% trans %}Who can see the Announcements?{% endtrans %}</h2>
<p>{% trans %}Users with the <em>{{ permissions_link }}</em> permission can view Drupal announcements.{% endtrans %}</p>
<h2>{% trans %}Additional resources{% endtrans %}</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/core-modules-and-themes/core-modules/announcements-feed/announcements-feed-module-overview\">{% trans %}Announcement module overview{% endtrans %}</a></li>
</ul>", "@help_topics/announcements_feed.overview.html.twig", "/Applications/XAMPP/xamppfiles/htdocs/hms/core/modules/announcements_feed/help_topics/announcements_feed.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 5, "trans" => 6];
        static $filters = ["escape" => 18];
        static $functions = ["render_var" => 8, "help_route_link" => 8];

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
