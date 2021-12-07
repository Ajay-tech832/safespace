<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Transformers\ImageTransformer;

class ImageController extends Controller
{
    public function getImages(){
        $images = Image::all();
        foreach($images as $image){

        }
        return fractal()->item($image)->transformWith(new ImageTransformer())->toArray();

    }
}
