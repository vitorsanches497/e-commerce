<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.app')] // Use o mesmo padrão do seu projeto
class ProductList extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Propriedades de busca
    public string $search = '';

    public string $searchDate = '';

    // Controle do modal
    public bool $showModal = false;

    public bool $promotion_active = false;

    public int $discount_percentage = 0;

    public ?int $productId = null;

    public ?int $category_id = null;

    public $categories = [];

    // Campos do formulário
    public string $name = '';

    public string $description = '';

    public string $price = '';

    public $image = null;

    public array $images = [];

    public string $currentImage = '';

    public function mount(): void
    {
        // Carrega categorias uma única vez
        $this->categories = Category::orderBy('name')->get();
    }

    // Regras de validação
    protected function rules(): array
    {
        return [
            'name'        => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:10'],
            'price'       => ['required', 'numeric', 'min:0.01'],
            'category_id' => ['required', 'exists:categories,id'],
            'image'       => $this->productId
                ? ['nullable', 'image', 'max:2048']
                : ['required', 'image', 'max:2048'],
            'images.*'    => ['image', 'max:2048'],
        ];
    }

    // Mensagens personalizadas
    protected $messages = [
        'name.required'        => 'O nome é obrigatório',
        'name.min'             => 'O nome deve ter no mínimo 3 caracteres',
        'description.required' => 'A descrição é obrigatória',
        'description.min'      => 'A descrição deve ter no mínimo 10 caracteres',
        'price.required'       => 'O preço é obrigatório',
        'price.numeric'        => 'O preço deve ser um número',
        'price.min'            => 'O preço deve ser maior que zero',
        'image.required'       => 'A imagem é obrigatória',
        'image.image'          => 'O arquivo deve ser uma imagem',
        'image.max'            => 'A imagem não pode ter mais de 2MB',
    ];

    // Resetar paginação ao buscar
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingSearchDate(): void
    {
        $this->resetPage();
    }

    // Abrir modal para CRIAR
    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    // Abrir modal para EDITAR
    public function edit(int $id): void
    {
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        $this->price = (string) $product->price;
        $this->promotion_active = (bool) $product->promotion_active;
        $this->discount_percentage = (int) $product->discount_percentage;
        $this->currentImage = $product->image ?? '';
        $this->image = null;

        $this->showModal = true;
    }

    // Salvar (criar ou atualizar)
    public function save(): void
    {
        $this->validate();

        $data = [
            'name'                => $this->name,
            'description'         => $this->description,
            'price'               => $this->price,
            'category_id'         => $this->category_id,
            'promotion_active'    => $this->promotion_active,
            'discount_percentage' => $this->promotion_active
                ? $this->discount_percentage
                : 0,
        ];

        // Imagem principal
        if ($this->image) {
            if ($this->productId && $this->currentImage) {
                Storage::disk('public')->delete($this->currentImage);
            }

            $data['image'] = $this->image->store('products', 'public');
        }

        // Criar ou atualizar produto (UMA ÚNICA VEZ)
        if ($this->productId) {
            $product = Product::findOrFail($this->productId);
            $product->update($data);
        } else {
            $product = Product::create($data);
        }

        // Imagens adicionais (quantas quiser)
        if (! empty($this->images)) {
            foreach ($this->images as $image) {
                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $path,
                ]);
            }
        }

        session()->flash(
            'message',
            $this->productId
                ? 'Produto atualizado com sucesso!'
                : 'Produto criado com sucesso!'
        );

        $this->closeModal();
    }

    // Excluir produto
    public function delete(int $id): void
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        session()->flash('message', 'Produto excluído com sucesso!');
    }

    // Fechar modal
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    // Limpar formulário
    private function resetForm(): void
    {
        $this->productId = null;
        $this->category_id = null;
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->promotion_active = false;
        $this->discount_percentage = 0;
        $this->image = null;
        $this->currentImage = '';
        $this->resetErrorBag();
    }

    // Renderizar
    public function render()
    {
        $products = Product::query()
            ->when(
                $this->search,
                fn ($q) => $q->where('name', 'like', "%{$this->search}%")
            )
            ->when(
                $this->searchDate,
                fn ($q) => $q->whereDate('created_at', $this->searchDate)
            )
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.product-list', [
            'products' => $products,
        ]);
    }
}
