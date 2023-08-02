<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated(); 
        if(Post::findOrFail($validated['post_id'])) {
            $comment = new Comment(); 
            $comment->post_id = $validated['post_id'];  
            $comment->content = $validated['content']; 
            $comment->user_id = $request->user()->id; 
            $comment->save(); 
            return new CommentResource($comment); 
        }
        //post isnt found, returns 404(we think)
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $validated = $request->validated();
        if($comment->user_id == $request->user()->id) {  
            $comment->content = $validated['content']; 
            $comment->save(); 
            return new CommentResource($comment); 
        }
        return response()->json([
            'message' => 'you cant do this.' 
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id == auth()->user()->id) {
            $comment->delete(); 
            return redirect('/api/posts/'.$comment->post_id); 
        }
        return response()->json([
            'message' => 'you cant do this.' 
        ]); 
    }
}
