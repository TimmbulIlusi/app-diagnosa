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
            @foreach($gejala_terpilih as $gejala)
                <span class="chip">{{ $gejala }}</span>
            @endforeach
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
                @foreach($top_predictions as $item)
                <tr>
                    <td>{{ $item['penyakit'] }}</td>
                    <td><strong>{{ $item['probabilitas'] }}%</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="warning-box">
            <div style="font-size: 24px;">⚠️</div>
            <div class="warning-text">
                <p><strong>@if($lang == 'id') Peringatan Medis: @else Medical Disclaimer: @endif</strong> @if($lang == 'id') Sistem menggunakan analisis probabilitas <i>Machine Learning</i>. @else This system uses Machine Learning probability analysis. @endif</p>
                <p><strong>&rarr; {{ $dokter }}</strong></p>
            </div>
        </div>

        <div class="section-title">@if($lang == 'id') Rujukan Informasi Obat: @else Medicine Information Reference: @endif</div>
        
        @if(!empty($medicines))
            <table class="med-table">
                <thead>
                    <tr>
                        <th width="25%">@if($lang == 'id') Nama Obat @else Medicine Name @endif</th>
                        <th width="75%">@if($lang == 'id') Detail Informasi @else Detail Information @endif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($top_predictions as $pred)
                    <tr>
                        <td><strong>{{ $pred['obat']['nama'] }}</strong></td>
                        <td>
                            <strong>@if($lang == 'id') Efek Samping: @else Side Effects: @endif</strong> {{ $pred['obat']['efek'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>{{ $saran_umum ?? 'N/A' }}</p>
        @endif

        <a href="/diagnosa?lang={{ $lang }}" class="back-btn">&larr; @if($lang == 'id') Kembali @else Back @endif</a>
    </div>
</body>
</html>