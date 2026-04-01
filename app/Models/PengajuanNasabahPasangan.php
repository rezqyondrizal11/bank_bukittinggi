<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PengajuanNasabahPasangan extends Model
{

    protected $table = 'Penjamin';
    protected $primaryKey = 'id_penjamin';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_pengajuan',
        'nama',
        'tempat_lahir',
        'dob',
        'no_ktp',
        'no_hp',
        'alamat',
        'pekerjaan',
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_penjamin, 5) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;

            $model->id_penjamin = 'PNPS' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
}
