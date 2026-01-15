<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Listar produtos
     */
    public function index()
    {
        // Carrega produtos + categoria (evita N+1)
        $products = Product::with('category')->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        // Buscar categorias para o select
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Salvar produto
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'price'       => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Editar produto
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Atualizar produto
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'price'       => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto atualizado!');
    }

    /**
     * Remover produto
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto removido!');
    }
}
