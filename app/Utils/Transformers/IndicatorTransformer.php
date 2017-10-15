<?php

namespace App\Utils\Transformers;

use Carbon\Carbon;

class IndicatorTransformer extends Transformer
{

    public function transform($indicator)
    {
        return [
            'date'  => Carbon::parse($indicator['created_at'])->format('d-m-Y'),
            'value' => round($indicator['value'], 2)
        ];
    }
}