<?php

namespace App\Utils\Transformers;


class ComponentTransformer extends Transformer
{

    public function transform($component)
    {
        return [
            'id'  => $component['id'],
            'app_code' =>$component['app_code'],
            'username' =>$component['username'],
            'password' =>$component['password'],
            'url' =>$component['api_server_url'],
            'quality_system_id' =>$component['quality_system_id'],
            'wrapper_class' =>$component['quality_system']['wrapper_class'],

        ];

        return $component;
    }
}