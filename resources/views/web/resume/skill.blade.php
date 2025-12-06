@php use Illuminate\Support\Str; @endphp

<style>
    .skill-grid {
        gap: 12px;
    }
    .skill-item {
        width: 96px;
    }
    .skill-circle-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .skill-circle {
        --size: 82px;
        --thickness: 6px;
        --bg-track: rgba(255, 255, 255, 0.08);
        --progress-color: #ff8a00;

        position: relative;
        width: var(--size);
        height: var(--size);
        border-radius: 50%;
        background:
            conic-gradient(
                var(--progress-color) calc(var(--progress) * 1%),
                var(--bg-track) 0
            );
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 4px;
    }
    .skill-circle-inner {
        width: calc(var(--size) - 2 * var(--thickness));
        height: calc(var(--size) - 2 * var(--thickness));
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }
    .skill-circle-inner img {
        max-width: 60%;
        max-height: 60%;
        object-fit: contain;
    }
    .skill-initials {
        font-weight: 600;
        font-size: 0.9rem;
        color: #fff;
    }
    .skill-type-title {
        font-size: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .skill-name {
        color: #fff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="my-skill">
    <div class="row ">

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="content-left">
                <div class="title-resume">
                    <h3>Skill</h3>
                    <h2>With good <span>Personal</span> and <span>Professional Skills</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="content-right">
                @php
                    $typeLabels = [
                        'frontend' => 'Frontend',
                        'backend' => 'Backend',
                        'devops' => 'DevOps',
                        'testing' => 'Testing',
                        'tools' => 'Tools',
                        'general' => 'General',
                        'personal_skills' => 'Personal Skills',
                    ];
                @endphp

                @forelse($skillsByType ?? collect() as $type => $skills)
                    @php
                        $label = $typeLabels[$type] ?? ucfirst(str_replace('_', ' ', (string) $type));
                    @endphp
                    <div class="skill-type-block mb-4">
                        <h4 class="skill-type-title mb-3">
                            <i class="fas fa-circle mr-1" style="font-size: 8px;"></i>
                            {{ $label }}
                        </h4>

                        <div class="skill-grid d-flex flex-wrap">
                            @foreach($skills as $skill)
                                @php
                                    $rawProgress = $skill->progress ?? '0';
                                    $percentage = (int) preg_replace('/[^0-9]/', '', $rawProgress);
                                    $percentage = max(0, min(100, $percentage));
                                    $logoPath = $skill->logo
                                        ? (Str::startsWith($skill->logo, ['http://', 'https://']) ? $skill->logo : asset('upload/' . ltrim($skill->logo, '/')))
                                        : null;
                                    $initials = strtoupper(Str::substr($skill->name ?? '', 0, 2));
                                @endphp
                                <div class="skill-item text-center mb-3 mr-3">
                                    <div class="skill-circle-wrapper">
                                        <div class="skill-circle" style="--progress: {{ $percentage }};">
                                            <div class="skill-circle-inner">
                                                @if($logoPath)
                                                    <img src="{{ $logoPath }}" alt="{{ $skill->name }} logo" class="img-fluid">
                                                @else
                                                    <span class="skill-initials">{{ $initials }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="skill-meta mt-2">
                                        <div class="skill-name small">
                                            {{ $skill->name }}
                                        </div>
                                        <small class="text-muted">{{ $percentage }}%</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No skills added yet.</p>
                @endforelse


            </div>
        </div>
    </div>
</div>
