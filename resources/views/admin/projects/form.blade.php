<div class="row gutters">
    <div class="form-group col-md-6">
        <label for="name">Project Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}" required>
        @error('name')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="url">Project URL</label>
        <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $project->url) }}" placeholder="https://example.com">
        @error('url')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="lunched_at">Launched At</label>
        <input type="date" class="form-control" id="lunched_at" name="lunched_at" value="{{ old('lunched_at', optional($project->lunched_at)->format('Y-m-d')) }}">
        @error('lunched_at')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if (!empty($project->image_path))
            <div class="mt-2">
                <img src="{{ asset($project->image_path) }}" alt="Current image" class="img-thumbnail" width="120">
            </div>
        @endif
        @error('image')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-12">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $project->description) }}</textarea>
        @error('description')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>
