<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserChatbot extends Model
{
    protected $fillable = [
        'user_id',
        'pertanyaan',
        'jawaban',
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id, 3) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;

            $model->id = 'UC' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
}
