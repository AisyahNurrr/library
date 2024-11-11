<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingsTable extends Migration
{
    public function up()
{
    Schema::create('borrowings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('book_id')->constrained('books', 'id')->onDelete('cascade'); // Pastikan ini benar
        $table->timestamp('borrowed_at')->nullable();
        $table->timestamp('due_date')->nullable();
        $table->timestamp('returned_at')->nullable();
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
}
