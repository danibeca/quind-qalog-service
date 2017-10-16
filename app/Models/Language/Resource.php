<?php


namespace Agilin\Models\Language;


use Illuminate\Database\Eloquent\Model;

class Resource extends Model {

    protected $table = 'language_resources';

    public function language()
    {
        return $this->belongsToMany('App\Models\Language\Language', 'language_translations', 'language_resource_id')
            ->select(array('id'))
            ->withPivot('translation')
            ->where('language_id', '=', session('language', 1));
    }


}