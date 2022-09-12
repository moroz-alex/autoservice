<?php

namespace App\Jobs;

use App\Models\Brand;
use App\Services\CarDataService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCarBrandsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $service;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CarDataService $service)
    {
        //
        $this->service = $service;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $brands = $this->service->importCarData('auto/categories/1/marks');
        foreach ($brands as $brand) {

            $newBrand = Brand::firstOrCreate(
                [
                    'source_id' => $brand->value,
                ],
                [
                    'title' => $brand->name,
                ],
            );

            ImportCarModelsJob::dispatch($this->service, $brand, $newBrand);
        }
    }
}
