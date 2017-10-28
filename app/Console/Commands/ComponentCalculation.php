<?php

namespace App\Console\Commands;


use App\Models\Component\Indicator;
use App\Models\Component\IndicatorValue;

use App\Models\Component\Component;
use App\Models\Component\ComponentTree;
use App\Models\QualitySystem\IssueValue;
use App\Utils\Models\CalculatorQA;
use App\Utils\Models\Language\SelectedLanguage;
use App\Wrappers\QuindWrapper\HTTPWrapper;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ComponentCalculation extends Command
{


    protected $signature = 'component:calculate';
    protected $description = 'Calculate component indicators';
    protected $accounts;

    public function handle()
    {
        App::singleton(SelectedLanguage::class);
        $instance = App::make(SelectedLanguage::class);
        $instance->setLanguageId(1);

        $qastaURL = env('QASTA_ENDPOINT');

        $mainComponentIds = Component::
        whereIn('id', ComponentTree::getRoots()->pluck('component_id'))
            ->Where(function ($query) {
                $query->where('run_quind', 1)
                    ->orWhere('last_run_quind', '<=', Carbon::now()->subHours(12));
            })->get()->pluck('id');


        foreach ($mainComponentIds as $mainComponentId)
        {

            /** @var ComponentTree $node */
            $node = ComponentTree::where('component_id', $mainComponentId)->get()->first();
            $parent = Component::find($mainComponentId);
            $parent->last_run_quind = Carbon::now();
            $parent->run_quind = false;
            $parent->save();
            $ids = $node->getDescendants()->pluck('component_id');
            $analyzableComponents = Component::whereIn('id', $ids)->get();
            $analyzableComponents = $analyzableComponents->push($parent);

            /** @var Component $analyzableComponent */
            foreach ($analyzableComponents->sortByDesc('type_id') as $analyzableComponent)
            {
                $this->sendIndicators($analyzableComponent, $qastaURL);
                $this->sendQA($analyzableComponent, $qastaURL);
                $this->sendInfo($analyzableComponent, $qastaURL);
            }

        }


    }

    public function sendIndicators(Component $analyzableComponent, $qastaURL)
    {


        $analyzableComponent->calculateIndicators();

        $values = IndicatorValue::where('component_id', $analyzableComponent->id)->get();
        $indicatorValueService = '/components/' . $analyzableComponent->id . '/indicator-values';
        $wrapper = new HTTPWrapper();
        $wrapper->post($qastaURL . $indicatorValueService, $values);
    }

    public function sendQA(Component $analyzableComponent, $qastaURL)
    {
        $attributeValueService = '/components/' . $analyzableComponent->id . '/quality-attribute-values';

        $calculator = new CalculatorQA();
        $result = [];
        if ($analyzableComponent->type_id == 3)
        {
            $result = $calculator->calculate($analyzableComponent->id, []);
        } else
        {
            foreach ($analyzableComponent->getLeaves() as $leaf)
            {
                $result = $calculator->calculate($leaf->id, $result);
            }
        }

        foreach ($result as $key => $value)
        {
            $info = explode('-', $key);
            $qadata = [];
            $qadata['impact'] = $info[0];
            $qadata['effort'] = $info[1];
            $qadata['attribute_id'] = $info[2];
            $qadata['quantity'] = $value;
            $qadata['component_id'] = $analyzableComponent->id;

            $wrapper = new HTTPWrapper();
            $wrapper->post($qastaURL . $attributeValueService, $qadata);

        }
    }

    public function sendInfo(Component $analyzableComponent, $qastaURL)
    {
        $infoService = '/components/' . $analyzableComponent->id . '/information-values';

        $systems = 0;
        $debt = 0;
        $applications = 0;
        if ($analyzableComponent->type_id != 3)
        {
            $leaves = $analyzableComponent->getLeaves();
            $totalNodes = ComponentTree::where('component_id', $analyzableComponent->id)->get()->first()->getDescendants()->count();
            $applications = $leaves->count();
            $systems = $totalNodes - $applications;
            foreach ($leaves as $leaf)
            {
                $debt = $debt + IssueValue::where('component_id', $leaf->id)->get()->sum('effort');
            }
        } else
        {
            $debt = IssueValue::where('component_id', $analyzableComponent->id)->get()->sum('effort');
        }

        $qadata = [];
        $qadata['systems'] = $systems;
        $qadata['applications'] = $applications;
        $qadata['debt'] = $debt;

        $wrapper = new HTTPWrapper();
        $wrapper->post($qastaURL . $infoService, $qadata);

    }
}
