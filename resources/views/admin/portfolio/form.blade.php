<div class="row gutters">
    <div class="form-group col-md-6">
        <label for="project_id">Project</label>
        <select class="form-control" id="project_id" name="project_id" required>
            <option value="">-- Select Project --</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ (int) old('project_id', $portfolio->project_id) === $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
        @error('project_id')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $portfolio->title) }}" required>
        @error('title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="sub_title">Sub Title</label>
        <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ old('sub_title', $portfolio->sub_title) }}">
        @error('sub_title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if (!empty($portfolio->image_path))
            <div class="mt-2">
                <img src="{{ asset($portfolio->image_path) }}" alt="Current image" class="img-thumbnail" width="120">
            </div>
        @endif
        @error('image')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>
