<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExpenseCategory;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $categories = [
            [
                'name' => 'Food',
                'description' => 'Daily food and restaurant expenses',
            ],
            [
                'name' => 'Transport',
                'description' => 'Bus, fuel, taxi, travel expenses',
            ],
            [
                'name' => 'Bills',
                'description' => 'Electricity, water, internet bills',
            ],
            [
                'name' => 'Shopping',
                'description' => 'Personal shopping expenses',
            ],
            [
                'name' => 'Health',
                'description' => 'Medical and pharmacy expenses',
            ],
            [
                'name' => 'Entertainment',
                'description' => 'Movies, games, subscriptions',
            ],
        ];

        foreach ($categories as $category) {
            ExpenseCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
