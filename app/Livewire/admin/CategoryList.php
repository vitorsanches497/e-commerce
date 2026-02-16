<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class CategoryList extends Component
{
    use WithPagination;

    public string $name = '';

    public ?int $categoryId = null;

    public bool $showModal = false;

    protected function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
        ];
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(int $id)
    {
        $category = Category::findOrFail($id);

        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->categoryId) {
            Category::find($this->categoryId)->update([
                'name' => $this->name,
            ]);
            session()->flash('message', 'Categoria atualizada!');
        } else {
            Category::create([
                'name' => $this->name,
            ]);
            session()->flash('message', 'Categoria criada!');
        }

        $this->closeModal();
    }

    public function delete(int $id)
    {
        Category::findOrFail($id)->delete();
        session()->flash('message', 'Categoria excluída!');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.category-list', [
            'categories' => Category::orderBy('name')->paginate(10),
        ]);
    }
}
