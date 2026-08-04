<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <title>Hasil Diagnosa</title>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 16px; }
        .warning-box { background: #fff3cd; border-left: 5px solid #ffc107; padding: 15px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #0f172a; color: white; }
        .back-btn { display: inline-block; padding: 10px 20px; background: #1d4ed8; color: white; text-decoration: none; border-radius: 6px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="warning-box">⚠️ Peringatan: Hasil ini adalah prediksi AI. Konsultasikan dengan dokter untuk diagnosis resmi.</div>
        <h3>Hasil Analisis AI</h3>
        <table>
            <thead><tr><th>Penyakit</th><th>Probabilitas</th><th>Rujukan Dokter</th></tr></thead>
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
        <a href="/diagnosa" class="back-btn">Kembali</a>
    </div>
</body>
</html>