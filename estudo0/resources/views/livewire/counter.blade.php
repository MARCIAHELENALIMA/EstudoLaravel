<div id="counter">
    {{ $counter }}
    <button wire:click="changeCounter(1)">+ 1</button>
    <button wire:click="changeCounter(-1)">- 1</button>
    <button wire:click="changeCounter(10)">+ 10</button>
    <button wire:click="changeCounter(-10)">- 10</button>

    <!-- Exibe a mensagem armazenada na variável -->
    @if ($message)
        <p>{{ $message }}</p>
    @endif

</div>
