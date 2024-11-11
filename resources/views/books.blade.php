<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to bottom right, #f0f4f8, #e1e8ed);
        }
        .card-header {
            background-color: #98d9e1;
            color: #fff;
        }
        .table th, .table td {
            border: 1px solid #d1d1d1;
        }
        .btn-primary {
            background-color: #ff6f61; /* Soft Coral Color */
        }
        .btn-warning {
            background-color: #f9c74f; /* Soft Yellow Color */
        }
        .btn-danger {
            background-color: #ff6f61; /* Soft Coral Color */
        }
        .btn-success {
            background-color: #90be6d; /* Soft Green Color */
        }
        .alert {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Daftar Buku Perpustakaan
                <a href="{{ route('addBookForm') }}" class="btn btn-primary float-end">Tambah Buku</a> 
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-auto">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg shadow-sm" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg shadow-sm me-2">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-success btn-lg shadow-sm">
                                    <i class="bi bi-person-plus"></i> Registrasi
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            @if (Session::has('success'))
                <div class="alert alert-success p-2">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('fail'))
                <div class="alert alert-danger p-2">{{ Session::get('fail') }}</div>
            @endif

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Tahun Terbit</th>
                            <th>Jumlah Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_books as $book)
                            <tr>
                                <td>{{ $book->kode_buku }}</td>
                                <td>{{ $book->judul_buku }}</td>
                                <td>{{ $book->penulis }}</td>
                                <td>{{ $book->tahun_terbit }}</td>
                                <td>{{ $book->jumlah_buku }}</td>
                                <td>
                                    <a href="{{ route('editBookForm', $book->kode_buku) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('deleteBook', $book->kode_buku) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
