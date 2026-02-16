<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Address;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AddressManager extends Component
{
    public $cep = '';

    public $street = '';

    public $number = '';

    public $complement = '';

    public $district = '';

    public $city = '';

    public $state = '';

    protected $rules = [
        'cep'      => 'required|min:8',
        'street'   => 'required',
        'number'   => 'required',
        'district' => 'required',
        'city'     => 'required',
        'state'    => 'required',
    ];

    public function updatedCep()
    {
        if (strlen($this->cep) < 8) {
            return;
        }

        $response = Http::get("https://viacep.com.br/ws/{$this->cep}/json/");

        if ($response->successful() && ! isset($response['erro'])) {
            $this->street = $response['logradouro'];
            $this->district = $response['bairro'];
            $this->city = $response['localidade'];
            $this->state = $response['uf'];
        }
    }

    public function save()
    {
        $this->validate();

        Address::create([
            'user_id'    => auth()->id(),
            'cep'        => $this->cep,
            'street'     => $this->street,
            'number'     => $this->number,
            'complement' => $this->complement,
            'district'   => $this->district,
            'city'       => $this->city,
            'state'      => $this->state,
        ]);

        session()->flash('message', 'Endereço salvo com sucesso!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.address-manager', [
            'addresses' => auth()->user()->addresses,
        ]);
    }
}
