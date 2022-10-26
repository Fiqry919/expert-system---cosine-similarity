<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryGejala extends Model
{
    use HasFactory;

    protected $table = 'history_gejala';

    protected $fillable = [
        'history_id',
        'gejala'
    ];

    public function history()
    {
        $this->belongsTo(History::class, 'history_id', 'id');
    }
}
