<h1>Criar Categoria</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Nome da categoria">

    <button type="submit">Salvar</button>
</form>
