<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Post;
use App\Models\Kategori;

class MigrateBackupImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $kategori = Kategori::where("kategori_name", "berita")->first();
        $post = new Post([
            'konten_id' => 5,
            'post_title' => $row[0],
            'post_slug' => $row[1],
            'post_status' => 1,
            'post_desc' => $row[2],
            'post_thumb' => $row[3],
            'post_view' => rand(200, 500),
        ]);
        // Simpan post
        $post->save();
        // Tambahkan post ke kategori
        $post->kategori()->sync([$kategori->id]);
        return $post;
    }

}
