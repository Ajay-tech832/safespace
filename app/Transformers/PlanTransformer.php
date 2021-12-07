<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class PlanTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($plan): array
    {
        return [
             "name" => $plan->name,
             "duration_amount" => $plan->duration_amount, 
             "duration_type" => $plan->duration_type,
             "price" => $plan->price,
             "description" => $plan->description,
        ];
    }
}
