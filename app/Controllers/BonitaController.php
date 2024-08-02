<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class BonitaController extends BaseController
{
    private $bonitaUrl = 'http://localhost:8080/bonita'; // URL del servidor de Bonita BPM

    public function authenticate()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $ch = curl_init();
        $data = [
            'username' => $username,
            'password' => $password
        ];

        curl_setopt($ch, CURLOPT_URL, $this->bonitaUrl . '/loginservice');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $matches);
        $cookies = [];
        foreach ($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }

        curl_close($ch);
        if (isset($cookies['JSESSIONID'])) {
            return $this->response->setJSON(['status' => 'success', 'cookies' => $cookies]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Authentication failed']);
        }
    }

    public function startProcess()
    {
        $processDefinitionId = $this->request->getVar('processDefinitionId');
        $cookies = $this->request->getVar('cookies');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->bonitaUrl . "/API/bpm/process/$processDefinitionId/instantiation");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Bonita-API-Token: ' . $cookies['X-Bonita-API-Token']
        ]);
        curl_setopt($ch, CURLOPT_COOKIE, 'JSESSIONID=' . $cookies['JSESSIONID'] . '; X-Bonita-API-Token=' . $cookies['X-Bonita-API-Token']);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            return $this->response->setJSON(['status' => 'success', 'response' => json_decode($response, true)]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to start process', 'response' => json_decode($response, true)]);
        }
    }

    public function executeTask()
    {
        $taskId = $this->request->getVar('taskId');
        $cookies = $this->request->getVar('cookies');
        $data = $this->request->getVar('data');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->bonitaUrl . "/API/bpm/userTask/$taskId/execution");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Bonita-API-Token: ' . $cookies['X-Bonita-API-Token']
        ]);
        curl_setopt($ch, CURLOPT_COOKIE, 'JSESSIONID=' . $cookies['JSESSIONID'] . '; X-Bonita-API-Token=' . $cookies['X-Bonita-API-Token']);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            return $this->response->setJSON(['status' => 'success', 'response' => json_decode($response, true)]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to execute task', 'response' => json_decode($response, true)]);
        }
    }
}