<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'prodi';

    protected $fillable = [
        'fakultas_id',
        'nama_prodi',
        'nama_kaprodi',
        'foto_kaprodi',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relasi: Prodi belongs to Fakultas
     */
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    /**
     * Scope: Search by nama_prodi atau nama_kaprodi
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where('nama_prodi', 'like', '%' . $keyword . '%')
                     ->orWhere('nama_kaprodi', 'like', '%' . $keyword . '%');
    }

    /**
     * Scope: Filter by fakultas
     */
    public function scopeFilterFakultas($query, $fakultasId)
    {
        if ($fakultasId) {
            return $query->where('fakultas_id', $fakultasId);
        }
        return $query;
    }
}
