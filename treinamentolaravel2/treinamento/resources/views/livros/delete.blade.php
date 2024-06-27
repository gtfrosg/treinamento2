<li>
    <form action="{{ route('livros.destroy', ['livro' => $livro->id]) }}" method="post">
    @csrf
    @method('delete')
    <button type="submit" onclick="return confirm('Tem certeza?');">Apagar</button> 
    </form>
</li>
