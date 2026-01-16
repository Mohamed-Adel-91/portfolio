<div class="row gutters">
    <div class="form-group col-md-6">
        <label for="life_goal_category_id">Category</label>
        <select class="form-control" id="life_goal_category_id" name="life_goal_category_id" required>
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ (int) old('life_goal_category_id', $item->life_goal_category_id) === $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('life_goal_category_id')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $item->title) }}" required>
        @error('title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="target_amount_egp">Target Amount (EGP)</label>
        <input type="number" class="form-control" id="target_amount_egp" name="target_amount_egp" step="0.01" min="0"
            value="{{ old('target_amount_egp', $item->target_amount_egp) }}" required>
        @error('target_amount_egp')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="sort_order">Sort Order</label>
        <input type="number" class="form-control" id="sort_order" name="sort_order" min="0"
            value="{{ old('sort_order', $item->sort_order ?? 0) }}">
        @error('sort_order')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="image">Goal Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @error('image')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
        <div class="goal-image-preview mt-2" id="goalImagePreview">
            @if ($item->image_url)
                <img src="{{ $item->image_url }}" alt="Goal image">
            @else
                <span class="text-muted small">No image selected.</span>
            @endif
        </div>
    </div>

    <div class="form-group col-md-3 d-flex align-items-center">
        <input type="hidden" name="allow_overdraft" value="0">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="allow_overdraft" name="allow_overdraft" value="1"
                {{ old('allow_overdraft', $item->allow_overdraft) ? 'checked' : '' }}>
            <label class="form-check-label" for="allow_overdraft">Allow overdraft</label>
        </div>
    </div>

    <div class="form-group col-md-3 d-flex align-items-center">
        <input type="hidden" name="is_active" value="0">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
    </div>

    <div class="form-group col-12">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $item->description) }}</textarea>
        @error('description')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>
