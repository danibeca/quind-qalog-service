<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentJobSerie;
use App\Models\Component\Indicator;
use App\Models\Component\MetricValue;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ComponentMetricValueController extends ApiController
{
    public function create($componentId)
    {
        MetricValue::where('component_id', $componentId)->delete();

        $metrics = Input::all();

        foreach ($metrics as $metric)
        {
            $value = new MetricValue($metric);
            $value->component_id = $componentId;
            $value->save();
        }

        return $this->respondResourceCreated();

    }


}