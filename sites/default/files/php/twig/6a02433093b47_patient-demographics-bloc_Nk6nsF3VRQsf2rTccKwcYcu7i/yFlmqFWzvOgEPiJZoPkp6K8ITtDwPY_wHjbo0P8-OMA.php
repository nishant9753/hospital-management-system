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

/* modules/custom/patient_lookup/templates/patient-demographics-block.html.twig */
class __TwigTemplate_a9ce0e962845a5b3304917e9bea728dc extends Template
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
        yield "<div class=\"row\">
    <div class=\"col-12\">
        <div class=\"card shadow-sm border-0 rounded-3\">
            <div class=\"card-body p-4 cs-iconsize\">
                <div class=\"row g-4 align-items-center\">
                    
                    <div class=\"row\">
        <div class=\"col-4 \">
          Name : <span class=\"highlight\">";
        // line 9
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_first_name", [], "any", true, true, true, 9)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_first_name", [], "any", false, false, true, 9), "N/A")) : ("N/A")), "html", null, true);
        yield " ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_last_name", [], "any", false, false, true, 9), "html", null, true);
        yield "</span>
        </div>
        <div class=\"col-2\">
        Date of Birth : <span class=\"highlight\"> ";
        // line 12
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date_of_birth", [], "any", false, false, true, 12), "html", null, true);
        yield " </span>
        </div>
        <div class=\"col-2 \">
          Gender : <span class=\"highlight\">";
        // line 15
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_gender", [], "any", false, false, true, 15), "html", null, true);
        yield "</span>
        </div>
        <div class=\"col-2 \">
          Blood group : <span class=\"highlight\">";
        // line 18
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_blood_group", [], "any", false, false, true, 18), "html", null, true);
        yield "</span>
        </div>
        <div class=\"col-2 \"> Age : <span class=\"highlight\"> 
            ";
        // line 21
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date_of_birth", [], "any", false, false, true, 21) && (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date_of_birth", [], "any", false, false, true, 21) != "-"))) {
            // line 22
            yield "            ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "computed_age", [], "any", false, false, true, 22)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 23
                yield "                ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "computed_age", [], "any", false, false, true, 23), "html", null, true);
                yield " Yrs
            ";
            }
            // line 25
            yield "        ";
        } else {
            // line 26
            yield "            -
        ";
        }
        // line 28
        yield "        </span>
        </div>
      </div>

      <div class=\"row \">
        
        <div class=\"col-4 \">
          PID : <span class=\"highlight\">";
        // line 35
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "pid", [], "any", false, false, true, 35), "html", null, true);
        yield "</span>
        </div>
        <div class=\"col-2\">
          Marital Status : <span class=\"highlight\">";
        // line 38
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_marital_status", [], "any", false, false, true, 38), "html", null, true);
        yield "</span>
        </div>
        <div class=\"col-2 \">
          Tel. : <span class=\"highlight\">";
        // line 41
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_phone_number", [], "any", false, false, true, 41), "html", null, true);
        yield "</span>
        </div>
        <div class=\"col-4 \">
          Address : <span class=\"highlight\">";
        // line 44
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_address", [], "any", false, false, true, 44), "html", null, true);
        yield "</span>
        </div>
        
        
        
        
      </div>
                </div>
            </div>
        </div>
    </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["content"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/custom/patient_lookup/templates/patient-demographics-block.html.twig";
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
        return array (  125 => 44,  119 => 41,  113 => 38,  107 => 35,  98 => 28,  94 => 26,  91 => 25,  85 => 23,  82 => 22,  80 => 21,  74 => 18,  68 => 15,  62 => 12,  54 => 9,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"row\">
    <div class=\"col-12\">
        <div class=\"card shadow-sm border-0 rounded-3\">
            <div class=\"card-body p-4 cs-iconsize\">
                <div class=\"row g-4 align-items-center\">
                    
                    <div class=\"row\">
        <div class=\"col-4 \">
          Name : <span class=\"highlight\">{{ content.field_first_name |default('N/A') }} {{ content.field_last_name }}</span>
        </div>
        <div class=\"col-2\">
        Date of Birth : <span class=\"highlight\"> {{ content.field_date_of_birth }} </span>
        </div>
        <div class=\"col-2 \">
          Gender : <span class=\"highlight\">{{ content.field_gender }}</span>
        </div>
        <div class=\"col-2 \">
          Blood group : <span class=\"highlight\">{{ content.field_blood_group }}</span>
        </div>
        <div class=\"col-2 \"> Age : <span class=\"highlight\"> 
            {% if content.field_date_of_birth and content.field_date_of_birth != '-' %}
            {% if content.computed_age %}
                {{ content.computed_age }} Yrs
            {% endif %}
        {% else %}
            -
        {% endif %}
        </span>
        </div>
      </div>

      <div class=\"row \">
        
        <div class=\"col-4 \">
          PID : <span class=\"highlight\">{{ content.pid }}</span>
        </div>
        <div class=\"col-2\">
          Marital Status : <span class=\"highlight\">{{ content.field_marital_status }}</span>
        </div>
        <div class=\"col-2 \">
          Tel. : <span class=\"highlight\">{{ content.field_phone_number }}</span>
        </div>
        <div class=\"col-4 \">
          Address : <span class=\"highlight\">{{ content.field_address }}</span>
        </div>
        
        
        
        
      </div>
                </div>
            </div>
        </div>
    </div>
</div>
", "modules/custom/patient_lookup/templates/patient-demographics-block.html.twig", "/Applications/XAMPP/xamppfiles/htdocs/hms/modules/custom/patient_lookup/templates/patient-demographics-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 21];
        static $filters = ["escape" => 9, "default" => 9];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'default'],
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
