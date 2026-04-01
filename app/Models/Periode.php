<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{

    protected $table = 'periode';
    protected $primaryKey = 'id_periode';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'nama_periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_periode, 3) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_periode = 'P' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
    protected $dates = ['created_at', 'updated_at'];
}
