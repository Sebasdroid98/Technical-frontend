<?php
namespace App\Services;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;

class ServiceControl {
    protected $clientHttp;
    public $headers;

    public function __construct() {
        $this->inicializarCliente();
    }

    public function inicializarCliente() {
        $this->clientHttp = new Client(['base_uri' => 'http://laravel_api/public/']);
        $this->headers = [
            'Accept' => 'application/json',
            'Authorization' => ''
        ];
    }

    public function setAuthorizationToken($token) {
        $this->headers['Authorization'] = 'Bearer ' . $token;
    }

    private function realizarPeticion($method, $route, $paramsURL = null, $dataRequest = null) {
        $finalRoute = $route . ($paramsURL ? '/' . $paramsURL : '');
        $options = ['headers' => $this->headers];
        if ($dataRequest !== null) {
            $options['json'] = $dataRequest;
        }

        try {
            $response = $this->clientHttp->request($method, $finalRoute, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return $this->manejoErrores($e);
        }
    }

    public function peticionGET($route, $paramsURL = null) {
        return $this->realizarPeticion('GET', $route, $paramsURL);
    }

    public function peticionPOST($route, $dataRequest) {
        return $this->realizarPeticion('POST', $route, null, $dataRequest);
    }

    public function peticionPUT($route, $paramsURL, $dataRequest) {
        return $this->realizarPeticion('PUT', $route, $paramsURL, $dataRequest);
    }

    public function peticionDELETE($route, $paramsURL = null) {
        return $this->realizarPeticion('DELETE', $route, $paramsURL);
    }

    public function manejoErrores(RequestException $exception) {
        $statusCode = $exception->getResponse() ? $exception->getResponse()->getStatusCode() : 'N/A';
        $apiErrorMessage = $exception->getMessage();
        return [
            'errorAPI' => [
                'code' => 'api' . $statusCode,
                'message' => $this->reconocerErrorAPI($statusCode, $apiErrorMessage)
            ]
        ];
    }

    public function reconocerErrorAPI($code, $msgApi = null) {
        $messages = [
            401 => 'No está autorizado para obtener el recurso.',
            404 => 'No se puede obtener el recurso.',
            429 => 'Se hicieron muchas peticiones.',
            500 => 'Fallo al conectar al servidor.'
        ];
        return ($messages[$code] ?? 'Error sin parametrizar.') . ' (CODE: API-' . $code . ') -> ' . $msgApi;
    }
}
