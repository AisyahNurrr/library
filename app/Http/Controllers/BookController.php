<?php

namespace App\Http\Controllers;

use App\Models\Buku; // Pastikan nama model sudah benar
use App\Models\User; // Tambahkan import model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Impor Auth untuk otentikasi
use Illuminate\Support\Facades\Hash; // Impor Hash untuk mengenkripsi password
use Illuminate\Support\Facades\Log; // Tambahkan baris ini untuk mengimpor Log

class BookController extends Controller
{
    public function loadAllBooks() {
        $all_books = Buku::all(); // Mengambil semua buku
        return view('books', compact('all_books')); // Mengirim data buku ke tampilan
    }

    public function loadAddBookForm() {
        return view('add-book'); // Memuat formulir untuk menambahkan buku baru
    }

    public function addBook(Request $request) {
        // Validasi permintaan yang masuk
        $request->validate([
            'kode_buku' => 'required|string|max:255|unique:buku,kode_buku', // Pastikan kode_buku unik
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric|digits:4',
            'jumlah_buku' => 'required|integer|min:1',
        ]);
    
        try {
            // Buat instance Buku baru
            $new_book = new Buku;
            $new_book->kode_buku = $request->kode_buku; // Menetapkan kode_buku
            $new_book->judul_buku = $request->judul_buku;
            $new_book->penulis = $request->penulis;
            $new_book->tahun_terbit = $request->tahun_terbit;
            $new_book->jumlah_buku = $request->jumlah_buku;
            $new_book->save(); // Simpan buku ke database

            return redirect()->route('books')->with('success', 'Buku berhasil ditambahkan');
        } catch (\Exception $e) {
            // Menangkap dan mencatat kesalahan
            Log::error('Gagal menambahkan buku: ' . $e->getMessage());
            return redirect()->route('addBookForm')->with('fail', 'Gagal menambahkan buku: ' . $e->getMessage());
        }
    }

    public function loadEditForm($kode_buku) {
        $book = Buku::where('kode_buku', $kode_buku)->first(); // Mencari buku berdasarkan kode_buku
        if ($book) {
            return view('edit-book', compact('book')); // Mengirim buku ke tampilan edit
        } else {
            return redirect()->route('books')->with('fail', 'Buku tidak ditemukan');
        }
    }

    public function editBook(Request $request) {
        // Validasi permintaan yang masuk
        $request->validate([
            'kode_buku' => 'required|string|max:255', // kode_buku harus menjadi bagian dari pembaruan
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric|digits:4',
            'jumlah_buku' => 'required|integer|min:1',
        ]);
    
        try {
            // Pembaruan buku menggunakan kode_buku
            $book = Buku::where('kode_buku', $request->kode_buku)->first();
            if ($book) {
                $book->judul_buku = $request->judul_buku;
                $book->penulis = $request->penulis;
                $book->tahun_terbit = $request->tahun_terbit;
                $book->jumlah_buku = $request->jumlah_buku;
                $book->save(); // Simpan perubahan
                return redirect()->route('books')->with('success', 'Buku berhasil diperbarui');
            } else {
                return redirect()->route('books')->with('fail', 'Buku tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->route('editBookForm', ['kode_buku' => $request->kode_buku])->with('fail', 'Gagal memperbarui buku: ' . $e->getMessage());
        }
    }
    
    public function deleteBook($kode_buku) {
        try {
            $book = Buku::where('kode_buku', $kode_buku)->first(); // Mencari buku berdasarkan kode_buku
            if ($book) {
                $book->delete(); // Menghapus buku
                return redirect()->route('books')->with('success', 'Buku berhasil dihapus');
            } else {
                return redirect()->route('books')->with('fail', 'Buku tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->route('books')->with('fail', 'Gagal menghapus buku: ' . $e->getMessage());
        }
    }

    // Menampilkan formulir registrasi
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Menangani registrasi pengguna baru
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Menangani login pengguna
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('books')->with('success', 'Login berhasil.'); // Ganti dengan rute yang sesuai
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Menangani logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

    public function indexUser() {
        // Retrieve all books
        $all_books = Buku::all();
        
        // Return the view for user book list
        return view('user_index', compact('all_books'));
    }
    
    public function borrowBook($kode_buku) {
        // Fetch the book by kode_buku
        $book = Buku::where('kode_buku', $kode_buku)->first();
    
        // Check if there are books available
        if ($book->jumlah_buku > 0) {
            // Decrease the available books by 1
            $book->jumlah_buku -= 1;
            $book->save();
    
            // Return success message
            return redirect()->route('userBookIndex')->with('success', 'Buku berhasil dipinjam!');
        } else {
            return redirect()->route('userBookIndex')->with('fail', 'Stok buku habis.');
        }
    }
    
}
