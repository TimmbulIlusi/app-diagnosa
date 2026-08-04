<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Diagnosa Medis</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 950px; margin: auto; background: white; padding: 40px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); border-top: 6px solid #1d4ed8; }
        .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; }
        @media (max-width: 600px) { .grid { grid-template-columns: 1fr; } }
        .symptom-container { height: 350px; overflow-y: auto; border: 1px solid #e2e8f0; padding: 20px; margin-bottom: 20px; border-radius: 10px; }
        .submit-btn { width: 100%; padding: 16px; background: #1d4ed8; color: white; border: none; border-radius: 10px; font-weight: 700; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fa-solid fa-notes-medical"></i> Menu Diagnosa AI</h2>
        <input type="text" id="searchInput" class="search-box" onkeyup="filterGejala()" placeholder="Cari keluhan...">
        <form action="/predict" method="POST">
            @csrf
            <div class="symptom-container">
                <div class="grid" id="symptomGrid"></div>
            </div>
            <button type="submit" class="submit-btn">Diagnosa</button>
        </form>
    </div>
    <script>
        const gejala = [ /* SALIN DATA GEJALA LENGKAPMU DI SINI */ ];
        const grid = document.getElementById('symptomGrid');
        gejala.forEach(g => {
            let labelEl = document.createElement('label');
            labelEl.className = 'symptom-item';
            labelEl.innerHTML = `<input type="checkbox" name="symptoms[]" value="${g.id}"> <span>{{ $lang == 'id' ? '${g.label}' : '${g.en}' }}</span>`;
            grid.appendChild(labelEl);
        });
        function filterGejala() { /* Logika filter kamu */ }
    </script>
</body>
</html>