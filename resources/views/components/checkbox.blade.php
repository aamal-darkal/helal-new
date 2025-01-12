@props([
    'name',
    'label',    
    'dbValue' => 0      
])
<div class="mb-3">
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}" {{ $attributes }} 
    @checked(old($name , $dbValue ) == 1) 
    class="d-inline-block position-relative form-check ms-2" value="1"
    style="top: 10px" >
    <label for="{{ $name }}" class="">{{ $label }}</label>
    @error($name)
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
</div>
