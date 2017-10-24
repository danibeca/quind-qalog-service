<?php

namespace Agilin\Models\QualitySystem\Metric;


use App\Models\Component\MetricValue;
use App\Utils\Models\AttributeValue;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model {

    protected $table = 'metric';
    protected $appends = ['value'];
    public $timestamps = false;

    use AttributeValue;

    public function calculate($componentId)
    {
        $result = MetricValue::where('metric_id', $this->id)->get->first();
        if(!isset($result)){
            $result  = $this->calculateFromExternalMetric($componentId);
        }

        return $result;
    }
}
