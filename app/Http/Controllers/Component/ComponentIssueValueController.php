<?php

namespace App\Http\Controllers\Component;

use App\Models\Component\ComponentJobSerie;
use App\Models\Component\Indicator;
use App\Models\QualitySystem\IssueValue;
use App\Utils\Transformers\IndicatorSerieTransformer;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ComponentIssueValueController extends ApiController
{
    public function create($componentId)
    {
        IssueValue::where('component_id', $componentId)->delete();
        $issues = Input::all();
        foreach ($issues as $issue)
        {
            //TODO Change to Async
            $value = new IssueValue($issue);
            $value->component_id = $componentId;
            $value->tags = json_encode($issue['tags']);
            $value->save();
        }

        return $this->respondResourceCreated();
    }


}