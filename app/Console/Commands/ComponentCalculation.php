<?php

namespace App\Console\Commands;


use App\Models\Component\Component;
use App\Models\Component\ComponentTree;
use App\Utils\Models\Language\SelectedLanguage;
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



        $mainComponentIds = ComponentTree::getRoots()->pluck('component_id');
        foreach ($mainComponentIds as $mainComponentId){
            $node = ComponentTree::find($mainComponentId);
            $parent = Component::find($node->component_id);
            $ids = $node->getDescendants()->pluck('component_id');
            $analyzableComponents = Component::whereIn('id', $ids)->get();
            $analyzableComponents = $analyzableComponents->push($parent);
            $analyzableComponents = $analyzableComponents->diff($parent->getLeaves());

            foreach ($analyzableComponents as $analyzableComponent){

                Log::info($analyzableComponent->calculateIndicators());
            }

        }


    }

}
