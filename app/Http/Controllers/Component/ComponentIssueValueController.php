<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentJobSerie;
use App\Models\Component\Indicator;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ComponentIssueValueController extends ApiController
{
    public function create($componentId)
    {

        $issues = Input::all();

        foreach ($issues as $issue)
        {

            Log::info(json_encode($issue));
            /*$job = new ComponentJobSerie();
            $job->name = $metric['name'];
            $job->type = $metric['type'];
            $job->external_id = $metric['id'];
            $job->component_id = $componentId;
            $job->save();*/
        }


        return $this->respondResourceCreated();
    }


}