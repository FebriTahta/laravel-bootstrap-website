<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socialmedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'socialmedia_name','socialmedia_icon','socialmedia_source'
    ];
}
