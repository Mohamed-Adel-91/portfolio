@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container">
                @include('admin.layouts.alerts')

                <div class="row gutters">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title mb-0">Transactions: {{ $item->title }}</div>
                                    <div class="text-muted small">Saved: {{ number_format((float) $item->saved_amount_egp, 2) }} EGP</div>
                                </div>
                                <a href="{{ route('admin.personal.life-goals.index') }}" class="btn btn-outline-secondary">
                                    Back to goals
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table custom-table m-0">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Amount (EGP)</th>
                                                <th>Occurred</th>
                                                <th>Note</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaction)
                                                <tr>
                                                    <td>
                                                        <span class="badge {{ $transaction->type === 'deposit' ? 'bg-success' : 'bg-danger' }}">
                                                            {{ \App\Models\LifeGoalTransaction::typeOptions()[$transaction->type] ?? $transaction->type }}
                                                        </span>
                                                    </td>
                                                    <td>{{ number_format((float) $transaction->amount_egp, 2) }}</td>
                                                    <td>{{ $transaction->occurred_at?->toDateString() }}</td>
                                                    <td>{{ $transaction->note ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <form method="POST"
                                                            action="{{ route('admin.personal.life-goals.transactions.destroy', [$item, $transaction]) }}"
                                                            onsubmit="return confirm('Delete this transaction?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No transactions yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($transactions->hasPages())
                                    @include('admin.partials.pagination', ['data' => $transactions])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
