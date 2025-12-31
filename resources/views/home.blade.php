<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>E-commerce</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <span class="font-bold text-xl">Minha Loja</span>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="text-gray-700">
                    Menu
                </button>

                <div
                    x-show="open"
                    @click.outside="open = false"
                    class="absolute right-0 mt-2 w-40 bg-white border rounded shadow"
                >
                    <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <section class="flex items-center justify-center h-[60vh]">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">
                Bem-vindo Naga-Store
            </h1>

            <p class="text-gray-600 mb-6">
                Aqui tem o que você precisa
            </p>

            <a
                href="{{ route('login') }}"
                class="bg-black text-white px-6 py-3 rounded hover:bg-gray-800 transition"
            >
                Fazer Login
            </a>
        </div>
    </section>

</body>
</html>
