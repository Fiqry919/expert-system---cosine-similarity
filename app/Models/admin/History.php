<?php

namespace App\Models\admin;

use Database\Factories\HistoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return new HistoryFactory();
    }

    protected $table = 'history';

    protected $fillable = [
        'id',
        'name',
        'email',
        'penyakit'
    ];

    protected $casts = [
        'id' => 'string'
    ];

    public function gejala()
    {
        $this->hasMany(HistoryGejala::class);
    }
}
