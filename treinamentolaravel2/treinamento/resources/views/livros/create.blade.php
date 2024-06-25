<form method="POST" action="/livros/store">

    @csrf
    Titulo: <input name='titulo'>
    Autor:  <input name='autor'>
    ISBN:   <input name='isbn'>

<button type="submit">Cadastrar</button>

</form>
