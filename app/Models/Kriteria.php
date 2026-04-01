<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Kriteria extends Model
{

    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'nama',
        'kode_kriteria',
        'bobot',
        'jenis'
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_kriteria, 2) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_kriteria = 'K' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class, 'id_kriteria', 'id_kriteria');
    }
    public function nilai_min()
    {
        return PengajuanNasabahPenilaian::join(
            'sub_kriteria',
            'sub_kriteria.id_subkriteria',
            '=',
            'pengajuan_nasabah_penilaian.sub_kriteria_id'
        )
            ->where('pengajuan_nasabah_penilaian.kriteria_id', $this->id)
            ->min('sub_kriteria.nilai');
    }

    public function nilai_max()
    {
        return PengajuanNasabahPenilaian::join(
            'sub_kriteria',
            'sub_kriteria.id_subkriteria',
            '=',
            'pengajuan_nasabah_penilaian.sub_kriteria_id'
        )
            ->where('pengajuan_nasabah_penilaian.kriteria_id', $this->id)
            ->max('sub_kriteria.nilai');
    }
}
