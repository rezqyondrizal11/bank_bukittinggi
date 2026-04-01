<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlikBiChecking extends Model
{
    protected $table      = 'slik_bi_checking';
    protected $primaryKey = 'id_slik';
    protected $keyType    = 'string';
    public $incrementing  = false;

    protected $fillable = [
        'id_pengajuan',
        'tanggal_cek',
        'status_slik',
        'keterangan',
        'harga',
        'total',
    ];

    protected $dates = ['created_at', 'updated_at'];

    // =========================================================
    // AUTO-INCREMENT ID  (format: SLK001, SLK002, ...)
    // =========================================================
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_slik, 4) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_slik = 'SLK' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    // =========================================================
    // RELASI
    // =========================================================
    public function pengajuan()
    {
        return $this->belongsTo(PengajuanNasabah::class, 'id_pengajuan', 'id_pengajuan');
    }
}
