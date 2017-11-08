<?php

namespace App\Models\Component;

use App\Models\QualitySystem\ExternalMetric;
use Illuminate\Database\Eloquent\Model;


class Metric extends Model
{


    public function calculate($componentId)
    {

        $result = 0;
        $metricValue = MetricValue::where('metric_id', $this->id)
            ->where('component_id', $componentId)
            ->get()->first();
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
        return $result;
    }

    public function calculateFromExternalMetric($componentId)
    {
        $component = Component::find($componentId);
        if(isset($component, $component->qualitySystemInstance,$component->qualitySystemInstance->qualitySystem)){
            $systemId = $component->qualitySystemInstance->qualitySystem->id;
            /** @var ExternalMetric $externalMetric */
            $externalMetric = ExternalMetric::where('metric_id', $this->id)->where('quality_system_id', $systemId)->get()->first();
            return $externalMetric->calculate($componentId);
        }
        return 0;
    }
}
