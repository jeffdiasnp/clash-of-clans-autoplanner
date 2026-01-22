<?php
namespace App\Controllers;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\ClashOfClansApiService;

class VillageController
{
    public function getVillage(Request $request, Response $response, $args)
    {
        $villageId = $args['id'] ?? null;
        if (!$villageId) {
            $response->getBody()->write(json_encode(['error' => 'Village ID is required']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        try {
            $apiService = new ClashOfClansApiService();
            $apiResult = $apiService->getVillage($villageId);
            $response->getBody()->write($apiResult);
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    }
}
