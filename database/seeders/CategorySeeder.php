<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Cursos',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Tenis',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Celulares',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Computadoras',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Cargadores',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Tarjetas de Video',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Monitores Gamer',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Licuadoras',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Televisores',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
        Category::create([
            'name' => 'Neveras',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
    }
}
