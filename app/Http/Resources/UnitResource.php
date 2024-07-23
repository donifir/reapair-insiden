<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
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
            'id' => $this->id,
            'nama_unit' => $this->nama_unit,
            'keterangan' =>  $this->keterangan,
            'pjo' =>  $this->pjos->name??"-",
            'pjo_id' =>  $this->pjo,
            'karu' =>  $this->karus->name??"-",
            'karu_id' =>  $this->karu,
            'kabit' =>  $this->kabits->name??"-",
            'kabit_id' =>  $this->kabit,
            'waka' =>  $this->wakas->name??"-",
            'waka_id' =>  $this->waka,
        ];
    }
}
