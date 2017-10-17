<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    public function getLeaves()
    {


    }

    public function getDescendants()
    {
        $node = ComponentTree::where('component_id', $this->id)->get()->first();
        return Component::findMany($node->getDescendants()->pluck('component_id'))
            ->where('app_code', '!=',null);

    }

}
