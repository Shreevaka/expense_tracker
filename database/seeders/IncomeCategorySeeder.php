<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IncomeCategory;

class IncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Salary',
                'description' => 'Monthly salary income',
            ],
            [
                'name' => 'Business',
                'description' => 'Income from business activities',
            ],
            [
                'name' => 'Freelance',
                'description' => 'Freelance project income',
            ],
            [
                'name' => 'Investment',
                'description' => 'Income from investments',
            ],
            [
                'name' => 'Bonus',
                'description' => 'Performance or yearly bonus',
            ],
        ];

        foreach ($categories as $category) {
            IncomeCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
