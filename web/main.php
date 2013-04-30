<?php

include __DIR__.'/../vendor/dropbox-php/dropbox-php/src/Dropbox/autoload.php';
include __DIR__.'/../oauth/oauth_client.php';
include __DIR__.'/../httpclient/http.php';

$main = $app['controllers_factory'];






$main->get('/', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {

	$key = '12f6692e591f34d122802a92e23cd807483c21e4';
	$secret = '113b17c5f51faba8a78022937b175e6b36d5c516';
	$redirectUrl = 'http://local.bc.pl';

	$oauth = new oauth_client_class();
	$oauth->Initialize();
	$oauth->request_token_url = 'https://launchpad.37signals.com/authorization/new';
	$oauth->dialog_url = 'https://launchpad.37signals.com/authorization/new?type={SCOPE}&client_id={CLIENT_ID}&redirect_uri={REDIRECT_URI}';
	$oauth->access_token_url = 'https://launchpad.37signals.com/authorization/token?type=web_server';
	$oauth->client_id = $key;
	$oauth->redirect_uri = $redirectUrl;
	$oauth->client_secret = $secret;
	$oauth->scope = 'web_server';
	$oauth->debug = true;

	$oauth->Process();



	return $app['twig']->render('main.twig');
});

return $main;