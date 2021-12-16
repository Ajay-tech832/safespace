<?php

namespace App\Transformers;

use App\Models\FeedDetail;
use App\Transformers\FeedDetailImageTransformer;
use App\Models\FeedDetailImage;
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
             "path" => fractal()->collection($data->feedDetailImages)->transformWith(new FeedDetailImageTransformer)->serializeWith(new \Spatie\Fractalistic\ArraySerializer())->toArray(),
        ];
    }
}