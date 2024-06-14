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
   public function stats()
    {
        // URL do arquivo CSV
        $csvUrl = 'https://raw.githubusercontent.com/mwaskom/seaborn-data/master/exercise.csv';

        // Baixar o arquivo CSV
        try {
            $response = Http::get($csvUrl);
            if ($response->failed()) {
                return response()->json(['error' => 'Failed to download CSV file.'], 500);
            }
            $csvData = $response->body();
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the CSV file: ' . $e->getMessage()], 500);
        }

        // Processar o CSV usando League\Csv
        try {
            $csv = Reader::createFromString($csvData);
            $csv->setHeaderOffset(0);
            $records = Statement::create()->process($csv);

            $data = iterator_to_array($records);

            // Filtrar e calcular estatísticas
            $types = ['rest', 'walking', 'running'];
            $stats = [];

            foreach ($types as $type) {
                $filtered = array_filter($data, function($row) use ($type) {
                    return $row['kind'] === $type;
                });

                $count = count($filtered);
                $pulseSum = array_sum(array_map('floatval', array_column($filtered, 'pulse')));
                $pulseAvg = $count > 0 ? $pulseSum / $count : 0;

                $stats[$type] = [
                    'count' => $count,
                    'average_pulse' => $pulseAvg,
                ];
            }

            // Retornar os resultados como JSON
            return response()->json($stats);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the CSV file: ' . $e->getMessage()], 500);
        }
    }
}
