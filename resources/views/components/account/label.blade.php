<label for="{{ $name }}" class="peer-focus:font-medium account-label @error("$name") text-red-400 @enderror">
    {{ $label }}
    @error("$name") {{ $message }}@enderror
</label>
