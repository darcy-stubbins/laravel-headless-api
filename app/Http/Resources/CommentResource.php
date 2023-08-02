<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id, 
            'author' => $this->user->name, 
            'author_id' => $this->user->id,
            'post_id' => $this->post->id, 
            'post_title' => $this->post->title,
            'content' => $this->content, 
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]; 
    }
}