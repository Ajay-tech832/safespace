<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Transformers\NotificationTransformer;
class NotificationController extends Controller
{
    public function getNotifications(){
        try{
            $notifications = Notification::all();
       
            return fractal()->collection($notifications)->transformWith(new NotificationTransformer())->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);

        }
    }
}
