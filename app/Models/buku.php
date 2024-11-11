<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Set the table name if it's not the plural form of the model name
    protected $table = 'buku'; // Replace 'bukus' with the correct table name

    // Define the fillable attributes to allow mass assignment
    protected $fillable = [
        'judul_buku',
        'penulis',
        'tahun_terbit',
        'jumlah_buku',
    ];
}
