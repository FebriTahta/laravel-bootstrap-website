<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
class MigrateBackup implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = DB::table("news")
        ->select("news_title","news_slug","news_desc","news_image")
        ->get();
        return collect($data);
    }
}
