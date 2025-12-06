@php
    $formAction = $formAction ?? route('admin.education.store');
    $formMethod = strtoupper($formMethod ?? 'POST');
    $selectedUniversityId = old('university_id', session('selected_university_id', $selectedUniversityId ?? $education->university_id ?? null));
@endphp

<div class="mb-3">
    @if (session('inline_university_success'))
        <div class="alert alert-success" role="alert">
            {{ session('inline_university_success') }}
        </div>
    @endif
    @if ($errors->has('name'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('name') }}
        </div>
    @endif
    <form class="form-inline" method="POST" action="{{ route('admin.education.university.storeInline') }}">
        @csrf
        <div class="form-row align-items-end">
            <div class="form-group col-md-8">
                <label class="sr-only" for="inline_university_name">New University</label>
                <input type="text" class="form-control" id="inline_university_name" name="name" placeholder="Add new university">
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-secondary">Add University</button>
            </div>
        </div>
    </form>
</div>

<form method="POST" action="{{ $formAction }}" enctype="multipart/form-data">
    @csrf
    @if ($formMethod !== 'POST')
        @method($formMethod)
    @endif

    <div class="row gutters">
    <div class="form-group col-md-6">
        <label for="university_id">University</label>
        <select class="form-control" id="university_id" name="university_id" required>
            <option value="">-- Select University --</option>
            @foreach($universities as $university)
                <option value="{{ $university->id }}" {{ (int) $selectedUniversityId === $university->id ? 'selected' : '' }}>
                    {{ $university->name }}
                </option>
            @endforeach
        </select>
        @error('university_id')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $education->title) }}" required>
        @error('title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="type">Type</label>
        <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $education->type) }}" placeholder="Diploma, Bachelor's Degree, Course">
        @error('type')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="sub_title">Sub Title</label>
        <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ old('sub_title', $education->sub_title) }}" placeholder="Faculty / Department">
        @error('sub_title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="start_at">Start Date</label>
        <input type="date" class="form-control" id="start_at" name="start_at" value="{{ old('start_at', optional($education->start_at)->format('Y-m-d')) }}">
        @error('start_at')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="end_at">End Date</label>
        <input type="date" class="form-control" id="end_at" name="end_at" value="{{ old('end_at', optional($education->end_at)->format('Y-m-d')) }}">
        @error('end_at')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="icon">Icon (CSS class)</label>
        <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $education->icon) }}" placeholder="e.g. fas fa-graduation-cap">
        @error('icon')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if (!empty($education->image_path))
            <div class="mt-2">
                <img src="{{ asset($education->image_path) }}" alt="Current image" class="img-thumbnail" width="120">
            </div>
        @endif
        @error('image')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-12">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $education->description) }}</textarea>
        @error('description')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>
</form>
