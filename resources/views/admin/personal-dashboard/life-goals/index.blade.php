@extends('admin.layouts.master')

@section('content')
    @php
        $itemsByCategory = $itemsByCategory ?? collect();
    @endphp

    <div class="page-wrapper">
        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container">
                @include('admin.layouts.alerts')

                <div class="row gutters">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <div>
                                    <div class="card-title mb-0">Life Goals & Achievements</div>
                                    <div class="text-muted small">
                                        Base currency: EGP
                                        @if (!empty($rates['USD']) || !empty($rates['SAR']))
                                            | USD rate: {{ $rates['USD'] ?? '-' }} | SAR rate: {{ $rates['SAR'] ?? '-' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-primary" href="{{ route('admin.personal.life-goal-items.create') }}">
                                        <i class="icon-plus-circle mr-1"></i>Add Goal
                                    </a>
                                    <a class="btn btn-outline-primary" href="{{ route('admin.personal.life-goal-categories.create') }}">
                                        Add Category
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="GET" class="mb-3">
                                    <div class="row gutters align-items-end">
                                        <div class="form-group col-md-3">
                                            <label for="active">Status</label>
                                            <select class="form-control" id="active" name="active">
                                                <option value="">All</option>
                                                <option value="1" {{ ($filters['active'] ?? '') === '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ ($filters['active'] ?? '') === '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <a href="{{ route('admin.personal.life-goals.index') }}"
                                                class="btn btn-outline-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>

                                @forelse ($categories as $category)
                                    @php
                                        $categoryItems = $itemsByCategory->get($category->id, collect());
                                    @endphp
                                    <div class="card mb-3">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge"
                                                    style="background-color: {{ $category->color ?? '#6c757d' }}; color: #fff;">
                                                    {{ $category->name }}
                                                </span>
                                                @if ($category->description)
                                                    <span class="text-muted small">{{ $category->description }}</span>
                                                @endif
                                            </div>
                                            <span class="text-muted small">{{ $categoryItems->count() }} goals</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="row gutters">
                                                @forelse ($categoryItems as $item)
                                                    @include('admin.personal-dashboard.life-goals._item-card', [
                                                        'item' => $item,
                                                        'category' => $category,
                                                    ])
                                                @empty
                                                    <div class="col-12 text-muted">No goals in this category yet.</div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-muted">No goal categories yet. Start by creating one.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="goalDepositModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" class="modal-content" id="goalDepositForm"
                data-action-template="{{ route('admin.personal.life-goals.deposit', ['life_goal_item' => '__ID__']) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Deposit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2 text-muted">Goal: <span id="goalDepositTitle">-</span></div>
                    <div class="mb-3">
                        <label class="form-label">Amount (EGP)</label>
                        <input type="number" class="form-control" name="amount_egp" step="0.01" min="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="occurred_at" value="{{ $today }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <input type="text" class="form-control" name="note" placeholder="Monthly saving">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Deposit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="goalWithdrawModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" class="modal-content" id="goalWithdrawForm"
                data-action-template="{{ route('admin.personal.life-goals.withdraw', ['life_goal_item' => '__ID__']) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Withdraw (SOS)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2 text-muted">Goal: <span id="goalWithdrawTitle">-</span></div>
                    <div class="mb-3">
                        <label class="form-label">Amount (EGP)</label>
                        <input type="number" class="form-control" name="amount_egp" step="0.01" min="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="occurred_at" value="{{ $today }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <input type="text" class="form-control" name="note" placeholder="SOS expense">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Withdraw</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom-css-scripts')
    <style>
        .goal-card {
            border: 1px solid #e4e7eb;
        }

        .goal-image {
            height: 180px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid #e4e7eb;
        }

        .goal-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .goal-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
        }
    </style>
@endpush

@push('custom-js-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const depositForm = document.getElementById('goalDepositForm');
            const withdrawForm = document.getElementById('goalWithdrawForm');
            const depositTitle = document.getElementById('goalDepositTitle');
            const withdrawTitle = document.getElementById('goalWithdrawTitle');
            const deleteForms = document.querySelectorAll('.js-goal-delete');

            const updateFormAction = (form, itemId) => {
                if (!form) {
                    return;
                }
                const template = form.dataset.actionTemplate || '';
                form.action = template.replace('__ID__', itemId || '');
            };

            document.querySelectorAll('.js-goal-deposit').forEach((button) => {
                button.addEventListener('click', function() {
                    const itemId = button.dataset.itemId;
                    const title = button.dataset.itemTitle || '';
                    updateFormAction(depositForm, itemId);
                    if (depositTitle) {
                        depositTitle.textContent = title;
                    }
                });
            });

            document.querySelectorAll('.js-goal-withdraw').forEach((button) => {
                button.addEventListener('click', function() {
                    const itemId = button.dataset.itemId;
                    const title = button.dataset.itemTitle || '';
                    updateFormAction(withdrawForm, itemId);
                    if (withdrawTitle) {
                        withdrawTitle.textContent = title;
                    }
                });
            });

            if (deleteForms.length) {
                deleteForms.forEach((form) => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        if (confirm('Delete this goal item?')) {
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>
@endpush
