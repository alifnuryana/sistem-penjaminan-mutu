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
        Schema::create('decrees', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->string('file_path');
            $table->unsignedBigInteger('size');
            $table->enum('type', ['SK Akreditasi', 'SK Pendirian']);
            $table->uuidMorphs('decreeable');
            $table->date('validity_date')->nullable();
            $table->date('release_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decrees');
    }
};
