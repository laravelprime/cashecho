<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $categories = [];

        foreach ($users as $user) {
            $expense_categories = [
                'Housing',
                'Transportation',
                'Food',
                'Groceries',
                'Utilities',
                'Healthcare',
                'Education',
                'Entertainment'
            ];
            
            $income_categories = [
                'Salary',
                'Bonuses',
                'Investments',
                'Gifts',
                'Business Income'
            ];
            
            $array_1 = collect($income_categories)->map(function ($category) use ($user) {
                return [
                    'transaction_type' => 'income',
                    'user_id' => $user->id,
                    'name' => $category,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();
            
            $array_2 = collect($expense_categories)->map(function ($category) use ($user) {
                return [
                    'transaction_type' => 'expense',
                    'user_id' => $user->id,
                    'name' => $category,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();
            
            $categories = array_merge($categories, $array_1, $array_2); 
        }

        DB::table('categories')->insert($categories);
    }
}
