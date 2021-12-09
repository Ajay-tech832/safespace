<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Transformers\NotificationTransformer;
class NotificationController extends Controller
{
    public function getNotifications(){
        $notifications = Notification::all();
        // foreach($notifications as $notification){

        // }
        return fractal()->collection($notifications)->transformWith(new NotificationTransformer())->toArray();

    }
}
