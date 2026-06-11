<div class="mb-3">
    @if($label) <label for="{{ $name }}" class="form-label">{{ $label }}</label>@endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" {{ $attributes->merge(['class' => 'form-control']) }}>
    @error($name)<div class="text-danger mt-1">{{ $message }}</div>@enderror
</div>