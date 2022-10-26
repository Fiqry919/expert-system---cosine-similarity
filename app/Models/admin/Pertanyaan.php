<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';

    protected $fillable = [
        'no',
        'type',
        'pertanyaan',
        'jawaban',
        'parent',
        'ya',
        'tidak'
    ];

    public static function kode()
    {
        $kode = Pertanyaan::max('no');
        $kode = (int) $kode + 1;

        return $kode;
    }
}
