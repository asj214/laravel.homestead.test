<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Comment as CommentResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
        return [
            'id' => $this->id,
            'group_id' => $this->group_id,
            'commentable_type' => $this->commentable_type,
            'commentable_id' => $this->commentable_id,
            'depth' => $this->depth,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'body' => $this->body,
            'like_cnt' => $this->like_cnt,
            'answers' => CommentResource::collection($this->whenLoaded('answers')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

}
