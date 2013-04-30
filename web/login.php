<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

include __DIR__.'/../oauth/oauth_client.php';
include __DIR__.'/../httpclient/http.php';

$login = $app['controllers_factory'];






$login->get('/', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {

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

	$redirect = Request::create('/', 'GET');
	return $app->handle($redirect, HttpKernelInterface::SUB_REQUEST);

});

return $login;