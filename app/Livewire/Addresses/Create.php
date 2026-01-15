<?php

namespace App\Livewire\Addresses;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Create extends Component
{
    public string $cep = '';
    public string $street = '';
    public string $number = '';
    public ?string $complement = null;
    public string $district = '';
    public string $city = '';
    public string $state = '';

    protected function rules(): array
    {
        return [
            'cep' => 'required|min:8',
            'street' => 'required',
            'number' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required|size:2',
        ];
    }

    public function save()
    {
        $this->validate();

        auth()->user()->addresses()->create([
            'cep' => $this->cep,
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'district' => $this->district,
            'city' => $this->city,
            'state' => strtoupper($this->state),
        ]);

        return redirect()->route('addresses.index');
    }

    public function render()
    {
        return view('livewire.addresses.create');
    }

    public function updatedCep()
    {
        $cep = preg_replace('/\D/', '', $this->cep);

        if (strlen($cep) !== 8) {
            return;
        }

        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || isset($response['erro'])) {
            return;
        }

        $this->street = $response['logradouro'];
        $this->district = $response['bairro'];
        $this->city = $response['localidade'];
        $this->state = $response['uf'];
    }
    
}
