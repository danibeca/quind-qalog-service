<?php

namespace App\Models\APIClient;


use Illuminate\Database\Eloquent\Model;

class APIClient extends Model
{
    protected $table = 'api_clients';


    public function qualitySystemInstances()
    {
        return  $this->hasMany('\App\Models\QualitySystem\QualitySystemInstance', 'api_client_id');
    }

}
