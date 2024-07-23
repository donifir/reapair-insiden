<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormInsident extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(PasienModel::class, 'norm', 'no_rkm_medis');
    }


    public function jenisInsiden(): BelongsTo
    {
        return $this->belongsTo(JenisInsiden::class, 'jenis_insiden', 'id');
    }

    public function pelaporInsiden(): BelongsTo
    {
        return $this->belongsTo(PelaporInsiden::class, 'pelapor_insiden', 'id');
    }
    public function korbanInsiden(): BelongsTo
    {
        return $this->belongsTo(KorbanInsiden::class, 'korban_insiden', 'id');
    }
    public function insidenMenyangkutPasien(): BelongsTo
    {
        return $this->belongsTo(InsidenMenyangkutPasien::class, 'pasien_di', 'id');
    }
    public function insidenTerjadiPadaPasien(): BelongsTo
    {
        return $this->belongsTo(InsidenTerjadiPadaPasien::class, 'spesialis_korban', 'id');
    }
    public function akibatInsidenTerhadapPasien(): BelongsTo
    {
        return $this->belongsTo(AkibatInsidenTerhadapPasien::class, 'akibat_insiden_kepasien', 'id');
    }
    public function tindakanDilakukanOleh(): BelongsTo
    {
        return $this->belongsTo(TindakanDilakukanOleh::class, 'pelaku_penanganan', 'id');
    }
    public function insidentPernahTerjadi(): BelongsTo
    {
        return $this->belongsTo(InsidentPernahTerjadi::class, 'insident_pernah_terjadi', 'id');
    }
    public function unitPenyebabInsiden(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_penyebab_insiden', 'id');
    }
    
}
