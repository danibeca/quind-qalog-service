<?php

namespace App\Models\QualitySystem;

use App\Wrappers\QuindWrapper\HTTPWrapper;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class QualitySystemInstance extends Model
{

    public function qualitySystem()
    {
        return $this->belongsTo('\App\Models\QualitySystem\QualitySystem', 'quality_system_id');
    }

    public static function verify($url, $username, $password)
    {
        $client = new HTTPWrapper($username, $password);
        try
        {
            $resources = $client->get($url . '/api/resources');
            if (empty($resources))
            {
                return false;
            }

        } catch (RequestException $e)
        {
            return false;
        }

        return true;
    }


    public function getResources()
    {
        Log::info('Hplio TIpy'. $this->type);
        if ($this->type == 2)
        {
            Log::info('Hplio ID'. $this->id);
        //    Log::info(json_encode($resources));
            $resources = QualitySystemInstanceResource::where('quality_system_instance_id', $this->id)->get()->toArray();

            return $resources;

        } else
        {

            $client = new Client();
            $url = $this->url . '/api/resources';
            try
            {
                return collect(json_decode($client->get($url)->getBody()->getContents()))->map(function ($item, $key) {
                    return ['key' => $item->key, 'name' => $item->name];
                });

            } catch (RequestException $e)
            {
                return [];
            }
        }
    }


}
