<div class="max-w-xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold">📍 Novo Endereço</h1>

    <form wire:submit.prevent="save" class="space-y-4">

        <input
            type="text"
            wire:model.debounce.800ms="cep"
            placeholder="CEP"
            class="w-full border rounded p-2"
        />
        <input type="text" wire:model.defer="street" placeholder="Rua"
               class="w-full border rounded p-2">

        <input type="text" wire:model.defer="number" placeholder="Número"
               class="w-full border rounded p-2">

        <input type="text" wire:model.defer="complement" placeholder="Complemento (opcional)"
               class="w-full border rounded p-2">

        <input type="text" wire:model.defer="district" placeholder="Bairro"
               class="w-full border rounded p-2">

        <input type="text" wire:model.defer="city" placeholder="Cidade"
               class="w-full border rounded p-2">

        <input type="text" wire:model.defer="state" placeholder="UF"
               class="w-full border rounded p-2">

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Salvar endereço
        </button>

    </form>
</div>
