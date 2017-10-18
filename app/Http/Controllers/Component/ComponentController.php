<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentTree;
use App\Utils\Transformers\ComponentTransformer;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use Illuminate\Support\Facades\Input;

class ComponentController extends ApiController
{
    public function index()
    {

    }

    public function show($componentId)
    {
        ComponentTree::fixTree();
        if (Input::has('leaves'))
        {
            $component = Component::find($componentId);
            return $this->respondData((New ComponentTransformer())->transformCollection($component->getDescendants()->toArray()));
        }
    }
}