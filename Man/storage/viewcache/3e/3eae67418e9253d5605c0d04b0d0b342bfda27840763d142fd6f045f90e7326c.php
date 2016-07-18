<?php

/* User\Index.twig */
class __TwigTemplate_994215245e1261d0f6dcbd8dd4b73d560feb1e7b8f1f7d1aecdcbba25701c7d6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <title>My Webpage</title>
</head>
<body>
<ul id=\"navigation\">
    ";
        // line 9
        echo "        ";
        // line 10
        echo "    ";
        // line 11
        echo "</ul>
";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["go"]) ? $context["go"] : null), "html", null, true);
        echo "
<h1>My Webpage</h1>
";
        // line 14
        echo twig_escape_filter($this->env, (isset($context["the"]) ? $context["the"] : null), "html", null, true);
        echo "
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "User\\Index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 14,  35 => 12,  32 => 11,  30 => 10,  28 => 9,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <title>My Webpage</title>*/
/* </head>*/
/* <body>*/
/* <ul id="navigation">*/
/*     {#{% for item in navigation %}#}*/
/*         {#<li><a href="{{ item.href }}">{{ item.caption }}</a></li>#}*/
/*     {#{% endfor %}#}*/
/* </ul>*/
/* {{ go }}*/
/* <h1>My Webpage</h1>*/
/* {{ the }}*/
/* </body>*/
/* </html>*/
/* */
