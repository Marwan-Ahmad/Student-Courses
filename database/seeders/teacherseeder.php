<?php

namespace Database\Seeders;

use App\Models\teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class teacherseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            'Gary Cabrera',
            ' James Vance',
            'Aliza Vance',
            'Averie Carter'
        ];
        foreach($data as $i){
        teacher::query()->create([
            'name'=>$i
        ]);
    }
    }
}