<?php

namespace App\Transformers;

use App\Models\Message;
use League\Fractal\TransformerAbstract;

class MessageTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(Message $data): array
    {
        return [
            "message" => $data->message,
        ];
    }
}
