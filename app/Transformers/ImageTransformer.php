<?php

namespace App\Transformers;

use App\Models\Image;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(Image $image): array
    {
        return [
             "path" => $image->path,
             "type" => $image->type,
        ];
    }
}
