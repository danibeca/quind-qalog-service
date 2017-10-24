<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{

    protected $fillable = ['id', 'type_id', 'app_code', 'quality_system_instance_id'];

    public function qualitySystemInstance()
    {
      return  $this->belongsTo('\App\Models\QualitySystem\QualitySystemInstance','quality_system_instance_id');
    }

    public function getDescendants()
    {
/*        $node = ComponentTree::where('component_id', $this->id)->get()->first();
        return Component::findMany($node->getDescendants()->pluck('component_id'))
            ->where('app_code', '!=',null)->with('qualitySystem');
*/
        $node = ComponentTree::where('component_id', $this->id)->get()->first();
        return Component::whereIn('id', $node->getDescendants()->pluck('component_id'))
            ->where('app_code', '!=',null)->with('qualitySystemInstance','qualitySystemInstance.qualitySystem')->get();
    }

}
