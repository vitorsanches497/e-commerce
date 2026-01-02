<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'E-commerce') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 font-sans antialiased">
    
    {{-- Header --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-xl">M</span>
                    </div>
                    <span class="text-xl font-bold text-gray-800">Marketplace</span>
                </a>

                {{-- Search Bar --}}
                <div class="hidden md:flex flex-1 max-w-xl mx-8">
                    <input type="text" 
                           placeholder="Search for products, brands and more..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Icons --}}
                <div class="flex items-center space-x-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </a>
                    @endauth

                    <button class="text-gray-700 hover:text-blue-600 transition relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>

                    <button class="text-gray-700 hover:text-blue-600 transition relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </button>
                </div>
            </div>

            {{-- Navigation Menu --}}
            <nav class="border-t py-3">
                <div class="flex space-x-8 text-sm">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 transition font-medium">All Categories</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition">New Arrivals</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition">Electronics</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition">Fashion</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition">Home & Living</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition">Beauty</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition text-red-500">Sale</a>
                </div>
            </nav>
        </div>
    </header>

    {{-- Content --}}
    {{ $slot }}

    {{-- Footer --}}
    <footer class="bg-blue-600 text-white py-16 mt-20">
        <div class="container mx-auto px-4">
            {{-- Newsletter --}}
            <div class="text-center mb-12">
                <div class="inline-block p-3 bg-white/10 rounded-full mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold mb-2">Subscribe to our newsletter</h2>
                <p class="text-blue-100 mb-6">Get the latest updates on new products and upcoming sales directly in your inbox.</p>
                
                <div class="flex justify-center">
                    <div class="flex max-w-md w-full">
                        <input type="email" 
                               placeholder="Enter your email"
                               class="flex-1 px-6 py-3 rounded-l-lg text-gray-800 focus:outline-none">
                        <button class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-r-lg font-semibold transition">
                            Subscribe
                        </button>
                    </div>
                </div>
                <p class="text-xs text-blue-100 mt-3">We respect your privacy. Unsubscribe at any time.</p>
            </div>

            {{-- Footer Links --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 border-t border-blue-500 pt-12">
                {{-- About --}}
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-white rounded flex items-center justify-center">
                            <span class="text-blue-600 font-bold">M</span>
                        </div>
                        <span class="font-bold text-lg">Marketplace</span>
                    </div>
                    <p class="text-blue-100 text-sm">
                        Your one-stop destination for premium products across fashion, electronics, home essentials, and more.
                    </p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="hover:text-blue-200 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="hover:text-blue-200 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="hover:text-blue-200 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Shop --}}
                <div>
                    <h3 class="font-bold text-lg mb-4">Shop</h3>
                    <ul class="space-y-2 text-blue-100 text-sm">
                        <li><a href="#" class="hover:text-white transition">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-white transition">Best Sellers</a></li>
                        <li><a href="#" class="hover:text-white transition">On Sale</a></li>
                        <li><a href="#" class="hover:text-white transition">Gift Cards</a></li>
                    </ul>
                </div>

                {{-- Support --}}
                <div>
                    <h3 class="font-bold text-lg mb-4">Support</h3>
                    <ul class="space-y-2 text-blue-100 text-sm">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Order Status</a></li>
                        <li><a href="#" class="hover:text-white transition">Returns & Exchange</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>

                {{-- Company --}}
                <div>
                    <h3 class="font-bold text-lg mb-4">Company</h3>
                    <ul class="space-y-2 text-blue-100 text-sm">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition">Become a Vendor</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="border-t border-blue-500 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-blue-100">
                <p>&copy; 2025 Marketplace. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <span>USA</span>
                    <span>•</span>
                    <span>UK</span>
                    <span>•</span>
                    <span>Japan</span>
                    <span>•</span>
                    <span>Spanish</span>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>