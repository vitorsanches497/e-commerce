<?php

namespace App\Livewire\Addresses;

use App\Models\Address;
use Livewire\Component;

class Edit extends Component
{
    public Address $address;

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

    public function mount(Address $address)
    {
        // Segurança: só edita se for dono
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $this->address = $address;

        // Preenche os campos
        $this->cep = $address->cep;
        $this->street = $address->street;
        $this->number = $address->number;
        $this->complement = $address->complement;
        $this->district = $address->district;
        $this->city = $address->city;
        $this->state = $address->state;
    }

    public function update()
    {
        $this->validate();

        $this->address->update([
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
        return view('livewire.addresses.edit');
    }
}
