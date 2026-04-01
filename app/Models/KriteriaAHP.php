<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class KriteriaAHP extends Model
{
    protected $table = 'kriteria_ahp';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_kriteria_1',
        'id_kriteria_2',
        'nilai_1',
        'nilai_2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id, 3) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id = 'KA' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
}
