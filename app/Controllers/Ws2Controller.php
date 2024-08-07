<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use GuzzleHttp\Client;

class Ws2Controller extends Controller
{
    public function index()
    {
        // Configura el cliente Guzzle
        $client = new Client([
            'base_uri' => 'https://localhost:9443', // URL base de tu WSO2 API Manager
        ]);

        // Definir las credenciales de acceso (client_id y client_secret)
        $client_id = 'your-client-id';
        $client_secret = 'your-client-secret';

        // Obtener un token de acceso
        try {
            $response = $client->post('/oauth2/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $client_id,
                    'client_secret' => $client_secret,
                ],
            ]);

            $body = $response->getBody();
            $data = json_decode($body, true);
            $access_token = $data['access_token'];
        } catch (\Exception $e) {
            return 'Error obteniendo el token de acceso: ' . $e->getMessage();
        }

        // Usar el token de acceso para consumir la API
        try {
            $response = $client->get('/api/v1/resource', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token,
                ],
            ]);

            $body = $response->getBody();
            $data = json_decode($body, true);

            // Procesar los datos recibidos
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return 'Error consumiendo la API: ' . $e->getMessage();
        }
    }
}