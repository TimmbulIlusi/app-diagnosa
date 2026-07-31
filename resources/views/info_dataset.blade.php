<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <title>Informasi Dataset</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f7f6; color: #333; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); }
        .nav-bar { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 25px; }
        .btn-home { background: #64748b; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 13.5px; }
        th, td { border: 1px solid #cbd5e1; padding: 12px; text-align: left; }
        th { background: #0f172a; color: white; font-weight: 600; position: sticky; top: 0; }
        tr:nth-child(even) { background-color: #f8fafc; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav-bar">
            <h2><i class="fa-solid fa-table" style="color: #1d4ed8;"></i> Informasi Dataset Obat</h2>
            <a href="/" class="btn-home"><i class="fa-solid fa-house"></i> Kembali ke Dashboard</a>
        </div>

        <p style="color: #64748b; margin-bottom: 15px;">Berikut adalah sampel data rekam medis dan rujukan obat yang digunakan dalam basis data (Knowledge Base) sistem:</p>
        
        <div style="overflow-x: auto; max-height: 500px; border: 1px solid #cbd5e1; border-radius: 6px;">
            <table>
                <thead>
                    <tr>
                        <th width="25%">Nama Obat</th>
                        <th width="30%">Komposisi Aktif</th>
                        <th width="45%">Kegunaan / Indikasi (Uses)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicineRows as $row)
                    <tr>
                        <td><strong>{{ $row['Medicine Name'] ?? '-' }}</strong></td>
                        <td>{{ $row['Composition'] ?? '-' }}</td>
                        <td>{{ $row['Uses'] ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>