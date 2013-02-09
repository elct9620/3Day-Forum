<?php

$app->get('/', array('\Aotoki\HomeController', 'home'));
$app->get('/app/:var', array('\Aotoki\HomeController', 'app'));

$app->notFound(function() use ($app) {
  $app->render('404.html');
});
