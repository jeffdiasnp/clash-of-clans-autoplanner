<?php
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;


$app = AppFactory::create();

// Middleware CORS
$app->add(function ($request, $handler) {
	$response = $handler->handle($request);
	return $response
		->withHeader('Access-Control-Allow-Origin', '*')
		->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
		->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
});

// Rotas serão carregadas aqui
(require __DIR__ . '/../routes/web.php')($app);

$app->run();
