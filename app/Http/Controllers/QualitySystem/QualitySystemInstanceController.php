<?php

namespace App\Http\Controllers\QualitySystem;


use App\Http\Controllers\ApiController;
use App\Models\APIClient\APIClient;
use App\Models\QualitySystem\QualitySystemInstance;
use App\Utils\Transformers\QualitySystemInstanceTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class QualitySystemInstanceController extends ApiController {


    public function index()
    {
        $result = collect();
        if (Input::has('component_id') && Input::has('with_no_used_resources'))
        {
            $instances = QualitySystemInstance::with('qualitySystem')
                ->where('component_owner_id', Input::get('component_id'))->get();
            foreach ($instances as $instance)
            {
                $instance->resources = $instance->getNoUsedResources();
                $result->push($instance);
            }

            return $this->respondData($result);
        }

        if (Input::has('component_id') && Input::has('with_resources'))
        {
            $instances = QualitySystemInstance::with('qualitySystem')
                ->where('component_owner_id', Input::get('component_id'))->get();
            foreach ($instances as $instance)
            {
                $instance->resources = $instance->getResources();
                $result->push($instance);
            }

            return $this->respondData($result);
        }


        if (Input::has('component_id'))
        {
            return $this->respondData((new QualitySystemInstanceTransformer())
                ->transformCollection(
                    QualitySystemInstance::with('qualitySystem')->where('component_owner_id', Input::get('component_id'))->get()
                        ->toArray()));
        }
    }

    public function show($instanceId)
    {

        $qa = QualitySystemInstance::find($instanceId);
        if (Input::has('resources'))
        {

            if (! is_null($qa))
            {
                //FIX THIS
                return $this->respondData($qa->getResources());
            } else
            {
                return $this->respondData([]);
            }

        }

        return $this->respondData($qa);

    }

    public function store(Request $request)
    {

        $verified = ($request->has('verified')) ? $request->verified : false;
        $qsi = new QualitySystemInstance();
        $qsi->quality_system_id = $request->quality_system_id;
        $qsi->url = $request->url;
        $qsi->type = $request->type;
        $qsi->verified = $verified;
        $qsi->component_owner_id = $request->component_id;
        if ($request->has('username') && ! empty($request->username))
        {
            $qsi->username = $request->username;
            $qsi->password = $request->password;
        }

        if ($request->type == 1)
        {
            $qsi->api_client_id = 1;
        } else
        {
            $newClient = new APIClient();
            $newClient->code = str_replace('.', '', str_replace('/', '', password_hash($request->url . strtotime(date('Y-m-d H:i:s')), PASSWORD_BCRYPT)));
            $newClient->save();
            $qsi->api_client_id = $newClient->id;
        }
        $qsi->save();

        return $this->respondResourceCreated();
    }


    public function update(Request $request, $id)
    {
        $qsi = QualitySystemInstance::find($id);
        if (isset($qsi))
        {
            $verified = ($request->has('verified')) ? $request->verified : false;
            $qsi->quality_system_id = $request->quality_system_id;
            $qsi->url = $request->url;
            $oldType = $qsi->type;
            $qsi->type = $request->type;
            $qsi->verified = $verified;

            if ($request->has('username') && ! empty($request->username))
            {
                $qsi->username = $request->username;
                $qsi->password = $request->password;

            } else
            {
                $qsi->username = null;
                $qsi->password = null;
            }

            if ($request->type == 1)
            {
                $qsi->api_client_id = 1;
            }
            else if($oldType == 1)
            {
                $newClient = new APIClient();
                $newClient->code = str_replace('/', '', password_hash($request->url . strtotime(date('Y-m-d H:i:s')), PASSWORD_BCRYPT));
                $newClient->save();
                $qsi->api_client_id = $newClient->id;
            }

            $qsi->save();

            return $this->respond('OK');
        }

        return $this->respondNotFound();

    }

    public function verify()
    {
        if (Input::has('username') && ! empty(Input::get('username')))
        {
            return $this->respond(QualitySystemInstance::verify(Input::get('url'), Input::get('username'), Input::get('password')));
        } else
        {
            return $this->respond(QualitySystemInstance::verify(Input::get('url')));
        }

    }


}
