<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentJobSerie;
use App\Models\Component\Indicator;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ComponentMetricValueController extends ApiController
{
    public function create($componentId)
    {


        $metrics = Input::all();

        foreach ($metrics as $metric)
        {

            Log::info(json_encode($metric));
            /*$job = new ComponentJobSerie();
            $job->name = $metric['name'];
            $job->type = $metric['type'];
            $job->external_id = $metric['id'];
            $job->component_id = $componentId;
            $job->save();*/
        }


        return $this->respondResourceCreated();

    }


}