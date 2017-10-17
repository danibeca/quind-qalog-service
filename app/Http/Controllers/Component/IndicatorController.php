<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\Indicator;
use App\Utils\Transformers\IndicatorTransformer;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Input;

class IndicatorController extends ApiController
{
    public function index()
    {
        if (Input::has('ids'))
        {
            $ids = array_map('intval', explode(',', Input::get('ids')));

            return $this->respondData((new IndicatorTransformer())->transformCollection(Indicator::findMany($ids)->toArray()));
        }

        return $this->respondData((new IndicatorTransformer())->transformCollection(Indicator::all()->toArray()));

    }
}