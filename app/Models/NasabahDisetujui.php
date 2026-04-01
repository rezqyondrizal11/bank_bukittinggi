<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class NasabahDisetujui extends Model
{

    protected $table = 'nasabah_disetujui';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_pengajuan',
        'nilai'
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id, 3) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;

            $model->id = 'ND' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
    public function pengajuanNasabah()
    {
        return $this->belongsTo(PengajuanNasabah::class, 'id_pengajuan');
    }
}
