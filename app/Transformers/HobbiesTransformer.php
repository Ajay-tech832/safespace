<?php

namespace App\Transformers;
use App\Models\Hobbie;
use League\Fractal\TransformerAbstract;

class HobbiesTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(Hobbie $data): array
    {
        return [
             "name" => $data->name,
             "icon" => $data->icon,
        ];
    }
}
