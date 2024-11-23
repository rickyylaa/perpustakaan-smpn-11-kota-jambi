<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'isbn',
        'judul',
        'slug',
        'kategori_id',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok_buku',
        'deskripsi',
        'sampul',
        'status'
    ];

    public function pinjam()
    {
        return $this->hasMany(Pinjam::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriDanRak::class);
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatPinjam::class);
    }
}
