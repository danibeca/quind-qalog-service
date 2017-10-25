<?php

namespace App\Models\Component;


use App\Models\Component\MetricValue;
use App\Models\QualitySystem\ExternalMetric;

use App\Models\QualitySystem\ExternalMetricValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Metric extends Model
{


    public function calculate($componentId)
    {

        $result = 0;
        $metricValue = MetricValue::where('metric_id', $this->id)->get()->first();
        if (! isset($metricValue))
        {
            $result = $this->calculateFromExternalMetric($componentId);
            $newMetricValue = new MetricValue();
            $newMetricValue->component_id = $componentId;
            $newMetricValue->metric_id = $this->id;
            $newMetricValue->value = $result;
            $newMetricValue->save();

        }else{
            $result = $metricValue->value;
        }
        Log::info('ValueMetric'.$result);
        //return $result->value;
    }

    public function calculateFromExternalMetric($componentId)
    {
        $systemId = Component::find($componentId)->qualitySystemInstance->qualitySystem->id;
        /** @var ExternalMetric $externalMetric */
        $externalMetric = ExternalMetric::where('metric_id', $this->id)->where('quality_system_id', $systemId)->get()->first();
        return $externalMetric->calculate();

    }
}
