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
        Schema::create('cartitem', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cartId')->constrained('cart')->onDelete('cascade');
            $table->string('courseId');
            $table->string('courseName');
            $table->string('courseLevel');
            $table->string('coursePrice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartitem');
    }
};
