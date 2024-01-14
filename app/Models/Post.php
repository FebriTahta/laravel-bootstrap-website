<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['post_title','post_slug','konten_id','post_status','post_desc','post_thumb','post_view'];

    public function konten()
    {
        return $this->belongsTo(Konten::class);
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function videosource()
    {
        return $this->morphMany(Videosource::class, 'videoable');
    }

    public function file()
    {
        return $this->morphMany(File::class,'fileable');
    }

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class);
    }
}
