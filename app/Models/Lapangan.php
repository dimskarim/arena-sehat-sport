<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model {
    use HasFactory;
    protected $fillable = ['kategori_id', 'name', 'deskripsi', 'harga', 'status'];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
    public function gambarLapangans() {
        return $this->hasMany(GambarLapangan::class);
    }
    public function waktuOperasionals() {
        return $this->hasMany(WaktuOperasional::class);
    }

    // Scope for filtering & search
    public function scopeSearch($query, $term) {
        if ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        }
    }
    public function scopeFilterKategori($query, $kategori_id) {
        if ($kategori_id) {
            $query->where('kategori_id', $kategori_id);
        }
    }
}