<?php

namespace Database\Seeders;

use App\Models\course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class courseseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            'English' ,
            'french',
'ICDL',
'Communication Skills'
        ];
        foreach($data as $i){
            course::query()->create([
                'title'=>$i
            ]);
        }

    }
}