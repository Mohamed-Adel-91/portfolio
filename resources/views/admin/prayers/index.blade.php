@extends('admin.layouts.master')
@section('content')
    <div class="page-wrapper">

        <!-- Side bar area -->
        @include('admin.layouts.sidebar')
        <!-- Side bar area end -->

        <!-- Page content area start -->
        <div class="page-content">

            <!-- Page Header Section start -->
            @include('admin.layouts.page-header')
            <!-- Page Header Section end -->

            <!-- Main container start -->
            <div class="main-container">
                @include('admin.layouts.alerts')

                <div class="row gutters">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Prayers</div>
                            </div>
                            <div class="card-body">
                                <div class="row gutters">
                                    @foreach ($prayers as $key => $prayer)
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="card prayer-card h-100">
                                                <div class="card-body">
                                                    <div class="prayer-name">{{ $prayer['label'] }}</div>
                                                    <div class="prayer-count" data-prayer-count="{{ $key }}">
                                                        {{ $counters[$key] ?? 0 }}
                                                    </div>
                                                    <button type="button" class="btn btn-primary btn-sm prayer-done"
                                                        data-prayer="{{ $key }}"
                                                        data-url="{{ route('admin.prayers.done', $key) }}">
                                                        Done
                                                    </button>
                                                    <div class="prayer-status text-muted small mt-2"
                                                        data-prayer-status="{{ $key }}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main container end -->
        </div>
        <!-- Page content area end -->
    </div>
@endsection

@push('custom-css-scripts')
    <style>
        .prayer-card {
            border: 1px solid #edf1f7;
            box-shadow: none;
        }

        .prayer-name {
            font-weight: 600;
            font-size: 1.05rem;
        }

        .prayer-count {
            font-size: 2.4rem;
            font-weight: 700;
            margin: 12px 0 16px;
        }

        .prayer-status {
            min-height: 18px;
        }
    </style>
@endpush

@push('custom-js-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfTokenEl = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenEl ? csrfTokenEl.getAttribute('content') : '';
            const buttons = document.querySelectorAll('.prayer-done');

            const setStatus = (prayerKey, message, className) => {
                const statusEl = document.querySelector('[data-prayer-status="' + prayerKey + '"]');
                if (!statusEl) {
                    return;
                }
                statusEl.textContent = message;
                statusEl.className = 'prayer-status small mt-2 ' + className;
            };

            const updateCounters = (counters) => {
                if (!counters) {
                    return;
                }
                Object.keys(counters).forEach(function(key) {
                    const countEl = document.querySelector('[data-prayer-count="' + key + '"]');
                    if (countEl) {
                        countEl.textContent = counters[key];
                    }
                });
            };

            buttons.forEach(function(button) {
                button.addEventListener('click', async function() {
                    const prayer = button.dataset.prayer;
                    const url = button.dataset.url;

                    if (!csrfToken || !url) {
                        setStatus(prayer, 'Missing configuration.', 'text-danger');
                        return;
                    }

                    button.disabled = true;
                    setStatus(prayer, 'Working...', 'text-muted');

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                        });

                        const data = await response.json().catch(() => null);

                        if (!response.ok || !data || !data.ok) {
                            const message = data && data.message ? data.message : 'Request failed.';
                            setStatus(prayer, message, 'text-danger');
                            return;
                        }

                        updateCounters(data.counters);
                        const message = data.message || 'Done.';
                        setStatus(prayer, message, data.decremented ? 'text-success' : 'text-warning');
                    } catch (error) {
                        setStatus(prayer, 'Network error. Try again.', 'text-danger');
                    } finally {
                        button.disabled = false;
                    }
                });
            });
        });
    </script>
@endpush
