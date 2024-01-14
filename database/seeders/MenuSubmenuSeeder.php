<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Database\Seeder;

class MenuSubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                // 1
                'menu_name' => 'informasi', 
                'menu_slug' => 'informasi',
                'menu_status' => 1
            ],
            [
                // 2
                'menu_name' => 'kesiswaan',
                'menu_slug' => 'kesiswaan',
                'menu_status' => 1
            ],
            [
                // 3
                'menu_name' => 'alumni',
                'menu_slug' => 'alumni',
                'menu_status' => 1
            ],
            [
                // 4
                'menu_name' => 'profile',
                'menu_slug' => 'profile',
                'menu_status' => 1
            ],
            [
                // 5
                'menu_name' => 'fasilitas',
                'menu_slug' => 'fasilitas',
                'menu_status' => 1
            ],
            
        ];

        // Menu::insert($data);
        foreach ($data as $menuData) {
            Menu::updateOrInsert(
                ['menu_slug' => $menuData['menu_slug']],
                $menuData
            );
        }

        $data2 = [
            [
                'menu_id' => 1, 
                'submenu_name' => 'daftar berita',
                'submenu_slug' => 'daftar-berita',
                'submenu_status' => 1
            ],
            [
                'menu_id' => 1, 
                'submenu_name' => 'daftar guru',
                'submenu_slug' => 'daftar-guru',
                'submenu_status' => 1
            ],
            [
                'menu_id' => 1, 
                'submenu_name' => 'daftar jurusan',
                'submenu_slug' => 'daftar-jurusan',
                'submenu_status' => 1
            ],
            [
                'menu_id' => 1, 
                'submenu_name' => 'daftar prestasi',
                'submenu_slug' => 'daftar-prestasi',
                'submenu_status' => 1
            ],
            [
                'menu_id' => 1, 
                'submenu_name' => 'daftar program unggulan',
                'submenu_slug' => 'daftar-program-unggulan',
                'submenu_status' => 1
            ],
            [
                'menu_id' => 2, 
                'submenu_name' => 'informasi kesiswaan',
                'submenu_slug' => 'informasi-kesiswaan',
                'submenu_status' => 1
            ],
            [
                'menu_id' => 2, 
                'submenu_name' => 'informasi kemitraan',
                'submenu_slug' => 'informasi-kemitraan',
                'submenu_status' => 1
            ],
            [
                'menu_id' => 3, 
                'submenu_name' => 'daftar alumni',
                'submenu_slug' => 'daftar-alumni',
                'submenu_status' => 1
            ],
            [
                'menu_id' => 3, 
                'submenu_name' => 'pendataan alumni',
                'submenu_slug' => 'pendataan-alumni',
                'submenu_status' => 1
            ],
            [
                'menu_id' => 4, 
                'submenu_name' => 'sarana prasarana',
                'submenu_slug' => 'sarana-prasarana',
                'submenu_status' => 1
            ],
        ];

        // Menu::insert($data);
        foreach ($data2 as $submenuData) {
            Submenu::updateOrInsert(
                ['submenu_slug' => $submenuData['submenu_slug']],
                $submenuData
            );
        }
    }
}
