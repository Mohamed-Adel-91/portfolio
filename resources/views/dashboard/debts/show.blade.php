@extends('admin.layouts.master')
@section('content')
    @php
        $formatMoney = fn($value) => number_format((float) $value, 2);
    @endphp

    <div class="page-wrapper">
        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container" data-account-id="{{ $account->id }}" data-account-type="{{ $account->type }}">
                @include('admin.layouts.alerts')

                <div id="debtMessage" class="alert d-none"></div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div>
                                <h4 class="mb-1">{{ $account->name }}</h4>
                                <div class="text-muted">{{ $account->provider ?? 'Unknown provider' }}</div>
                            </div>
                            <div class="mt-2">
                                <button type="button" class="btn btn-sm btn-outline-success js-transaction-btn"
                                    data-action="payment">
                                    Add Payment
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger js-transaction-btn"
                                    data-action="charge">
                                    Add Charge
                                </button>
                                @if ($account->type === 'revolving')
                                    <button type="button" class="btn btn-sm btn-outline-primary js-limit-btn"
                                        data-url="{{ route('dashboard.debts.limit', $account) }}">
                                        Update Limit
                                    </button>
                                @endif
                                <a href="{{ route('dashboard.debts.index') }}" class="btn btn-sm btn-outline-secondary">
                                    Back
                                </a>
                            </div>
                        </div>

                        <div class="row gutters mt-3">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="text-muted">Total Owed</div>
                                        <div class="debt-total" data-field="total_balance">
                                            {{ $formatMoney($account->total_balance) }} {{ $account->currency }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($account->type === 'revolving')
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="text-muted">Credit Limit</div>
                                            <div class="debt-total" data-field="credit_limit">
                                                {{ $formatMoney($account->credit_limit ?? 0) }} {{ $account->currency }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="text-muted">Available Credit</div>
                                            <div class="debt-total" data-field="available_credit">
                                                {{ $formatMoney($account->available_credit ?? 0) }} {{ $account->currency }}
                                            </div>
                                            <div class="progress debt-progress mt-2">
                                                @php
                                                    $utilization = $account->utilization_percent ?? 0;
                                                @endphp
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: {{ $utilization }}%"
                                                    data-field="utilization_percent">
                                                    {{ $utilization }}%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="text-muted">Total Principal</div>
                                            <div class="debt-total" data-field="total_principal">
                                                {{ $formatMoney($loanTotalPrincipal ?? 0) }} {{ $account->currency }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="text-muted">Remaining Principal</div>
                                            <div class="debt-total" data-field="principal_balance">
                                                {{ $formatMoney($loanRemainingPrincipal ?? $account->principal_balance) }}
                                                {{ $account->currency }}
                                            </div>
                                            <div class="text-muted small mt-2">
                                                Extras: <span data-field="extra_balance">
                                                    {{ $formatMoney($account->extra_balance) }} {{ $account->currency }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($account->type === 'loan')
                            <div class="row gutters mt-3">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between text-muted small">
                                                <span>Installment</span>
                                                <span>
                                                    {{ $formatMoney($account->installment_amount ?? 0) }}
                                                    {{ $account->currency }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between text-muted small mt-1">
                                                <span>Next Due</span>
                                                <span>{{ $account->next_due_date ?? '-' }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between text-muted small mt-1">
                                                <span>End Date</span>
                                                <span>{{ $account->end_date ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="card-title">Transactions</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="transactionsTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Direction</th>
                                        <th>Amount</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->transaction_date }}</td>
                                            <td>{{ ucfirst($transaction->type) }}</td>
                                            <td>{{ ucfirst($transaction->direction) }}</td>
                                            <td>{{ $formatMoney($transaction->amount) }} {{ $account->currency }}</td>
                                            <td>{{ $transaction->note ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No transactions yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Credit Limit Changes</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="limitChangesTable">
                                <thead>
                                    <tr>
                                        <th>Changed At</th>
                                        <th>Old Limit</th>
                                        <th>New Limit</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($limitChanges as $change)
                                        <tr>
                                            <td>{{ $change->changed_at }}</td>
                                            <td>{{ $formatMoney($change->old_limit ?? 0) }} {{ $account->currency }}</td>
                                            <td>{{ $formatMoney($change->new_limit) }} {{ $account->currency }}</td>
                                            <td>{{ $change->note ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No limit changes yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="debtTransactionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="debtTransactionForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionModalTitle">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="account_id" value="{{ $account->id }}">
                    <input type="hidden" name="action_context" id="transactionActionContext">

                    <div class="mb-3">
                        <label class="form-label">Account</label>
                        <input type="text" class="form-control" value="{{ $account->name }}" readonly>
                    </div>
                    <div class="mb-3" id="transactionTypeGroup">
                        <label class="form-label">Type</label>
                        <select name="type" id="transactionType" class="form-select"></select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" step="0.01" min="0.01" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Transaction Date</label>
                        <input type="date" name="transaction_date" class="form-control"
                            value="{{ \Carbon\Carbon::now(config('app.timezone'))->toDateString() }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="note" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="transactionSubmitBtn">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="debtLimitModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="debtLimitForm">
                <div class="modal-header">
                    <h5 class="modal-title">Update Credit Limit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="limitRequestUrl" value="{{ route('dashboard.debts.limit', $account) }}">

                    <div class="mb-3">
                        <label class="form-label">Account</label>
                        <input type="text" class="form-control" value="{{ $account->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Limit</label>
                        <input type="number" step="0.01" min="0" name="new_limit" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="note" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="limitSubmitBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom-css-scripts')
    <style>
        .debt-total {
            font-size: 1.6rem;
            font-weight: 700;
        }

        .debt-progress {
            height: 8px;
        }
    </style>
@endpush

@push('custom-js-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfTokenEl = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenEl ? csrfTokenEl.getAttribute('content') : '';
            const transactionModalEl = document.getElementById('debtTransactionModal');
            const limitModalEl = document.getElementById('debtLimitModal');
            const transactionModal = transactionModalEl ? new bootstrap.Modal(transactionModalEl) : null;
            const limitModal = limitModalEl ? new bootstrap.Modal(limitModalEl) : null;
            const transactionForm = document.getElementById('debtTransactionForm');
            const limitForm = document.getElementById('debtLimitForm');
            const messageEl = document.getElementById('debtMessage');
            const actionContextInput = document.getElementById('transactionActionContext');
            const typeSelect = document.getElementById('transactionType');
            const typeGroup = document.getElementById('transactionTypeGroup');

            const formatMoney = (value) => {
                const number = Number(value) || 0;
                return number.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
            };

            const showMessage = (message, type) => {
                if (!messageEl) {
                    return;
                }
                messageEl.textContent = message;
                messageEl.className = 'alert alert-' + type;
                messageEl.classList.remove('d-none');
            };

            const updateAccountHeader = (account) => {
                const totalEl = document.querySelector('[data-field="total_balance"]');
                if (totalEl) {
                    totalEl.textContent = formatMoney(account.total_balance) + ' ' + account.currency;
                }

                const principalEl = document.querySelector('[data-field="principal_balance"]');
                if (principalEl) {
                    principalEl.textContent = formatMoney(account.principal_balance) + ' ' + account.currency;
                }

                const extraEl = document.querySelector('[data-field="extra_balance"]');
                if (extraEl) {
                    extraEl.textContent = formatMoney(account.extra_balance) + ' ' + account.currency;
                }

                if (account.type === 'revolving') {
                    const limitEl = document.querySelector('[data-field="credit_limit"]');
                    const availableEl = document.querySelector('[data-field="available_credit"]');
                    const utilizationEl = document.querySelector('[data-field="utilization_percent"]');

                    if (limitEl) {
                        limitEl.textContent = formatMoney(account.credit_limit || 0) + ' ' + account.currency;
                    }
                    if (availableEl) {
                        availableEl.textContent = formatMoney(account.available_credit || 0) + ' ' + account.currency;
                    }
                    if (utilizationEl) {
                        const percent = account.utilization_percent || 0;
                        utilizationEl.style.width = percent + '%';
                        utilizationEl.textContent = percent + '%';
                    }
                }
            };

            const setTypeOptions = (action) => {
                if (!typeSelect) {
                    return;
                }
                typeSelect.innerHTML = '';
                if (action === 'payment') {
                    const option = document.createElement('option');
                    option.value = 'payment';
                    option.textContent = 'Payment';
                    typeSelect.appendChild(option);
                } else {
                    ['charge', 'fee', 'interest'].forEach((value) => {
                        const option = document.createElement('option');
                        option.value = value;
                        option.textContent = value.charAt(0).toUpperCase() + value.slice(1);
                        typeSelect.appendChild(option);
                    });
                }
                if (typeGroup) {
                    typeGroup.style.display = 'block';
                }
            };

            document.querySelectorAll('.js-transaction-btn').forEach((button) => {
                button.addEventListener('click', () => {
                    const action = button.dataset.action;
                    if (actionContextInput) {
                        actionContextInput.value = action;
                    }

                    setTypeOptions(action);
                    document.getElementById('transactionModalTitle').textContent =
                        action === 'payment' ? 'Add Payment' : 'Add Charge';

                    if (transactionModal) {
                        transactionModal.show();
                    }
                });
            });

            if (transactionForm) {
                transactionForm.addEventListener('submit', async function(event) {
                    event.preventDefault();
                    const submitBtn = document.getElementById('transactionSubmitBtn');
                    const formData = new FormData(transactionForm);
                    const actionContext = formData.get('action_context');
                    const direction = actionContext === 'payment' ? 'decrease' : 'increase';
                    const type = formData.get('type');

                    submitBtn.disabled = true;
                    showMessage('Saving transaction...', 'info');

                    try {
                        const response = await fetch('{{ route('dashboard.debts.transaction') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });

                        const data = await response.json().catch(() => null);
                        if (!response.ok || !data || !data.ok) {
                            const message = data && data.message ? data.message : 'Unable to save transaction.';
                            showMessage(message, 'danger');
                            return;
                        }

                        updateAccountHeader(data.account);
                        showMessage(data.message || 'Transaction saved.', 'success');

                        const tableBody = document.querySelector('#transactionsTable tbody');
                        if (tableBody) {
                            const note = formData.get('note') || '-';
                            const amount = formatMoney(formData.get('amount')) + ' ' + data.account.currency;
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${formData.get('transaction_date')}</td>
                                <td>${type}</td>
                                <td>${direction}</td>
                                <td>${amount}</td>
                                <td>${note}</td>
                            `;
                            tableBody.prepend(row);
                        }

                        transactionForm.reset();
                        if (transactionModal) {
                            transactionModal.hide();
                        }
                    } catch (error) {
                        showMessage('Network error. Please try again.', 'danger');
                    } finally {
                        submitBtn.disabled = false;
                    }
                });
            }

            if (document.querySelector('.js-limit-btn')) {
                document.querySelector('.js-limit-btn').addEventListener('click', () => {
                    if (limitModal) {
                        limitModal.show();
                    }
                });
            }

            if (limitForm) {
                limitForm.addEventListener('submit', async function(event) {
                    event.preventDefault();
                    const submitBtn = document.getElementById('limitSubmitBtn');
                    const url = document.getElementById('limitRequestUrl').value;
                    const formData = new FormData(limitForm);

                    submitBtn.disabled = true;
                    showMessage('Updating limit...', 'info');

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });

                        const data = await response.json().catch(() => null);
                        if (!response.ok || !data || !data.ok) {
                            const message = data && data.message ? data.message : 'Unable to update limit.';
                            showMessage(message, 'danger');
                            return;
                        }

                        updateAccountHeader(data.account);
                        showMessage(data.message || 'Limit updated.', 'success');

                        const tableBody = document.querySelector('#limitChangesTable tbody');
                        if (tableBody) {
                            const note = formData.get('note') || '-';
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${new Date().toLocaleString()}</td>
                                <td>-</td>
                                <td>${formatMoney(formData.get('new_limit'))} ${data.account.currency}</td>
                                <td>${note}</td>
                            `;
                            tableBody.prepend(row);
                        }

                        limitForm.reset();
                        if (limitModal) {
                            limitModal.hide();
                        }
                    } catch (error) {
                        showMessage('Network error. Please try again.', 'danger');
                    } finally {
                        submitBtn.disabled = false;
                    }
                });
            }
        });
    </script>
@endpush
