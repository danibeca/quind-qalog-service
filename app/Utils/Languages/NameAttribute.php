<?php

namespace App\Utils\Models\Language;


trait NameAttribute {

    public function lrname(){
        return $this->belongsTo('Appin\Models\Language\Resource', 'lr_name','id');
    }

    public function getNameAttribute(){
        return $this->lrname->language->first()->pivot->translation;
    }
}