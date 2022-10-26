<?php

namespace App\Models\admin;

use Database\Factories\CaseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return new CaseFactory();
    }

    protected $table = 'aturan';

    protected $fillable = [
        'kode',
        'penyakit',
        'aturan'
    ];

    public function penyakits()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit', 'kode');
    }

    public static function kode()
    {
        $kode = Aturan::max('kode');
        $null = '';
        $kode = str_replace("R", "", $kode);
        $kode = (int) $kode + 1;
        $int = $kode;

        if (strlen($kode) == 1) {
            $null = "0";
        }

        $newKode = "R" . $null . $int;
        return $newKode;
    }
}
