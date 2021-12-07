<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class HobbiesTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($hobbie): array
    {
        return [
             "name" => $hobbie->name,
             "icon" => $hobbie->icon,
        ];
    }
}
