<?php

namespace App\Http\Controllers\Metric;


use App\Models\QualitySystem\QualitySystem;
use App\Http\Controllers\ApiController;

use Illuminate\Support\Facades\Input;

class ExternalMetricController extends ApiController
{
    public function index()
    {
        if (Input::has('qualitySystem'))
        {
            return $this->respond(QualitySystem::find(Input::get('qualitySystem'))->metrics()->get());
        }

    }


}