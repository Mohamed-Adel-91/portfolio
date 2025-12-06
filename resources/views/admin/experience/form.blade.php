@php
    $formAction = $formAction ?? route('admin.experience.store');
    $formMethod = strtoupper($formMethod ?? 'POST');
    $selectedCompanyId = old('company_id', session('selected_company_id', $selectedCompanyId ?? $experience->company_id ?? null));
@endphp

<div class="mb-3">
    @if (session('inline_company_success'))
        <div class="alert alert-success" role="alert">
            {{ session('inline_company_success') }}
        </div>
    @endif
    @if ($errors->has('name'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('name') }}
        </div>
    @endif
    <form class="form-inline" method="POST" action="{{ route('admin.experience.company.storeInline') }}">
        @csrf
        <div class="form-row align-items-end">
            <div class="form-group col-md-8">
                <label class="sr-only" for="inline_company_name">New Company</label>
                <input type="text" class="form-control" id="inline_company_name" name="name" placeholder="Add new company">
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-secondary">Add Company</button>
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
        <label for="company_id">Company</label>
        <select class="form-control" id="company_id" name="company_id" required>
            <option value="">-- Select Company --</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ (int) $selectedCompanyId === $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
        @error('company_id')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $experience->title) }}" placeholder="Back-End Web Developer (2023 - Now)" required>
        @error('title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="work_type">Work Type</label>
        <input type="text" class="form-control" id="work_type" name="work_type" value="{{ old('work_type', $experience->work_type) }}" placeholder="Full-time, Part-time, Freelance">
        @error('work_type')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="sub_title">Location type</label>
        <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ old('sub_title', $experience->sub_title) }}" >
        @error('sub_title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="start_at">Start Date</label>
        <input type="date" class="form-control" id="start_at" name="start_at" value="{{ old('start_at', optional($experience->start_at)->format('Y-m-d')) }}">
        @error('start_at')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="end_at">End Date</label>
        <input type="date" class="form-control" id="end_at" name="end_at" value="{{ old('end_at', optional($experience->end_at)->format('Y-m-d')) }}">
        @error('end_at')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="icon">Icon (CSS class)</label>
        <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $experience->icon) }}" placeholder="e.g. fas fa-briefcase">
        @error('icon')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="image">Company Logo</label>
        <input type="file" class="form-control" id="image" name="image">
        @if (!empty($experience->logo_path))
            <div class="mt-2">
                <img src="{{ asset($experience->logo_path) }}" alt="Current logo" class="img-thumbnail" width="120">
            </div>
        @endif
        @error('image')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-12">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $experience->description) }}</textarea>
        @error('description')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>
</form>
