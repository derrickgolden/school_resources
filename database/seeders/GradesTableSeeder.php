<?php

namespace Database\Seeders;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $grades = [
            'pp1',
            'pp2',
            'grade one',
            'grade two',
            'grade three',
            'grade four',
            'grade five',
            'grade six',
            'grade seven',
            'grade eight',
            'grade nine',
        ];

        foreach ($grades as $grade) {
            Grade::create(['name' => $grade]);
        }
    }
}
