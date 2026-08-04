<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($lang == 'id') Hasil Diagnosa AI @else AI Diagnosis Result @endif</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7f6; padding: 20px; }
        .container { max-width: 950px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .section-title { font-size: 18px; font-weight: bold; margin: 20px 0 10px; border-bottom: 2px solid #e2e8f0; padding-bottom: 5px; }
        .chip { display: inline-block; background: #e2e8f0; padding: 5px 15px; border-radius: 20px; margin: 3px; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #e2e8f0; padding: 12px; text-align: left; }
        th { background: #0f172a; color: white; }
        .back-btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #1d4ed8; color: white; border-radius: 6px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h3>@if($lang == 'id') Gejala yang Dilaporkan @else Reported Symptoms @endif</h3>
        <div>@foreach($gejala_terpilih as $g)<span class="chip">{{ $g }}</span>@endforeach</div>

        <h3>@if($lang == 'id') Hasil Analisis AI @else AI Analysis Results @endif</h3>
        <table>
            <thead>
                <tr>
                    <th>Penyakit</th>
                    <th>Probabilitas</th>
                    <th>Rujukan Dokter</th>
                </tr>
            </thead>
            <tbody>
                @foreach($top_predictions as $item)
                <tr>
                    <td><strong>{{ $item['penyakit'] }}</strong></td>
                    <td>{{ $item['probabilitas'] }}%</td>
                    <td>{{ $item['dokter'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>@if($lang == 'id') Rekomendasi Obat & Efek Samping @else Medicine & Side Effects @endif</h3>
        <table>
            <thead>
                <tr>
                    <th>Penyakit</th>
                    <th>Nama Obat</th>
                    <th>Efek Samping</th>
                </tr>
            </thead>
            <tbody>
                @foreach($top_predictions as $item)
                <tr>
                    <td>{{ $item['penyakit'] }}</td>
                    <td>{{ $item['obat']['nama'] }}</td>
                    <td>{{ $item['obat']['efek'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="/diagnosa?lang={{ $lang }}" class="back-btn">
            &larr; @if($lang == 'id') Kembali @else Back @endif
        </a>
    </div>
</body>
</html>