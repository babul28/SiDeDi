<?php

use App\CategoryQuestion;
use Illuminate\Database\Seeder;

class CategoryQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryQuestions = [
            [
                'category' => 'Ekslusif'
            ],
            [
                'category' => 'Intoleran'
            ],
            [
                'category' => 'Ekstrem'
            ],
            [
                'category' => 'Kekerasan'
            ],
        ];

        foreach ($categoryQuestions as $categoryQuestion) {
            CategoryQuestion::create($categoryQuestion);
        }
    }
}
