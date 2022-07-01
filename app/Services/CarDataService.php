<?php

namespace App\Services;

use App\Components\ImportDataClient;
use GuzzleHttp\Exception\ClientException;

class CarDataService
{
    public function importCarData($uri)
    {

        $import = new ImportDataClient();
        try {
            $response = $import->client->request('GET', $uri);
        } catch (ClientException $e) {
            preg_match('/"code":\s"(\S+)",\s/', $e->getMessage(), $errorCode);
            abort($e->getResponse()->getStatusCode(), 'Ошибка обновления данных: ' . $errorCode[1]);
        }
        return json_decode($response->getBody()->getContents());
    }
}
