<?php

namespace App\Models\QualitySystem;

use Illuminate\Database\Eloquent\Model;

class QualitySystem extends Model
{
    public function metrics()
    {
        return $this->hasMany('App\Models\QualitySystem\ExternalMetric');
    }
}
