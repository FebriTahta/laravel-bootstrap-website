<?php

namespace Database\Seeders;
use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_name' => 'berita',
                'kategori_slug' => 'berita',
                'kategori_status' => 1,
                
            ],
            [
                'kategori_name' => 'artikel',
                'kategori_slug' => 'artikel',
                'kategori_status' => 1,
                
            ],
            [
                'kategori_name' => 'hot topic',
                'kategori_slug' => 'hot topic',
                'kategori_status' => 1,
               
            ],
        ];

        foreach ($data as $kategori) {
            Kategori::updateOrInsert(
                ['kategori_slug' => $kategori['kategori_slug']],
                $kategori
            );
        }
    }
}
