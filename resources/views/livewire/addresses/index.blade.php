<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">📍 Meus Endereços</h1>

        <a href="{{ route('addresses.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            ➕ Novo endereço
        </a>
    </div>

    @if($addresses->count())
        <div class="space-y-4">
            @foreach($addresses as $address)
                <div class="border rounded p-4 flex justify-between items-center">
                    <div>
                        <p class="font-semibold">
                            {{ $address->street }}, {{ $address->number }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ $address->district }} —
                            {{ $address->city }}/{{ $address->state }}
                        </p>
                        <p class="text-sm text-gray-500">
                            CEP: {{ $address->cep }}
                        </p>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('addresses.edit', $address) }}"
                           class="text-blue-600 hover:underline">
                            Editar
                        </a>

                        <button
                            wire:click="delete({{ $address->id }})"
                            onclick="confirm('Tem certeza que deseja excluir este endereço?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline">
                            Excluir
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">
            Você ainda não cadastrou nenhum endereço.
        </p>
    @endif

</div>
