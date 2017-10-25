<?php

namespace App\Http\Controllers\Component;



use App\Models\QualitySystem\ExternalMetricValue;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ComponentMetricValueController extends ApiController
{
    public function create($componentId)
    {
        ExternalMetricValue::where('component_id', $componentId)->delete();

        $metrics = Input::all();

        foreach ($metrics as $metric)
        {
            $value = new ExternalMetricValue($metric);
            $value->component_id = $componentId;
            $value->save();
        }

        return $this->respondResourceCreated();

    }


}