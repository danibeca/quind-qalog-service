<?php

namespace App\Http\Controllers\APIClient;


use App\Http\Controllers\ApiController;
use App\Models\APIClient\APIClient;
use App\Models\Component\Component;
use App\Models\QualitySystem\QualitySystemInstance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class APIClientComponentController extends ApiController
{
    public function index($code)
    {

        /** @var APIClient $client */
        $client = APIClient::where('code', $code)->get()->first();
        if (isset($client))
        {
            $qualitySystemInstance = QualitySystemInstance::where('api_client_id', $client->id)->get()->first();
            if ($qualitySystemInstance && ! $qualitySystemInstance->verified)
            {
                $qualitySystemInstance->verified = true;
                $qualitySystemInstance->save();
            }

            $ownerIds = $client->qualitySystemInstances()->get()->pluck('component_owner_id');
            $roots = Component::
            whereIn('id', $ownerIds)
                ->Where(function ($query) {
                    $query->where('run_client', 1)
                        ->orWhere('last_run_client', '<=', Carbon::now()->subHours(12));
                })->get();

            foreach ($roots as $root)
            {
                $root->run_client = 2;
                $root->save();
            }

            return $this->respond($roots->pluck('id'));
        }

        return $this->respondNotFound();
    }

    public function update(Request $request, $code)
    {
        $component = Component::find($code);
        if (isset($component))
        {
            $component->last_run_client = Carbon::now();
            if($component->run_client === 2){
                $component->run_client = 0;
            }
            $component->run_quind = 1;
            $component->save();

        }

        return $this->respond('OK');
    }

}
