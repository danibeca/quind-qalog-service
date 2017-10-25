<?php

namespace App\Models\QualitySystem;

use App\Utils\Models\AttributeValue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use JWadhams\JsonLogic;

class ExternalMetric extends Model
{
    protected $appends = ['value'];

    use AttributeValue;

    public function calculate()
    {

        $extenalMetricValue = ExternalMetricValue::where('external_metric_id', $this->id)->get()->first();
        if(isset($extenalMetricValue)){
            $this->value = $extenalMetricValue->value;
            return $this->normalize();
        }

        if($this->type == 2){
            $pattern = json_decode($this->pattern);
            if(isset($pattern->search)){
                Log::info(IssueValue::where('tags','like','%'.$pattern->value.'%')->count());
            }

        }

        return 0;
    }

    public function normalize()
    {
        $data = $this->normalization_data;
        foreach (json_decode($data) as $key => $attribute)
        {
            if (str_contains($key, '@this'))
            {
                $data = str_replace($key . '.value', $this->value, $data);
            }
            if (str_contains($key, '@ext_'))
            {
                /** @var ExternalMetric $metricDependency */
                $metricDependency = ExternalMetric::where('code', substr($key, 5, strlen($key)))->first();
                $data = str_replace($key . '.value', $metricDependency->calculate(), $data);
            }
        }
        return JsonLogic::apply(json_decode($this->normalization_rule), json_decode($data));
    }
}
