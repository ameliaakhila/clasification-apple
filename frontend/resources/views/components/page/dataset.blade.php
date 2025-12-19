<x-layout title="dataset">
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-danger">DataSet</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Diameter</th>
                                <th>Berat</th>
                                <th>Kadar Gula</th>
                                <th>Asal Daerah</th>
                                <th>Warna</th>
                                <th>Musim panen</th>
                                <th>Kualitas</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($records as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row['diameter'] }}</td>
                                    <td>{{ $row['berat'] }}</td>
                                    <td>{{ $row['kadar_gula'] }}</td>
                                    <td>{{ $row['asal_daerah'] }}</td>
                                    <td>{{ $row['warna'] }}</td>
                                    <td>{{ $row['musim_panen'] }}</td>
                                    <td>{{ $row['kualitas'] }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-layout>