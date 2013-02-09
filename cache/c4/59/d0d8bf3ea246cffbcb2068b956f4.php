<?php

/* index.html */
class __TwigTemplate_c459d0d8bf3ea246cffbcb2068b956f4 extends Twig_Template
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
<!--[if lt IE 7]>      <html class=\"no-js lt-ie9 lt-ie8 lt-ie7\"> <![endif]-->
<!--[if IE 7]>         <html class=\"no-js lt-ie9 lt-ie8\"> <![endif]-->
<!--[if IE 8]>         <html class=\"no-js lt-ie9\"> <![endif]-->
<!--[if gt IE 8]><!--> <html class=\"no-js\"> <!--<![endif]-->
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
        <title>3Day Forum</title>
        <meta name=\"description\" content=\"\">
        <meta name=\"viewport\" content=\"width=device-width\">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->


        <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["css_path"]) ? $context["css_path"] : null), "html", null, true);
        echo "/main.css\">
        <script src=\"";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["js_path"]) ? $context["js_path"] : null), "html", null, true);
        echo "/vendor/modernizr.min.js\"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class=\"chromeframe\">You are using an outdated browser. <a href=\"http://browsehappy.com/\">Upgrade your browser today</a> or <a href=\"http://www.google.com/chromeframe/?redirect=true\">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

        <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js\"></script>
        <script>window.jQuery || document.write('<script src=\"";
        // line 27
        echo twig_escape_filter($this->env, (isset($context["js_path"]) ? $context["js_path"] : null), "html", null, true);
        echo "/vendor/jquery.min.js\"><\\/script>')</script>



        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

    <!-- build:js scripts/amd-app.js -->
    <script data-main=\"";
        // line 40
        echo twig_escape_filter($this->env, (isset($context["js_path"]) ? $context["js_path"] : null), "html", null, true);
        echo "/main\" src=\"";
        echo twig_escape_filter($this->env, (isset($context["js_path"]) ? $context["js_path"] : null), "html", null, true);
        echo "/vendor/require.js\"></script>
    <!-- endbuild -->
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 40,  53 => 27,  40 => 17,  36 => 16,  19 => 1,);
    }
}
