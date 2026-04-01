<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'tempat_lahir',
        'tanggal_lahir',
        'no_ktp',
        'no_hp',
        'alamat',
        'status_aktif'
    ];
    protected $primaryKey = 'id_user';
    protected $keyType = 'string';
    public $incrementing = false;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'role',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getAuthIdentifier()
    {
        return $this->id_user;
    }

    public function getAuthIdentifierName()
    {
        return 'id_user';
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_user, 2) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_user = 'U' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
}
