<?php

namespace App\Models\QualitySystem;

use Illuminate\Database\Eloquent\Model;

class ExternalMetricValue extends Model
{
    protected $fillable = ['code','component_id', 'value'];

}
