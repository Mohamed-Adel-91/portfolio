@php use Illuminate\Support\Str; @endphp

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
                        'backend' => 'Backend',
                        'database' => 'Database',
                        'frontend' => 'Frontend',
                        'devops' => 'DevOps',
                        'data_science_and_analytics' => 'Data Science & Analytics',
                        'testing' => 'Testing',
                        'tools' => 'Tools',
                        'general' => 'General',
                        'personal_skills' => 'Personal Skills',
                    ];
                    $orderedTypeKeys = collect(['backend','database','frontend', 'devops', 'data_science_and_analytics',  'testing', 'tools', 'general', 'personal_skills'])
                        ->filter(fn ($key) => ($skillsByType ?? collect())->has($key));
                    $remainingTypes = collect($skillsByType ?? collect())->keys()->diff($orderedTypeKeys);
                    $orderedTypeKeys = $orderedTypeKeys->concat($remainingTypes);
                @endphp

                @forelse($orderedTypeKeys as $type)
                    @php $skills = ($skillsByType ?? collect())[$type] ?? collect(); @endphp
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
                        <div id="{{ $collapseId }}" class="collapse {{ $isFirst ? 'show' : 'show' }}"
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

@push('custom-web-js-scripts')
    <script>
        (function ($) {
            const accordion = $('#accordionSkills');

            accordion.find('.collapse').on('show.bs.collapse', function () {
                accordion.find('.collapse.show').not(this).collapse('hide');
            });
        })(jQuery);
    </script>
@endpush
