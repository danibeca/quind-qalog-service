<?php

namespace App\Models\Component;


use Agilin\Models\QualitySystem\Metric\Metric;
use App\Utils\Models\Language\NameAttribute;
use Illuminate\Database\Eloquent\Model;
use JWadhams\JsonLogic;

class Indicator extends Model
{
    protected $appends = ['name'];
    use NameAttribute;


    public function calculate($componentId)
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
                $metric = Metric::where('code', substr($key, 5, strlen($key)))->first();

                $data = str_replace($key . '.value', $metric->calculate($componentId), $data);
            }
        }
        $value = JsonLogic::apply(json_decode($this->calculation_rule), json_decode($data));

        //$this->saveIndicator($application, $value);
        return $value;
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
