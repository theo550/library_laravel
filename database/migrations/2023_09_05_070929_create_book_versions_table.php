<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_versions', function (Blueprint $table) {
            $table->id();
            $table->date('published_date');
            $table->timestamps();
            $table->foreignId('book_id')->constrained();
            $table->foreignId('publisher_id')->constrained();
            $table->foreignId('edition_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_versions');
    }
};
