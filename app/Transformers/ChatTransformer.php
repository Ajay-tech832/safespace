<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ChatTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform($chats): array
    {
        return [
             "chat_topic" => $chats['chat_topic'],
        ];
    }
}
