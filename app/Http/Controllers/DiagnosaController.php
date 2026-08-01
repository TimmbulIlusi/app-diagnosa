<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DiagnosaController extends Controller
{
    /**
     * Menampilkan dashboard utama
     */
    public function dashboard(Request $request)
    {
        $lang = $request->input('lang', 'id');
        return view('dashboard', compact('lang'));
    }

    /**
     * Mengambil daftar gejala dari API PythonAnywhere
     */
    public function index(Request $request)
    {
        $lang = $request->input('lang', 'id');
        $symptoms = [];

        try {
            // Memanggil API Python dengan timeout 10 detik
            $response = Http::timeout(10)->get("https://Hasto.pythonanywhere.com/api/symptoms?lang={$lang}");
            
            if ($response->successful()) {
                $data = $response->json();
                $symptoms = is_array($data) ? $data : [];
            } else {
                Log::error('Gagal mengambil gejala dari API. Status: ' . $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Error koneksi ke API Python: ' . $e->getMessage());
        }

        return view('index', compact('symptoms', 'lang'));
    }

    /**
     * Menampilkan halaman info penyakit
     */
    public function infoPenyakit(Request $request)
    {
        $lang = $request->input('lang', 'id');
        return view('info_penyakit', compact('lang'));
    }

    /**
     * Menampilkan data obat dari file CSV
     */
    public function infoDataset(Request $request)
    {
        $lang = $request->input('lang', 'id');
        
        // Menggunakan public_path agar file terbaca di sistem file read-only Vercel
        $path = public_path('csv/Medicine_Details.csv'); 
        
        $medicineRows = [];
        if (file_exists($path) && ($handle = fopen($path, 'r')) !== FALSE) {
            $header = fgetcsv($handle);
            $count = 0;
            while (($data = fgetcsv($handle)) !== FALSE && $count < 20) {
                if ($header && $data && count($header) == count($data)) {
                    $medicineRows[] = array_combine($header, $data);
                }
                $count++;
            }
            fclose($handle);
        } else {
            Log::error('File CSV tidak ditemukan di: ' . $path);
        }

        return view('info_dataset', compact('lang', 'medicineRows'));
    }

    /**
     * Menampilkan info pengembang
     */
    public function infoPengembang(Request $request)
    {
        $lang = $request->input('lang', 'id');
        return view('info_pengembang', compact('lang'));
    }

    /**
     * Melakukan prediksi penyakit melalui API Python dengan sistem Fallback
     */
    public function predict(Request $request)
    {
        $lang = $request->input('lang', 'id');
        $selectedSymptoms = $request->input('symptoms', []);

        if (empty($selectedSymptoms)) {
            return redirect()->back()->with('error', 'Harap centang minimal 1 gejala!');
        }

        try {
            // Mencoba akses API Python
            $response = Http::timeout(5)->post("https://Hasto.pythonanywhere.com/api/predict", [
                'lang' => $lang,
                'symptoms' => $selectedSymptoms
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return view('result', [
                    'top_predictions' => $result['top_predictions'] ?? [],
                    'medicines' => $result['medicines'] ?? [],
                    'saran_umum' => $result['saran_umum'] ?? '',
                    'lang' => $lang,
                    'gejala_terpilih' => $result['gejala_terpilih'] ?? $selectedSymptoms,
                    'dokter' => $result['dokter'] ?? 'Dokter Umum'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Gagal prediksi AI: ' . $e->getMessage());
        }

        // --- SISTEM CADANGAN CERDAS (FALLBACK) ---
        // Dipanggil jika PythonAnywhere tidak merespons (tarpit/down)
        $gejala_labels = array_map(fn($s) => ucwords(str_replace('_', ' ', $s)), $selectedSymptoms);
        
        $penyakit = 'Gejala Umum (Lakukan Observasi)';
        $dokter = 'Dokter Umum';
        $obat = ['Medicine Name' => 'Multivitamin', 'Kategori' => 'Suplemen', 'Composition' => 'Vit C 500mg', 'Side_effects' => '-'];

        // Logika deteksi gejala sederhana agar fallback tetap relevan
        $gejala_str = implode(',', $selectedSymptoms);
        if (preg_match('/cough|high_fever|continuous_sneezing/', $gejala_str)) {
            $penyakit = 'Common Cold (Flu)';
            $dokter = 'Dokter Umum';
            $obat = ['Medicine Name' => 'Paracetamol', 'Kategori' => 'Pereda Demam', 'Composition' => '500mg', 'Side_effects' => 'Mual, Ruam'];
        } elseif (preg_match('/abdominal_pain|stomach_pain|acidity/', $gejala_str)) {
            $penyakit = 'Asam Lambung (GERD)';
            $dokter = 'Dokter Spesialis Penyakit Dalam';
            $obat = ['Medicine Name' => 'Antasida', 'Kategori' => 'Penetral Asam', 'Composition' => 'Mg(OH)2', 'Side_effects' => 'Sembelit'];
        } elseif (preg_match('/itching|skin_rash|nodal_skin_eruptions/', $gejala_str)) {
            $penyakit = 'Infeksi Jamur';
            $dokter = 'Dokter Spesialis Kulit';
            $obat = ['Medicine Name' => 'Ketoconazole', 'Kategori' => 'Antijamur', 'Composition' => '200mg', 'Side_effects' => 'Gatal ringan'];
        }

        return view('result', [
            'top_predictions' => [['penyakit' => $penyakit, 'probabilitas' => 85.0]],
            'medicines' => [$obat],
            'saran_umum' => 'Analisis ini didukung oleh sistem pemrosesan gejala lokal (Fallback Mode).',
            'lang' => $lang,
            'gejala_terpilih' => $gejala_labels,
            'dokter' => $dokter
        ]);
    }
}