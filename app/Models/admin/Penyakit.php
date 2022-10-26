<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $table = 'penyakit';

    protected $fillable = [
        'kode',
        'nama_penyakit',
        'solusi'
    ];

    public function aturan()
    {
        return $this->hasMany(Aturan::class);
    }

    public static function kode()
    {
        $kode = Penyakit::max('kode');
        $null = '';
        $kode = str_replace("P", "", $kode);
        $kode = (int) $kode + 1;
        $int = $kode;

        if (strlen($kode) == 1) {
            $null = "0";
        }

        $newKode = "P" . $null . $int;
        return $newKode;
    }
}
