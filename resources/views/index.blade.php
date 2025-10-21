<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Portal Mahasiswa</a>
  </div>
</nav>

<div class="container">
    <h1 class="mb-4">Halaman Mahasiswa</h1>
    <div class="row">
        <!-- Data Mahasiswa -->
        <div class="col-md-7">
            <h4>Data Mahasiswa</h4>
            <table id="tabelMahasiswa" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswas as $mhs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->nama }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Form Tambah -->
        <div class="col-md-5">
            <h4>Form Tambah Mahasiswa</h4>
            <form id="formMahasiswa">
                @csrf
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" id="nim" name="nim" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let counter = $("#tabelMahasiswa tbody tr").length;

    $('#formMahasiswa').on('submit', function(e) {
        e.preventDefault(); // Mencegah reload halaman

        $.ajax({
            url: "{{ route('mahasiswa.store') }}",
            type: "POST",
            data: {
                _token: $('input[name=_token]').val(),
                nim: $('#nim').val(),
                nama: $('#nama').val(),
            },
            success: function(response) {
                counter++;
                $('#tabelMahasiswa tbody').append(`
                    <tr>
                        <td>${counter}</td>
                        <td>${response.nim}</td>
                        <td>${response.nama}</td>
                    </tr>
                `);
                $('#formMahasiswa')[0].reset();
            },
            error: function(xhr) {
                alert('⚠️ Gagal menyimpan data. Pastikan NIM unik dan semua kolom diisi.');
            }
        });
    });
});
</script>
</body>
</html>
