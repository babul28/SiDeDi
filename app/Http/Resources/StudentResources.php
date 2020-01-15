<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResources extends JsonResource
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
            'student_id' => $this->id,
            'student_name' => $this->name,
            'NISN' => $this->NISN,
            'gender' => $this->gender,
            'religion' => $this->religion,
            'age' => $this->age,
            'join_at' => $this->created_at->diffForHumans(),
            'answers' => new AnswerCollection($this->whenLoaded('answers')),
        ];
    }
}
