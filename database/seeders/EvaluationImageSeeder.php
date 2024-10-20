<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluationImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evaluations = Evaluation::all();

        $images = [
            'afbakeu.jpg',
            'fadmv.jpg',
            'dnalrfsdlf.jpg',
            'fasldgsrtnk.jpg',
            'fnoawev.jpg',
            'kcasdcj.jpg',
        ];

        for($i = 0; $i < 100; $i++) {
            $evaluation = $evaluations->random();
            $evaluation->images()->create([
                'image' => $images[array_rand($images)],
            ]);
        }
    }
}
