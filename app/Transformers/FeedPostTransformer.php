<?php

namespace App\Transformers;

use App\Models\FeedPost;
use App\Models\FeedPostImage;
use League\Fractal\TransformerAbstract;

class FeedPostTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(FeedPost $data): array
    {
        //dd($data->path);
        return [
             "heading" => $data->heading,
             "sub_heading"=>$data->sub_heading,
             "image_path"=>$data->image_path,
             "like"=>$data->like,
             "description_heading"=>$data->description_heading,
             "about"=>$data->about,
             "description"=>$data->description,
             "path" => fractal()->collection($data->feedPostImages)->transformWith(new FeedDetailImageTransformer)->serializeWith(new \Spatie\Fractalistic\ArraySerializer())->toArray(),
        ];
    }
}