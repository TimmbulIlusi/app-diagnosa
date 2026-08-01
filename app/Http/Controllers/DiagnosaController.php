<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiagnosaController extends Controller
{
    public function dashboard(Request $request) { return view('dashboard', ['lang' => $request->input('lang', 'id')]); }

    public function index(Request $request) { return view('index', ['lang' => $request->input('lang', 'id')]); }

    public function infoPenyakit(Request $request) { return view('info_penyakit', ['lang' => $request->input('lang', 'id')]); }

    public function infoDataset(Request $request) 
    {
        $lang = $request->input('lang', 'id');
        $medPath = base_path('public/csv/Medicine_Details.csv');
        $medicineRows = [];
        
        if (file_exists($medPath) && ($handle = fopen($medPath, 'r')) !== FALSE) {
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== FALSE && count($medicineRows) < 20) {
                $medicineRows[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return view('info_dataset', compact('lang', 'medicineRows'));
    }

    public function infoPengembang(Request $request) { return view('info_pengembang', ['lang' => $request->input('lang', 'id')]); }

    public function predict(Request $request)
    {
        $lang = $request->input('lang', 'id');
        $selectedSymptoms = $request->input('symptoms', []);

        if (empty($selectedSymptoms)) {
            return redirect()->back()->with('error', 'Harap centang minimal 1 gejala!');
        }

        $trainPath = base_path('public/python_service/datasets/Training.csv');
        $medPath = base_path('public/csv/Medicine_Details.csv');
        
        $predictions = [];
        $medicines = [];

        if (file_exists($trainPath) && ($handle = fopen($trainPath, 'r')) !== FALSE) {
            $header = fgetcsv($handle);
            $prognosisIdx = array_search('prognosis', $header);
            while (($row = fgetcsv($handle)) !== FALSE) {
                $prognosis = $row[$prognosisIdx];
                $score = 0;
                foreach ($selectedSymptoms as $s) {
                    $sIdx = array_search($s, $header);
                    if ($sIdx !== false && isset($row[$sIdx]) && $row[$sIdx] == 1) $score++;
                }
                if ($score > 0) $predictions[$prognosis] = ($predictions[$prognosis] ?? 0) + $score;
            }
            fclose($handle);
        }

        if (empty($predictions)) return $this->runFallback($lang, $selectedSymptoms);

        arsort($predictions);
        $top = array_slice($predictions, 0, 3, true);

        if (file_exists($medPath) && ($handle = fopen($medPath, 'r')) !== FALSE) {
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== FALSE) {
                $data = array_combine($header, $row);
                foreach (array_keys($top) as $p) {
                    if (stripos($data['Uses'] ?? '', $p) !== false) {
                        $medicines[] = ['Medicine Name' => $data['Medicine Name'], 'Kategori' => 'Obat', 'Composition' => $data['Composition'], 'Side_effects' => $data['Side_effects']];
                    }
                }
                if (count($medicines) >= 3) break;
            }
            fclose($handle);
        }

        return view('result', [
            'top_predictions' => array_map(fn($p, $s) => ['penyakit' => str_replace('_', ' ', $p), 'probabilitas' => ($s * 10)], array_keys($top), $top),
            'medicines' => $medicines,
            'lang' => $lang,
            'gejala_terpilih' => array_map(fn($s) => ucwords(str_replace('_', ' ', $s)), $selectedSymptoms),
            'dokter' => 'Dokter Spesialis Sesuai Diagnosa'
        ]);
    }

    private function runFallback($lang, $selectedSymptoms)
    {
        return view('result', [
            'top_predictions' => [['penyakit' => 'Gejala Umum (Observasi)', 'probabilitas' => 85.0]],
            'medicines' => [['Medicine Name' => 'Multivitamin', 'Kategori' => 'Suplemen', 'Composition' => 'Vitamin C', 'Side_effects' => '-']],
            'lang' => $lang,
            'gejala_terpilih' => array_map(fn($s) => ucwords(str_replace('_', ' ', $s)), $selectedSymptoms),
            'dokter' => 'Dokter Umum'
        ]);
    }
}