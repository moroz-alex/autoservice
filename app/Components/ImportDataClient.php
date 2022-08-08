<?php

namespace App\Components;

use App\Models\Settings;
use GuzzleHttp\Client;

class ImportDataClient
{
    public $client;

    /**
     * @param $client
     */
    public function __construct()
    {
        $settings = Settings::first();

        $this->client = new Client([
            'base_uri' => 'https://' . $settings->api_key . '@developers.ria.com/',
            'timeout' => 10.0,
        ]);
    }
}
