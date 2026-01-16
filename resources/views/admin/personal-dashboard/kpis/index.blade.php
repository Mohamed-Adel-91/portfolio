@extends('admin.layouts.master')

@section('content')
    @php
        $throughput = $aggregates['throughput'] ?? [];
        $throughputValues = collect($throughput)->pluck('count');
        $maxThroughput = $throughputValues->max() ?? 0;
        $totalCount = $aggregates['totalCount'] ?? 0;
        $completionRate = $aggregates['completionRate'] ?? 0;
        $plannedCount = $aggregates['plannedCount'] ?? 0;
        $donePlannedCount = $aggregates['donePlannedCount'] ?? 0;
        $overdueCount = $aggregates['overdueCount'] ?? 0;
        $quadrantCounts = $aggregates['quadrantCounts'] ?? [];
        $starCounts = $aggregates['starCounts'] ?? [];
        $categoryLeaderboard = $aggregates['categoryLeaderboard'] ?? [];
        $query = request()->query();
    @endphp

    <div class="page-wrapper">
        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container">
                @include('admin.layouts.alerts')

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">KPIs & Analysis</div>
                        <a href="{{ route('admin.personal.kpis.export', $query) }}" class="btn btn-outline-secondary btn-sm">
                            Export CSV
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="GET">
                            <div class="row gutters align-items-end">
                                <div class="form-group col-md-2">
                                    <label for="date_start">From</label>
                                    <input type="date" class="form-control" id="date_start" name="date_start"
                                        value="{{ $rangeStart->toDateString() }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="date_end">To</label>
                                    <input type="date" class="form-control" id="date_end" name="date_end"
                                        value="{{ $rangeEnd->toDateString() }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value="">All</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ (int) ($filters['category_id'] ?? 0) === $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="quadrant">Quadrant</label>
                                    <select class="form-control" id="quadrant" name="quadrant">
                                        <option value="">All</option>
                                        @foreach ($quadrantOptions as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ ($filters['quadrant'] ?? '') === $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">All</option>
                                        @foreach ($statusOptions as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ ($filters['status'] ?? '') === $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="stars_min">Min Stars</label>
                                    <select class="form-control" id="stars_min" name="stars_min">
                                        <option value="">Any</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ ($filters['stars_min'] ?? '') == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row gutters align-items-end mt-2">
                                <div class="form-group col-md-4">
                                    <label>Include</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <input type="hidden" name="include_items" value="0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="include_items" name="include_items"
                                                value="1" {{ ($filters['include_items'] ?? true) ? 'checked' : '' }}>
                                            <label class="form-check-label small" for="include_items">Items</label>
                                        </div>
                                        <input type="hidden" name="include_tasks" value="0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="include_tasks" name="include_tasks"
                                                value="1" {{ ($filters['include_tasks'] ?? true) ? 'checked' : '' }}>
                                            <label class="form-check-label small" for="include_tasks">Tasks</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                    <a href="{{ route('admin.personal.kpis.index') }}" class="btn btn-outline-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row gutters mt-3">
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Completion Rate</div>
                            </div>
                            <div class="card-body">
                                <div class="h4">{{ $completionRate }}%</div>
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $completionRate }}%"></div>
                                </div>
                                <div class="text-muted small">{{ $aggregates['doneCount'] ?? 0 }} done out of {{ $totalCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Planned vs Done</div>
                            </div>
                            <div class="card-body">
                                <div class="text-muted small">Planned</div>
                                <div class="h5">{{ $plannedCount }}</div>
                                <div class="text-muted small">Done</div>
                                <div class="h5">{{ $donePlannedCount }}</div>
                                <div class="progress">
                                    @php
                                        $plannedPercent = $plannedCount > 0 ? round(($donePlannedCount / $plannedCount) * 100) : 0;
                                    @endphp
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $plannedPercent }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Overdue Tasks</div>
                            </div>
                            <div class="card-body">
                                <div class="h4 text-danger">{{ $overdueCount }}</div>
                                <div class="text-muted small">Tasks past due date and not done.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters mt-3">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Weekly Throughput</div>
                            </div>
                            <div class="card-body">
                                @if ($maxThroughput > 0)
                                    <div class="throughput-chart">
                                        @foreach ($throughput as $week)
                                            @php
                                                $height = $maxThroughput > 0 ? round(($week['count'] / $maxThroughput) * 100) : 0;
                                            @endphp
                                            <div class="throughput-bar">
                                                <div class="bar" style="height: {{ $height }}%"></div>
                                                <div class="label">{{ $week['label'] }}</div>
                                                <div class="value">{{ $week['count'] }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-muted">No completed items in this range.</div>
                                @endif
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="card-title">Quadrant Distribution</div>
                            </div>
                            <div class="card-body">
                                @foreach ($quadrantOptions as $value => $label)
                                    @php
                                        $count = $quadrantCounts[$value] ?? 0;
                                        $percent = $totalCount > 0 ? round(($count / $totalCount) * 100) : 0;
                                    @endphp
                                    <div class="metric-row">
                                        <div class="metric-label">{{ $label }}</div>
                                        <div class="metric-bar">
                                            <div style="width: {{ $percent }}%"></div>
                                        </div>
                                        <div class="metric-value">{{ $count }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="card-title">Priority Distribution (Stars)</div>
                            </div>
                            <div class="card-body">
                                @foreach ($starCounts as $stars => $count)
                                    @php
                                        $percent = $totalCount > 0 ? round(($count / $totalCount) * 100) : 0;
                                    @endphp
                                    <div class="metric-row">
                                        <div class="metric-label">{{ $stars }} stars</div>
                                        <div class="metric-bar">
                                            <div style="width: {{ $percent }}%"></div>
                                        </div>
                                        <div class="metric-value">{{ $count }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Category Leaderboard</div>
                            </div>
                            <div class="card-body">
                                @forelse ($categoryLeaderboard as $category)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>{{ $category['name'] }}</span>
                                        <span class="badge bg-light text-dark border">{{ $category['count'] }}</span>
                                    </div>
                                @empty
                                    <div class="text-muted">No category data for this range.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('custom-css-scripts')
    <style>
        .throughput-chart {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            height: 180px;
        }

        .throughput-bar {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1 1 0;
        }

        .throughput-bar .bar {
            width: 100%;
            background: #0d6efd;
            border-radius: 6px 6px 0 0;
            min-height: 4px;
        }

        .throughput-bar .label {
            font-size: 0.7rem;
            color: #6c757d;
            margin-top: 4px;
        }

        .throughput-bar .value {
            font-size: 0.75rem;
            font-weight: 600;
        }

        .metric-row {
            display: grid;
            grid-template-columns: 1fr 2fr auto;
            gap: 8px;
            align-items: center;
            margin-bottom: 8px;
        }

        .metric-label {
            font-size: 0.85rem;
        }

        .metric-bar {
            background: #edf0f2;
            border-radius: 999px;
            height: 8px;
            overflow: hidden;
        }

        .metric-bar div {
            height: 100%;
            background: #20c997;
        }

        .metric-value {
            font-size: 0.85rem;
            font-weight: 600;
        }
    </style>
@endpush
