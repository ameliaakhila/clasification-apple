<x-layout title="dataset">
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 font-bolder text-danger">Clasification</h1>

        <form action="{{ route('clasification') }}" method="POST" class="user" id="prediksiForm">
            @csrf
            <div class="row">
                <!-- Diameter -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-danger" for="diameter">Diameter Buah (cm):</label>
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-danger p-1 fw-bold">0</span>
                            <input type="range" class="form-range form-danger slider flex-grow-1" id="diameter"
                                name="diameter" min="0" max="10" step="0.1" value="{{ $default['diameter'] ?? 5 }}">
                            <span class="text-danger sliderValue fw-bold"
                                id="diameterValue">{{ $default['diameter'] ?? 5 }}</span>
                        </div>
                    </div>

                    <!-- Kadar Gula -->
                    <div class="form-group">
                        <label class="text-danger" for="kadar_gula">Kadar Gula (%):</label>
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-danger p-1 fw-bold">0</span>
                            <input type="range" class="form-range form-danger slider flex-grow-1" id="kadar_gula"
                                name="kadar_gula" min="0" max="20" step="0.1"
                                value="{{ $default['kadar_gula'] ?? 10 }}">
                            <span class="text-danger sliderValue fw-bold"
                                id="kadar_gulaValue">{{ $default['kadar_gula'] ?? 10 }}</span>
                        </div>
                    </div>


                    <!-- Berat -->
                    <div class="form-group">
                        <label class="text-danger" for="berat">Berat Buah (gr):</label>
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-danger fw-bold">0</span>
                            <input type="range" class="form-range form-danger slider flex-grow-1" id="berat"
                                name="berat" min="0" max="500" step="1" value="{{ $default['berat'] ?? 255 }}">
                            <span id="beratValue"
                                class="text-danger sliderValue fw-bold">{{ $default['berat'] ?? 255 }}</span>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <!-- Warna -->
                    <div class="form-group">
                        <label for="warna" class="text-danger">Warna</label>
                        <select class="form-control rounded-pill border border-danger shadow-sm text-dark" name="warna"
                            id="warna" required>
                            <option value="" selected>-- Pilih Warna --</option>
                            <option value="merah">Merah</option>
                            <option value="hijau">Hijau</option>
                            <option value="kuning">Kuning</option>
                        </select>
                    </div>

                    <!-- Asal Daerah -->
                    <div class="form-group">
                        <label for="asal_daerah" class="text-danger">Asal Daerah</label>
                        <select class="form-control rounded-pill border border-danger shadow-sm text-dark"
                            name="asal_daerah" id="asal_daerah" required>
                            <option value="" selected>-- Pilih Asal Daerah --</option>
                            <option value="Kalimantan">Kalimantan</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                        </select>
                    </div>

                    <!-- Musim Panen -->
                    <div class="form-group">
                        <label for="musim_panen" class=" text-danger">Musim Panen</label>
                        <select class="form-control border rounded-pill border-danger shadow-sm text-dark"
                            name="musim_panen" id="musim_panen" required>
                            <option value="" selected>-- Pilih Musim Panen --</option>
                            <option value="hujan">Musim Hujan</option>
                            <option value="kemarau">Musim Kemarau</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tombol Prediksi -->
            <button type="submit" class="btn btn-danger btn-user btn-block text-lg">
                Prediksi
            </button>
        </form>

        @if (isset($inputValue))
            <div class="card shadow my-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Data Train Yang Telah Di Input</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <li>
                            <ul>a</ul>
                            <ul>b</ul>
                            <ul>c</ul>
                        </li>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($hasil))
            <div class="alert alert-danger mt-3 px-2 fw-bold text-center">
                <b>🍎 Hasil Prediksi: {{ $hasil }} <br></b>
                @if($confidence)
                    Kepercayaan: {{ $confidence }} <br>
                @endif
                @if($akurasi !== null)
                    Akurasi: {{ $akurasi}} <br>
                    Precision: {{ $precision}} <br>
                    Recall: {{ $recall}}
                @endif
            </div>
        @endif
    </div>
</x-layout>