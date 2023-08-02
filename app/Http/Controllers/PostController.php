<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PostCollection(Post::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated(); 
        $post = new Post(); 
        $post->title = $validated['title']; 
        $post->content = $validated['content']; 
        $post->user_id = $request->user()->id; 
        $post->save(); 
        return new PostResource($post); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        if($post->user_id == $request->user()->id) {  
            $post->title = $validated['title']; 
            $post->content = $validated['content']; 
            $post->save(); 
            return new PostResource($post); 
        }
        return response()->json([
            'message' => 'you cant do this.' 
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->user_id == auth()->user()->id) {
            $post->delete(); 
            return redirect('/api/posts'); 
        }
        return response()->json([
            'message' => 'you cant do this.' 
        ]); 
    }
}
