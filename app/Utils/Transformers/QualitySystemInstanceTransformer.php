<?php

namespace App\Utils\Transformers;


class QualitySystemInstanceTransformer extends Transformer
{

    public function transform($instance)
    {
        return [
            'id' => $instance['id'],
            'name'  => $instance['quality_system']['name'],
            'url'  => $instance['url'],
            'verified' =>$instance['verified']
        ];

        return $instance;
    }
}