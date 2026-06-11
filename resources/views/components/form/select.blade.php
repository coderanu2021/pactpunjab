<div class="mb-3">
    @if($label)
        <label class="form-label">
            {{ $label }}
        </label>
    @endif

    <select
        name="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'form-select'
        ]) }}
    >
        <option value="">
            Select Option
        </option>

        @foreach($options as $value => $text)

            <option
                value="{{ $value }}"
                @selected(old($name, $selected) == $value)
            >
                {{ $text }}
            </option>

        @endforeach

    </select>

    @error($name)
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
</div>