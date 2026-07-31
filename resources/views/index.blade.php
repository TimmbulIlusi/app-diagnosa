<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($lang == 'id') Sistem Cerdas Diagnosa Medis @else Smart Medical Diagnosis @endif</title>
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%); 
            color: #334155; 
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container { 
            width: 100%; 
            max-width: 950px; 
            background: #ffffff; 
            padding: 40px; 
            border-radius: 16px; 
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08); 
            border-top: 6px solid #1d4ed8;
        }
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 2px solid #f1f5f9; 
            padding-bottom: 20px; 
            margin-bottom: 20px; 
        }
        .header h2 {
            color: #1e3a8a;
            font-size: 26px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .dashboard-btn {
            background: #f1f5f9;
            color: #334155;
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #e2e8f0;
        }
        .dashboard-btn:hover {
            background: #e2e8f0;
            color: #1e3a8a;
        }
        .lang-switcher {
            display: flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 30px;
        }
        .lang-btn { 
            text-decoration: none; 
            padding: 6px 16px; 
            color: #64748b; 
            border-radius: 20px; 
            font-size: 14px; 
            font-weight: 600; 
            transition: all 0.3s ease;
        }
        .active-lang { 
            background: #1d4ed8; 
            color: white; 
            box-shadow: 0 2px 8px rgba(29, 78, 216, 0.3);
        }
        
        p.subtitle {
            color: #64748b;
            font-size: 15px;
            margin-bottom: 20px;
        }

        .search-box-wrapper {
            position: relative;
            margin-bottom: 25px;
        }
        .search-box-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
        }
        .search-box { 
            width: 100%; 
            padding: 14px 16px 14px 48px; 
            border: 1.5px solid #cbd5e1; 
            border-radius: 10px; 
            font-size: 15px; 
            outline: none;
            transition: all 0.3s;
            background-color: #fafbfc;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .search-box:focus { 
            border-color: #1d4ed8; 
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(29, 78, 216, 0.1); 
        }

        .symptom-container { 
            height: 380px; 
            overflow-y: auto; 
            border: 1.5px solid #e2e8f0; 
            padding: 20px; 
            border-radius: 10px; 
            background: #f8fafc; 
        }
        .symptom-container::-webkit-scrollbar {
            width: 8px;
        }
        .symptom-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); 
            gap: 12px; 
        }
        
        label { 
            display: flex; 
            align-items: center; 
            cursor: pointer; 
            font-size: 14.5px; 
            padding: 10px 14px; 
            border-radius: 8px; 
            background: #ffffff;
            transition: all 0.2s; 
            border: 1px solid #e2e8f0; 
            color: #334155;
            font-weight: 500;
        }
        label:hover { 
            background: #eff6ff; 
            border-color: #bfdbfe; 
            color: #1d4ed8;
        }
        input[type="checkbox"] { 
            margin-right: 12px; 
            cursor: pointer; 
            width: 18px;
            height: 18px;
            accent-color: #1d4ed8;
        }

        .submit-btn { 
            width: 100%; 
            margin-top: 25px; 
            padding: 16px; 
            background-color: #1d4ed8; 
            color: white; 
            border: none; 
            border-radius: 10px; 
            font-size: 16px; 
            font-weight: 700; 
            cursor: pointer; 
            transition: background 0.3s, transform 0.1s;
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.25);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .submit-btn:hover { 
            background-color: #1e40af; 
        }
        .submit-btn:active {
            transform: scale(0.99);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>
                <i class="fa-solid fa-notes-medical" style="color: #1d4ed8;"></i>
                @if($lang == 'id') Sistem Cerdas Diagnosa Medis @else Smart Medical Diagnosis @endif
            </h2>
            <div class="header-actions">
                <!-- Tombol Dashboard Pengganti Info Sistem -->
                <a href="/?lang={{ $lang }}" class="dashboard-btn">
                    <i class="fa-solid fa-house"></i> @if($lang == 'id') Dashboard @else Dashboard @endif
                </a>
                <div class="lang-switcher">
                    <a href="/diagnosa?lang=id" class="lang-btn {{ $lang == 'id' ? 'active-lang' : '' }}">ID</a>
                    <a href="/diagnosa?lang=en" class="lang-btn {{ $lang == 'en' ? 'active-lang' : '' }}">EN</a>
                </div>
            </div>
        </div>

        <p class="subtitle">
            @if($lang == 'id')
                Silakan centang gejala yang Anda rasakan di bawah ini, atau gunakan kolom pencarian untuk menemukannya dengan cepat:
            @else
                Please check the symptoms you are experiencing below, or use the search bar to find them quickly:
            @endif
        </p>
        
        <!-- Search Bar dengan Ikon -->
        <div class="search-box-wrapper">
            <i class="fa-solid fa-magnifying-glass"></i>
            @if($lang == 'id')
                <input type="text" id="searchInput" class="search-box" onkeyup="filterGejala()" placeholder="Cari keluhan atau gejala (contoh: gatal, demam, pusing)...">
            @else
                <input type="text" id="searchInput" class="search-box" onkeyup="filterGejala()" placeholder="Search symptoms (e.g., itching, fever, headache)...">
            @endif
        </div>

        <form action="/predict" method="POST" id="diagnosisForm">
            @csrf
            <input type="hidden" name="lang" value="{{ $lang }}">
            <input type="hidden" id="errorMsg" value="@if($lang == 'id') Harap centang minimal 1 gejala sebelum mendiagnosis! @else Please select at least 1 symptom before diagnosing! @endif">
            
            <div class="symptom-container">
                <div class="grid" id="symptomGrid">
                    @foreach($symptoms as $symptom)
                    <label class="symptom-item">
                        <input type="checkbox" name="symptoms[]" value="{{ $symptom['id'] }}">
                        <span class="symptom-text">{{ $symptom['label'] }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            
            <button type="submit" class="submit-btn">
                <i class="fa-solid fa-stethoscope" style="margin-right: 8px;"></i>
                @if($lang == 'id') Mulai Proses Diagnosis AI @else Start AI Diagnosis Process @endif
            </button>
        </form>
    </div>

    <script>
        function filterGejala() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let labels = document.getElementsByClassName('symptom-item');
            
            for (let i = 0; i < labels.length; i++) {
                let text = labels[i].getElementsByClassName('symptom-text')[0].innerText.toLowerCase();
                if (text.includes(input)) {
                    labels[i].style.display = "flex";
                } else {
                    labels[i].style.display = "none";
                }
            }
        }

        document.getElementById('diagnosisForm').addEventListener('submit', function(e) {
            let checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            if (checkboxes.length === 0) {
                e.preventDefault(); 
                let msg = document.getElementById('errorMsg').value;
                alert(msg);
            }
        });
    </script>
</body>
</html>