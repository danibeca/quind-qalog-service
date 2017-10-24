<?php

namespace App\Models\QualitySystem;

use Illuminate\Database\Eloquent\Model;

class IssueValue extends Model
{
    protected $fillable = ['component_id', 'rule', 'severity',
        'status', 'message', 'effort',
        'debt', 'type',
        'creationDate', 'updateDate'
    ];

}
