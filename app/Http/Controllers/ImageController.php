<?php

namespace App\Http\Controllers;
use Exception;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\imageRequest;
use App\Models\Image;
use App\Transformers\ImageTransformer;

class ImageController extends Controller
{
    use ImageTrait;

    public function getImages(){
        try{
            $images = Image::all();
        
            return fractal()->collection($images)->transformWith(new ImageTransformer())->toArray();
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        

        }
}
   

    public function storeProfileImages(imageRequest $request)
    {
        try{
            $user= Auth::user();
            if($request->hasFile('images')) {
                foreach($request->file('images') as $image){
                    $path = $this->multipleImageUpload($image);
                    $user = new Image;
                    $user->path= $path;
                    $user->user_id = Auth::id();
                    $user->date_time = date("Y-m-d");
                    $user->save();
                 } 
             } 
             return response()->json(['message'=>'Profile Upload Succssfully'],200); 
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        
    }
}  

    public function updateProfileImages(imageRequest $request)
    {
        try {
            $user= Auth::user();
            Image::where('user_id', $user->id)->delete();
            if($request->hasFile('images')) {
                foreach($request->file('images') as $image){
                    $path = $this->multipleImageUpload($image);
                    $user = new Image;
                    $user->path= $path;
                    $user->user_id = Auth::id();
                    $user->date_time = date("Y-m-d");
                    $user->save();
                 } 
             } 
             return response()->json(['message'=>'Profile Updated Succssfully'],200);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
       
       }
    
   }
}