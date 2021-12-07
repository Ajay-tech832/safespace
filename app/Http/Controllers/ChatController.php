<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ChatTransformer;
use App\Models\Chat;

class ChatController extends Controller
{
    public function getChats(){
        $chats = Chat::all();
        foreach($chats as $chat){

        }
        return fractal()->item($chat)->transformWith(new ChatTransformer())->toArray();

    }
}
