<?php

include __DIR__.'/../vendor/dropbox-php/dropbox-php/src/Dropbox/autoload.php';


$main = $app['controllers_factory'];






$main->get('/', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {





	return $app['twig']->render('main.twig');
});

return $main;