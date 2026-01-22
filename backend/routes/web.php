<?php
use Slim\App;

return function (App $app) {
    // Exemplo de rota
    $app->get('/api/status', function ($request, $response) {
        $response->getBody()->write(json_encode(['status' => 'ok']));
        return $response->withHeader('Content-Type', 'application/json');
    });

    // Rota para buscar dados da vila
    $app->get('/api/village/{id}', [\App\Controllers\VillageController::class, 'getVillage']);
};
