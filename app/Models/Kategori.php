<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['kategori_name','kategori_status','kategori_slug'];
    
    public function post()
    {
        return $this->belongsToMany(Post::class);
    }
}
