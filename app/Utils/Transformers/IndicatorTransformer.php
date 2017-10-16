<?php

namespace App\Utils\Transformers;


class IndicatorTransformer extends Transformer
{

    public function transform($indicator)
    {
        /*$name = $indicator->tmpname;
        if($indicator->lr_name !== null){
            $name = $indicator->name;
        }*/
        return [
            'id'  => $indicator['id'],
            'name' =>$indicator['name']
        ];
    }
}