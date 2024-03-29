<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unsurImage()
    {
        return $this->hasMany(UnsurImage::class);
    }

    public function sertifikatImage()
    {
        return $this->hasMany(SertifikatImage::class);
    }
}
