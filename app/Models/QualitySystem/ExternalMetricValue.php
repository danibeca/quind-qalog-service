<?php

namespace App\Models\QualitySystem;

use Illuminate\Database\Eloquent\Model;

class ExternalMetricValue extends Model
{
    protected $fillable = ['component_id', 'value', 'external_metric_id'];

}
