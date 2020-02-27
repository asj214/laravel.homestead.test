<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Banner extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'title' => $this->title,
            'intro' => $this->intro,
            'descr' => $this->descr,
            'link_url' => $this->link_url,
            'started_at' => $this->started_at,
            'finished_at' => $this->finished_at,
            'attachment' => $this->when($this->attachment, function(){
                return asset($this->attachment->path);
                // $ret = [];
                // foreach($this->attachment as $attachment){
                //     $ret[] = asset($attachment->path);
                // }
                // return $ret;
            })
        ];
    }

}
