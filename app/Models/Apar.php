<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_seri', 'jenis_apar', 'kapasitas', 'kepemilikan', 'gedung', 'lantai',
        'koordinat_x', 'koordinat_y', 'status_posisi', 'tanggal_kadaluarsa', 'status_inspeksi', 'qr_code_path'
    ];
    public function inspeksis()
    {
        return $this->hasMany(Inspeksi::class);
    }
}