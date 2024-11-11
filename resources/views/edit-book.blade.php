<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to bottom right, #f0f4f8, #e1e8ed);
        }
        .card-header {
            background-color: #98d9e1; /* Soft Mint Color */
            color: #fff;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        .alert {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #ff6f61; /* Soft Coral Color */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header"> Edit Buku </div>

            @if (Session::has('fail'))
                <div class="alert alert-danger p-2">{{ Session::get('fail') }}</div>
            @endif

            <div class="card-body">
                <form action="{{ route('EditBook') }}" method="post">
                    @csrf
                    <input type="hidden" name="kode_buku" value="{{ $book->kode_buku }}">

                    <div class="mb-3">
                        <label for="judul_buku" class="form-label">Judul Buku</label>
                        <input type="text" name="judul_buku" value="{{ old('judul_buku', $book->judul_buku) }}" class="form-control" id="judul_buku" placeholder="Tambahkan judul buku" required>
                        @error('judul_buku')
                           <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" name="penulis" value="{{ old('penulis', $book->penulis) }}" class="form-control" id="penulis" placeholder="Tambahkan nama penulis" required>
                        @error('penulis')
                           <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" class="form-control" id="tahun_terbit" placeholder="Tambahkan tahun terbit" min="1000" max="9999" required>
                        @error('tahun_terbit')
                           <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                        <input type="number" name="jumlah_buku" value="{{ old('jumlah_buku', $book->jumlah_buku) }}" class="form-control" id="jumlah_buku" placeholder="Tambahkan jumlah buku" min="1" required>
                        @error('jumlah_buku')
                           <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-KsvBU9z8uYPQUFjdbK1ab9B2nElASvCxtvOiLgrH5m4f3F4pXU0Yd1j8k4xK1Qz6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-bTBQ59BZtP/4BT8G3QRiTA2EF2HmcqQiXy3oR0bWeD+UG9/jELo3DYoD+09mRmN2" crossorigin="anonymous"></script>
</body>
</html>
