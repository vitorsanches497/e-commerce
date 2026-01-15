<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        return view('livewire.home-page', [
            'categories'       => Category::withCount('products')->get(),
            'bestSellers'      => Product::latest()->take(4)->get(),
            'featuredProducts' => Product::inRandomOrder()->take(4)->get(),
        ]);
    }
}
