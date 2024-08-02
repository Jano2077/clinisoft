<?php

namespace App\Controllers;


use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;


class Wso2Controller extends BaseController
{
    public function fetchData()
    {
        // URL de la API de WSO2 con parámetros
        $apiUrl = 'http://10.2.133.27:5161/24362658?sexo=F&periodo=1223';

        // Token de Autenticación (puede ser de tipo Bearer)
        $authToken = 'Bearer tu_token_de_autenticacion';

        // Inicializar cURL
        $ch = curl_init($apiUrl);
        //var_dump($apiUrl);die;
        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: ' . $authToken,
        ]);

        // Ejecutar solicitud cURL
        $response = curl_exec($ch);

        // Verificar si hubo un error
        if (curl_errno($ch)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                                  ->setJSON(['error' => curl_error($ch)]);
        }

        // Cerrar cURL
        curl_close($ch);

        // Decodificar la respuesta JSON
        $jsonData = json_decode($response, true);
        //var_dump($data);die;
        // Verificar si la decodificación fue exitosa
        if (json_last_error() === JSON_ERROR_NONE) {
        
                
               
            


            //return $this->response->setStatusCode(ResponseInterface::HTTP_OK)->setJSON($data);
            return view('prepdf', ['jsonData' => $jsonData]);
        } else {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                                  ->setJSON(['error' => 'Error al decodificar JSON']);
        }
    }
}