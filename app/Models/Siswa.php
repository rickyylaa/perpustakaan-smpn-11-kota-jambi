<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'barcode',
        'nisn',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'foto',
        'kelas_id',
        'status'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function pinjam()
    {
        return $this->hasMany(Pinjam::class, 'siswa_id');
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatPinjam::class, 'siswa_id');
    }
}
