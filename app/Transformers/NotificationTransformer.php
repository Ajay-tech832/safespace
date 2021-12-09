<?php

namespace App\Transformers;

use App\Models\Notification;
use League\Fractal\TransformerAbstract;

class NotificationTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(Notification $notification): array
    {
        return [
             "text" => $notification['text'],
             "type" => $notification['type'],
        ];
    }
}
