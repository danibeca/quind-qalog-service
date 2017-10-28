<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use App\Models\Component\ComponentTree;
use App\Utils\Transformers\SimpleComponentTransformer;
use Illuminate\Http\Request;


class ComponentController extends ApiController
{

    public function index()
    {
        if (Input::has('parent_id'))
        {
            /** @var ComponentTree $node */
            $node = ComponentTree::find(Input::get('parent_id'));

            /** @var Component $parent */
            $parent = Component::find($node->component_id);
            $ids = $node->getDescendants()->pluck('component_id');
            /** @var Component $result */
            $result = Component::whereIn('id', $ids)->get();
            if (Input::has('self_included') && Input::get('self_included'))
            {
                $result = $result->push($parent);
            }

            if (Input::has('no_leaves'))
            {
                $result = $result->diff($parent->getLeaves());
            }

            if (Input::has('only_leaves'))
            {
                $result = Component::find(Input::get('parent_id'))->getLeaves();
            }

            return $this->respondData((new SimpleComponentTransformer())->transformCollection(array_values($result->sortBy('tag_id')->toArray())));
        }

        return $this->respondNotFound();
    }

    public function store(Request $request)
    {
        $newComponent = new Component ($request->except('parent_id'));
        $newComponent->save();
        $newComponentTree = new ComponentTree();
        if ($request->has('parent_id') && $request->type_id !== 1)
        {
            $newComponentTree->component_id = $newComponent->id;
            $newComponentTree->appendToNode(ComponentTree::where('component_id', $request->parent_id)->first())->save();

            /** @var Component $root */
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
