<div class="container mx-auto px-4 py-8">

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <h1 class="text-3xl font-bold">Categorias</h1>
        <button wire:click="create"
                class="bg-blue-600 text-white px-4 py-2 rounded">
            + Nova Categoria
        </button>
    </div>

    <div class="bg-white shadow rounded">
        <table class="min-w-full divide-y">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left">Nome</th>
                    <th class="px-6 py-3 text-right">Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                    <tr class="border-t">
                        <td class="px-6 py-3">{{ $category->name }}</td>
                        <td class="px-6 py-3 text-right">
                            <button wire:click="edit({{ $category->id }})"
                                    class="text-blue-600 mr-3">
                                Editar
                            </button>
                            <button wire:click="delete({{ $category->id }})"
                                    class="text-red-600">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4">
            {{ $categories->links() }}
        </div>
    </div>

    {{-- Modal --}}
    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded p-6 w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">
                    {{ $categoryId ? 'Editar Categoria' : 'Nova Categoria' }}
                </h2>

                <input type="text"
                       wire:model="name"
                       class="w-full border px-3 py-2 rounded">

                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="flex justify-end mt-4 gap-2">
                    <button wire:click="closeModal"
                            class="px-4 py-2 bg-gray-300 rounded">
                        Cancelar
                    </button>
                    <button wire:click="save"
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                        Salvar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
