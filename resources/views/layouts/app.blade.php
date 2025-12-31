<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'E-commerce') }}</title>
    
    {{-- Vite: CSS e JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Livewire Styles --}}
    @livewireStyles
</head>
<body class="bg-gray-50 font-sans antialiased">
    
    {{-- Menu de Navegação --}}
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                
                {{-- Logo/Nome --}}
                <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">
                    🛒 {{ config('app.name', 'E-commerce') }}
                </a>
                
                {{-- Links do Menu --}}
                <div class="flex space-x-4">
                    <a href="{{ url('/') }}" 
                       class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded transition">
                        🏠 Início
                    </a>
                    
                    <a href="{{ route('products.index') }}" 
                       class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded transition">
                        📦 Produtos
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    {{-- Conteúdo Principal --}}
    <main class="min-h-screen">
        {{ $slot }}
    </main>
    
    {{-- Rodapé --}}
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.</p>
        </div>
    </footer>
    
    {{-- Livewire Scripts --}}
    @livewireScripts
</body>
</html>