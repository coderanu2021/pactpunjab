<div class="mb-3">

    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
        </label>
    @endif

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'form-control'
        ]) }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
    @enderror

</div>