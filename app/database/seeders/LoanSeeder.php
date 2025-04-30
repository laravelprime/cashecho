<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['pending', 'partially_paid', 'paid'];
        $counterparties = ['John Doe', 'Jane Smith', 'ABC Corp', 'XYZ Ltd', 'Mike Johnson'];
        $descriptions = ['Car repair loan', 'Short-term personal loan', 'Investment partnership', 'Loan for rent', 'Business advance'];
        $loanTypes = ['borrowed', 'lent'];
        $loans = [];

        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                $loanType = $loanTypes[array_rand($loanTypes)];
                $status = $statuses[array_rand($statuses)];
                $amount = rand(5000, 500000) / 100; // 50.00 - 5000.00

                $loans[] = [
                    'user_id' => $user->id,
                    'loan_type' => $loanType,
                    'counterparty' => $counterparties[array_rand($counterparties)],
                    'amount' => $amount,
                    'description' => $descriptions[array_rand($descriptions)],
                    'date' => now()->subDays(rand(0, 120)),
                    'status' => $status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('loans')->insert($loans);
    }
}
