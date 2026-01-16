<div class="max-w-xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold">✏️ Editar Endereço</h1>

    <form wire:submit.prevent="update" class="space-y-4">

        <input
            type="text"
            wire:model.defer="cep"
            placeholder="CEP"
            class="w-full border rounded p-2"
        >

        <input
            type="text"
            wire:model.defer="street"
            placeholder="Rua"
            class="w-full border rounded p-2"
        >

        <input
            type="text"
            wire:model.defer="number"
            placeholder="Número"
            class="w-full border rounded p-2"
        >

        <input
            type="text"
            wire:model.defer="complement"
            placeholder="Complemento (opcional)"
            class="w-full border rounded p-2"
        >

        <input
            type="text"
            wire:model.defer="district"
            placeholder="Bairro"
            class="w-full border rounded p-2"
        >

        <input
            type="text"
            wire:model.defer="city"
            placeholder="Cidade"
            class="w-full border rounded p-2"
        >

        <input
            type="text"
            wire:model.defer="state"
            placeholder="UF"
            class="w-full border rounded p-2"
        >

        <button
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Atualizar endereço
        </button>

    </form>
</div>
