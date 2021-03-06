<?php

namespace App\Models\Component;


use App\Models\Component\Metric;
use App\Utils\Models\Language\NameAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use JWadhams\JsonLogic;

class Indicator extends Model
{
    protected $appends = ['name'];
    use NameAttribute;


    public function calculate($componentId)
    {

        $result = 0;
        $indicatorValue = IndicatorValue::where('indicator_id', $this->id)->where('component_id', $componentId)->get()->first();

        if (! isset($indicatorValue))
        {


            $data = $this->calculation_data;

            foreach (json_decode($data) as $key => $attribute)
            {
                if (str_contains($key, '@ind_'))
                {
                    $subIndicator = $this->getDependencyByKey($key);
                    $data = str_replace($key . '.value', $subIndicator->calculate($componentId), $data);
                }
                if (str_contains($key, '@met_'))
                {
                    /** @var Metric $metric */
                    $metric = Metric::where('code', substr($key, 5, strlen($key)))->first();

                    $data = str_replace($key . '.value', $metric->calculate($componentId), $data);

                }
            }
            try
            {
                $result = JsonLogic::apply(json_decode($this->calculation_rule), json_decode($data));
            } catch (\Exception $e)
            {
                Log::info($e->getMessage());
                $result = 0;

            }
            $newIndicatorValue = new IndicatorValue();
            $newIndicatorValue->component_id = $componentId;
            $newIndicatorValue->indicator_id = $this->id;
            $newIndicatorValue->value = $result;
            $newIndicatorValue->save();


        } else
        {
            $result = $indicatorValue->value;
        }

        return $result;
    }

    public function getDependencyByKey($key)
    {
        return Indicator::where('code', substr($key, 5, strlen($key)))->first();
    }
}
