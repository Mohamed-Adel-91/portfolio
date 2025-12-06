<div class="row gutters">
    <div class="form-group col-md-6">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $skill->name) }}" required>
        @error('name')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="type">Type</label>
        <select id="type" name="type" class="form-control" required>
            <option value="">-- Select Type --</option>
            @foreach($typeOptions as $value => $label)
                <option value="{{ $value }}" {{ old('type', $skill->type?->value ?? $skill->type ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('type')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="progress">Progress (%)</label>
        <input type="number" class="form-control" id="progress" name="progress" value="{{ old('progress', $skill->progress) }}" min="0" max="100" required>
        @error('progress')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="logo">Logo</label>
        <input type="file" class="form-control" id="logo" name="logo">
        @if (!empty($skill->logo_path))
            <div class="mt-2">
                <img src="{{ asset($skill->logo_path) }}" alt="{{ $skill->name }} logo" class="img-thumbnail" width="80">
            </div>
        @endif
        @error('logo')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>
