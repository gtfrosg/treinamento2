<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use League\Csv\Reader;
use League\Csv\Statement;

class ExerciseController extends Controller
{
    public function index(){
	return view('exercises.index');
    }
   public function stats(){
        // URL do arquivo CSV
        $csvUrl = 'https://raw.githubusercontent.com/mwaskom/seaborn-data/master/exercise.csv';

        // Baixar o arquivo CSV
        try {
		// Esse try serve para se qualquer problema acontecer nesse bloco a excecussão é interrompida e passada para o bloco catch
            $response = Http::get($csvUrl);
            if ($response->failed()) {
                return view('errorMensages.CSVdownloadError',['error' => 'Falha para fazer download do arquivo URL']);
            }
		//Se a requisição do arquivo é feita com sucesso obtemos o corpo da resposta que contém os dados csv por meio do método $response->body() e é armazenado na variável 
	   
	  $csvData = $response->body();
        } catch (\Exception $e) {
	// Esse bloco catch captura a excessão de try e armazena na variável $e, podemos usar ela para obter mais informações sobre erros ela é muito boa
            return view('errorMensages.CSVfindError',['error2' => 'Um erro ocorreu ao buscar o arquivo CSV: ' . $e->getMessage()]);
        }

        // Processar o CSV usando League\Csv
        try {
            $csv = Reader::createFromString($csvData);
		// cria um onbjeto Reader a partir de uma string que contem os dados CSV, que permite fazer manipulações do conteúdo do CSV usando métodos específicos da biblioteca League\Csv
            $csv->setHeaderOffset(0);
		// é um método da biblioteca League\Csv que tem como objetivo definir a linha que vai criar o cabeçalho e quais serão os nomes das colunas
		// esse 0 representa que a primeira linha do documento CSV baixado será o cabeçalho 
	    $records = Statement::create()->process($csv);
		// faz o processamento dos registros que foram lidos pelo objeto Reader usando a biblioteca Statement que é uma biblioteca que permite criar consultas ou operações sobre dados CSV
		// Esse método create() cria um objeto de statmente que pode ser usado para fazer a consulta
		// E esse process é um outro metodo de statement que recebe como argumento um objeto Reader $csv no caso ele vai permitir retornar um iterador dos registros do arquivo
            $data = iterator_to_array($records);
		// Está convertendo o iterador de registros obtido pelo processamento do CSV em um array php
		// está armazenando cada item em um indice numérico sequencial dentro do array $data
	
            // Filtrar e calcular estatísticas
            $types = ['rest', 'walking', 'running'];
		//criando um array com três elementos que é utilizado para definir os diferentes tipos de atividades
            $stats = [];
		//criando um array vazio que será usado para armazenar as estatísticas calculadas para rest walking e running
            foreach ($types as $type) {
		// para cada tipo de atividade $type ele executa o foreach
                $filtered = array_filter($data, function($row) use ($type) {
		//filtra o array armazenado em $data e para cada linha $row a função anonima verifioca se o valor da coluna (kind) é igual ao tipo de atividade atual
                    return $row['kind'] === $type;
		//Se a condição for verdadeira a linha é incluida no array $filtered
                });

                $count = count($filtered);
		//Sendo  $filtered um array que contem as linhas filtradas do CSV cada linha dele é uma linha do CSV que corresponde ao tipo de atividade. Count é uma função do php que retorna o número de elementos em um array. Nesse caso ele vai retornar o numero de linhas filtrada
		$pulseSum = array_sum(array_map('floatval', array_column($filtered, 'pulse')));
                // Ela está calculando a soma das pulsações para todas as linhas filtradas no array $filtered
		// Basicamente a primeira parte está calculando as pulsações fazendo a soma, a segunda garante que todas as pulsações sejam tratadas como float e a terceira extrai as pulsções das linhas filtradas
		//após isso está sendo armazenado na variável $pulseSum que vai ser usado para calcular a média das pulsações
		$pulseAvg = $count > 0 ? $pulseSum / $count : 0;
		// está sendo calculado a média das pulsações, mas também se está fazendo um if-else. No caso o antecedente é o numero de linhas filtradas seja maior que 0 o consequente será a realização do calculo da média. Se não for o caso do antecendente o consequente será 0
                $stats[$type] = [
                    'count' => $count,
                    'average_pulse' => $pulseAvg,
                ];
		// Essas linhas criam ou atualizam uma entrada no array $stats para o tipo de atividade atual, armazenando o número de registros ('count') e a média das pulsações ('average_pulse')
            }

           // Retornar os resultados na view Blade
            return view('stats.index', ['stats' => $stats]);
        } catch (\Exception $e) {
            return response()->view('stats', ['error3' => 'Um erro ocorreu durante o processamento do arquivo CSV: ' . $e->getMessage()]);
        }
    }
    public function stats2(){
	return view('stats.index2');
    }
}
