<?php

namespace App\Transformers;

use App\Models\FeedDetail;
use League\Fractal\TransformerAbstract;

class FeedDetailTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(FeedDetail $data): array
    {
        return [
             "heading" => $data->heading,
             "sub_heading" => $data->sub_heading,
             "about" => $data->about,
             "goal" => $data->goal,
             
        ];
    }
}