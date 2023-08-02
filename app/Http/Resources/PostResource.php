<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title, 
            'comments' => $this->comments,
            'content' => $this->content, 
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]; 
    }
}
