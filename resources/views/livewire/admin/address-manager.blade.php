<div class="max-w-xl mx-auto">

    @if (session()->has('message'))
        <div class="bg-green-100 p-3 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-3">
        <input wire:model.lazy="cep" placeholder="CEP" class="input" />
        <input wire:model="street" placeholder="Rua" class="input" />
        <input wire:model="number" placeholder="Número" class="input" />
        <input wire:model="complement" placeholder="Complemento" class="input" />
        <input wire:model="district" placeholder="Bairro" class="input" />
        <input wire:model="city" placeholder="Cidade" class="input" />
        <input wire:model="state" placeholder="UF" class="input" />

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Salvar endereço
        </button>
    </form>

    <hr class="my-6">

    <h2 class="font-bold mb-2">Meus endereços</h2>

    @foreach ($addresses as $address)
        <div class="border p-3 mb-2 rounded">
            {{ $address->street }}, {{ $address->number }} - {{ $address->city }}/{{ $address->state }}
        </div>
    @endforeach
</div>
