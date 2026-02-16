<form
    wire:submit.prevent="login"
    class="bg-white p-8 rounded shadow w-full max-w-md"
>
    <h1 class="text-2xl font-bold mb-6 text-center">
        Login
    </h1>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">E-mail</label>
        <input
            type="email"
            wire:model.defer="email"
            class="w-full border rounded px-3 py-2"
        >
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-6">
        <label class="block text-sm font-medium mb-1">Senha</label>
        <input
            type="password"
            wire:model.defer="password"
            class="w-full border rounded px-3 py-2"
        >
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <button
        type="submit"
        class="w-full bg-black text-white py-2 rounded hover:bg-gray-800 transition"
    >
        Entrar
    </button>
</form>
