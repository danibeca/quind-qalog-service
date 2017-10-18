<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{

    public function qualitySystem()
    {
      return  $this->belongsTo('\App\Models\QualitySystem\QualitySystem');
    }

    public function getDescendants()
    {
/*        $node = ComponentTree::where('component_id', $this->id)->get()->first();
        return Component::findMany($node->getDescendants()->pluck('component_id'))
            ->where('app_code', '!=',null)->with('qualitySystem');
*/
        $node = ComponentTree::where('component_id', $this->id)->get()->first();
        return Component::whereIn('id', $node->getDescendants()->pluck('component_id'))
            ->where('app_code', '!=',null)->with('qualitySystem')->get();
    }

}
