@props(['field'])
@error($field)
<div class="text-red-500 mt-2">{{ $message }}</div>
@enderror