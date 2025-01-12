@props([
    'name',
    'label',
    'dbValue' => '',
    'type' => 'text',   
])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ old( $name , $dbValue ) }}" id="{{ $name }}"
     {{ $attributes->merge( ['class'=> "form-control " . ($errors->has($name)? 'is-invalid':'')])}}>    
        @error($name )
        <div class="text-danger pt-1">
            {{ $message }}
        </div>
    @enderror
</div>
