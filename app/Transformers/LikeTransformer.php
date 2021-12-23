<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class LikeTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($data): array
    {
        
        return [
            "feed_post_id" => $data->feed_post_id,
            'likes' => $data->likes,
        ];
    }
}
