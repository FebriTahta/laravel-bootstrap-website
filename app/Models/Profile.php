<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_name',
        'profile_title',
        'profile_subtitle',
        'profile_thumb',
        'profile_logo',
        'profile_badge',
        'profile_link1',
        'profile_heroimage',
        'profile_herotitle',
        'profile_herosubtitle',
        'profile_herodesc',
        'profile_contactnumber',
        'profile_featuretitle',
        'profile_featuredesc',
        'profile_featurelink',
        'profile_address',
        'profile_email',
        'profile_maplong',
        'profile_maplat',
    ];

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
