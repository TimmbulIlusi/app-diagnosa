<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiagnosaController extends Controller
{
    public function dashboard(Request $request)
    {
        $lang = $request->input('lang', 'id');
        return view('dashboard', compact('lang'));
    }

    public function index(Request $request)
    {
        $lang = $request->input('lang', 'id');
        $symptoms = [];

        try {
            $response = Http::get("https://Hasto.pythonanywhere.com/api/symptoms?lang={$lang}");
            if ($response->successful()) {
                $data = $response->json();
                $symptoms = is_array($data) ? $data : [];
            }
        } catch (\Exception $e) {
            $symptoms = [];
        }

        return view('index', compact('symptoms', 'lang'));
    }

    public function infoPenyakit(Request $request)
    {
        $lang = $request->input('lang', 'id');
        return view('info_penyakit', compact('lang'));
    }

    public function infoDataset(Request $request)
    {
        $lang = $request->input('lang', 'id');
        
        // PENTING: Gunakan public_path() agar file terbaca di Vercel
        // Pastikan file berada di: public/csv/Medicine_Details.csv
        $path = public_path('csv/Medicine_Details.csv'); 
        
        $medicineRows = [];
        if (file_exists($path) && ($handle = fopen($path, 'r')) !== FALSE) {
            $header = fgetcsv($handle);
            $count = 0;
            while (($data = fgetcsv($handle)) !== FALSE && $count < 20) {
                if (count($header) == count($data)) {
                    $medicineRows[] = array_combine($header, $data);
                }
                $count++;
            }
            fclose($handle);
        }

        return view('info_dataset', compact('lang', 'medicineRows'));
    }

    public function infoPengembang(Request $request)
    {
        $lang = $request->input('lang', 'id');
        return view('info_pengembang', compact('lang'));
    }

    public function predict(Request $request)
    {
        $lang = $request->input('lang', 'id');
        $selectedSymptoms = $request->input('symptoms', []);

        if (empty($selectedSymptoms)) {
            return redirect()->back()->with('error', 'Harap centang minimal 1 gejala!');
        }

        try {
            $response = Http::post("https://Hasto.pythonanywhere.com/api/predict", [
                'lang' => $lang,
                'symptoms' => $selectedSymptoms
            ]);

            $result = $response->json();
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal terhubung ke layanan AI. Pastikan Flask sedang berjalan.');
        }

        return view('result', [
            'top_predictions' => $result['top_predictions'] ?? [],
            'medicines' => $result['medicines'] ?? [],
            'saran_umum' => $result['saran_umum'] ?? '',
            'lang' => $lang,
            'gejala_terpilih' => $result['gejala_terpilih'] ?? $selectedSymptoms,
            'dokter' => $result['dokter'] ?? 'Dokter Umum'
        ]);
    }
}