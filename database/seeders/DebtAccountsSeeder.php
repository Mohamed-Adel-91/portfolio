<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\DebtAccount;
use App\Services\Debt\DebtService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DebtAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::query()->first();

        if (!$admin && app()->environment(['local', 'development'])) {
            $admin = Admin::create([
                'first_name' => 'Local',
                'last_name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Str::random(16),
                'mobile' => null,
                'profile_picture' => 'images/profile.png',
            ]);
        }

        if (!$admin) {
            return;
        }

        $adminId = $admin->id;
        $service = app(DebtService::class);

        $accounts = [
            [
                'name' => 'SAIB Loan',
                'provider' => 'SAIB',
                'type' => 'loan',
                'currency' => 'EGP',
                'current_balance' => 0,
                'credit_limit' => null,
                'installment_amount' => 3567.00,
                'installment_day' => 15,
                'start_date' => '2022-07-15',
                'end_date' => '2028-07-15',
                'is_active' => true,
            ],
            [
                'name' => 'Cairo Bank House Loan',
                'provider' => 'Banque du Caire',
                'type' => 'loan',
                'currency' => 'EGP',
                'current_balance' => 0,
                'credit_limit' => null,
                'installment_amount' => 777.00,
                'installment_day' => 5,
                'start_date' => '2018-11-05',
                'end_date' => '2038-11-05',
                'is_active' => true,
            ],
            [
                'name' => 'NBE Credit Card',
                'provider' => 'NBE',
                'type' => 'revolving',
                'currency' => 'EGP',
                'current_balance' => 10500.00,
                'credit_limit' => 15000.00,
                'installment_amount' => null,
                'installment_day' => null,
                'start_date' => null,
                'end_date' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Valu Card',
                'provider' => 'Valu',
                'type' => 'revolving',
                'currency' => 'EGP',
                'current_balance' => 29400.00,
                'credit_limit' => 29400.00,
                'installment_amount' => null,
                'installment_day' => null,
                'start_date' => null,
                'end_date' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Aman Card',
                'provider' => 'Aman',
                'type' => 'revolving',
                'currency' => 'EGP',
                'current_balance' => 0.00,
                'credit_limit' => 15000.00,
                'installment_amount' => null,
                'installment_day' => null,
                'start_date' => null,
                'end_date' => null,
                'is_active' => true,
            ],
        ];

        foreach ($accounts as $account) {
            if ($account['type'] === 'loan') {
                $loanModel = new DebtAccount($account);
                $totalPrincipal = $service->computeLoanTotalPrincipal($loanModel);
                $account['principal_balance'] = $totalPrincipal;
                $account['extra_balance'] = 0;
                $account['current_balance'] = $totalPrincipal;
                $account['credit_limit'] = null;
            } else {
                $account['principal_balance'] = $account['current_balance'];
                $account['extra_balance'] = 0;
                $account['current_balance'] = $account['principal_balance'];
            }

            $identity = [
                'name' => $account['name'],
                'provider' => $account['provider'],
                'type' => $account['type'],
            ];

            $service->getOrCreateAccountForAdmin($adminId, $identity, $account);
        }

        $service->refreshNextDueDatesForAdmin($adminId);
    }
}
