from flask import Flask, request, jsonify
import joblib
import pandas as pd
from sklearn.metrics import accuracy_score, precision_score, recall_score
import os

app = Flask(__name__)

model_path = os.path.join(os.path.dirname(__file__), "model_apel.joblib")
model = joblib.load(model_path)

@app.route("/prediksi", methods=["POST"])
def prediksi():
    try:
        # Cek apakah request JSON
        if request.is_json:
            data_json = request.get_json()
        else:
            # fallback ke form-data
            data_json = request.form.to_dict()
        data = {
            "diameter": [float(data_json["diameter"])],
            "berat": [float(data_json["berat"])],
            "kadar_gula": [float(data_json["kadar_gula"])],
            "warna": [data_json["warna"].lower()],
            "asal_daerah": [data_json["asal_daerah"].strip()],
            "musim_panen": [data_json["musim_panen"].lower()]
        }

        df = pd.DataFrame(data)


        # Prediksi
        hasil = model.predict(df)[0]
        confidence = max(model.predict_proba(df)[0])

        # Prediksi seluruh dataset untuk menghitung akurasi
        df_csv = pd.read_csv("apel_balance_500.csv")
        X_csv = df_csv[["diameter", "berat", "kadar_gula", "warna", "asal_daerah", "musim_panen"]].copy()
        y_true = df_csv["kualitas"]
        
        # preprocessing sederhana (lowercase/strip) agar sesuai model
        X_csv["warna"] = X_csv["warna"].str.lower()
        X_csv["asal_daerah"] = X_csv["asal_daerah"].str.strip()
        X_csv["musim_panen"] = X_csv["musim_panen"].str.lower()

        y_pred = model.predict(X_csv)

        akurasi = accuracy_score(y_true, y_pred)
        precision = precision_score(y_true, y_pred, average='macro', zero_division=0)
        recall = recall_score(y_true, y_pred, average='macro', zero_division=0)


        return jsonify({
            "prediksi": hasil,
            "confidence": f"{confidence*100:.2f}%",
            "akurasi": f"{akurasi*100:.2f}%" if akurasi is not None else "N/A",
            "precision": f"{precision*100:.2f}%" if precision is not None else "N/A",
            "recall": f"{recall*100:.2f}%" if recall is not None else "N/A"
        })

    except Exception as e:
        return jsonify({"error": str(e)}), 400

if __name__ == "__main__":
    app.run(debug=True)


# from flask import Flask, request, jsonify
# from sklearn.metrics import accuracy_score, precision_score, recall_score

# app = Flask(__name__)

# @app.route("/", methods=["GET"])
# def hello():
#     # Debug sederhana
#     print("DEBUG: Endpoint '/' diakses")
#     return "Halo, Flask berjalan dengan baik!"

# from flask import Flask, jsonify
# from sklearn.metrics import accuracy_score, precision_score, recall_score

# app = Flask(__name__)

# # JSON input langsung di dalam kode
# data_json_list = [
#     {"label_asli": "Bagus", "prediksi": "Bagus"},
#     {"label_asli": "Bagus", "prediksi": "Bagus"},
#     {"label_asli": "Bagus", "prediksi": "Jelek"},
#     {"label_asli": "Bagus", "prediksi": "Bagus"},
#     {"label_asli": "Bagus", "prediksi": "Jelek"},
#     {"label_asli": "Jelek", "prediksi": "Bagus"},
#     {"label_asli": "Jelek", "prediksi": "Jelek"},
#     {"label_asli": "Jelek", "prediksi": "Jelek"},
#     {"label_asli": "Jelek", "prediksi": "Jelek"},
#     {"label_asli": "Jelek", "prediksi": "Jelek"}

# ]


# @app.route("/", methods=["GET"])
# def hello():
#     # Ambil y_true dan y_pred
#     y_pred = [item["prediksi"] for item in data_json_list]
#     y_true = [item["label_asli"] for item in data_json_list]

#     # Debug print ke terminal
#     print("DEBUG: y_true =", y_true)
#     print("DEBUG: y_pred =", y_pred)

#     # Hitung metrik
#     akurasi = accuracy_score(y_true, y_pred)
#     precision = precision_score(y_true, y_pred, average='macro', zero_division=0)
#     recall = recall_score(y_true, y_pred, average='macro', zero_division=0)

#     print("DEBUG: akurasi =", akurasi)
#     print("DEBUG: precision =", precision)
#     print("DEBUG: recall =", recall)

#     # Tampilkan di browser sebagai JSON
#     return jsonify({
#         "akurasi": f"{akurasi*100:.2f}%",
#         "precision": f"{precision*100:.2f}%",
#         "recall": f"{recall*100:.2f}%"
#     })

if __name__ == "__main__":
    app.run(debug=True, port=5000)
