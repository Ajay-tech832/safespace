<?php

namespace App\Transformers;

use App\Models\FeedPost;
use League\Fractal\TransformerAbstract;

class FeedPostTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(FeedPost $data): array
    {
        return [
             "heading" => $data->heading,
             "sub_heading"=>$data->sub_heading,
             "path"=>$data->path,
             "like"=>$data->like,
             "description_heading"=>$data->description_heading,
             "about"=>$data->about,
             "description"=>$data->description,
             
        ];
    }
}