<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class NotificationTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($notification): array
    {
        return [
             "text" => $notification['text'],
             "type" => $notification['type'],
        ];
    }
}
