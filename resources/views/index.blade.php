<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Diagnosa Medis</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f7f6; padding: 20px; }
        .container { width: 100%; max-width: 950px; margin: auto; background: white; padding: 30px; border-radius: 12px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 10px; }
        @media (max-width: 600px) { .grid { grid-template-columns: 1fr; } }
        .search-box { width: 100%; padding: 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .submit-btn { width: 100%; padding: 16px; background: #1d4ed8; color: white; border: none; border-radius: 8px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>@if($lang == 'id') Pilih Gejala @else Select Symptoms @endif</h2>
        <input type="text" id="searchInput" class="search-box" onkeyup="filterGejala()" placeholder="Cari...">
        <form action="/predict" method="POST">
            @csrf
            <div class="grid" id="symptomGrid"></div>
            <button type="submit" class="submit-btn">Diagnosa</button>
        </form>
    </div>
    <script>
        const gejala = [ /* Data gejala original kamu tetap di sini */ ];
        const grid = document.getElementById('symptomGrid');
        gejala.forEach(g => {
            let labelEl = document.createElement('label');
            labelEl.className = 'symptom-item';
            labelEl.innerHTML = `<input type="checkbox" name="symptoms[]" value="${g.id}"> <span>{{ $lang == 'id' ? '${g.label}' : '${g.en}' }}</span>`;
            grid.appendChild(labelEl);
        });
        function filterGejala() { /* Logika filter kamu tetap di sini */ }
    </script>
</body>
</html>