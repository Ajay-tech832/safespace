<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($image): array
    {
        return [
             "path" => $image->path,
             "type" => $image->type,
        ];
    }
}
