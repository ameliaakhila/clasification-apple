<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPrediksi extends Model
{
    use HasFactory;

    protected $table = 'hasil_prediksi';
    protected $fillable = [
        'diameter',
        'berat',
        'kadar_gula',
        'warna',
        'asal_daerah',
        'musim_panen',
        'hasil'
    ];

    // public $timestamps = false;
}
