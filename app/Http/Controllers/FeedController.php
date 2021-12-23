<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Traits\ImageTrait;
use App\Models\Feed;
use App\Models\FeedDetailImage;
use App\Models\FeedPostImage;
use App\Http\Requests\FeedRequest;
use App\Http\Requests\FeedDetailRequest;
use App\Http\Requests\FeedPostRequest;
use App\Models\FeedDetail;
use App\Models\FeedPost;
use App\Models\Like;
use App\Transformers\FeedTransformer;
use App\Transformers\FeedDetailTransformer;
use App\Transformers\FeedPostTransformer;
use App\Transformers\LikeTransformer;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    use ImageTrait;
    
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
            if($request->input('status'))
            {
                    $path = $this->imageUpload($request);
                    $feeds= new Feed;
                    $feeds->heading = $request->input('heading');
                    $feeds->path = $path;
                    $feeds->status= $request->input('status');
                    $feeds->user_id = Auth::id();
                    $feeds->save();
            
            return response()->json(['message'=>'Feed Added Succssfully'],200);   
            }else{
                    $path = $this->imageUpload($request);
                    $feeds= new Feed;
                    $feeds->heading = $request->input('heading');
                    $feeds->path = $path;
                    $feeds->save();
            
            return response()->json(['message'=>'Feed Added Succssfully'],200);   
            }
            
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        } 
    }

    public function updateFeeds(FeedRequest $request)
    {
        try {
            if($request->input('status'))
            {
                    $path = $this->imageUpload($request);
                    $feeds= Feed::find($request->post('id'));
                    $feeds->heading = $request->input('heading');
                    $feeds->path = $path;
                    $feeds->status = $request->post('status');
                    $feeds->user_id = Auth::id();
                    $feeds->save();
                return response()->json(['message'=>'Feed Updated Succssfully'],200);
            }else{
                    $path = $this->imageUpload($request);
                    $feeds= Feed::find($request->post('id'));
                    $feeds->heading = $request->input('heading');
                    $feeds->path = $path;
                    $feeds->save();
                return response()->json(['message'=>'Feed Updated Succssfully'],200);  
            }
           
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        } 
    }

    public function getFeedDetails()
    {
        
        try {
            $feed_details = FeedDetail::with('feedDetailImages')->get();
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
            $feed_details->user_id = Auth::id();
            $feed_details->save();
            
            if ($request->hasFile('images')) {
                foreach($request->file('images') as $image){
                    $path = $this->multipleImageUpload($image);
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
    

    public function getFeedPosts()
    {
        // $posts = FeedPost::with('feedPostlikes.user')->get();
        // foreach ($posts as $post){
        //     $post = count($post->feedPostlikes);
        //     dd($post);
        // }
        
        try{
            $feed_posts = FeedPost::with('feedPostImages','feedPostlikes')->get();
            return fractal()->collection($feed_posts)->transformWith(new FeedPostTransformer())->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
    }

    public function addFeedPosts(FeedPostRequest $request)
    {
        try{
                $image_path = $this->imageUpload($request);
                $feed_posts = new FeedPost;
                $feed_posts->heading = $request->input('heading');
                $feed_posts->sub_heading = $request->input('sub_heading');
                $feed_posts->about = $request->input('about');
                $feed_posts->image_path = $image_path;
                $feed_posts->description_heading = $request->input('description_heading');
                $feed_posts->description = $request->input('description');
                $feed_posts->like = $request->input('like');
                $feed_posts->user_id = Auth::id();
                $feed_posts->save();
            
                if($request->hasFile('images')) {
                    foreach($request->file('images') as $image){
                    $path = $this->multipleImageUpload($image);
                    $feed_post_image = new FeedPostImage;
                    $feed_post_image->path= $path;
                    $feed_post_image->feed_post_id= $request->input('id');
                    $feed_post_image->save();
                 } 
             }
            return response()->json(['message'=>'Feed Post Added Succssfully'],200);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
        
    }

    public function updateFeedPosts(FeedPostRequest $request)
    {
        try{
                $image_path = $this->imageUpload($request);
                $feed_posts = FeedPost::find($request->post('id'));
                $feed_posts->heading = $request->input('heading');
                $feed_posts->sub_heading = $request->input('sub_heading');
                $feed_posts->about = $request->input('about');
                $feed_posts->image_path = $image_path;
                $feed_posts->description_heading = $request->input('description_heading');
                $feed_posts->description = $request->input('description');
                $feed_posts->like = $request->input('like');
                $feed_posts->user_id = Auth::id();
                $feed_posts->save();
            
                if($request->hasFile('images')) {
                    foreach($request->file('images') as $image){
                    $path = $this->multipleImageUpload($image);
                    FeedPostImage::Where('feed_post_id', $request->post('feed_post_id'))
                                   ->update(['path'=>$path]);
                 } 
             }
            return response()->json(['message'=>'Feed Post Updated Succssfully'],200);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
    }


    public function getPostLikes()
    {
        
        $feed_post_likes = Like::groupBy('feed_post_id')->select('feed_post_id', DB::raw('count(*) as likes'))->get();

        return fractal()->collection($feed_post_likes)->transformWith(new LikeTransformer())->toArray();
    }

    public function addPostLikes(Request $request)
    {
        $user = Auth::user();
        $likes = $request->likes;
        foreach($likes as $like)
        {
            Like::create([
                'user_id' => $user->id,
                'feed_post_id'=> $like,
            ]);
        }
    }
}
