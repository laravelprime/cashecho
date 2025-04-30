<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $transactions = [];

        foreach ($users as $user) {
            $userCategories = Category::where('user_id', $user->id)->get();

            for ($i = 0; $i < 20; $i++) {
                $category = $userCategories->random();
                $amount = $category->transaction_type === 'income'
                    ? rand(1000, 10000) / 100
                    : rand(100, 5000) / 100;

                $transactions[] = [
                    'amount' => $amount,
                    'description' => Str::title($category->transaction_type) . ' for ' . $category->name,
                    'date' => now()->subDays(rand(0, 60)),
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('transactions')->insert($transactions);
    }
}
