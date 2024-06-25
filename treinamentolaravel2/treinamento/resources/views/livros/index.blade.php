@forelse ($livros as $livro)
    <ul>
        <li><a href="/livros/"></a></li>
        <li>{{ $livro->titulo }}</li>
        <li>{{ $livro->autor }}</li>
        <li>{{ $livro->isbn }}</li>
    </ul>
@empty
    Não há livros cadastrados
@endforelse

