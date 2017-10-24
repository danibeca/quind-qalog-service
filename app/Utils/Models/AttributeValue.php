<?php

namespace App\Utils\Models;


trait AttributeValue {

    public function getValueAttribute()
    {
        $result = null;
        if (isset($this->attributes['value']))
        {
            $result = $this->attributes['value'];
        }
        return $result;
    }
}