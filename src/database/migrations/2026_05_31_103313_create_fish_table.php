<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fishes', function (Blueprint $table) {
            $table->id();

            // region / wilayah ikan
            $table->foreignId('region_id')
                ->constrained('regions')
                ->cascadeOnDelete();

            // user/admin yang input data ikan
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            // jenis diganti jadi nama ilmiah
            $table->string('scientific_name')->nullable();

            // gambar ikan / makhluk
            $table->string('image')->nullable();

            // detail ikan
            $table->text('description')->nullable();
            $table->text('characteristics')->nullable();
            $table->string('habitat')->nullable();
            $table->string('average_weight')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fishes');
    }
};
