@forelse ($books as $book)
    <ul>
        <li>{{ $book->title }}</li>
        <li>{{ $book->authors }}</li>
        <li>{{ $book->image_url }}</li>
    </ul>
@empty
    Não há livros cadastrados
@endforelse
