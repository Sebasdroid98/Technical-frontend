<?php
namespace App\Services;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client; // Se importa la libreria Guzzle

class ServiceControl{

    protected $client;
    protected $baseUri;
    public $headers;

    public function __construct(){
        $this->headers = array(
            'Accept'        => 'application/json',
            'Authorization' => ''
        );
    }

    /**
     * Funcion para el metodo GET
     * @param String $route -> con la ruta a usar
     * @param String $paramsURL -> con los parametros para la ruta si los tiene
     */
    public function peticionGET(String $route, String $paramsURL = null)
    {
        $this->client = new Client(['base_uri' =>  env('APIREST_URL')]);

        /* Se envia token del api */
        // $this->headers['Authorization'] = 'Bearer ' . session('tokenAPI');

        $finalRoute = $route;
        if ($paramsURL != null) { $finalRoute = $finalRoute.'/'.$paramsURL; }

        try {
            $rtaApi = $this->client->request('GET', $finalRoute, [
                'headers' => $this->headers
            ]);
            return json_decode($rtaApi->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return $this->manejoErrores($e);
        }
    }

    /**
     * Funcion para el metodo POST
     * @param String $route -> con la ruta a usar
     * @param Array $dataRequest -> con los parametros del Body de la peticion
     */
    public function peticionPOST(String $route, Array $dataRequest)
    {
        $this->client = new Client(['base_uri' =>  env('APIREST_URL')]);

        /* Se envia token del api */
        // $this->headers['Authorization'] = 'Bearer ' . session('tokenAPI');

        try {
            $rtaApi = $this->client->request('POST', $route, [
                'json' => $dataRequest,
                'headers' => $this->headers
            ]);
            return json_decode($rtaApi->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return $this->manejoErrores($e);
        }
    }

    /**
     * Funcion para el metodo POST
     * @param String $route -> con la ruta a usar
     * @param String $paramsURL -> con los parametros para la ruta si los tiene
     * @param Array $dataRequest -> con los parametros del Body de la peticion
     */
    public function peticionPUT(String $route, String $paramsURL, Array $dataRequest)
    {
        $this->client = new Client(['base_uri' =>  env('APIREST_URL')]);

        /* Se envia token del api */
        // $this->headers['Authorization'] = 'Bearer ' . session('tokenAPI');

        $finalRoute = $route;
        if ($paramsURL != null) { $finalRoute = $finalRoute.'/'.$paramsURL; }

        try {
            $rtaApi = $this->client->request('PUT', $finalRoute, [
                'json' => $dataRequest,
                'headers' => $this->headers
            ]);
            return json_decode($rtaApi->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return $this->manejoErrores($e);
        }
    }
    
    /**
     * Funcion para el metodo DELETE
     * @param String $route -> con la ruta a usar
     * @param String $paramsURL -> con los parametros para la ruta si los tiene
     */
    public function peticionDELETE(String $route, String $paramsURL = null)
    {
        $this->client = new Client(['base_uri' => env('APIREST_URL')]);

        /* Se envia token del api */
        // $this->headers['Authorization'] = 'Bearer ' . session('tokenAPI');

        $finalRoute = $route;
        if ($paramsURL != null) {
            $finalRoute = $finalRoute . '/' . $paramsURL;
        }

        try {
            $rtaApi = $this->client->request('DELETE', $finalRoute, [
                'headers' => $this->headers
            ]);
            return json_decode($rtaApi->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return $this->manejoErrores($e);
        }
    }

    /**
     * Funcion para reconocer el error
     * @param Int $codeError -> con el codigo de error
     * @param String $msgApi -> con el mensaje de error del api
     * @return String $msg -> con el mensaje correspondiente
     */
    public function reconocerErrorAPI($code,$msgApi = null)
    {
        $msg = '';
        switch ($code) {
            case 401:
                $msg = 'No esta autorizado para obtener el recurso. (CODE: API-401) -> '.$msgApi;
                break;

            case 404:
                $msg = 'No se puede obtener el recurso. (CODE: API-404) -> '.$msgApi;
                break;

            case 429:
                $msg = 'Se hicieron muchas peticiones. (CODE: API-429) -> '.$msgApi;
                break;

            case 500:
                $msg = 'Fallo al conectar al servidor. (CODE: API-500) -> '.$msgApi;
                break;

            default:
                $msg = 'Error sin parametrizar. (CODE: API-OTH) -> '.$msgApi;
                break;
        }
        return $msg;
    }

    /**
     * Función para retornar el detalle de la excepcion/error en las peticiones
     * @param RequestException $e con los detalles de la excepcion
     * @return Array con el resultado del analisis
     */
    public function manejoErrores(RequestException $exception)
    {
        // dd($exception);
        $statusCode = $exception->getResponse()->getStatusCode();
        $apiErrorMessage = $exception->getMessage();

        return json_decode(
            json_encode([
                'errorAPI' => [
                    'code' => 'api'.$statusCode,
                    'message' => $this->reconocerErrorAPI($statusCode,$apiErrorMessage)
                ]
            ])
        ,true);
    }

}
