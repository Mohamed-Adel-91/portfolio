<div class="row gutters">
    <div class="form-group col-md-6">
        <label for="head_title">Head Title</label>
        <input type="text" class="form-control" id="head_title" name="head_title" value="{{ old('head_title', $resume->head_title) }}" required>
        @error('head_title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $resume->title) }}" required>
        @error('title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-12">
        <label for="sub_title">Sub Title</label>
        <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ old('sub_title', $resume->sub_title) }}">
        @error('sub_title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>
