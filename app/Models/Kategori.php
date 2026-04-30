<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model {
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    protected static function boot() {
        parent::boot();
        static::creating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->name);
        });
        static::updating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->name);
        });
    }

    public function lapangans() {
        return $this->hasMany(Lapangan::class);
    }
}