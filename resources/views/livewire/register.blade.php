<form wire:submit.prevent="register"
      class="bg-white p-8 rounded shadow w-full max-w-md">

    <h1 class="text-2xl font-bold mb-6 text-center">Cadastro</h1>

    <div class="mb-4">
        <input type="text" wire:model.defer="name"
               placeholder="Nome"
               class="w-full border px-3 py-2 rounded">
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <input type="email" wire:model.defer="email"
               placeholder="E-mail"
               class="w-full border px-3 py-2 rounded">
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-6">
        <input type="password" wire:model.defer="password"
               placeholder="Senha"
               class="w-full border px-3 py-2 rounded">
        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <button class="w-full bg-black text-white py-2 rounded">
        Cadastrar
    </button>
</form>
