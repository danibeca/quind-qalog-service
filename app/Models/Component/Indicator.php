<?php

namespace App\Models\Component;


use App\Utils\Models\Language\NameAttribute;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $appends = ['name'];
    use NameAttribute;
}