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
        Schema::create('takhts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('otagh_id')->constrained('otaghs')->onDelete('cascade');
            $table->enum('state', ['empty', 'full', 'reserve'])->default('empty');
            $table->foreignId('resident_id')->nullable()->constrained('residents')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('takhts');
    }
};
