<div class="container mx-auto px-4 py-8">
    {{-- Mensagem de sucesso --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    {{-- Cabeçalho --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Produtos</h1>
        <button wire:click="create" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Cadastrar Produto
        </button>
    </div>

    {{-- Filtros de busca --}}
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Busca por nome --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Buscar por nome
                </label>
                <input type="text" 
                       wire:model.live="search" 
                       placeholder="Digite o nome do produto..."
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Busca por data --}}
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Buscar por data de cadastro
                </label>
                <input type="date" 
                       wire:model.live="searchDate"
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
    </div>

    {{-- Tabela de produtos --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imagem</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" 
                                     alt="{{ $product->name }}"
                                     class="h-16 w-16 object-cover rounded">
                            @else
                                <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                    <span class="text-gray-400">Sem imagem</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="edit({{ $product->id }})"
                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                Editar
                            </button>
                            <button wire:click="delete({{ $product->id }})"
                                    wire:confirm="Tem certeza que deseja excluir este produto?"
                                    class="text-red-600 hover:text-red-900">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Nenhum produto encontrado
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginação --}}
        <div class="px-6 py-4 bg-gray-50">
            {{ $products->links() }}
        </div>
    </div>

    {{-- Modal de formulário --}}
    @if ($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white">
                {{-- Cabeçalho do modal --}}
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-xl font-bold">
                        {{ $productId ? 'Editar Produto' : 'Cadastrar Produto' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                {{-- Formulário --}}
                <form wire:submit.prevent="save" class="mt-4">
                    {{-- Nome --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Nome do Produto *
                        </label>
                        <input type="text" 
                               wire:model="name"
                               class="w-full px-3 py-2 border rounded @error('name') border-red-500 @enderror">
                        @error('name') 
                            <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Descrição --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Descrição *
                        </label>
                        <textarea wire:model="description" 
                                  rows="3"
                                  class="w-full px-3 py-2 border rounded @error('description') border-red-500 @enderror"></textarea>
                        @error('description') 
                            <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror
                    </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Categoria *
                </label>

                <select wire:model="category_id"
                        class="w-full px-3 py-2 border rounded @error('category_id') border-red-500 @enderror">
                    <option value="">Selecione uma categoria</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                @endforeach
            </select>

            @error('category_id')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>


                    {{-- Preço --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Preço *
                        </label>
                        <input type="number" 
                               wire:model="price" 
                               step="0.01"
                               class="w-full px-3 py-2 border rounded @error('price') border-red-500 @enderror">
                        @error('price') 
                            <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Imagem --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Imagem {{ $productId ? '' : '*' }}
                        </label>
                        
                        {{-- Mostra imagem atual se estiver editando --}}
                        @if ($productId && $currentImage)
                            <div class="mb-2">
                                <img src="{{ Storage::url($currentImage) }}" 
                                     alt="Imagem atual"
                                     class="h-32 w-32 object-cover rounded">
                                <p class="text-sm text-gray-500 mt-1">Imagem atual (envie uma nova para substituir)</p>
                            </div>
                        @endif

                        <input type="file" 
                               wire:model="image" 
                               accept="image/*"
                               class="w-full px-3 py-2 border rounded @error('image') border-red-500 @enderror">
                        @error('image') 
                            <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror

                        {{-- Preview da nova imagem --}}
                        @if ($image)
                            <div class="mt-2">
                                <img src="{{ $image->temporaryUrl() }}" 
                                     alt="Preview"
                                     class="h-32 w-32 object-cover rounded">
                            </div>
                        @endif
                    </div>

                    {{-- Botões --}}
                    <div class="flex justify-end gap-2 pt-4 border-t">
                        <button type="button" 
                                wire:click="closeModal"
                                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                            {{ $productId ? 'Atualizar' : 'Cadastrar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>