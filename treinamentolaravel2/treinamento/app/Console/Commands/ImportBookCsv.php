<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Book;

class ImportBookCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-book-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ImportaExerciseCsv';

    /**
     * Execute the console command.
     */
    public function handle()
    {
	//definindo a URL que será baixada
        $url = 'https://raw.githubusercontent.com/zygmuntz/goodbooks-10k/master/books.csv';
	//fazendo requisição http para obter o conteudo do csv
	$response = Http::get($url);
	//atribui o resultado da operação de divisão à variável $lines, onde cada elemento do array $lines corresponde a uma linha do CSV.
	$lines = explode("\n", $response->body());
	//extrai o cabeçalho
	$header = str_getcsv(array_shift($lines));
	// iterando sobre cada linha do CSV para criar um novos registros na tabela Books do banco de dados
  	foreach ($lines as $line) {
	    // Converte a linha em um array de campos CSV
            $row = str_getcsv($line);
	    // Verifica se o número de campos na linha corresponde ao cabeçalho
            if ($row !== false && count($row) === count($header)) {
		// Combina o cabeçalho com a linha para formar um array associativo de dados do livro
                $bookData = array_combine($header, $row);
		// Cria um novo registro na tabela 'books' com os dados do livro
                Book::create([
                    'book_id' => $bookData['book_id'],
                    'goodreads_book_id' => $bookData['goodreads_book_id'],
                    'best_book_id' => $bookData['best_book_id'],
		    'work_id' => $bookData['work_id'],
		    'books_count' => $bookData['books_count'],
		    'isbn13' => $bookData['isbn13'],
		    'authors' => $bookData['authors'],
		    'original_publication_year' => $bookData['original_publication_year'],
		    'original_title' => $bookData['original_title'],
		    'title' => $bookData['title'],
		    'language_code' => $bookData['language_code'],
		    'average_rating' => $bookData['average_rating'],
		    'ratings_count' => $bookData['ratings_count'],
		    'work_text_reviews_count' => $bookData['work_text_reviews_count'],
		    'ratings_1' => $bookData['ratings_1'],
		    'ratings_2' => $bookData['ratings_2'],
		    'ratings_3' => $bookData['ratings_3'],
		    'ratings_4' => $bookData['ratings_4'],
		    'ratings_5' => $bookData['ratings_5'],
		    'image_url' => $bookData['image_url'],
		    'small_image_url' => $bookData['small_image_url'],
                    // Adicione outros campos conforme necessário
               ]);
            }
	} 
	// Exibe uma mensagem de sucesso no console
        $this->info('Os livros foram importados com sucesso!');
    }
}
