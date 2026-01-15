<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Nome do produto">
    <input type="number" step="0.01" name="price" placeholder="Preço">

    <select name="category_id">
        <option value="">Selecione a categoria</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Salvar</button>
</form>
