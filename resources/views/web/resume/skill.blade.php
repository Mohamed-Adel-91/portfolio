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
            conic-gradient(var(--progress-color) calc(var(--progress) * 1%),
                var(--bg-track) 0);
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

    .skill-type-title .btn-link {
        color: #fff;
        text-decoration: none;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .skill-type-title .btn-link:hover,
    .skill-type-title .btn-link:focus {
        color: #ccc;
        text-decoration: none;
        box-shadow: none;
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
            <div class="content-right" id="accordionSkills">
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
                        $collapseId = 'skill-type-' . Str::slug((string) $type);
                        $isFirst = $loop->first;
                    @endphp
                    <div class="card mb-3">
                        <div class="card-header p-0">
                            <h4 class="skill-type-title mb-0">
                                <button class="btn btn-link d-flex align-items-center w-100 text-left px-3 py-2"
                                    type="button" data-toggle="collapse" data-target="#{{ $collapseId }}"
                                    aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
                                    aria-controls="{{ $collapseId }}">
                                    <i class="fas fa-circle mr-2" style="font-size: 8px;"></i>
                                    {{ $label }}
                                </button>
                            </h4>
                        </div>
                        <div id="{{ $collapseId }}" class="collapse {{ $isFirst ? 'show' : '' }}"
                            data-parent="#accordionSkills">
                            <div class="card-body pt-3">
                                <div class="skill-grid d-flex flex-wrap">
                                    @foreach ($skills as $skill)
                                        @php
                                            $rawProgress = $skill->progress ?? '0';
                                            $percentage = (int) preg_replace('/[^0-9]/', '', $rawProgress);
                                            $percentage = max(0, min(100, $percentage));
                                            $logoPath = $skill->logo
                                                ? (Str::startsWith($skill->logo, ['http://', 'https://'])
                                                    ? $skill->logo
                                                    : asset('upload/' . ltrim($skill->logo, '/')))
                                                : null;
                                            $initials = strtoupper(Str::substr($skill->name ?? '', 0, 2));
                                        @endphp
                                        <div class="skill-item text-center mb-3 mr-3">
                                            <div class="skill-circle-wrapper">
                                                <div class="skill-circle" style="--progress: {{ $percentage }};">
                                                    <div class="skill-circle-inner">
                                                        @if ($logoPath)
                                                            <img src="{{ $logoPath }}"
                                                                alt="{{ $skill->name }} logo" class="img-fluid">
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
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No skills added yet.</p>
                @endforelse


            </div>
        </div>
    </div>
</div>
