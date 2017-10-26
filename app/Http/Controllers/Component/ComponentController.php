<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use App\Models\Component\ComponentTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ComponentController extends ApiController
{

    public function store(Request $request)
    {
        $newComponent = new Component ($request->except('parent_id'));
        $newComponent->save();
        $newComponentTree = new ComponentTree();
        if ($request->has('parent_id') && $request->type_id !== 1)
        {
            $newComponentTree->component_id = $newComponent->id;
            $newComponentTree->appendToNode(ComponentTree::where('component_id', $request->parent_id)->first())->save();
            $root = Component::find(ComponentTree::where('component_id', $request->parent_id)
                ->get()->first()->getRoot()->component_id);
            $root->run_client = true;
            $root->save();

        } else
        {
            $newComponentTree->component_id = $newComponent->id;
            $newComponentTree->saveAsRoot();
        }

        ComponentTree::fixTree();


        return $this->respondResourceCreated();
    }

}
