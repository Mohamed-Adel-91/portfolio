<div class="row gutters">
    <div class="form-group col-md-6">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
        @error('title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="sub_title">Sub Title</label>
        <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ old('sub_title', $gallery->sub_title) }}">
        @error('sub_title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if (!empty($gallery->image_path))
            <div class="mt-2">
                <img src="{{ asset($gallery->image_path) }}" alt="Current image" class="img-thumbnail" width="120">
            </div>
        @endif
        @error('image')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-12">
        <label for="iframe">Iframe (optional)</label>
        <textarea class="form-control" id="iframe" name="iframe" rows="4" placeholder='<iframe src=\"...\"></iframe>'>{{ old('iframe', $gallery->iframe) }}</textarea>
        @error('iframe')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>
