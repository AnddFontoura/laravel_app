<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected array $categories = [
        [
            'name' => 'Camisetas',
            'description' => 'Camisetas de times'
        ],
        [
            'name' => 'Calções',
            'description' => 'Calções de times'
        ],
        [
            'name' => 'Meião',
            'description' => 'Meião de times'
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->categories as $category) {
            $categoryExists = Category::where('name', $category['name'])
                ->first();
           
            if (!$categoryExists) {
                Category::create($category);
            } else {
                Category::where('name', $category['name'])
                    ->update($category);
            }
        }
    }
}
