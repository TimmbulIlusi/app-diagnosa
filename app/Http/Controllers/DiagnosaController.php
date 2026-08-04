<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DiagnosaController extends Controller
{
    public function dashboard(Request $request) { return view('dashboard', ['lang' => $request->input('lang', 'id')]); }
    public function index(Request $request) { return view('index', ['lang' => $request->input('lang', 'id')]); }
    public function infoPenyakit(Request $request) { return view('info_penyakit', ['lang' => $request->input('lang', 'id')]); }
    public function infoPengembang(Request $request) { return view('info_pengembang', ['lang' => $request->input('lang', 'id')]); }

    public function infoDataset(Request $request) 
    {
        $lang = $request->input('lang', 'id');
        // PATH YANG BENAR SESUAI FOLDER PROJECT KAMU
        $medPath = public_path('csv/Medicine_Details.csv'); 
        $medicineRows = [];
        
        if (file_exists($medPath) && ($handle = fopen($medPath, 'r')) !== FALSE) {
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== FALSE && count($medicineRows) < 20) {
                if ($header && $row && count($header) == count($row)) {
                    $medicineRows[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        
        return view('info_dataset', compact('lang', 'medicineRows'));
    }

    public function predict(Request $request)
    {
        $lang = $request->input('lang', 'id');
        $selectedSymptoms = $request->input('symptoms', []);

        if (empty($selectedSymptoms)) {
            return redirect()->back()->with('error', 'Harap centang minimal 1 gejala!');
        }

        try {
            $response = Http::timeout(10)->post('https://hasto.pythonanywhere.com/api/predict', [
                'symptoms' => $selectedSymptoms,
                'lang' => $lang
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return view('result', [
                    'top_predictions' => $data['top_predictions'], 
                    'gejala_terpilih' => $data['gejala_terpilih'],
                    'lang' => $lang
                ]);
            }
        } catch (\Exception $e) {
            Log::error("API Gagal: " . $e->getMessage());
        }

        return redirect()->back()->with('error', 'Sistem AI sedang sibuk.');
    }
}