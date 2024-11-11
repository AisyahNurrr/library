<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',       // User yang meminjam buku
        'book_id',       // Buku yang dipinjam
        'borrowed_at',   // Tanggal peminjaman
        'due_date',      // Batas waktu pengembalian
        'returned_at'    // Tanggal pengembalian (null jika belum dikembalikan)
    ];

    public function book()
    {
        return $this->belongsTo(Buku::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
