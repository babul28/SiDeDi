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
            'eksklusif_teks' => $this->eksklusif_teks,
            'intoleran' => $this->intoleran,
            'intoleran_teks' => $this->intoleran_teks,
            'ekstream' => $this->ekstream,
            'ekstream_teks' => $this->ekstream_teks,
            'kekerasan' => $this->kekerasan,
            'kekerasan_teks' => $this->kekerasan_teks,
            'average' => $this->avg_report,
            'submit_date' => $this->created_at->diffForHumans(),
        ];
    }
}
