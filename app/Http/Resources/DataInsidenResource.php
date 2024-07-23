<?php

namespace App\Http\Resources;

use App\Models\StatusForminsiden;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class DataInsidenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {$user = Auth::guard('sanctum')->user()->id;
        // return parent::toArray($request);
        return [
        
            'id' =>  $this->id??'',
            'dilihat'=>StatusForminsiden::where('user_id',$user)->where('formindisiden_id',$this->id)->first()->jam_lihat??'belum',
            'nama' =>  $this->pasien->nm_pasien??"",
            'jenis_kelamin' =>  $this->pasien->jk??"",
            'umur' =>  $this->pasien->umur??"",
            'alamat' =>  $this->pasien->alamat??"",

            'norm' =>  $this->norm??"",
            'waktu_insiden' =>  $this->waktu_insiden??"",
            'insident' =>  $this->insident??"",
            'kronologi_insiden' =>  $this->kronologi_insiden??"",
            'jenis_insiden' =>  $this->jenis_insiden??"",
            'keterangan_jenis_insiden'=>$this->jenisInsiden->keterangan??'',

            'pelapor_insiden' =>  $this->pelapor_insiden??"",
            'keterangan_pelapor_insiden' =>  $this->pelaporInsiden->keterangan??'',
            'penjelasn_pelapor_insiden' =>  $this->penjelasn_pelapor_insiden??"",

            'korban_insiden' =>  $this->korban_insiden??"",
            'keterangan_korban_insiden' =>  $this->korbanInsiden->keterangan??'',
            'penjelasan_korban_insiden' =>  $this->penjelasan_korban_insiden??"",

            'pasien_di' =>  $this->pasien_di??"",
            'keterangan_pasien_di' =>  $this->insidenMenyangkutPasien->keterangan??'',
            'penjelasan_pasien_di' =>  $this->penjelasan_pasien_di??"",

            'tempat_insiden' =>  $this->tempat_insiden??"",

            'spesialis_korban' =>  $this->spesialis_korban??"",
            'keterangan_spesialis_korban' =>  $this->insidenTerjadiPadaPasien->keterangan??'',
            'penjelasan_spesialis_korban' =>  $this->penjelasan_spesialis_korban??"",

            // error
            'id_unit_penyebab_insiden' =>  $this->unit_penyebab_insiden??"",
            'unit_penyebab_insiden' =>  $this->unitPenyebabInsiden->nama_unit??"",

            'akibat_insiden_kepasien' =>  $this->akibat_insiden_kepasien??"",
            'keterangan_akibat_insiden_kepasien' =>  $this->akibatInsidenTerhadapPasien->keterangan??'',

            'penanganan_insiden' =>  $this->penanganan_insiden??"",

            'pelaku_penanganan' =>  $this->pelaku_penanganan??"",
            'keterangan_pelaku_penanganan' =>  $this->tindakanDilakukanOleh->keterangan??'',
            'penjelasan_pelaku_penanganan' =>  $this->penjelasan_pelaku_penanganan??"",

            'insident_pernah_terjadi' =>  $this->insident_pernah_terjadi??"",
            'keterangan_insident_pernah_terjadi' =>  $this->insidentPernahTerjadi->keterangan??'',
            'penjelasan_insident_pernah_terjadi' =>  $this->penjelasan_insident_pernah_terjadi??"",
            

            'grading_resiko_kejadian' =>  $this->grading_resiko_kejadian??"",
            'user_id' =>  $this->user_id??'',
            'created_at' =>  $this->created_at??"",
            'updated_at' =>  $this->updated_at??"",
        ];
    }
}
