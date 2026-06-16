<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';

    protected $fillable = [
        'name',
        'dekan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi: Satu Fakultas memiliki banyak Prodi (hasMany)
     */
    public function prodis()
    {
        return $this->hasMany(Prodi::class);
    }

    /**
     * Scope: Search by nama fakultas atau dekan
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', '%' . $keyword . '%')
                     ->orWhere('dekan', 'like', '%' . $keyword . '%');
    }
}
