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
        Schema::create('descriptions', function (Blueprint $table) {
            $table->id();
            $table->text('desc'); // فیلد توضیحات (متن طولانی)
            $table->unsignedBigInteger('resident_id'); // کلید خارجی
            
            // فیلد enum با مقادیر مجاز
            $table->enum('type', ['bedhey', 'sarrsed', 'khoroj', 'other'])->default('other');
            
            // تعریف کلید خارجی
            $table->foreign('resident_id')
                  ->references('id')
                  ->on('residents')
                  ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descriptions');
    }
};
