<div class="row ">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="content-left">
            <div class="title-resume">
                <h3>Education</h3>
                <h2>Learning experience in a few <span>Professional Universities</span></h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="content-right">
            @php
                $groupedEducations = $educations
                    ->filter(fn ($edu) => $edu->university)
                    ->groupBy(fn ($edu) => $edu->university->name);
            @endphp
            <ul class="timeline">
                @foreach($groupedEducations as $universityName => $items)
                    @php
                        $first = $items->first();
                        $mode = $first->sub_title ?? $first->type;
                    @endphp
                    <li>
                        <h4>
                            {{ $universityName }}
                            @if($mode)
                                <small style="font-size: 12px;">{{ $mode }}</small>
                            @endif
                        </h4>

                        @foreach($items as $edu)
                            @php
                                $startYear = optional($edu->start_at)->format('Y');
                                $endYear = $edu->end_at ? $edu->end_at->format('Y') : 'Now';
                            @endphp
                            <div class="mb-2">
                                <span class="d-block">
                                    {{ $edu->title }}
                                    @if($startYear || $endYear)
                                        ({{ $startYear }}@if($startYear && $endYear) - {{ $endYear }}@endif)
                                    @endif
                                    @if($edu->type)
                                        <small>
                                            {{ $edu->type }}
                                        </small>
                                    @endif
                                </span>

                                

                                @if($edu->description)
                                    <p class="text-muted small mb-1 mt-1">
                                        {{ $edu->description }}
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
