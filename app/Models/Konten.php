<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;
    protected $fillable = ['konten_name','konten_slug','konten_status','kontentable_type','kontentable_id','konten_model'];

    public function kontentable()
    {
        return $this->morphTo();
    }

    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
