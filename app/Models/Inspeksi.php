<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspeksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'apar_id', 'user_id', 'kondisi_tekanan', 'kondisi_selang', 'kondisi_segel',
        'catatan', 'foto_tekanan', 'foto_selang', 'foto_segel'
    ];
    public function apar()
    {
        return $this->belongsTo(Apar::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}