<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;

class LivroController extends Controller
{
    public function create(){
	return view('livros.create');
    }

    public function store(){
	$livro = new Livro;
	$livro->titulo = request()->titulo;
        $livro->autor = request()->autor;
        $livro->isbn = request()->isbn;
        $livro->save();
	return redirect('/livros/create');
    }
    
    public function index(){

	$livros = Livro::all();
	return view('livros.index',[
	    'livros' => $livros
	]);
    }

    public function show(Livro $livro){
	return view('livros.show',[
	    'livro' => $livro
	]);
    }
    
    public function edit(Livro $livro){
	return view('livros.edit',[
	    'livro' => $livro
	]);
    }
    
    public function update(Request $request, Livro $livro){

    	$livro->titulo = $request->titulo;
	$livro->autor = $request->autor;
	$livro->isbn = $request->isbn;
	$livro->save();
	
	return redirect("/livros/show/{$livro->id}");
    }
    public function destroy(){
	dd("oi");
	$livro->delete();
	return redirect('/livros/index');
    }
}
