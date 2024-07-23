<?php

namespace App\Http\Resources;

use App\Models\Jabatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormInsidenToUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'=> $this->id,
            'nama'=> $this->user->name,
            'jabatan'=>Jabatan::find($this->user->jabatan_id)->nama_jabatan,
            'status'=>$this->status_laporan,
            'jam_lihat' =>  $this->jam_lihat?Carbon::parse($this->jam_lihat)->format('d-M-Y H:i'):'belum terbaca',
        ];
    }
}
