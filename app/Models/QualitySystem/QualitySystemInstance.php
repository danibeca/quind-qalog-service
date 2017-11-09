<?php

namespace App\Models\QualitySystem;

use App\Models\Component\Component;
use App\Utils\Wrappers\HTTPWrapper;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Model;

class QualitySystemInstance extends Model
{

    public function qualitySystem()
    {
        return $this->belongsTo('\App\Models\QualitySystem\QualitySystem', 'quality_system_id');
    }

    public static function verify($url, $username = null, $password = null)
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


    public function getResources(){
        return array_values($this->getIResources());
    }

    public function getIResources()
    {
        $result = [];
        if ($this->type == 2)
        {
            $result = QualitySystemInstanceResource::where('quality_system_instance_id', $this->id)->get()->toArray();

        } else
        {
            $wrapper = new HTTPWrapper($this->username, $this->password);
            $url = $this->url . '/api/resources';
            try
            {
                $result = collect($wrapper->get($url))->map(function ($item) {
                    return ['key' => $item->key, 'name' => $item->name];
                })->toArray();

            } catch (RequestException $e)
            {
                $result = QualitySystemInstanceResource::where('quality_system_instance_id', $this->id)->get()->toArray();
            }
        }

        return $result;

    }

    public function getNoUsedResources()
    {
        $result = $this->getIResources();

        $usedResourceKeys = Component::where('quality_system_instance_id', $this->id)->get()->pluck('app_code')->toArray();

        return $this->removeUsedResources($result, $usedResourceKeys);

    }

    public function removeUsedResources($resources, $usedResourceKeys)
    {
        return array_values(array_udiff($resources, $usedResourceKeys,
            function ($obj_a, $obj_b) {
                $a = '';
                $b = '';
                if (isset($obj_a['key']))
                {
                    $a = $obj_a['key'];
                } else
                {
                    $a = $obj_a;
                }

                if (isset($obj_b['key']))
                {
                    $b = $obj_b['key'];
                } else
                {
                    $b = $obj_b;
                }

                return strcmp($a, $b);
            }
        ));
    }


}
