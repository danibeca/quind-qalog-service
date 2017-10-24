<?php

namespace App\Http\Controllers\Component;


use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use App\Utils\Transformers\QualitySystemInstanceTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ComponentQualitySystemController extends ApiController
{
    /*
    public function index($componentId)
    {
        if(Input::has('resources')){
            $qa = Component::find($componentId)->qualitySystem()->get();
            if(!is_null($qa)){
                return $this->respondData($qa->resources());
            }else{
                return $this->respondData([]);
            }

        }
        return $this->respondData((new QualitySystemInstanceTransformer())
            ->transformCollection(Component::find($componentId)->qualitySystemInstance()->get()->toArray()));
    }*/

    /*
    public function store(Request $request, $componentId)
    {
        $component = Component::find($componentId);
        $verified = ($request->has('verified')) ? $request->verified : false;

        $component->qualitySystems()
            ->attach($request->id,
                ['url' => $request->url, 'type' => $request->type, 'verified' => $verified]);

        return $this->respondResourceCreated();
    }
    */
}
