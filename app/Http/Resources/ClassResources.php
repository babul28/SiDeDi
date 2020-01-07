<?php

namespace App\Http\Resources;

use App\Question;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassResources extends JsonResource
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
            'students' => $this->students->count(),
            'author' => new UserResource($this->user)
        ];

        // return [
        //     'class_id' => $this->id,
        //     'class_name' => $this->name_class,
        //     'img_url' => $this->path_img_header,
        //     'code_refferal' => $this->code_ref_class,
        //     'created_at' => $this->created_at->diffForHumans(),
        //     'author' => new UserResource($this->user),
        //     'students' => new StudentCollection($this->students),
        // ];
    }

    /**
     * Add meta data for classresources
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'questions' => Question::all(),
            ]
        ];
    }
}
