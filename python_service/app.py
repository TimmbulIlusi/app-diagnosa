import pickle
import pandas as pd
from flask import Flask, request, jsonify
from flask_cors import CORS
import os

app = Flask(__name__)
CORS(app)

# 1. Tentukan path file secara absolut
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
MODEL_PATH = os.path.join(BASE_DIR, 'model_fixed.pkl')
DATASET_PATH = os.path.join(BASE_DIR, 'datasets/Training.csv')

# 2. Load model dan data satu kali saat server start
try:
    with open(MODEL_PATH, 'rb') as f:
        model = pickle.load(f)
    df = pd.read_csv(DATASET_PATH)
    symptoms_list = [col for col in df.columns if col != 'prognosis']
except Exception as e:
    print(f"Error loading files: {e}")
    model = None

@app.route('/api/symptoms', methods=['GET'])
def get_symptoms():
    return jsonify(symptoms_list)

@app.route('/api/predict', methods=['POST'])
def predict():
    if model is None:
        return jsonify({'error': 'Model not loaded'}), 500
    
    data = request.get_json()
    selected_symptoms = data.get('symptoms', [])
    
    # 3. Buat vektor biner input
    input_vector = [1 if s in selected_symptoms else 0 for s in symptoms_list]
    input_df = pd.DataFrame([input_vector], columns=symptoms_list)
    
    # 4. Prediksi
    # Mendapatkan probabilitas untuk semua kelas
    probs = model.predict_proba(input_df)[0]
    classes = model.classes_
    
    # Mengambil top 3
    top_indices = probs.argsort()[-3:][::-1]
    results = []
    for i in top_indices:
        results.append({
            'penyakit': classes[i].replace('_', ' '),
            'probabilitas': round(float(probs[i] * 100), 2)
        })

    return jsonify({
        'top_predictions': results,
        'gejala_terpilih': [s.replace('_', ' ') for s in selected_symptoms],
        'dokter': 'Dokter Spesialis Sesuai Diagnosa'
    })

if __name__ == '__main__':
    app.run(debug=False)