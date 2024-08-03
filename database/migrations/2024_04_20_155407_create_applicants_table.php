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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scholarshipId')->constrained('scolarship');
            $table->foreignId('userId')->constrained('users');
            $table->string('name');
            $table->string('nric');
            $table->string('gender');
            $table->date('birthday');
            $table->string('email');
            $table->text('address');
            $table->string('contact');
            $table->string('course');
            $table->string('qualification');
            $table->string('file');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
