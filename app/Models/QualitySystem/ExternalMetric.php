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

    public function calculate($componentId)
    {
        $this->value = 0;

        $extenalMetricValue = ExternalMetricValue::where('external_metric_id', $this->id)
            ->where('component_id', $componentId)
            ->get()->first();
        if (isset($extenalMetricValue))
        {
            $this->value = $extenalMetricValue->value;

        }

        if ($this->type == 2)
        {
            $pattern = json_decode($this->pattern);
            if (isset($pattern->search))
            {
                $this->value = IssueValue::where('tags', 'like', '%' . $pattern->value . '%')
                    ->where('component_id', $componentId)
                    ->count();
            } else
            {
                $query = [];
                $count =  0;
                foreach ($pattern as $key => $value){
                    $query[$count]['column'] = $key;
                    $query[$count]['value'] = $value;
                    $count++;
                }
                $this->value = IssueValue::where($query[0]['column'] ,$query[0]['value'])
                    ->where($query[1]['column'] ,$query[1]['value'])
                    ->where('component_id', $componentId)
                    ->count();
            }

        }

        return $this->normalize($componentId);


    }

    public function normalize($componentId)
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
                $data = str_replace($key . '.value', $metricDependency->calculate($componentId), $data);
            }
        }

        return JsonLogic::apply(json_decode($this->normalization_rule), json_decode($data));
    }
}
