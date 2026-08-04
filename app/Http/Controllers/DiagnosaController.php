<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DiagnosaController extends Controller
{
    // TAMBAHKAN INI AGAR ERROR HILANG
    public function dashboard(Request $request) 
    { 
        return view('dashboard', ['lang' => $request->input('lang', 'id')]); 
    }

    public function index(Request $request) { return view('index', ['lang' => $request->input('lang', 'id')]); }

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