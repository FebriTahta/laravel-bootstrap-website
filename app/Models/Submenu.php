<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;
    protected $fillable = ['menu_id','submenu_name','submenu_slug','submenu_status'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function konten()
    {
        return $this->morphOne(Konten::class, 'kontentable');
    }
}
