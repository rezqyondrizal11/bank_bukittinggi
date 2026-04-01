<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PengajuanNasabahPembiayaan extends Model
{

    protected $table = 'pengajuan_nasabah_pembiayaan';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pengajuan_nasabah_id',
        'kegunaan',
        'jangka_waktu',
        'jumlah',

    ];

    protected $dates = ['created_at', 'updated_at'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;

            $model->id = 'PNPB' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
}
