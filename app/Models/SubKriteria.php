<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class SubKriteria extends Model
{

    protected $table = 'sub_kriteria';
    protected $primaryKey = 'id_subkriteria';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_kriteria',
        'deskripsi',
        'nilai',
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_subkriteria, 3) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;

            $model->id_subkriteria = 'SK' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
}
