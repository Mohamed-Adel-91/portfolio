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
        <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $skill->type) }}" placeholder="Backend, Frontend, Tools">
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

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>
