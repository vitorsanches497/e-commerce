<?php

declare(strict_types=1);

namespace App\Livewire\Addresses;

use Livewire\Component;

class Index extends Component
{
    public function delete(int $id): void
    {
        auth()->user()
            ->addresses()
            ->where('id', $id)
            ->delete();
    }

    public function render()
    {
        return view('livewire.addresses.index', [
            'addresses' => auth()->user()->addresses()->latest()->get(),
        ]);
    }
}
