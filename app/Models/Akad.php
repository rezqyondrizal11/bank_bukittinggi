<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akad extends Model
{
    protected $table      = 'akad';
    protected $primaryKey = 'id_akad';
    protected $keyType    = 'string';
    public $incrementing  = false;

    protected $fillable = [
        'id_pengajuan',
        'id_direksi',
        'nomor_urut',
        'kode_bank',
        'kode_akad',
        'tahun',
        'no_akad',
        'tanggal_akad',
        'jangka_waktu_bulan',
        'harga_pokok',
        'uang_muka',
        'pembiayaan_bank',
        'margin',
        'harga_jual',
        'subsidi_pemko',
        'beban_nasabah',
        'piutang_murabahah',
        'angsuran_bulanan',
        'status_pembiayaan',
    ];

    protected $dates = ['tanggal_akad', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_akad, 4) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_akad = 'AKD' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanNasabah::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function direksi()
    {
        return $this->belongsTo(User::class, 'id_direksi', 'id_user');
    }
}
