<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class FeedDetailImageTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($data): array
    {
        return [
             "path" =>$data->path,
             
        ];
    }
}