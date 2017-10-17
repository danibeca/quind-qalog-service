<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentTree;
use App\Models\Component\Indicator;
use App\Utils\Models\Language\SelectedLanguage;
use App\Utils\Transformers\IndicatorTransformer;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use Illuminate\Support\Facades\App;
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
            return $component->getDescendants();
        }
    }
}