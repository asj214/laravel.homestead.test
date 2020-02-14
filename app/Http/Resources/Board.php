<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Comment as CommentResource;

class Board extends JsonResource {

    public function toArray($request){

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'body' => $this->body,
            'thumbnail' => $this->thumbnail,
            'view_cnt' => $this->view_cnt,
            'like_cnt' => $this->like_cnt,
            'comment_cnt' => $this->comment_cnt,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];

    }

}
