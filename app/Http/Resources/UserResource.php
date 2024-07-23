<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'=> $this->name,
            'email' =>  $this->email,
            'jabatan_id' =>  $this->jabatan_id,
            'password' =>  $this->password,
            'jabatan' =>   $this->jabatan->nama_jabatan??'',
            'unit_id' =>  $this->unit_id,
            'unit' => $this->unit->nama_unit??'',
            'email' =>  $this->email,
        ];
    }
}
