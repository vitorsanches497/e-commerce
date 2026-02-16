<div class="max-w-xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold">➕ Novo Endereço</h1>

    <form wire:submit.prevent="save" class="space-y-4">

        <div>
            <label class="block text-sm font-medium mb-1">CEP</label>
            <input
                type="text"
                wire:model.blur="cep"
                placeholder="00000-000"
                maxlength="9"
                class="w-full border rounded p-2 @if($cepError) border-red-500 @endif"
            >
            
            @if($buscandoCep)
                <p class="text-blue-500 text-sm mt-1">🔄 Buscando CEP...</p>
            @endif
            
            @if($cepError)
                <p class="text-red-500 text-sm mt-1">{{ $cepError }}</p>
            @endif
            
            @error('cep')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Rua</label>
            <input
                type="text"
                wire:model.defer="street"
                placeholder="Nome da rua"
                class="w-full border rounded p-2 @error('street') border-red-500 @enderror"
            >
            @error('street')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Número</label>
            <input
                type="text"
                wire:model.defer="number"
                placeholder="123"
                class="w-full border rounded p-2 @error('number') border-red-500 @enderror"
            >
            @error('number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Complemento (opcional)</label>
            <input
                type="text"
                wire:model.defer="complement"
                placeholder="Apto, Bloco, etc"
                class="w-full border rounded p-2"
            >
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Bairro</label>
            <input
                type="text"
                wire:model.defer="district"
                placeholder="Nome do bairro"
                class="w-full border rounded p-2 @error('district') border-red-500 @enderror"
            >
            @error('district')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Cidade</label>
            <input
                type="text"
                wire:model.defer="city"
                placeholder="Nome da cidade"
                class="w-full border rounded p-2 @error('city') border-red-500 @enderror"
            >
            @error('city')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Estado (UF)</label>
            <input
                type="text"
                wire:model.defer="state"
                placeholder="SP"
                maxlength="2"
                class="w-full border rounded p-2 @error('state') border-red-500 @enderror"
            >
            @error('state')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full"
        >
            💾 Salvar Endereço
        </button>

    </form>
</div>