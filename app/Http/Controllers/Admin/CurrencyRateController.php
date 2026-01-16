<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateCurrencyRateRequest;
use App\Models\CurrencyRate;
use App\Services\PersonalDashboard\LifeGoals\CurrencyRateService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CurrencyRateController extends Controller
{
    public function edit(): View
    {
        $rates = CurrencyRate::query()
            ->orderBy('code')
            ->get()
            ->keyBy('code');

        return view('admin.personal-dashboard.currency-rates.edit', [
            'pageName' => 'Exchange Rates',
            'rates' => $rates,
        ]);
    }

    public function update(
        UpdateCurrencyRateRequest $request,
        CurrencyRateService $service
    ): RedirectResponse {
        $service->updateRates($request->validated()['rates']);

        return redirect()
            ->route('admin.personal.currency-rates.edit')
            ->with('success', 'Exchange rates updated successfully.');
    }
}
