<?php

namespace App\Transformers;
use App\Models\Hobbie;
use League\Fractal\TransformerAbstract;

class UserHobbieTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($data): array
    {
        return [
             "name" => $data->hobbie->name,
             "icon" => $data->hobbie->icon,
        ];
    }
}
