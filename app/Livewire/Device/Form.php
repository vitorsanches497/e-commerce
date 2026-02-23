<?php

namespace App\Livewire\Device;

use Livewire\Component;

class Form extends Component
{
    public $name;
        
    public $phone;

    protected $rule = [
        'name' => 'required|max:50',
        'phone' => 'required|max:20'
    ];
    
    public function save()
    {
        $this->validade();

        Device::create([
            'name' => $this->name,
            'phone' => $this->phone,
        ]);

        session()->flash('Deu certo');
        
        $this->reset(); 
    }

    public function render()
    {
        return view('livewire.device.form');
    }
    
    
    



}

