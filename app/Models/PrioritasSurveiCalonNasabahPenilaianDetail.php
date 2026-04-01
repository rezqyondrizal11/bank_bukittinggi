<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrioritasSurveiCalonNasabahPenilaianDetail extends Model
{
    protected $table = 'detail_survei';


    protected $primaryKey = 'id_detail_survei';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_survei',
        'jenis_dokumen',
        'opsi',
        'keterangan',
        'file_path'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_detail_survei, 7) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_detail_survei = 'PSCNPD' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
}
