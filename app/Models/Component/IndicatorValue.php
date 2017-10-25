<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;

class IndicatorValue extends Model
{
    protected $fillable = ['code','component_id', 'value', 'metric_id'];

}
