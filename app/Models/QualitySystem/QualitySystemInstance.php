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
        if ($this->type == 2)
        {
            return QualitySystemInstanceResource::where('quality_system_instance_id', $this->id)->get()->toArray();

        } else
        {
            $wrapper = new HTTPWrapper($this->username, $this->password);
            $url = $this->url . '/api/resources';
            try
            {
                return collect($wrapper->get($url))->map(function ($item) {
                    return ['key' => $item->key, 'name' => $item->name];
                });

            } catch (RequestException $e)
            {
                return [];
            }
        }
    }


}
