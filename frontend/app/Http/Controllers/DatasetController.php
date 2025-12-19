<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\HasilPrediksi;

class DatasetController extends Controller
{
    // Fungsi untuk membaca CSV secara reusable
    private function readCSV()
    {
        $csvFile = base_path('../backend/apel_balance_500.csv');

        if (!file_exists($csvFile)) {
            abort(404, "File CSV tidak ditemukan!");
        }

        $rows = array_map('str_getcsv', file($csvFile));
        $header = array_shift($rows);
        return array_map(fn($row) => array_combine($header, $row), $rows);
    }

    public function index()
    {
        $records = $this->readCSV();
        return view('components.page.dataset', compact('records'));
    }

    public function clasification(Request $request)
    {

        //validasi
        $request->validate([
            'diameter' => 'required|numeric',
            'berat' => 'required|numeric',
            'kadar_gula' => 'required|numeric',
            'warna' => 'required|string',
            'asal_daerah' => 'required|string',
            'musim_panen' => 'required|string',
            'kualitas' => 'nullable|string'
        ]);

        // Ambil value yang dikirim POST untuk menampilkan kembali di form
        $inputValues = [
            'diameter' => $request->input('diameter'),
            'berat' => $request->input('berat'),
            'kadar_gula' => $request->input('kadar_gula'),
            'warna' => $request->input('warna'),
            'asal_daerah' => $request->input('asal_daerah'),
            'musim_panen' => $request->input('musim_panen'),
        ];
        // dd($inputValues);

        $response = Http::timeout(60)->asForm()->post('http://127.0.0.1:5000/prediksi', $request->all());


        if ($response->failed()) {
            return back()->with('error', 'Flask API Error: ' . $response->body());
        }

        $hasilJson = $response->json();
        // dd($hasilJson);

        // Simpan ke database
        HasilPrediksi::create([
            'diameter' => $request->input('diameter'),
            'berat' => $request->input('berat'),
            'kadar_gula' => $request->input('kadar_gula'),
            'warna' => $request->input('warna'),
            'asal_daerah' => $request->input('asal_daerah'),
            'musim_panen' => $request->input('musim_panen'),
            'hasil' => $hasilJson['prediksi'] ?? 'N/A',
        ]);

        return view('components.page.clasification', [
            'hasil' => $hasilJson['prediksi'] ?? 'N/A',
            'confidence' => $hasilJson['confidence'] ?? null,
            'akurasi' => $hasilJson['akurasi'] ?? null,
            'precision' => $hasilJson['precision'] ?? null,
            'recall' => $hasilJson['recall'] ?? null,
            'default' => $inputValues
        ]);
    }
}
