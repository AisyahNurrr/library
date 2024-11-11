<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        // Ambil semua peminjaman buku yang dilakukan oleh user yang sedang login
        $borrowings = Borrowing::with('book', 'user')->where('user_id', Auth::id())->get();
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        // Ambil buku yang tersedia untuk dipinjam
        $books = Buku::where('jumlah_buku', '>', 0)->get(); 
        return view('borrowings.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:buku,id', // Pastikan nama tabel 'buku' sesuai
            'due_date' => 'required|date|after:today',
        ]);

        // Buat peminjaman baru
        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'borrowed_at' => now(),
            'due_date' => $request->due_date,
        ]);

        // Kurangi jumlah buku
        $book = Buku::find($request->book_id);
        $book->jumlah_buku -= 1;
        $book->save();

        return redirect()->route('borrowings.index')->with('success', 'Buku berhasil dipinjam!');
    }

    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->returned_at = now();
        $borrowing->save();

        // Tambahkan kembali jumlah buku
        $book = Buku::find($borrowing->book_id);
        $book->jumlah_buku += 1;
        $book->save();

        return redirect()->route('borrowings.index')->with('success', 'Buku berhasil dikembalikan!');
    }
}
