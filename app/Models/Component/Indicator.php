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
        $indicatorValue = IndicatorValue::where('indicator_id', $this->id)->get()->first();

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

            Log::info($this->calculation_rule);
            Log::info($this->calculation_rule);
            $result = JsonLogic::apply(json_decode($this->calculation_rule), json_decode($data));

            $newIndicatorValue = new IndicatorValue();
            $newIndicatorValue->component_id = $componentId;
            $newIndicatorValue->indicator_id = $this->id;
            $newIndicatorValue->value = $result;
            $newIndicatorValue->save();


        }else{
            $result = $indicatorValue->value;
        }

        return $result;
    }

    public function getDependencyByKey($key)
    {
        return Indicator::where('code', substr($key, 5, strlen($key)))->first();
    }
    /*
        public function calculateFromDB(Application $application, $date)
        {
            return $this->applications()
                ->where($this->appIdField, $application->id)
                ->wherePivot($this->registeredDateField, $date)
                ->get()->first()
                ->pivot->value;
        }

        public function saveIndicator(Application $application, $value)
        {
            $date = Carbon::now()->format('Y-m-d');
            if ($this->hasRecordOnDate($application, $date))
            {
                $this->applications()->where($this->appIdField, $application->id)
                    ->wherePivot($this->registeredDateField, $date)
                    ->updateExistingPivot($application->id, [$this->valueField => $value, $this->registeredDateField => $date]);
            } else
            {
                $this->applications()->save($application, [$this->valueField => $value, $this->registeredDateField => $date]);
            }
        }*/


}
