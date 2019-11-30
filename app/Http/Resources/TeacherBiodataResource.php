<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherBiodataResource extends JsonResource
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
            'NIP' => $this->NIP,
            'gender' => $this->gender,
            'religion' => $this->religion,
            'institution' => $this->institution,
        ];
    }
}
