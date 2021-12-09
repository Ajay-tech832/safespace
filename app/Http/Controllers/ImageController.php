<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\imageRequest;
use App\Models\Image;
use App\Transformers\ImageTransformer;

class ImageController extends Controller
{
    public function getImages(){
        $images = Image::all();
        
        return fractal()->collection($images)->transformWith(new ImageTransformer())->toArray();

    }

    public function storeProfileImages(imageRequest $request)
    {
        $user= Auth::user();
        if ($request->hasfile('images')) {
            $images = $request->file('images');
            // foreach($images as $image) {
                $name = Auth::id() . "/" . date("Y") . "/" . date("m") . "/" . time() . '_' . $images->getClientOriginalName();
                $path = $images->storeAs('uploads', $name, 'public');
                $user = new Image;
                $user->path= $path;
                $user->user_id = Auth::id();
                $user->date_time = date("Y-m-d");
                $user->save();
               
         } 
         return response()->json(['message'=>'Profile Upload Succssfully'],200);
    }

    public function updateProfileImages(imageRequest $request)
    {
        $user= Auth::user();
        Image::where('user_id', $user->id)->delete();
        if ($request->hasfile('images')) {
            $images = $request->file('images');
            $name = Auth::id() . "/" . date("Y") . "/" . date("m") . "/" . time() . '_' . $images->getClientOriginalName();
            $path = $images->storeAs('uploads', $name, 'public');
                Image::create([
                    'path' => '/storage/'.$path,
                    'user_id'=>$user->id,
                  ]);
              
         } 
         return response()->json(['message'=>'Profile Updated Succssfully'],200);
    }
    
}
