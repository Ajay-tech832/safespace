<?php

namespace App\Transformers;

use App\Models\Connection;
use League\Fractal\TransformerAbstract;

class ConnectionTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(Connection $data): array
    {
        return [
            "status" => $data->status,
        ];
    }
}
