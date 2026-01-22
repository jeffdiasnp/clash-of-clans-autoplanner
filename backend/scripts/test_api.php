<?php
require_once __DIR__ . '/../app/Services/ClashOfClansApiService.php';
use App\Services\ClashOfClansApiService;

$service = new ClashOfClansApiService();
try {
    $result = $service->getVillage('#gycrljpjg');
    echo "Status: " . $result['status'] . "\n";
    echo "Body:\n";
    echo $result['body'] . "\n";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
