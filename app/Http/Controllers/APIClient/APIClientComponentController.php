<?php

namespace App\Http\Controllers\APIClient;


use App\Http\Controllers\ApiController;
use App\Models\APIClient\APIClient;
use App\Models\Component\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;

class APIClientComponentController extends ApiController
{
    public function index($code){

        /** @var APIClient $client */
        $client = APIClient::where('code', $code)->get()->first();
        if(isset($client)){
            $ownerIds = $client->qualitySystemInstances()->get()->pluck('component_owner_id');
            $rootIds = Component::
            whereIn('id', $ownerIds)
                ->Where(function ($query) {
                    $query->where('run_client', 1)
                        ->orWhere('last_run_client', '<=', Carbon::now()->subHours(12));
                })->get()->pluck('id');
            return $this->respond($rootIds);
        }
        return $this->respondNotFound();
    }

    public function update(Request $request,$code)
    {
            $component = Component::find($code);
            if(isset($component)){
                $component->last_run_client = Carbon::now();
                $component->run_client = false;
                $component->run_quind = true;
                $component->save();

            }

            return $this->respond('OK');
    }

}
