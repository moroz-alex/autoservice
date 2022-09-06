<?php

namespace App\Jobs;

use App\Models\CarModel;
use App\Services\CarDataService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCarModelsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $brand;
    private $service;
    private $newBrand;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CarDataService $service, $brand, $newBrand)
    {
        $this->brand = $brand;
        $this->service = $service;
        $this->newBrand = $newBrand;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $models = $this->service->importCarData('auto/categories/1/marks/' . $this->brand->value . '/models/');
        foreach ($models as $model) {
            CarModel::firstOrCreate(
                [
                    'source_id' => $model->value,
                ],
                [
                    'brand_id' => $this->newBrand->id,
                    'title' => $model->name,
                ],
            );
        }
    }
}
