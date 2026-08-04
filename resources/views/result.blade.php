<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosa AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h3 { color: #1e3a8a; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }
        .chip { display: inline-block; background: #e2e8f0; padding: 5px 15px; border-radius: 20px; margin: 3px; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0 30px; }
        th, td { border: 1px solid #e2e8f0; padding: 12px; text-align: left; }
        th { background: #0f172a; color: white; }
        .back-btn { display: inline-block; padding: 10px 20px; background: #1d4ed8; color: white; border-radius: 6px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h3>Gejala yang Dilaporkan</h3>
        <div>
            @foreach($gejala_terpilih as $gejala)
                <span class="chip">{{ $gejala }}</span>
            @endforeach
        </div>

        <h3>Hasil Analisis AI</h3>
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

        <h3>Rekomendasi Obat & Efek Samping</h3>
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

        <a href="/diagnosa?lang={{ $lang }}" class="back-btn">Kembali</a>
    </div>
</body>
</html>