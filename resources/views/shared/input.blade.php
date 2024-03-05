@php
    $label ??= null;
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
@endphp

<div @class(['form-group form-floating mb-3', $class])>
    <input class="form-control @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}"
        name="{{ $name }}" value="{{ old($name, $value) }}">
    <label for="{{ $name }}">{{ $label }}</label>
    {{-- @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror --}}
</div>
