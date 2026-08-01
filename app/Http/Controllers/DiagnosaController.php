<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiagnosaController extends Controller
{
    // Fungsi yang hilang tadi
    public function dashboard(Request $request)
    {
        $lang = $request->input('lang', 'id');
        return view('dashboard', compact('lang'));
    }

    public function index(Request $request)
    {
        $lang = $request->input('lang', 'id');
        // Daftar gejala tetap didefinisikan secara manual atau diambil dari file
        return view('index', compact('lang'));
    }

    public function predict(Request $request)
    {
        $lang = $request->input('lang', 'id');
        $selectedSymptoms = $request->input('symptoms', []);

        if (empty($selectedSymptoms)) {
            return redirect()->back()->with('error', 'Harap centang minimal 1 gejala!');
        }

        $trainPath = public_path('python_service/datasets/Training.csv');
        $medPath = public_path('csv/Medicine_Details.csv');
        
        $predictions = [];
        
        // Membaca Training.csv untuk mencocokkan gejala
        if (($handle = fopen($trainPath, 'r')) !== FALSE) {
            $header = fgetcsv($handle);
            $prognosisIdx = array_search('prognosis', $header);
            
            while (($row = fgetcsv($handle)) !== FALSE) {
                $prognosis = $row[$prognosisIdx];
                $score = 0;
                foreach ($selectedSymptoms as $s) {
                    $sIdx = array_search($s, $header);
                    if ($sIdx !== false && $row[$sIdx] == 1) {
                        $score++;
                    }
                }
                if ($score > 0) {
                    $predictions[$prognosis] = ($predictions[$prognosis] ?? 0) + $score;
                }
            }
            fclose($handle);
        }

        arsort($predictions);
        $top = array_slice($predictions, 0, 3, true);

        // Mengambil obat
        $medicines = [];
        if (($handle = fopen($medPath, 'r')) !== FALSE) {
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== FALSE) {
                $data = array_combine($header, $row);
                foreach (array_keys($top) as $penyakit) {
                    if (stripos($data['Uses'], $penyakit) !== false || stripos($data['Medicine Name'], $penyakit) !== false) {
                        $medicines[] = [
                            'Medicine Name' => $data['Medicine Name'],
                            'Kategori' => 'Obat Medis',
                            'Composition' => $data['Composition'],
                            'Side_effects' => $data['Side_effects']
                        ];
                    }
                }
                if (count($medicines) >= 3) break;
            }
            fclose($handle);
        }

        $formattedPredictions = [];
        foreach ($top as $p => $s) {
            $formattedPredictions[] = ['penyakit' => $p, 'probabilitas' => ($s * 10)];
        }

        return view('result', [
            'top_predictions' => $formattedPredictions,
            'medicines' => $medicines,
            'saran_umum' => 'Analisis dilakukan oleh engine internal Laravel.',
            'lang' => $lang,
            'gejala_terpilih' => array_map(fn($s) => ucwords(str_replace('_', ' ', $s)), $selectedSymptoms),
            'dokter' => 'Dokter Spesialis Sesuai Kondisi'
        ]);
    }
}