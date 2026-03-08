<?php

namespace App\Livewire\Device;

use Livewire\Component;
use App\Models\Device;

class Index extends Component
{
    public $devices;

    public function mount()
    {
        $this->devices = Device::all();
    }

    public function render()
    {
        return view('livewire.device.index');
    }
}