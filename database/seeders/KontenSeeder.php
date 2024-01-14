<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Konten;

class KontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'konten_name' => 'konten berita',
                'konten_slug' => 'konten-berita',
                'konten_status' => 1,
                'konten_model' => 2,
                'kontentable_type' => 'App\\Models\\Submenu',
                'kontentable_id' => 1
            ],
            [
                'konten_name' => 'konten guru',
                'konten_slug' => 'konten-guru',
                'konten_status' => 1,
                'konten_model' => 1,
                'kontentable_type' => 'App\\Models\\Submenu',
                'kontentable_id' => 2
            ],
            
        ];

        foreach ($data as $konten) {
            Konten::updateOrInsert(
                ['konten_slug' => $konten['konten_slug']],
                $konten
            );
        }
    }
}
