<?php

namespace App\Transformers;

use App\Models\Feed;
use League\Fractal\TransformerAbstract;

class FeedTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(Feed $data): array
    {
        return [
             "heading" => $data->heading,
             "path" => $data->path,
             
        ];
    }
}