<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class UserProfileTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($data): array
    {
        return [
           "name"=>$data['full_name'],
           "first_name"=>$data['first_name'],
           "last_name"=>$data['last_name'],
           "email"=>$data['email'],
           "mobile"=>$data['mobile'],
           "date_of_birth"=>$data['date_of_birth'],
           "gender"=>$data['gender'],
           "visible_profile"=>$data['visible_profile'],
           "path" => fractal()->collection($data->profileImage)->transformWith(new ImageTransformer)->serializeWith(new \Spatie\Fractalistic\ArraySerializer())->toArray(),
           "member" => fractal()->collection($data->members)->transformWith(new MemberTransformer)->serializeWith(new \Spatie\Fractalistic\ArraySerializer())->toArray(),
        ];
    }
}
