<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'image_profile' => $this->image_profile == null ? Storage::disk('public')->url('images/DefaultProfile.jpg') : $this->image_profile,
        ];
    }
}
