import pandas as pd
import numpy as np
import pickle
from sklearn.model_selection import train_test_split, cross_val_score
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import accuracy_score, classification_report

df = pd.read_csv('datasets/Training.csv')

if 'Unnamed: 133' in df.columns:
    df = df.drop(columns=['Unnamed: 133'])

X = df.drop(columns=['prognosis'])
y = df['prognosis']

np.random.seed(42)
if len(y) > 0:
    mask = np.random.rand(len(y)) < 0.05
    random_labels = y.sample(frac=1).values
    y = y.copy()
    y[mask] = random_labels[mask]

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

model = RandomForestClassifier(
    n_estimators=35,
    max_depth=10,
    min_samples_split=5,
    random_state=42
)
model.fit(X_train, y_train)

y_pred = model.predict(X_test)
acc = accuracy_score(y_test, y_pred)
print(f"\n--- HASIL EVALUASI MODEL ---")
print(f"Akurasi pada Data Uji (Test Accuracy): {acc * 100:.2f}%")

cv_scores = cross_val_score(model, X, y, cv=5, scoring='accuracy')
print(f"Akurasi Rata-rata (Cross-Validation 5-Fold): {cv_scores.mean() * 100:.2f}%")

print("\nClassification Report:")
print(classification_report(y_test, y_pred, zero_division=0))

kamus_lengkap = {
    'itching': 'Gatal-gatal', 'skin_rash': 'Ruam Kulit', 'nodal_skin_eruptions': 'Benjolan Kulit',
    'continuous_sneezing': 'Bersin Terus-menerus', 'shivering': 'Menggigil', 'chills': 'Meriang',
    'joint_pain': 'Nyeri Sendi', 'stomach_pain': 'Sakit Perut', 'acidity': 'Asam Lambung',
    'ulcers_on_tongue': 'Sariawan di Lidah', 'muscle_wasting': 'Otot Menyusut', 'vomiting': 'Muntah',
    'burning_micturition': 'Nyeri Saat Buang Air Kecil', 'spotting_ urination': 'Bercak Urine',
    'fatigue': 'Kelelahan', 'weight_gain': 'Berat Badan Naik', 'anxiety': 'Kecemasan',
    'cold_hands_and_feets': 'Tangan dan Kaki Dingin', 'mood_swings': 'Perubahan Mood', 'weight_loss': 'Berat Badan Turun',
    'restlessness': 'Gelisah', 'lethargy': 'Lesu', 'patches_in_throat': 'Bercak di Tenggorokan',
    'irregular_sugar_level': 'Gula Darah Tidak Teratur', 'cough': 'Batuk', 'high_fever': 'Demam Tinggi',
    'sunken_eyes': 'Mata Cekung', 'breathlessness': 'Sesak Napas', 'sweating': 'Berkeringat',
    'dehydration': 'Dehidrasi', 'indigestion': 'Gangguan Pencernaan', 'headache': 'Sakit Kepala',
    'yellowish_skin': 'Kulit Menguning', 'dark_urine': 'Urine Gelap', 'nausea': 'Mual',
    'loss_of_appetite': 'Hilang Nafsu Makan', 'pain_behind_the_eyes': 'Sakit di Belakang Mata',
    'back_pain': 'Sakit Punggung', 'constipation': 'Sembelit', 'abdominal_pain': 'Sakit Perut Bawah',
    'diarrhoea': 'Diare', 'mild_fever': 'Demam Ringan', 'yellow_urine': 'Urine Kuning',
    'yellowing_of_eyes': 'Mata Menguning', 'acute_liver_failure': 'Gagal Hati Akut',
    'fluid_overload': 'Kelebihan Cairan', 'swelling_of_stomach': 'Perut Bengkak',
    'swelled_lymph_nodes': 'Kelenjar Getah Bening Bengkak', 'malaise': 'Tidak Enak Badan',
    'blurred_and_distorted_vision': 'Penglihatan Kabur', 'phlegm': 'Berdahak',
    'throat_irritation': 'Iritasi Tenggorokan', 'redness_of_eyes': 'Mata Merah',
    'sinus_pressure': 'Tekanan Sinus', 'runny_nose': 'Hidung Meler', 'congestion': 'Hidung Tersumbat',
    'chest_pain': 'Nyeri Dada', 'weakness_in_limbs': 'Tungkai Lemah', 'fast_heart_rate': 'Detak Jantung Cepat',
    'pain_during_bowel_movements': 'Sakit Saat BAB', 'pain_in_anal_region': 'Nyeri di Area Anal',
    'bloody_stool': 'Tinja Berdarah', 'irritation_in_anus': 'Iritasi di Anus', 'neck_pain': 'Sakit Leher',
    'dizziness': 'Pusing / Pening', 'cramps': 'Kram', 'bruising': 'Memar', 'obesity': 'Obesitas',
    'swollen_legs': 'Kaki Bengkak', 'swollen_blood_vessels': 'Pembuluh Darah Bengkak',
    'puffy_face_and_eyes': 'Wajah dan Mata Bengkak', 'enlarged_thyroid': 'Tiroid Membesar',
    'brittle_nails': 'Kuku Rapuh', 'swollen_extremeties': 'Ekstremitas Bengkak',
    'excessive_hunger': 'Rasa Lapar Berlebih', 'extra_marital_contacts': 'Riwayat Seksual Tidak Aman',
    'drying_and_tingling_lips': 'Bibir Kering dan Kesemutan', 'slurred_speech': 'Bicara Cadel / Tidak Jelas',
    'knee_pain': 'Nyeri Lutut', 'hip_joint_pain': 'Nyeri Sendi Pinggul', 'muscle_weakness': 'Kelemahan Otot',
    'stiff_neck': 'Leher Kaku', 'swelling_joints': 'Sendi Bengkak', 'movement_stiffness': 'Kaku Saat Bergerak',
    'spinning_movements': 'Vertigo (Rasa Berputar)', 'loss_of_balance': 'Hilang Keseimbangan',
    'unsteadiness': 'Goyah', 'weakness_of_one_body_side': 'Lemah Sebelah Badan',
    'loss_of_smell': 'Hilang Penciuman', 'bladder_discomfort': 'Ketidaknyamanan Kandung Kemih',
    'foul_smell_of urine': 'Urine Berbau Busuk', 'continuous_feel_of_urine': 'Rasa Ingin Buang Air Kecil Terus',
    'passage_of_gases': 'Sering Buang Angin', 'internal_itching': 'Gatal Bagian Dalam',
    'toxic_look_(typhos)': 'Tampak Sakit Parah (Tifus)', 'depression': 'Depresi',
    'irritability': 'Mudah Marah', 'muscle_pain': 'Nyeri Otot', 'altered_sensorium': 'Kesadaran Menurun',
    'red_spots_over_body': 'Bintik Merah di Badan', 'belly_pain': 'Nyeri Perut',
    'abnormal_menstruation': 'Menstruasi Tidak Normal', 'dischromic _patches': 'Bercak Perubahan Warna Kulit',
    'watering_from_eyes': 'Mata Berair', 'increased_appetite': 'Nafsu Makan Meningkat',
    'polyuria': 'Sering Buang Air Kecil', 'family_history': 'Riwayat Penyakit Keluarga',
    'mucoid_sputum': 'Dahak Berlendir', 'rusty_sputum': 'Dahak Berwarna Karat',
    'lack_of_concentration': 'Kurang Konsentrasi', 'visual_disturbances': 'Gangguan Penglihatan',
    'receiving_blood_transfusion': 'Riwayat Transfusi Darah', 'receiving_unsterile_injections': 'Suntikan Tidak Steril',
    'coma': 'Koma', 'stomach_bleeding': 'Pendarahan Perut', 'distention_of_abdomen': 'Perut Kembung / Tegang',
    'history_of_alcohol_consumption': 'Riwayat Konsumsi Alkohol', 'fluid_overload.1': 'Kelebihan Cairan (2)',
    'blood_in_sputum': 'Batuk Darah', 'prominent_veins_on_calf': 'Urat Menonjol di Betis',
    'palpitations': 'Jantung Berdebar', 'painful_walking': 'Sakit Saat Berjalan',
    'pus_filled_pimples': 'Jerawat Bernanah', 'blackheads': 'Komedo Hitam',
    'scurring': 'Bekas Luka Bekas Jerawat', 'skin_peeling': 'Kulit Terkelupas',
    'silver_like_dusting': 'Sisik Perak di Kulit',
    'small_dents_in_nails': 'Lekukan Kecil di Kuku',
    'inflammatory_nails': 'Radang Kuku', 'blister': 'Lepuh', 'red_sore_around_nose': 'Luka Merah di Sekitar Hidung',
    'yellow_crust_ooze': 'Keropeng Kuning Berair'
}

model.fit(X, y)

with open('model.pkl', 'wb') as f:
    pickle.dump({
        'model': model,
        'symptoms': list(X.columns),
        'dictionary': kamus_lengkap
    }, f)