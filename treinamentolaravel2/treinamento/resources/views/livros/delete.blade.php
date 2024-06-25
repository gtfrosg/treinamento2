<li>
    <form action="/livros/update " method="post">
    @csrf
    @method('delete')
    <button type="submit" onclick="return confirm('Tem certeza?');">Apagar</button> 
    </form>
</li>
