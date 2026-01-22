<?php
namespace App\Services;

class ClashOfClansApiService
{
    private $apiUrl;
    private $apiToken;

    public function __construct()
    {
        $envPath = __DIR__ . '/../../.env';
        if (!file_exists($envPath)) {
            throw new \Exception('.env file not found in backend directory');
        }
        $env = parse_ini_file($envPath);
        $this->apiUrl = rtrim($env['COC_API_URL'] ?? '', '/');
        $this->apiToken = $env['COC_API_TOKEN'] ?? '';
    }

    public function getVillage($villageId)
    {
        if (!$this->apiUrl || !$this->apiToken) {
            throw new \Exception('API config missing');
        }
        $url = $this->apiUrl . '/players/%23' . urlencode(ltrim($villageId, '#'));
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->apiToken,
            'Accept: application/json',
        ]);
        // Ignorar verificação SSL (apenas para testes locais)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($result === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception('Erro na requisição: ' . $error);
        }
        curl_close($ch);
        if ($httpCode < 200 || $httpCode >= 300) {
            $msg = 'Erro na API Clash of Clans: HTTP ' . $httpCode;
            $body = json_decode($result, true);
            if (isset($body['reason'])) {
                $msg .= ' - ' . $body['reason'];
            }
            throw new \Exception($msg);
        }
        return $result;
    }
}
