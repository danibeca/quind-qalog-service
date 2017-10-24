<?php

namespace App\Models\QualitySystem;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class QualitySystemInstance extends Model
{

    public function qualitySystem()
    {
        return  $this->belongsTo('\App\Models\QualitySystem\QualitySystem','quality_system_id');
    }

    public static function verify($url)
    {
        $client = new Client();
        try
        {
            $client->get($url);

        } catch (RequestException $e)
        {
            return false;
        }

        return true;
    }


    public function getResources()
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