<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Component extends Model
{

    protected $fillable = ['id', 'type_id', 'app_code', 'quality_system_instance_id'];

    public function qualitySystemInstance()
    {
      return  $this->belongsTo('\App\Models\QualitySystem\QualitySystemInstance','quality_system_instance_id');
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
                ->with('qualitySystemInstance','qualitySystemInstance.qualitySystem')
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
        foreach (Indicator::all()->sortBy('level') as $indicator){
            $indicator->calculate($this->id);
        }

    }

}
