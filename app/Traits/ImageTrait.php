<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

trait ImageTrait
{
    public function imageUpload(Request $request)
    {
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $name = Auth::id() . "/" . date("Y") . "/" . date("m") . "/" . time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('uploads/feeds', $name, 'public');
            return $path;
    }
  }

  public function multipleImageUpload($image)
  {
    
            $name = Auth::id() . "/" . date("Y") . "/" . date("m") . "/" . time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('uploads/feeds', $name, 'public');
            return $path;
        }
}