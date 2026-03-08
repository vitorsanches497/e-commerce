<?php

namespace App\Livewire\Device;

use Livewire\Component;
use App\Models\Device;

class Form extends Component
{
    public $deviceId;

    public $name;
        
    public $phone;

    protected $rules = [
        'name' => 'required|max:50',
        'phone' => 'required|max:20'
    ];
    
    public function mount($id =null)
    {
        if ($id) {
            $device = Device::find($id);

            $this->deviceId = $device->id;
            $this->name = $device->name;
            $this->phone = $device->phone;
        }
    }

    public function save()
    {
        ///dd($this->name, $this->phone);
        $this->validate();

        Device::create([
            'name' => $this->name,
            'phone' => $this->phone,
        ]);

        session()->flash('success', 'Deu certo');
        
        $this->reset(); 
    }

    public function render()
    {
        return view('livewire.device.form');
    }
}

