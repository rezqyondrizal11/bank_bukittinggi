<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PrioritasSurveiCalonNasabah extends Model
{

    protected $table = 'hasil_spk';
    protected $primaryKey = 'id_hasil_spk';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_pengajuan',
        'nilai_preferensi',
        'status_terpilih'
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_hasil_spk, 5) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_hasil_spk = 'PSCN' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
    public function pengajuanNasabah()
    {
        return $this->belongsTo(PengajuanNasabah::class, 'id_pengajuan');
    }
}
