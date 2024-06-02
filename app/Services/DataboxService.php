<?php
// app/Services/DataboxService.php
namespace App\Services;

use GuzzleHttp\Client;

class DataboxService
{
    private $client;
    private $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.databox.api_key');
    }

    public function pushData(array $data)
    {
        $response = $this->client->post('https://push.databox.com/', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'json' => $data,
        ]);

        return $response->getStatusCode() === 200;
    }
}
