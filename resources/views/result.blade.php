<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f4f7f6; }
        .container { max-width: 900px; margin: auto; background: white; padding: 25px; border-radius: 12px; }
        .warning-box { background: #fff3cd; border-left: 5px solid #ffc107; padding: 15px; margin: 20px 0; }
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 600px; }
        th, td { border: 1px solid #ddd; padding: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="warning-box">⚠️ Peringatan: Hasil ini adalah prediksi AI. Konsultasikan dengan dokter.</div>
        <h3>@if($lang == 'id') Gejala Terpilih @else Symptoms @endif</h3>
        @foreach($gejala_terpilih as $g) <span>{{ $g }}, </span> @endforeach
        
        <h3>Hasil Analisis</h3>
        <div class="table-wrapper">
            <table>
                <thead><tr><th>Penyakit</th><th>Probabilitas</th><th>Dokter</th></tr></thead>
                <tbody>
                    @foreach($top_predictions as $item)
                    <tr><td>{{ $item['penyakit'] }}</td><td>{{ $item['probabilitas'] }}%</td><td>{{ $item['dokter'] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="/diagnosa?lang={{ $lang }}">Kembali</a>
    </div>
</body>
</html>