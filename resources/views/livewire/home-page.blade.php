<div>
    {{-- ================= HERO SECTION ================= --}}
    <section class="bg-gradient-to-r from-gray-800 to-gray-600 text-white">
        <div class="container mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                {{-- Text --}}
                <div>
                    <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-xs font-semibold mb-4">
                        NOVA COLEÇÃO
                    </span>

                    <h1 class="text-5xl md:text-6xl font-bold mb-4 leading-tight">
                        Redefina Seu <br> Estilo.
                    </h1>

                    <p class="text-lg text-gray-200 mb-8">
                        Descubra produtos essenciais de alta qualidade, criados para o estilo de vida moderno.
                    </p>

                    <div class="flex space-x-4">
                        @auth
                            <a href="{{ route('products.index') }}"
                               class="bg-blue-600 hover:bg-blue-700 px-8 py-3 rounded-lg font-semibold flex items-center gap-2">
                                Compre Agora →
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                               class="bg-blue-600 hover:bg-blue-700 px-8 py-3 rounded-lg font-semibold flex items-center gap-2">
                                Compre agora →
                            </a>
                        @endauth

                        <button class="bg-white/10 hover:bg-white/20 px-8 py-3 rounded-lg font-semibold">
                            Veja o Lookbook
                        </button>
                    </div>
                </div>

                {{-- Image --}}
                <div class="hidden md:block">
                    <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800"
                         class="rounded-2xl shadow-2xl h-[500px] w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- ================= FEATURES ================= --}}
    <section class="py-12 border-b">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            @php
                $features = [
                    ['Frete Grátis', 'Em pedidos acima de R$50,00 reais'],
                    ['Pagamento Seguro', 'Pagamento 100% seguro'],
                    ['Devoluções fáceis', 'Política de devolução de 30 dias'],
                    ['Suporte 24 horas por dia, 7 dias por semana', 'Ajuda instantânea'],
                ];
            @endphp

            @foreach($features as $feature)
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full"></div>
                    <div>
                        <h4 class="font-bold">{{ $feature[0] }}</h4>
                        <p class="text-sm text-gray-600">{{ $feature[1] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================= CATEGORIES ================= --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Comprar por categoria</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($categories as $category)
                    <div class="bg-white border rounded-xl p-6 text-center hover:shadow-lg transition">
                        <h3 class="font-bold">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500">
                            {{ $category->products_count }} produtos
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= BEST SELLERS ================= --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Mais Vendidos da Semana</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($bestSellers as $product)
                    <div class="bg-white rounded-xl shadow hover:shadow-xl transition">
                        <div class="aspect-square bg-gray-100 overflow-hidden">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}"
                                     class="w-full h-full object-cover hover:scale-110 transition">
                            @endif
                        </div>

                        <div class="p-4">
                            <h3 class="font-bold line-clamp-1">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2">{{ $product->description }}</p>

                            <div class="flex justify-between items-center mt-4">
                                <span class="text-xl font-bold">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </span>

                                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                                    Adicionar ao Carrinho
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-4 text-center text-gray-500">
                        Nenhum produto cadastrado.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ================= FEATURED ================= --}}
    @if($featuredProducts->count())
        <section class="py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8">Só Para Você</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        <div>
                            <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden mb-2">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}"
                                         class="w-full h-full object-cover hover:scale-110 transition">
                                @endif
                            </div>
                            <h3 class="font-semibold line-clamp-2">{{ $product->name }}</h3>
                            <p class="text-blue-600 font-bold">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
