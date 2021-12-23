<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($data): array
    {
        
        return [
            'full_name'=>$data->full_name,
            'first_name'=>$data->first_name,
            'last_name'=>$data->last_name,
            'email'=>$data->email,
            'mobile'=>$data->mobile,
            'date_of_birth'=>$data->date_of_birth,
            
            // "token" => $data['token'],
            // 'user' => $data['user'],
        ];
    }
}
