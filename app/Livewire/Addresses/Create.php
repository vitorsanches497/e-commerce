<?php

declare(strict_types=1);

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
    
    // ADICIONE ESTA PROPRIEDADE PARA MENSAGENS DE ERRO
    public string $cepError = '';
    public bool $buscandoCep = false;

    protected function rules(): array
    {
        return [
            'cep'      => 'required|min:8',
            'street'   => 'required',
            'number'   => 'required',
            'district' => 'required',
            'city'     => 'required',
            'state'    => 'required|size:2',
        ];
    }

    public function updatedCep()
    {
        // Limpa mensagens anteriores
        $this->cepError = '';
        $this->buscandoCep = true;
        
        // Remove tudo que não é número
        $cepLimpo = preg_replace('/\D/', '', $this->cep);
        
        // Valida se tem 8 dígitos
        if (strlen($cepLimpo) !== 8) {
            $this->buscandoCep = false;
            return;
        }

        try {
            // Faz a requisição com timeout de 10 segundos
            $response = Http::timeout(10)->get("https://viacep.com.br/ws/{$cepLimpo}/json/");
            
            // Verifica se a requisição HTTP falhou
            if ($response->failed()) {
                $this->cepError = '❌ Falha ao conectar com o serviço ViaCEP. Status: ' . $response->status();
                $this->limparCampos();
                $this->buscandoCep = false;
                return;
            }
            
            // Pega os dados como array
            $data = $response->json();
            
            // CORREÇÃO: Verifica se a API retornou erro (CEP não encontrado)
            if (isset($data['erro']) && $data['erro'] === true) {
                $this->cepError = '❌ CEP não encontrado na base dos Correios.';
                $this->limparCampos();
                $this->buscandoCep = false;
                return;
            }
            
            // Verifica se veio o campo logradouro (validação extra)
            if (!isset($data['logradouro'])) {
                $this->cepError = '⚠️ CEP encontrado, mas sem dados de endereço.';
                $this->buscandoCep = false;
                return;
            }
            
            // ✅ Preenche os campos com sucesso
            $this->street = $data['logradouro'] ?? '';
            $this->district = $data['bairro'] ?? '';
            $this->city = $data['localidade'] ?? '';
            $this->state = $data['uf'] ?? '';
            
            // Atualiza o CEP com formatação
            $this->cep = $data['cep'] ?? $cepLimpo;
            
            $this->buscandoCep = false;
            
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            $this->cepError = '❌ Erro de conexão: Verifique sua internet.';
            $this->limparCampos();
            $this->buscandoCep = false;
            
        } catch (\Exception $e) {
            $this->cepError = '❌ Erro inesperado: ' . $e->getMessage();
            $this->limparCampos();
            $this->buscandoCep = false;
        }
    }
    
    private function limparCampos(): void
    {
        $this->street = '';
        $this->district = '';
        $this->city = '';
        $this->state = '';
    }

    public function save()
    {
        $this->validate();

        auth()->user()->addresses()->create([
            'cep'        => $this->cep,
            'street'     => $this->street,
            'number'     => $this->number,
            'complement' => $this->complement,
            'district'   => $this->district,
            'city'       => $this->city,
            'state'      => strtoupper($this->state),
        ]);

        session()->flash('success', '✅ Endereço cadastrado com sucesso!');

        return redirect()->route('addresses.index');
    }

    public function render()
    {
        return view('livewire.addresses.create');
    }
}