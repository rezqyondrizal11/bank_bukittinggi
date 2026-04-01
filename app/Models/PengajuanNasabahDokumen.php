<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PengajuanNasabahDokumen extends Model
{

    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_pengajuan',
        'jenis_dokumen',
        'file_path',
        'status_verifikasi',

    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_dokumen, 4) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_dokumen = 'PND' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
    protected $dates = ['created_at', 'updated_at'];
}
