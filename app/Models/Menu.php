<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = ['menu_name','menu_status','menu_slug'];

    // relasi
    public function submenu()
    {
        return $this->hasMany(Submenu::class);
    }

    public function konten()
    {
        return $this->morphOne(Konten::class, 'kontentable');
    }
}
