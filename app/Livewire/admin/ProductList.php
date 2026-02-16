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

#[Layout('components.layouts.app')]
class ProductList extends Component
{
    use WithPagination;
    use WithFileUploads;

    /*PROPRIEDADES**/

    // Busca / filtros
    public string $search = '';
    public string $searchDate = '';

    // Modal
    public bool $showModal = false;

    // Promoção
    public bool $promotion_active = false;
    public int $discount_percentage = 0;

    // IDs
    public ?int $productId = null;
    public ?int $category_id = null;

    // Listas
    public $categories = [];

    // Formulário
    public string $name = '';
    public string $description = '';
    public string $price = '';

    // Uploads
    public $image = null;        // imagem principal
    public array $images = [];   // imagens adicionais
    public string $currentImage = '';

    /** CICLO DE VIDA*/

    public function mount(): void
    {
        $this->categories = Category::orderBy('name')->get();
    }

    /** VALIDAÇÃO*/

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

    /** FILTROS*/

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingSearchDate(): void
    {
        $this->resetPage();
    }

    /** CRUD*/

    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(Product $product): void
    {
        $this->fill($product->toArray());
    }

    public function save(): void
    {
        $this->validate();

        $data = $this->validate();

        // Imagem principal
        if ($this->image) {
            if ($this->productId && $this->currentImage) {
                Storage::disk('public')->delete($this->currentImage);
            }

            $data['image'] = $this->image->store('products', 'public');
        }

        // Criar ou atualizar
        $product = $this->productId
            ? tap(Product::findOrFail($this->productId))->update($data)
            : Product::create($data);

        // Imagens adicionais
        foreach ($this->images as $image) {
            ProductImage::create([
                'product_id' => $product->id,
                'image'      => $image->store('products', 'public'),
            ]);
        }

        session()->flash(
            'message',
            $this->productId
                ? 'Produto atualizado com sucesso!'
                : 'Produto criado com sucesso!'
        );

        $this->closeModal();
    }

    public function delete(int $id): void
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->images()->delete();
        $product->delete();

        session()->flash('message', 'Produto excluído com sucesso!');
    }

    /** AUXILIARES */

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset();
    }

    /** RENDER */

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

        return view('livewire.product-list', compact('products'));
    }
}
