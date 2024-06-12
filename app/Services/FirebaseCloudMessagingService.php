<?php

namespace App\Services;

use GuzzleHttp\Client;

class FirebaseCloudMessagingService
{
    protected $client;
    protected $apiUrl = 'https://fcm.googleapis.com/fcm/send';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
            ]
        ]);
    }

    protected function getAccessToken()
    {
        // Load the service account key JSON file
        $serviceAccount = json_decode(file_get_contents(config('services.databox.credentials')), true);

        // Get the access token using JWT
        $now = time();
        $exp = $now + 3600; // Token valid for 1 hour
        $payload = [
            'iss' => $serviceAccount['client_email'],
            'sub' => $serviceAccount['client_email'],
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now,
            'exp' => $exp,
            'scope' => 'https://www.googleapis.com/auth/cloud-platform'
        ];

        $jwt = \Firebase\JWT\JWT::encode($payload, $serviceAccount['private_key'], 'RS256');

        $client = new Client();
        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['access_token'];
    }

    public function getMetrics()
    {
        $response = $this->client->get('/v1/projects/YOUR_PROJECT_ID/fcm/send');
        $data = json_decode($response->getBody()->getContents(), true);

        return $data;
    }
}
