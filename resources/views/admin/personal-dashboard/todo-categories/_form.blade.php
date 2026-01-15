<div class="row gutters">
    <div class="form-group col-md-6">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        @error('name')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug"
            value="{{ old('slug', $category->slug) }}" placeholder="auto-generated if empty">
        @error('slug')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="color">Badge Color</label>
        <input type="text" class="form-control" id="color" name="color"
            value="{{ old('color', $category->color) }}" placeholder="#0d6efd">
        @error('color')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="is_active">Status</label>
        <select class="form-control" id="is_active" name="is_active">
            <option value="1" {{ old('is_active', $category->is_active ?? true) ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('is_active', $category->is_active ?? true) ? '' : 'selected' }}>Inactive</option>
        </select>
        @error('is_active')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="sort_order">Sort Order</label>
        <input type="number" class="form-control" id="sort_order" name="sort_order" min="0"
            value="{{ old('sort_order', $category->sort_order ?? 0) }}">
        @error('sort_order')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-12">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
        @error('description')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>
