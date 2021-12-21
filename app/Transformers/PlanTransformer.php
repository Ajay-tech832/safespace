<?php

namespace App\Transformers;
use App\Models\Plan;
use League\Fractal\TransformerAbstract;

class PlanTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($data): array
    {
        return [
             "name" => $data->name,
             "duration_amount" => $data->duration_amount, 
             "duration_type" => $data->duration_type,
             "price" => $data->price,
             "description" => $data->description,
        ];
    }
}
