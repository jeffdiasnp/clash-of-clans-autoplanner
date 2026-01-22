<?php
require_once __DIR__ . '/../app/Services/ClashOfClansApiService.php';
use App\Services\ClashOfClansApiService;

$service = new ClashOfClansApiService();
try {
    $result = $service->getVillage('#gycrljpjg');
    echo "Status: " . $result['status'] . "\n";
    echo "Body:\n";
    var_dump($result['body']);
    echo "\n";
    if (!empty($result['curl_error'])) {
        echo "cURL Error: " . $result['curl_error'] . "\n";
    }
    echo "URL: " . $result['url'] . "\n";
    echo "Token prefix: " . $result['token_prefix'] . "\n";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
