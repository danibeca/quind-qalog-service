<?php

namespace App\Http\Controllers\APIClient;


use App\Http\Controllers\ApiController;
use App\Models\APIClient\APIClient;

class APIClientComponentController extends ApiController
{
    public function index($code){

        /** @var APIClient $client */
        $client = APIClient::where('code', $code)->get()->first();
        if(isset($client)){
            return $this->respond($client->qualitySystemInstances()->get()->pluck('component_owner_id'));
        }
        return $this->respondNotFound();
    }

}
