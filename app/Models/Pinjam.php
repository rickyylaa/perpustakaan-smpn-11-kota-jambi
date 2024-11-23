<?php

namespace App\Models;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pinjam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function getKeterlambatan()
    {
        $tanggalKembali = new DateTime($this->tanggal_kembali);
        $tanggalSekarang = new DateTime();
        return $tanggalSekarang > $tanggalKembali ? $tanggalSekarang->diff($tanggalKembali)->days : 0;
    }

    public static function getDenda()
    {
        $denda = DB::table('dendas')->first();
        return $denda ? $denda->denda_pinjam : 1000;
    }
}
