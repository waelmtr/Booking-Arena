<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sports = [
            "football" ,
            "basketball" ,
            "tennis"
        ];

        foreach($sports as $sport){
            Sport::firstOrCreate(['name' => $sport]);
        }
    }
}
