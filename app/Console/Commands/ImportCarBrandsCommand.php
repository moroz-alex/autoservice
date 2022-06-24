<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use Illuminate\Console\Command;

class ImportCarBrandsCommand extends Command
{

    protected $signature = 'import:carbrands';

    protected $description = 'Import car brands from AUTO.RIA';

    public function handle()
    {
        $import = new ImportDataClient();
        $response = $import->client->request('GET', 'auto/categories/1/marks');
        dd(json_decode($response->getBody()->getContents()));
    }
}
