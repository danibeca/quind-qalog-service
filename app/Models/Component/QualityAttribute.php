<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;

class QualityAttribute extends Model
{
    public function tags(){
        return $this->belongsToMany('App\Models\Component\IssueTag');
    }
/*
    public function rules(){
        return $this->belongsToMany('Agilin\Models\Application\IssueRule');
    }*/
}
