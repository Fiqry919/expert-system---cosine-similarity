<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;

    protected $table = 'gejala';

    protected $fillable = [
        'kode',
        'nama_gejala'
    ];

    public static function kode()
    {
        $kode = Gejala::max('kode');
        $null = '';
        $kode = str_replace("G", "", $kode);
        $kode = (int) $kode + 1;
        $int = $kode;

        if (strlen($kode) == 1) {
            $null = "0";
        }

        $newKode = "G" . $null . $int;
        return $newKode;
    }
}
