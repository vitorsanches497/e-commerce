<div>
    <form wire:submit="save" class="w-full grid grid-cols-2">
        <div class="w-full flex">
            <label for="nome">Nome</label>
            <input id="nome" wire:model="name" class="w-56 h-12 border text-black text-md" type="text"/>
        </div>
        <div class="w-full flex">
            <label for="fone">Telefone</label>
            <input x-mask="(99) 9 99999-9999" id="fone" wire:model="phone" class="w-56 h-12 border text-black text-md" type="text"/>
        </div>
        <button type="submit">Enviar</button>
    </form>
</div>
