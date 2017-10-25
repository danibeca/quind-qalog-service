<?php


namespace App\Utils\Models;


use App\Models\Component\QualityAttribute;
use App\Models\QualitySystem\IssueValue;
use Illuminate\Support\Facades\Log;

class CalculatorQA
{


    public function calculate($componentId, $result)
    {

        $issueImpacts = $this->getImpactArray();
        $qualityAttributes = QualityAttribute::all();

        foreach ($issueImpacts as $key => $issueImpact)
        {
            $issues = IssueValue::where('component_id', $componentId)->where('severity',$issueImpact)->get();
            foreach ($issues as $issue)
            {
                $effort = $this->getEffortQualified($issue->effort);
                $assigned = false;
                foreach ($qualityAttributes as $qualityAttribute)
                {
                    foreach (json_decode($issue->tags) as $tag)
                    {

                        if ($qualityAttribute->tags->pluck('name')->contains($tag) && ! $assigned)
                        {
                            if (! isset($result[$key . '-' . $effort . '-' . $qualityAttribute->id]))
                            {
                                $result[$key . '-' . $effort . '-' . $qualityAttribute->id] = 0;
                            }
                            $result[$key . '-' . $effort . '-' . $qualityAttribute->id]++;
                            $assigned = true;
                            break;
                        }

                    }

                    /* if ($qualityAttribute->rules->pluck('name')->contains($issue->rule->name) && ! $assigned)
                     {
                         if (! isset($result[$issueImpact->id . '-' . $effort . '-' . $qualityAttribute->id]))
                         {
                             $result[$issueImpact->id . '-' . $effort . '-' . $qualityAttribute->id] = 0;
                         }
                         $result[$issueImpact->id . '-' . $effort . '-' . $qualityAttribute->id]++;
                         $assigned = true;
                         break;
                     }*/

                }

            }
        }

        return $result;


    }


    public function getEffortQualified($effort)
    {
        $result = 0;
        if ($effort <= 30)
        {
            $result = 1;
        } else if ($effort > 30 && $effort <= 180)
        {
            $result = 2;
        } else if ($effort > 180 && $effort <= 360)
        {
            $result = 3;
        } else if ($effort > 360 && $effort <= 720)
        {
            $result = 4;
        } else
        {
            $result = 5;
        }

        return $result;

    }


    public function getImpactArray()
    {
        return [1 => 'INFO', 2 => 'MINOR', 3 => 'MAJOR', 4 => 'CRITICAL', 5 => 'BLOCKER'];
    }

}