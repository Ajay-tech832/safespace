<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Transformers\MessageTransformer;

class MessageController extends Controller
{
    public function getMessages(Request $request)
    {
        $messages = Message::where('user_id',$request->id)->get();
        
        return fractal()->collection($messages)->transformWith(new MessageTransformer())->toArray();
    }
}
