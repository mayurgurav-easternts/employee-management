<div>
    <label>{{ $label }}</label>
    <input type="{{ $type }}" wire:model="{{ $model }}" class="form-control">
    @error($model) <span class="text-danger">{{ $message }}</span> @enderror
</div>
