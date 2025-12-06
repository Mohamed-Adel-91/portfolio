<div class="row ">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="content-left">
            <div class="title-resume">
                <h3>Experience</h3>
                <h2>Over {{ date('Y') - 2012 }} years of professional experience - More than {{ date('Y') - 2022 }} years experience as
                    a <span>Software Developer</span></h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="content-right">
            @php
                $groupedExperiences = $experiences
                    ->filter(fn ($exp) => $exp->company)
                    ->groupBy(fn ($exp) => $exp->company->name);
            @endphp
            <ul class="timeline">
                @foreach($groupedExperiences as $companyName => $items)
                    @php
                        $first = $items->first();
                        $workType = $first->work_type;
                    @endphp
                    <li>
                        <h4>
                            {{ $companyName }}
                            @if($workType)
                                <small style="font-size: 12px;">{{ $workType }}</small>
                            @endif
                        </h4>

                        @foreach($items as $exp)
                            @php
                                $startYear = optional($exp->start_at)->format('Y');
                                $endYear = $exp->end_at ? $exp->end_at->format('Y') : 'Now';
                            @endphp
                            <div class="mb-2">
                                <span class="d-block">
                                    {{ $exp->title }}
                                    @if($startYear || $endYear)
                                        ({{ $startYear }}@if($startYear && $endYear) - {{ $endYear }}@endif)
                                    @endif
                                    @if($exp->sub_title)
                                        <small class="text-muted">
                                            {{ $exp->sub_title }}
                                        </small>
                                    @endif
                                </span>

                                @if($exp->description)
                                    <p class="text-muted small mb-1 mt-1">
                                        {{ $exp->description }}
                                    </p>
                                @endif
                            </div>

                            @if(!$loop->last)
                                <hr class="my-2" style="border-color: rgba(255,255,255,0.1);">
                            @endif
                        @endforeach
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
