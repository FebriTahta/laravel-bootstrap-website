<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_name',
        'alumni_jurusan',
        'alumni_tahun_ajaran1',
        'alumni_tahun_ajaran2',
        'alumni_email',
        'alumni_kegiatan',
        'alumni_keterangan',
        'alumni_passpharse',
        'alumni_image',
        'alumni_status'
    ];

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class);
    }
}
