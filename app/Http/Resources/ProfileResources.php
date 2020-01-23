<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResources extends JsonResource
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
            'data' => [
                'user_id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'join_at' => $this->created_at->diffForHumans(),
                'biodata' => new TeacherBiodataResource($this->TeacherBiodata),
            ],
        ];
    }
}
