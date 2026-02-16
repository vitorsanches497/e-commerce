<div class="space-y-6">

    <h1 class="text-2xl font-bold">
        Olá, {{ auth()->user()->name }} 👋
    </h1>

    <p class="text-gray-600">
        Bem-vindo ao painel do sistema.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

        {{-- Produtos --}}
        <a href="{{ route('products.index') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-lg shadow text-center">
            <h2 class="text-lg font-bold">📦 Produtos</h2>
            <p class="text-sm mt-2">Gerenciar produtos</p>
        </a>

        {{-- Categorias --}}
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.categories.index') }}"
               class="bg-green-600 hover:bg-green-700 text-white p-6 rounded-lg shadow text-center">
                <h2 class="text-lg font-bold">🗂 Categorias</h2>
                <p class="text-sm mt-2">Criar e editar categorias</p>
            </a>
        @endif

        {{-- Usuários --}}
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.users.index') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white p-6 rounded-lg shadow text-center">
                <h2 class="text-lg font-bold">👤 Usuários</h2>
                <p class="text-sm mt-2">Gerenciar usuários</p>
            </a>
        @endif

        {{-- Endereços --}}
            <a href="{{ route('addresses.index') }}"
                class="bg-yellow-600 hover:bg-yellow-700 text-white p-6 rounded-lg shadow text-center">
                 <h2 class="text-lg font-bold">📍 Endereços</h2>
                 <p class="text-sm mt-2">Meus endereços</p>
            </a>

        {{-- Administração --}}
        @if(auth()->user()->is_admin)
            <a href="/admin"
               class="bg-red-600 hover:bg-red-700 text-white p-6 rounded-lg shadow text-center">
                <h2 class="text-lg font-bold">⚙ Administração</h2>
                <p class="text-sm mt-2">Área restrita</p>
            </a>
        @endif

    </div>
</div>
