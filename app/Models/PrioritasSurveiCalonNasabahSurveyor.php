<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PrioritasSurveiCalonNasabahSurveyor extends Model
{

    protected $table = 'prioritas_survei_calon_nasabah_surveyor';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pengajuan_nasabah_id',
        'user_id',
        'survei_date'
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id, 6) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;

            $model->id = 'PSCNS' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
    public function pengajuanNasabah()
    {
        return $this->belongsTo(PengajuanNasabah::class, 'pengajuan_nasabah_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
