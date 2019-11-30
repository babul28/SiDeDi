<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResources extends JsonResource
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
            'report_id' => $this->id,
            'eksklusif' => $this->eksklusif,
            'intoleran' => $this->intoleran,
            'ekstream' => $this->ekstream,
            'kekerasan' => $this->kekerasan,
            'submit_date' => $this->created_at->diffForHumans(),
        ];
    }
}
