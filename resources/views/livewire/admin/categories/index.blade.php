<h1>Categorias</h1>

<a href="{{ route('categories.create') }}">Nova categoria</a>

<ul>
    @foreach ($categories as $category)
        <li>{{ $category->name }}</li>
    @endforeach
</ul>
