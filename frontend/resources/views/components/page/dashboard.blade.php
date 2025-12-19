<x-layout title="Dashboard Sistem Klasifikasi Apel">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-danger">Dashboard Sistem Klasifikasi Apel</h1>
        </div>

        <!-- System Description -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-danger"><i class="fas fa-info-circle"></i> Tentang Sistem</h5>
                <p>
                    Sistem ini digunakan untuk mengklasifikasikan kualitas apel berdasarkan beberapa kriteria:
                </p>
                <ul>
                    <li><strong>Diameter</strong> - Ukuran fisik apel</li>
                    <li><strong>Berat</strong> - Berat buah</li>
                    <li><strong>Kadar Gula</strong> - Tingkat kemanisan</li>
                    <li><strong>Warna</strong> - Hijau, Kuning, Merah</li>
                    <li><strong>Asal Daerah</strong> - Lokasi produksi apel</li>
                    <li><strong>Musim Panen</strong> - Waktu panen</li>
                </ul>
                <p>
                    <strong>Frontend:</strong> Laravel 12
                    <strong>Backend:</strong> Flask (Python ML)
                    <strong>Database:</strong> MySQL
                    <strong>Styling:</strong> Bootstrap 5
                </p>
            </div>
        </div>

        <!-- Cards Section -->
        <div class="row">

            <!-- Total DataSet -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Dataset</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">500</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-database fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Training -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Training</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">400</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-brain fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Akurasi Model -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Akurasi Model
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">92%</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kriteria Warna Apel -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Kriteria Warna</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Hijau-Kuning-Merah</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-apple-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Workflow Sistem -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-danger text-white">
                <i class="fas fa-project-diagram"></i> Workflow Sistem
            </div>
            <div class="card-body">
                <ol>
                    <li>Dataset apel dibaca dari MySQL atau CSV.</li>
                    <li>Data diproses di backend Flask (preprocessing & klasifikasi ML).</li>
                    <li>Model Logistic Regression / Decision Tree diterapkan.</li>
                    <li>Hasil prediksi dikirim ke frontend Laravel melalui API.</li>
                    <li>Dashboard menampilkan dataset, hasil prediksi, dan evaluasi akurasi.</li>
                </ol>
            </div>
        </div>

    </div>
</x-layout>
