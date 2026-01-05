@extends('admin.layouts.master')
@section('content')
    @php
        $formatMoney = fn($value) => number_format((float) $value, 2);
    @endphp

    <div class="page-wrapper">
        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container">
                @include('admin.layouts.alerts')

                <div id="debtMessage" class="alert d-none"></div>

                <div class="row gutters">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="text-muted">Total Debt</div>
                                <div class="debt-total text-danger" data-summary="total-debt">
                                    {{ $formatMoney($totalDebt) }} EGP
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="text-muted">Total Available Credit</div>
                                <div class="debt-total text-success" data-summary="total-available">
                                    {{ $formatMoney($totalAvailableCredit) }} EGP
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="text-muted">Loans Due This Month</div>
                                <div class="debt-total">
                                    {{ $loansDueThisMonth->count() }}
                                </div>
                                @if ($loansDueThisMonth->isNotEmpty())
                                    <div class="text-muted small mt-2">
                                        {{ $loansDueThisMonth->pluck('name')->implode(', ') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters mt-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="text-muted">إجمالي قيمة القروض</div>
                                <div class="debt-total text-danger" data-summary="total-loan-principal">
                                    {{ $formatMoney($totalLoanPrincipal) }} EGP
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="text-muted">إجمالي المتبقي من القروض</div>
                                <div class="debt-total text-warning" data-summary="total-loan-remaining">
                                    {{ $formatMoney($totalLoanRemaining) }} EGP
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters mt-3">
                    @foreach ($accounts as $account)
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card h-100 debt-account-card" data-account-id="{{ $account->id }}"
                                data-account-type="{{ $account->type }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="debt-account-name">{{ $account->name }}</div>
                                            <div class="text-muted">{{ $account->provider ?? 'Unknown provider' }}</div>
                                        </div>
                                        <span class="badge {{ $account->type === 'loan' ? 'bg-primary' : 'bg-success' }}">
                                            {{ ucfirst($account->type) }}
                                        </span>
                                    </div>

                                    <div class="debt-balance mt-3" data-field="total_balance">
                                        {{ $formatMoney($account->total_balance) }} {{ $account->currency }}
                                    </div>
                                    <div class="text-muted small">Total Owed</div>

                                    @if ($account->type === 'revolving')
                                        <div class="mt-3">
                                            <div class="d-flex justify-content-between text-muted small">
                                                <span>Credit Limit</span>
                                                <span data-field="credit_limit">
                                                    {{ $formatMoney($account->credit_limit ?? 0) }} {{ $account->currency }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between text-muted small mt-1">
                                                <span>Available</span>
                                                <span data-field="available_credit">
                                                    {{ $formatMoney($account->available_credit ?? 0) }} {{ $account->currency }}
                                                </span>
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
                                    @else
                                        <div class="mt-3">
                                            <div class="d-flex justify-content-between text-muted small">
                                                <span>Total Principal</span>
                                                <span data-field="total_principal">
                                                    {{ $formatMoney($account->total_principal ?? 0) }} {{ $account->currency }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between text-muted small mt-1">
                                                <span>Remaining Principal</span>
                                                <span data-field="principal_balance">
                                                    {{ $formatMoney($account->principal_balance) }} {{ $account->currency }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between text-muted small mt-1">
                                                <span>Extras</span>
                                                <span data-field="extra_balance">
                                                    {{ $formatMoney($account->extra_balance) }} {{ $account->currency }}
                                                </span>
                                            </div>
                                            @php
                                                $loanTotal = (float) ($account->total_principal ?? 0);
                                                $loanRemaining = (float) $account->principal_balance;
                                                $loanPaid = max(0, $loanTotal - $loanRemaining);
                                                $loanProgress = $loanTotal > 0 ? round(($loanPaid / $loanTotal) * 100, 2) : 0;
                                            @endphp
                                            <div class="progress debt-progress mt-2">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ $loanProgress }}%"
                                                    data-field="loan_progress">
                                                    {{ $loanProgress }}%
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between text-muted small mt-1">
                                                <span>Installment</span>
                                                <span>
                                                    {{ $formatMoney($account->installment_amount ?? 0) }}
                                                    {{ $account->currency }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between text-muted small mt-1">
                                                <span>Next Due</span>
                                                <span>
                                                    {{ $account->next_due_date ?? '-' }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between text-muted small mt-1">
                                                <span>End Date</span>
                                                <span>{{ $account->end_date ?? '-' }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="debt-actions mt-4">
                                        <button type="button" class="btn btn-sm btn-outline-success js-transaction-btn"
                                            data-action="payment" data-account-id="{{ $account->id }}">
                                            Add Payment
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger js-transaction-btn"
                                            data-action="charge" data-account-id="{{ $account->id }}">
                                            Add Charge
                                        </button>
                                        @if ($account->type === 'revolving')
                                            <button type="button" class="btn btn-sm btn-outline-primary js-limit-btn"
                                                data-account-id="{{ $account->id }}"
                                                data-url="{{ route('dashboard.debts.limit', $account) }}">
                                                Update Limit
                                            </button>
                                        @endif
                                        <a href="{{ route('dashboard.debts.show', $account) }}"
                                            class="btn btn-sm btn-outline-secondary">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                    <input type="hidden" name="account_id" id="transactionAccountId">
                    <input type="hidden" name="action_context" id="transactionActionContext">

                    <div class="mb-3">
                        <label class="form-label">Account</label>
                        <input type="text" class="form-control" id="transactionAccountName" readonly>
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
                    <input type="hidden" id="limitAccountId">
                    <input type="hidden" id="limitRequestUrl">

                    <div class="mb-3">
                        <label class="form-label">Account</label>
                        <input type="text" class="form-control" id="limitAccountName" readonly>
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

        .debt-account-name {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .debt-balance {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .debt-progress {
            height: 8px;
        }

        .debt-actions .btn {
            margin-right: 6px;
            margin-bottom: 6px;
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
            const accountIdInput = document.getElementById('transactionAccountId');
            const accountNameInput = document.getElementById('transactionAccountName');
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

            const parseValue = (text) => {
                return parseFloat(String(text).replace(/[^\d.-]/g, '')) || 0;
            };

            const updateSummaryTotals = () => {
                let totalDebt = 0;
                let totalAvailable = 0;
                let totalLoanPrincipal = 0;
                let totalLoanRemaining = 0;
                const cards = document.querySelectorAll('.debt-account-card');
                cards.forEach((card) => {
                    const totalEl = card.querySelector('[data-field="total_balance"]');
                    totalDebt += parseValue(totalEl ? totalEl.textContent : 0);

                    if (card.dataset.accountType === 'revolving') {
                        const availableEl = card.querySelector('[data-field="available_credit"]');
                        totalAvailable += parseValue(availableEl ? availableEl.textContent : 0);
                    }

                    if (card.dataset.accountType === 'loan') {
                        const totalPrincipalEl = card.querySelector('[data-field="total_principal"]');
                        const remainingEl = card.querySelector('[data-field="principal_balance"]');
                        totalLoanPrincipal += parseValue(totalPrincipalEl ? totalPrincipalEl.textContent : 0);
                        totalLoanRemaining += parseValue(remainingEl ? remainingEl.textContent : 0);
                    }
                });

                const totalDebtEl = document.querySelector('[data-summary="total-debt"]');
                const totalAvailableEl = document.querySelector('[data-summary="total-available"]');
                const totalLoanPrincipalEl = document.querySelector('[data-summary="total-loan-principal"]');
                const totalLoanRemainingEl = document.querySelector('[data-summary="total-loan-remaining"]');
                if (totalDebtEl) {
                    totalDebtEl.textContent = formatMoney(totalDebt) + ' EGP';
                }
                if (totalAvailableEl) {
                    totalAvailableEl.textContent = formatMoney(totalAvailable) + ' EGP';
                }
                if (totalLoanPrincipalEl) {
                    totalLoanPrincipalEl.textContent = formatMoney(totalLoanPrincipal) + ' EGP';
                }
                if (totalLoanRemainingEl) {
                    totalLoanRemainingEl.textContent = formatMoney(totalLoanRemaining) + ' EGP';
                }
            };

            const updateAccountCard = (account) => {
                const card = document.querySelector('.debt-account-card[data-account-id="' + account.id + '"]');
                if (!card) {
                    return;
                }
                const totalEl = card.querySelector('[data-field="total_balance"]');
                if (totalEl) {
                    totalEl.textContent = formatMoney(account.total_balance) + ' ' + account.currency;
                }

                const principalEl = card.querySelector('[data-field="principal_balance"]');
                if (principalEl) {
                    principalEl.textContent = formatMoney(account.principal_balance) + ' ' + account.currency;
                }

                const extraEl = card.querySelector('[data-field="extra_balance"]');
                if (extraEl) {
                    extraEl.textContent = formatMoney(account.extra_balance) + ' ' + account.currency;
                }

                if (account.type === 'revolving') {
                    const limitEl = card.querySelector('[data-field="credit_limit"]');
                    const availableEl = card.querySelector('[data-field="available_credit"]');
                    const utilizationEl = card.querySelector('[data-field="utilization_percent"]');

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
                } else {
                    const totalPrincipalEl = card.querySelector('[data-field="total_principal"]');
                    const progressEl = card.querySelector('[data-field="loan_progress"]');
                    const totalPrincipal = parseValue(totalPrincipalEl ? totalPrincipalEl.textContent : 0);
                    const remainingPrincipal = Number(account.principal_balance) || 0;
                    const paid = Math.max(0, totalPrincipal - remainingPrincipal);
                    const progress = totalPrincipal > 0 ? Math.round((paid / totalPrincipal) * 10000) / 100 : 0;
                    if (progressEl) {
                        progressEl.style.width = progress + '%';
                        progressEl.textContent = progress + '%';
                    }
                }
                updateSummaryTotals();
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
                    const accountId = button.dataset.accountId;
                    const card = document.querySelector('.debt-account-card[data-account-id="' + accountId + '"]');
                    const accountName = card ? card.querySelector('.debt-account-name').textContent : '';

                    if (accountIdInput) {
                        accountIdInput.value = accountId;
                    }
                    if (actionContextInput) {
                        actionContextInput.value = action;
                    }
                    if (accountNameInput) {
                        accountNameInput.value = accountName;
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

                        updateAccountCard(data.account);
                        showMessage(data.message || 'Transaction saved.', 'success');
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

            document.querySelectorAll('.js-limit-btn').forEach((button) => {
                button.addEventListener('click', () => {
                    const accountId = button.dataset.accountId;
                    const url = button.dataset.url;
                    const card = document.querySelector('.debt-account-card[data-account-id="' + accountId + '"]');
                    const accountName = card ? card.querySelector('.debt-account-name').textContent : '';

                    document.getElementById('limitAccountId').value = accountId;
                    document.getElementById('limitRequestUrl').value = url;
                    document.getElementById('limitAccountName').value = accountName;

                    if (limitModal) {
                        limitModal.show();
                    }
                });
            });

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

                        updateAccountCard(data.account);
                        showMessage(data.message || 'Limit updated.', 'success');
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
