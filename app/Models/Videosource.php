<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videosource extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_name','video_source','videoable_type','videoable_id'
    ];
}
