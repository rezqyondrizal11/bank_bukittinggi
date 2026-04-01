<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalSurvei extends Model
{
    protected $table      = 'jadwal_survei';
    protected $primaryKey = 'id_survei';
    protected $keyType    = 'string';
    public $incrementing  = false;

    protected $fillable = [
        'id_ao',
        'id_pengajuan',
        'tanggal_survei',
        'note',
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_survei, 7) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_survei = 'JDWSRV' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function pengajuanNasabah()
    {
        return $this->belongsTo(PengajuanNasabah::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_ao', 'id_user');
    }

    public function details()
    {
        return $this->hasMany(PrioritasSurveiCalonNasabahPenilaianDetail::class, 'id_survei', 'id_survei');
    }
}
