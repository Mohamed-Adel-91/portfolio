@extends('admin.layouts.master')

@section('content')
    @php
        $usdRate = old('rates.USD.rate_to_egp', optional($rates->get('USD'))->rate_to_egp);
        $sarRate = old('rates.SAR.rate_to_egp', optional($rates->get('SAR'))->rate_to_egp);
        $usdActive = old('rates.USD.is_active', optional($rates->get('USD'))->is_active ?? true);
        $sarActive = old('rates.SAR.is_active', optional($rates->get('SAR'))->is_active ?? true);
    @endphp

    <div class="page-wrapper">
        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container">
                @include('admin.layouts.alerts')

                <div class="row gutters">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-title mb-0">Exchange Rates</div>
                                <a href="{{ route('admin.personal.life-goals.index') }}"
                                    class="btn btn-outline-secondary">Back</a>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.personal.currency-rates.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row gutters">
                                        <div class="col-md-6">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="fw-bold">USD</div>
                                                        <div class="form-check">
                                                            <input type="hidden" name="rates[USD][is_active]" value="0">
                                                            <input class="form-check-input" type="checkbox" id="usd_active"
                                                                name="rates[USD][is_active]" value="1" {{ $usdActive ? 'checked' : '' }}>
                                                            <label class="form-check-label small" for="usd_active">Active</label>
                                                        </div>
                                                    </div>
                                                    <label class="form-label mt-2">1 USD = EGP</label>
                                                    <input type="number" class="form-control" name="rates[USD][rate_to_egp]" step="0.000001"
                                                        value="{{ $usdRate }}" required>
                                                    @error('rates.USD.rate_to_egp')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="fw-bold">SAR</div>
                                                        <div class="form-check">
                                                            <input type="hidden" name="rates[SAR][is_active]" value="0">
                                                            <input class="form-check-input" type="checkbox" id="sar_active"
                                                                name="rates[SAR][is_active]" value="1" {{ $sarActive ? 'checked' : '' }}>
                                                            <label class="form-check-label small" for="sar_active">Active</label>
                                                        </div>
                                                    </div>
                                                    <label class="form-label mt-2">1 SAR = EGP</label>
                                                    <input type="number" class="form-control" name="rates[SAR][rate_to_egp]" step="0.000001"
                                                        value="{{ $sarRate }}" required>
                                                    @error('rates.SAR.rate_to_egp')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Save Rates</button>
                                    </div>
                                </form>
                                <div class="text-muted small mt-3">
                                    Rates use EGP as base: enter how many EGP equal 1 unit of USD or SAR.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
