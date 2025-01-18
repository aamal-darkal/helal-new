@props([
    'items',
    'name',
    'dbValue'
])
<div class="mb-3">
    @foreach ($items as $item )        
        <input class="form-check-input" name="{{ $name }}" type="radio" value="{{ $item }}" id="{{ $item }}" @checked($item == $dbValue)>
        <label for="user" class="ps-3 pe-1 pt-1"> {{ $item }} </label>    
    @endforeach
</div>
