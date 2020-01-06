<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassWithAuthorResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'class_id' => $this->id,
            'class_name' => $this->name_class,
            'img_url' => $this->path_img_header,
            'code_refferal' => $this->code_ref_class,
            'created_at' => $this->created_at->diffForHumans(),
            'author' => new UserResource($this->user)
        ];
    }
}
