<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($lang == 'id') Hasil Analisis Probabilitas @else Probability Analysis Result @endif</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7f6; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 950px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border-top: 5px solid #1d4ed8; }
        .section-title { color: #495057; font-size: 16px; font-weight: bold; margin-bottom: 10px; border-bottom: 2px solid #eee; padding-bottom: 5px; }
        .chip-container { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 25px; padding: 15px; background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e9ecef; }
        .chip { background-color: #e2e8f0; color: #334155; padding: 6px 12px; border-radius: 20px; font-size: 14px; font-weight: 500; }
        
        .prob-table { width: 100%; border-collapse: collapse; margin: 20px 0 30px 0; }
        .prob-table th, .prob-table td { border: 1px solid #e2e8f0; padding: 12px 15px; font-size: 15px; text-align: left; }
        .prob-table th { background-color: #0f172a; color: white; font-weight: 600; }
        .prob-table tr:first-child { background-color: #eff6ff; font-weight: bold; color: #1e40af; }
        
        .warning-box { background-color: #fff3cd; border-left: 5px solid #ffc107; padding: 15px 20px; border-radius: 6px; margin-bottom: 30px; display: flex; align-items: flex-start; gap: 15px; }
        .warning-text p { margin: 0 0 5px 0; font-size: 14px; color: #664d03; }
        .warning-text strong { color: #856404; font-size: 15px; }

        .medicine-disclaimer { font-size: 13px; color: #64748b; background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 10px 14px; border-radius: 6px; margin-bottom: 15px; display: flex; align-items: center; gap: 8px; }
        
        table.med-table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        .med-table th, .med-table td { border: 1px solid #dee2e6; padding: 12px 15px; text-align: left; font-size: 14px; vertical-align: top; }
        .med-table th { background-color: #1d4ed8; color: white; font-weight: 500; }
        .badge-kategori { display: inline-block; background: #e7f5ff; color: #1c7ed6; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; margin-top: 4px; }
        
        .back-btn { display: inline-block; margin-top: 30px; text-decoration: none; padding: 12px 25px; background: #1d4ed8; color: white; border-radius: 6px; font-weight: bold; transition: background 0.2s; }
        .back-btn:hover { background: #1e40af; }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="section-title">@if($lang == 'id') Gejala yang Anda Laporkan: @else Reported Symptoms: @endif</div>
        <div class="chip-container">
            @forelse($gejala_terpilih as $gejala)
                <span class="chip">{{ $gejala }}</span>
            @empty
                <span style="color: #64748b; font-size: 14px; font-style: italic;">@if($lang == 'id') Tidak ada gejala yang dipilih. @else No symptoms selected. @endif</span>
            @endforelse
        </div>

        <div class="section-title">@if($lang == 'id') Hasil Analisis Probabilitas Model (Top 3): @else Model Probability Analysis Results (Top 3): @endif</div>
        
        <table class="prob-table">
            <thead>
                <tr>
                    <th>@if($lang == 'id') Kemungkinan Kondisi / Penyakit @else Possible Condition / Disease @endif</th>
                    <th width="20%">@if($lang == 'id') Tingkat Probabilitas @else Probability Rate @endif</th>
                </tr>
            </thead>
            <tbody>
                @forelse($top_predictions as $item)
                <tr>
                    <td>
                        @if($loop->first)<i class="fa-solid fa-circle-chevron-right" style="color: #2563eb; margin-right: 6px;"></i>@endif
                        {{ $item['penyakit'] ?? ($item['disease'] ?? '-') }}
                    </td>
                    <td><strong>{{ $item['probabilitas'] ?? ($item['probability'] ?? '0') }}%</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" style="text-align: center; color: #64748b;">@if($lang == 'id') Tidak ada data prediksi. @else No prediction data available. @endif</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="warning-box">
            <div class="warning-icon" style="font-size: 24px;">⚠️</div>
            <div class="warning-text">
                @if($lang == 'id')
                    <p><strong>Peringatan Medis:</strong> Sistem menggunakan analisis probabilitas <i>Machine Learning</i> dan bukan pengganti diagnosis medis resmi.</p>
                    <p>Sangat disarankan bagi Anda untuk berkonsultasi secara langsung dengan: <br> <strong>&rarr; {{ $dokter }}</strong></p>
                @else
                    <p><strong>Medical Disclaimer:</strong> This system uses Machine Learning probability analysis and does not replace official medical diagnosis.</p>
                    <p>It is highly recommended to consult directly with: <br> <strong>&rarr; {{ $dokter }}</strong></p>
                @endif
            </div>
        </div>

        <div class="section-title">@if($lang == 'id') Rujukan Informasi Obat & Penanganan (Knowledge Base): @else Medicine Information & Care Reference (Knowledge Base): @endif</div>
        
        <div class="medicine-disclaimer">
            <i class="fa-solid fa-circle-info" style="color: #2563eb; font-size: 15px;"></i>
            <span>
                @if($lang == 'id')
                    <strong>Catatan:</strong> Informasi obat di bawah bersumber dari basis data umum (*Knowledge Base*) untuk tujuan edukasi semata. Selalu konsultasikan penggunaan obat dengan dokter atau apoteker.
                @else
                    <strong>Note:</strong> Medicine information below is sourced from a general database for educational purposes only. Always consult a doctor or pharmacist regarding medication.
                @endif
            </span>
        </div>

        @if(!empty($medicines) && is_array($medicines) && isset($medicines[0]) && is_array($medicines[0]))
            <table class="med-table">
                <thead>
                    <tr>
                        <th width="25%">@if($lang == 'id') Nama & Jenis Obat @else Medicine Name & Type @endif</th>
                        <th width="30%">@if($lang == 'id') Kandungan Aktif @else Active Composition @endif</th>
                        <th width="45%">@if($lang == 'id') Efek Samping Umum @else Common Side Effects @endif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicines as $obat)
                    <tr>
                        <td>
                            <strong>{{ $obat['Medicine Name'] ?? '-' }}</strong><br>
                            <span class="badge-kategori">{{ $obat['Kategori'] ?? 'Obat Umum' }}</span>
                        </td>
                        <td>{{ $obat['Composition'] ?? '-' }}</td>
                        <td>{{ $obat['Side_effects'] ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="background-color: #f8fafc; border: 1.5px dashed #cbd5e1; padding: 20px; border-radius: 8px; margin-top: 10px;">
                <h4 style="color: #1e3a8a; margin-bottom: 8px; font-size: 15px;">
                    <i class="fa-solid fa-circle-info" style="color: #2563eb; margin-right: 6px;"></i>
                    @if($lang == 'id') Saran Penanganan Mandiri (First Aid): @else General Care Advice (First Aid): @endif
                </h4>
                <p style="color: #475569; font-size: 14.5px; margin: 0; line-height: 1.5;">
                    {{ $saran_umum }}
                </p>
            </div>
        @endif

        <a href="/diagnosa?lang={{ $lang }}" class="back-btn">&larr; @if($lang == 'id') Kembali Cek Gejala @else Back to Symptoms @endif</a>
    </div>
</body>
</html>