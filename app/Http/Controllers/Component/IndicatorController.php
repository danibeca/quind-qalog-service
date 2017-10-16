<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\Indicator;
use App\Utils\Models\Language\SelectedLanguage;
use App\Utils\Transformers\IndicatorTransformer;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use App\Models\Component\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

class IndicatorController extends ApiController
{
    public function index()
    {
        if (Input::has('ids'))
         {
             $result = collect();
             $ids = array_map('intval', explode(',', Input::get('ids')));

             /*foreach ($ids as $id)
             {
                 $result = $result->union([$id => Indicator::find($id)]);
             }*/

             return $this->respondData((new IndicatorTransformer())->transformCollection(Indicator::findMany($ids)->toArray()));

         }

        return $this->respondData((new IndicatorTransformer())->transformCollection(Indicator::all()->toArray()));

    }
}