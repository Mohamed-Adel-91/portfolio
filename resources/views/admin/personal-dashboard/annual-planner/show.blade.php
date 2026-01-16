@extends('admin.layouts.master')

@section('content')
    @php
        $weekdayLabels = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];
        $query = request()->query();
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
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <div>
                                    <div class="text-muted">Annual Planner</div>
                                    <div class="h5 mb-0">{{ $year }}</div>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-outline-secondary"
                                        href="{{ route('admin.personal.annual-planner.show', ['year' => $prevYear] + $query) }}">
                                        Prev
                                    </a>
                                    <a class="btn btn-outline-secondary"
                                        href="{{ route('admin.personal.annual-planner.show', ['year' => $nextYear] + $query) }}">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="GET" class="mt-3">
                    <div class="row gutters align-items-end">
                        <div class="form-group col-md-3">
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
                                @foreach (\App\Models\TodoTask::statusOptions() as $value => $label)
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
                        <div class="form-group col-md-2">
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
                        <div class="form-group col-md-1 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Apply</button>
                            <a href="{{ route('admin.personal.annual-planner.show', ['year' => $year]) }}"
                                class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <div class="row gutters mt-3">
                    <div class="col-lg-9">
                        <div class="annual-grid">
                            @foreach ($calendars as $monthNumber => $calendar)
                                @php
                                    $monthStats = $months[$monthNumber] ?? ['scheduled' => 0, 'done' => 0, 'daily_counts' => []];
                                    $monthName = $calendar['monthStart']->format('F');
                                @endphp
                                <div class="mini-month">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="fw-bold"
                                            href="{{ route('admin.personal.monthly-planner.show', ['year' => $year, 'month' => $monthNumber] + $query) }}">
                                            {{ $monthName }}
                                        </a>
                                        <span class="badge bg-light text-dark border">{{ $monthStats['scheduled'] }} scheduled</span>
                                    </div>
                                    <div class="text-muted small mb-2">Done: {{ $monthStats['done'] }}</div>
                                    <div class="mini-weekdays">
                                        @foreach ($weekdayLabels as $label)
                                            <span>{{ $label }}</span>
                                        @endforeach
                                    </div>
                                    <div class="mini-grid">
                                        @foreach ($calendar['days'] as $day)
                                            @php
                                                $dateKey = $day->toDateString();
                                                $count = $monthStats['daily_counts'][$dateKey] ?? 0;
                                                $heatClass = $count >= 6 ? 'heat-high' : ($count >= 3 ? 'heat-med' : ($count >= 1 ? 'heat-low' : ''));
                                                $isOutside = $day->month !== $calendar['monthStart']->month;
                                            @endphp
                                            <div class="mini-day {{ $heatClass }} {{ $isOutside ? 'is-muted' : '' }}">
                                                {{ $day->format('j') }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Year Highlights</div>
                            </div>
                            <div class="card-body">
                                <div class="text-muted">Completion Rate</div>
                                <div class="h5">{{ $doneRate }}%</div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $doneRate }}%"></div>
                                </div>

                                <div class="text-muted">Total Scheduled</div>
                                <div class="h6">{{ $totalCount }}</div>
                                <div class="text-muted">Done Items/Tasks</div>
                                <div class="h6 mb-3">{{ $doneCount }}</div>

                                <div class="text-muted">Longest Done Streak</div>
                                <div class="h6 mb-3">{{ $longestStreak }} days</div>

                                <div class="text-muted mb-2">Top Categories</div>
                                @forelse ($topCategories as $category)
                                    <div class="d-flex justify-content-between">
                                        <span class="small">{{ $category['name'] }}</span>
                                        <span class="small fw-bold">{{ $category['count'] }}</span>
                                    </div>
                                @empty
                                    <div class="text-muted small">No category data.</div>
                                @endforelse

                                <div class="text-muted mt-3 mb-2">Quadrant Split</div>
                                @foreach ($quadrantOptions as $value => $label)
                                    @php
                                        $count = $quadrantCounts[$value] ?? 0;
                                        $percent = $totalCount > 0 ? round(($count / $totalCount) * 100) : 0;
                                    @endphp
                                    <div class="small">{{ $label }} ({{ $count }})</div>
                                    <div class="progress mb-2">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%"></div>
                                    </div>
                                @endforeach

                                <div class="text-muted mt-3 mb-2">Stars Distribution</div>
                                @foreach ($starCounts as $stars => $count)
                                    <div class="d-flex justify-content-between small">
                                        <span>{{ $stars }} stars</span>
                                        <span class="fw-bold">{{ $count }}</span>
                                    </div>
                                @endforeach
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
        .annual-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
        }

        .mini-month {
            border: 1px solid #e4e7eb;
            border-radius: 8px;
            padding: 12px;
            background: #fff;
        }

        .mini-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            font-size: 0.7rem;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .mini-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            font-size: 0.7rem;
        }

        .mini-day {
            text-align: center;
            padding: 2px 0;
            border-radius: 4px;
        }

        .mini-day.is-muted {
            opacity: 0.4;
        }

        .heat-low {
            background: #e6f4ea;
        }

        .heat-med {
            background: #b7e1cd;
        }

        .heat-high {
            background: #6fcf97;
            color: #fff;
        }
    </style>
@endpush
