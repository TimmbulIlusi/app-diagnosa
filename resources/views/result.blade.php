<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <title>Hasil Diagnosa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .warning-box { background: #fff3cd; border-left: 5px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 6px; }
        .chip { display: inline-block; background: #e2e8f0; padding: 5px 15px; border-radius: 20px; margin: 3px; font-size: 14px; }
        
        /* TAMBAHAN UNTUK RESPONSIVITAS */
        .table-wrapper { overflow-x: auto; width: 100%; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; min-width: 600px; }
        
        th, td { border: 1px solid #e2e8f0; padding: 12px; text-align: left; }
        th { background: #0f172a; color: white; }
        .back-btn { display: inline-block; padding: 10px 20px; background: #1d4ed8; color: white; border-radius: 6px; text-decoration: none; }
        
        @media (max-width: 600px) {
            .container { padding: 15px; }
            h3 { font-size: 18px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="warning-box">
            <strong>⚠️ Peringatan Penting:</strong> Sistem ini hanya menggunakan <i>knowledge base</i> dan prediksi AI. Hasil ini bukan diagnosis medis resmi. Segera konsultasikan dengan dokter atau tenaga medis profesional untuk hasil yang akurat.
        </div>

        <h3>Gejala yang Dilaporkan</h3>
        <div>@foreach($gejala_terpilih as $g)<span class="chip">{{ $g }}</span>@endforeach</div>

        <h3>Hasil Analisis AI</h3>
        <div class="table-wrapper"> <!-- Pembungkus ini mencegah tabel merusak layar HP -->
            <table>
                <thead>
                    <tr><th>Penyakit</th><th>Probabilitas</th><th>Rujukan Dokter</th></tr>
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
        </div>

        <h3>Rekomendasi Obat</h3>
        <div class="table-wrapper"> <!-- Pembungkus ini mencegah tabel merusak layar HP -->
            <table>
                <thead>
                    <tr><th>Penyakit</th><th>Nama Obat</th><th>Efek Samping</th></tr>
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
        </div>

        <a href="/diagnosa?lang={{ $lang }}" class="back-btn">Kembali</a>
    </div>
</body>
</html>