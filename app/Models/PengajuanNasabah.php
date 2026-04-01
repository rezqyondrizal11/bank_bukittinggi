<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PengajuanNasabah extends Model
{
    protected $table      = 'pengajuan';
    protected $primaryKey = 'id_pengajuan';
    protected $keyType    = 'string';
    public $incrementing  = false;

    protected $fillable = [
        'id_nasabah',
        'id_periode',
        'pekerjaan',
        'jenis_usaha',
        'alamat_usaha',
        'penghasilan_usaha',
        'lama_usaha_tahun',
        'tujuan_pembiayaan',
        'jumlah_permohonan',
        'jangka_waktu_bulan',
        'jumlah_tanggungan',
        'status_pengajuan',
        'no_rek',
        'agree',
    ];

    protected $dates = ['created_at', 'updated_at'];

    // =========================================================
    // AUTO-INCREMENT ID
    // =========================================================
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastNumber = self::selectRaw("MAX(CAST(SUBSTRING(id_pengajuan, 3) AS UNSIGNED)) as max_id")
                ->value('max_id');

            $number = $lastNumber ? $lastNumber + 1 : 1;
            $model->id_pengajuan = 'PN' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    // =========================================================
    // RELASI
    // =========================================================


    public function nasabah()
    {
        return $this->belongsTo(User::class, 'id_nasabah', 'id_user');
    }
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode', 'id_periode');
    }

    public function pasangan()
    {
        return $this->hasOne(PengajuanNasabahPasangan::class, 'id_pengajuan', 'id_pengajuan');
    }


    public function pembiayaan()
    {
        return $this->hasOne(PengajuanNasabahPembiayaan::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function dokumen()
    {
        return $this->hasMany(PengajuanNasabahDokumen::class, 'id_pengajuan', 'id_pengajuan');
    }


    public function penilaians()
    {
        return $this->hasMany(PengajuanNasabahPenilaian::class, 'pengajuan_nasabah_id', 'id_pengajuan');
    }


    public function barangs()
    {
        return $this->hasMany(BarangPermohonan::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function reviews()
    {
        return $this->hasMany(PengajuanNasabahReview::class, 'id_pengajuan', 'id_pengajuan');
    }

    /**
     * Prioritas survei 
     */
    public function prioritasSurveiCalonNasabahSurveyor()
    {
        return $this->hasOne(PrioritasSurveiCalonNasabahSurveyor::class, 'id_pengajuan', 'id_pengajuan');
    }

    /**
     * Nasabah yang sudah disetujui.
     */
    public function nasabahDisetujui()
    {
        return $this->hasOne(NasabahDisetujui::class, 'id_pengajuan', 'id_pengajuan');
    }

    /**
     * Jadwal survei.
     */
    public function jadwalSurvei()
    {
        return $this->hasOne(JadwalSurvei::class, 'id_pengajuan', 'id_pengajuan');
    }
    /**
     * slik bi checking
     */
    public function slik()
    {
        return $this->hasOne(SlikBiChecking::class, 'id_pengajuan', 'id_pengajuan');
    }
    public function statusLogs()
    {
        return $this->hasMany(StatusPengajuanLog::class, 'id_pengajuan', 'id_pengajuan')
            ->orderBy('tanggal_status', 'desc');
    }
    public function akad()
    {
        return $this->hasOne(Akad::class, 'id_pengajuan', 'id_pengajuan');
    }

    // =========================================================
    // HELPER
    // =========================================================

    public function matrix_keputusan($id_kriteria)
    {
        return PengajuanNasabahPenilaian::where('pengajuan_nasabah_id', $this->id_pengajuan)
            ->where('kriteria_id', $id_kriteria)
            ->first();
    }
}
