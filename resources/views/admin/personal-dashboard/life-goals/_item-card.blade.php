@php
    $savedAmount = (float) $item->saved_amount_egp;
    $remainingAmount = (float) $item->remaining_egp;
    $progressPercent = $item->progress_percent;
    $targetUsd = $item->target_amount_usd;
    $targetSar = $item->target_amount_sar;
@endphp

<div class="col-lg-4 col-md-6">
    <div class="card h-100 goal-card">
        <div class="goal-image">
            @if ($item->image_url)
                <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
            @else
                <div class="goal-placeholder text-muted">
                    <i class="bi bi-image"></i>
                    <span>No image</span>
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="fw-bold">{{ $item->title }}</div>
                    @if ($item->description)
                        <div class="text-muted small">{{ Str::limit($item->description, 80) }}</div>
                    @endif
                </div>
                @if ($item->allow_overdraft)
                    <span class="badge bg-warning text-dark">Overdraft</span>
                @endif
            </div>

            <div class="goal-metrics mt-2">
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Target (EGP)</span>
                    <span class="fw-bold">{{ number_format((float) $item->target_amount_egp, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Target (USD)</span>
                    <span>{{ $targetUsd ? number_format((float) $targetUsd, 2) : '-' }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Target (SAR)</span>
                    <span>{{ $targetSar ? number_format((float) $targetSar, 2) : '-' }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Saved</span>
                    <span class="fw-bold">{{ number_format($savedAmount, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Remaining</span>
                    <span>{{ number_format($remainingAmount, 2) }}</span>
                </div>
            </div>

            <div class="progress mt-2">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progressPercent }}%"></div>
            </div>
            <div class="text-muted small mt-1">{{ number_format($progressPercent, 1) }}% saved</div>

            <div class="d-flex flex-wrap gap-2 mt-3">
                <button type="button" class="btn btn-sm btn-outline-success js-goal-deposit"
                    data-bs-toggle="modal" data-bs-target="#goalDepositModal"
                    data-item-id="{{ $item->id }}" data-item-title="{{ $item->title }}">
                    Add Deposit
                </button>
                <button type="button" class="btn btn-sm btn-outline-danger js-goal-withdraw"
                    data-bs-toggle="modal" data-bs-target="#goalWithdrawModal"
                    data-item-id="{{ $item->id }}" data-item-title="{{ $item->title }}">
                    Withdraw (SOS)
                </button>
                <a href="{{ route('admin.personal.life-goals.transactions', $item) }}"
                    class="btn btn-sm btn-outline-secondary">Transactions</a>
                <a href="{{ route('admin.personal.life-goal-items.edit', $item) }}"
                    class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="POST" action="{{ route('admin.personal.life-goal-items.destroy', $item) }}"
                    class="js-goal-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-dark">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
