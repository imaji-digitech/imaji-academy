<div>
    <input wire:keydown="doSomething" wire:model="some">
    @error('some') <span class="error">{{ $message }}</span> @enderror

    {{ $c }}
</div>
