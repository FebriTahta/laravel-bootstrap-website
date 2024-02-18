<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'deskripsi_ulasan',
        'rating_ulasan'
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
