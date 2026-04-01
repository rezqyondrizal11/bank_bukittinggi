<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PengajuanNasabahReview extends Model
{

    protected $table = 'pengajuan_nasabah_review';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pengajuan_nasabah_id',
        'user_id',
        'status',
        'note',
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id, 4) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id = 'PNR' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
