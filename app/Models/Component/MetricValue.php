<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;

class MetricValue extends Model
{
    protected $fillable = ['code','component_id', 'value', 'metric_id'];

}
