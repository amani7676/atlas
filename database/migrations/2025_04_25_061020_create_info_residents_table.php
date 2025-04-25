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
        Schema::create('info_residents', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->boolean('vadeh')->default(0);
            $table->boolean('ejareh')->default(0);
            $table->boolean('madrak')->default(0);
            $table->boolean('has_phone')->default(0);
            $table->boolean('bedehy')->default(0);
            $table->boolean('form')->default(0);
            $table->date('hamahang')->nullable();
            $table->enum('state', ['active', 'reserve','leaving' ,'exit'])->default('active');
            $table->text('job')->nullable();
            $table->bigInteger('age')->nullable();
            $table->bigInteger('takhir')->nullable();
            $table->foreignId('resident_id')->constrained('residents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_residents');
    }
};
