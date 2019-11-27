<?php

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Classe::class, 10)->create();
    }
}
