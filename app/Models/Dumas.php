<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dumas extends Model
{
    use HasFactory;

    protected $fillable = [
      'tanggal',
      'pelapor',
      'perihal',
      'satker',
      'pj_id',
      'den_id',
      'unit_id',
      'is_done',
      'insert_user',
      'update_user',
    ];

    public function pj() {
      return $this->belongsTo(User::class);
    }

    public function nd() {
      return $this->hasOne(NotaDinas::class);
    }

    public function terlapor() {
      return $this->hasMany(Terlapor::class);
    }

    public function witness() {
      return $this->hasMany(Witness::class);
    }

    public function sphp() {
      return $this->hasOne(SPHP::class);
    }

    public function klarifikasi() {
      return $this->hasOne(Klarifikasi::class);
    }

    public function sprinlidik() {
      return $this->hasOne(SprinLidik::class);
    }

    public function pulbaket() {
      return $this->hasOne(Pulbaket::class);
    }

    public function riksasaksi() {
      return $this->hasOne(RiksaSaksi::class);
    }

    public function bukti_pendukung() {
      return $this->hasOne(BuktiPendukung::class);
    }
    public function evidences() {
      return $this->hasMany(Evidence::class);
    }
    
    public function klarifikasi_terlapor() {
      return $this->hasOne(KlarifikasiTerlapor::class);
    }

    public function lhp() {
      return $this->hasOne(LHP::class);
    }   

    public function pengajuan_gelar() {
      return $this->hasOne(PengajuanGelar::class);
    }

    public function nd_gelar() {
      return $this->hasOne(NDGelar::class);
    }

    public function lhg() {
      return $this->hasOne(LHG::class);
    }

    public function nd_kadiv() {
      return $this->hasOne(NDKadiv::class);
    }

    public function sphp_second() {
      return $this->hasOne(SPHPSecond::class);
    }

    public function progress() {
      return $this->hasMany(ProgressDumas::class)->orderBy('updated_at', 'desc');
    }

    public function latest_progress() {
      return $this->hasOne(ProgressDumas::class)->latestOfMany();
    }

    public function status() {
      return $this->hasOne(DumasStatus::class);
    }

    // documents
    public function sprin() {
      return $this->hasMany(Sprin::class);
    }
    public function bai_saksi() {
      return $this->hasOne(BAISaksi::class);
    }
    public function bai_terlapor() {
      return $this->hasOne(BAITerlapor::class);
    }
    public function sp_saksi() {
      return $this->hasOne(PernyataanSaksi::class);
    }
    public function sp_terlapor() {
      return $this->hasOne(PernyataanTerlapor::class);
    }
    public function nd_lhp() {
      return $this->hasOne(NDLHP::class);
    }
    public function nd_lhg() {
      return $this->hasOne(NDLHG::class);
    }
}
