<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangPermohonan extends Model
{

    protected $table = 'barang_permohonan';
    protected $primaryKey = 'id_barang';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_pengajuan',
        'nama_barang',
        'volume',
        'satuan',
        'harga',
        'total',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_barang, 3) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_barang = 'BP' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
    protected $dates = ['created_at', 'updated_at'];
}
