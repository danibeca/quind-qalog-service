<?php

namespace App\Models\QualitySystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class QualitySystem extends Model
{
    protected $fillable = ['name'];


    public static function active(Builder $builder, Model $model)
    {
        $builder->where('active', true);
    }

    public function metrics()
    {
        return $this->hasMany('App\Models\QualitySystem\ExternalMetric');
    }
}
