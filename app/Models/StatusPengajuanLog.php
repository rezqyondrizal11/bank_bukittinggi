<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPengajuanLog extends Model
{
    protected $table      = 'status_pengajuan_log';
    protected $primaryKey = 'id_status';
    protected $keyType    = 'string';
    public $incrementing  = false;

    protected $fillable = [
        'id_pengajuan',
        'status',
        'tanggal_status',
        'keterangan',
    ];

    protected $dates = ['tanggal_status', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_status, 4) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_status = 'SPL' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }


    public function pengajuan()
    {
        return $this->belongsTo(PengajuanNasabah::class, 'id_pengajuan', 'id_pengajuan');
    }
}
