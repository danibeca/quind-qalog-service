<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Component extends Model
{

    protected $fillable = ['id', 'type_id', 'app_code', 'quality_system_instance_id'];

    public function qualitySystemInstance()
    {
        return $this->belongsTo('\App\Models\QualitySystem\QualitySystemInstance', 'quality_system_instance_id');
    }

    public function getLeavesWithQSI()
    {
        $result = collect();
        $tree = ComponentTree::where('component_id', $this->id)->get()->first()->getDescendants();
        if ($tree->count() > 0)
        {
            $ids = $tree->pluck('component_id');
            $result = Component::whereIn('id', $ids)
                ->where('type_id', 3)
                ->with('qualitySystemInstance', 'qualitySystemInstance.qualitySystem')
                ->get();
        }

        return $result;

    }

    public function getLeaves()
    {
        $result = collect();
        $tree = ComponentTree::where('component_id', $this->id)->get()->first()->getDescendants();
        if ($tree->count() > 0)
        {
            $ids = $tree->pluck('component_id');
            $result = Component::whereIn('id', $ids)->where('type_id', 3)->get();

        }

        return $result;

    }

    public function calculateIndicators()
    {
        IndicatorValue::where('component_id', $this->id)->delete();
        MetricValue::where('component_id', $this->id)->delete();

        if($this->type_id != 3){
            Log::info($this->type_id);
            foreach (Metric::all() as $metric)
            {
                $value = 0;
                foreach ($this->getLeaves() as $leaf)
                {
                    $value = $value + $metric->calculate($leaf->id);
                }

                $newMetricValue = new MetricValue();
                $newMetricValue->component_id = $this->id;
                $newMetricValue->metric_id = $metric->id;
                $newMetricValue->value = $value;
                $newMetricValue->save();
            }
        }

        /** @var Indicator $indicator */
        foreach (Indicator::all()->sortBy('level') as $indicator){
               $indicator->calculate($this->id);
        }
    }

}
