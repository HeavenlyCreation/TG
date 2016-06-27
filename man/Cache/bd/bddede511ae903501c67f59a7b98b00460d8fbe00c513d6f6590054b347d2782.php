<?php

/* /Layouts/test.tg */
class __TwigTemplate_6585a9717b82648d3dcde59cb38aec474598ed5bfe1490c34ed5d5b4eb862600 extends Twig_Template
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
        // line 8
        echo twig_escape_filter($this->env, (isset($context["the"]) ? $context["the"] : null), "html", null, true);
        echo "
</ul>

<h1>My Webpage</h1>
";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["go"]) ? $context["go"] : null), "html", null, true);
        echo "
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "/Layouts/test.tg";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 12,  28 => 8,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <title>My Webpage</title>*/
/* </head>*/
/* <body>*/
/* <ul id="navigation">*/
/*     {{ the }}*/
/* </ul>*/
/* */
/* <h1>My Webpage</h1>*/
/* {{ go }}*/
/* </body>*/
/* </html>*/
