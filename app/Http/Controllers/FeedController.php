<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Feed;
use App\Models\FeedDetailImage;
use App\Http\Requests\FeedRequest;
use App\Http\Requests\FeedDetailRequest;
use App\Models\FeedDetail;
use App\Transformers\FeedTransformer;
use App\Transformers\FeedDetailTransformer;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    
    public function getFeeds()
    {
        try {
            $feeds = Feed::all();

            return fractal()->collection($feeds)->transformWith(new FeedTransformer())->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
    }

    public function addFeeds(FeedRequest $request)
    {
        try {
            if ($request->hasfile('images')) {
                $images = $request->file('images');
                $name = Auth::id() . "/" . date("Y") . "/" . date("m") . "/" . time() . '_' . $images->getClientOriginalName();
                $path = $images->storeAs('uploads/feeds', $name, 'public');

                $feeds= new Feed;
                $feeds->heading = $request->input('heading');
                $feeds->path = $path;
                $feeds->save();
        }
        return response()->json(['message'=>'Feed Added Succssfully'],200); 
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        } 
    }

    public function updateFeeds(FeedRequest $request)
    {
        try {
            if ($request->hasfile('images')) {
                $images = $request->file('images');
                $name = Auth::id() . "/" . date("Y") . "/" . date("m") . "/" . time() . '_' . $images->getClientOriginalName();
                $path = $images->storeAs('uploads/feeds', $name, 'public');
                $feeds= Feed::find($request->post('id'));
                $feeds->heading = $request->input('heading');
                $feeds->path = $path;
                $feeds->save();
            }
            return response()->json(['message'=>'Feed Updated Succssfully'],200);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        } 
    }

    public function getFeedDetails()
    {
        try {
            $feed_details = FeedDetail::all();
             
            return fractal()->collection($feed_details)->transformWith(new FeedDetailTransformer())->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        } 
        
    }

    public function addFeedDetails(FeedDetailRequest $request)
    {
        try{
            $feed_details = new FeedDetail;

            $feed_details->heading = $request->input('heading');
            $feed_details->sub_heading = $request->input('sub_heading');
            $feed_details->about = $request->input('about');
            $feed_details->goal = $request->input('goal');
            $feed_details->save();
            
            if ($request->hasfile('images')) {
                $images = $request->file('images');
                 foreach($images as $image) {
                    $name = Auth::id() . "/" . date("Y") . "/" . date("m") . "/" . time() . '_' . $image->getClientOriginalName();
                    $path = $image->storeAs('uploads/feeds', $name, 'public');
                    $feed_details_image = new FeedDetailImage;
                    $feed_details_image->path= $path;
                    $feed_details_image->feed_detail_id= $request->input('id');
                    $feed_details_image->save();
                 } 
             } 
    
            return response()->json(['message'=>'Feed Details Added Succssfully'],200);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        } 
        
    }
    
}
