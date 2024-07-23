<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pjos(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pjo', 'id');
    }
    public function karus(): BelongsTo
    {
        return $this->belongsTo(User::class, 'karu', 'id');
    }
    public function kabits(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kabit', 'id');
    }
    public function wakas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'waka', 'id');
    }
}
