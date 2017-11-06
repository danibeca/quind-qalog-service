<?php

namespace App\Http\Controllers\APIClient;


use App\Http\Controllers\ApiController;
use App\Models\APIClient\APIClient;
use App\Models\QualitySystem\QualitySystemInstance;
use App\Models\QualitySystem\QualitySystemInstanceResource;
use Illuminate\Support\Facades\Input;

class APIClientController extends ApiController
{
    public function show($code)
    {

        /** @var APIClient $client */
        $client = APIClient::where('code', $code)->get()->first();
        if (isset($client))
        {
            $qualitySystemInstance = QualitySystemInstance::where('api_client_id', $client->id)->get()->first();
            if (! $qualitySystemInstance->verified)
            {
                $qualitySystemInstance->verified = true;
                $qualitySystemInstance->save();
            }

            if (Input::has('resources_needed'))
            {
                //if ($qualitySystemInstance->type === 2)
                //{
                    $resourceCount = QualitySystemInstanceResource::where('quality_system_instance_id', $qualitySystemInstance->id)->count();
                    $resourceCount = ($resourceCount === 0)? 1 : $resourceCount;
                    return $this->respond(['check' => $resourceCount,
                                           'url' => $qualitySystemInstance->url,
                                           'username' => $qualitySystemInstance->username,
                                           'password' => $qualitySystemInstance->password

                    ]);
                //}
            }

            return $this->respond(false);
        }

        return $this->respondNotFound();
    }


}
