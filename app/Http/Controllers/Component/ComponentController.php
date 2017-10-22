<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use App\Models\Component\ComponentTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ComponentController extends ApiController
{

    public function store(Request $request)
    {
        $newComponent = new Component ($request->except('parent_id'));
        $newComponent->save();
        if ($request->has('parent_id') && $request->type_id !== 1)
        {
            $newComponentTree = new ComponentTree();
            $newComponentTree->component_id = $newComponent->id;
            $newComponentTree->appendToNode(ComponentTree::where('component_id', $request->parent_id)->first())->save();

        } else
        {
            $newComponentTree = new ComponentTree();
            $newComponentTree->component_id = $newComponent->id;
            $newComponentTree->saveAsRoot();
        }

        ComponentTree::fixTree();

        return $this->respondResourceCreated();

    }

}
