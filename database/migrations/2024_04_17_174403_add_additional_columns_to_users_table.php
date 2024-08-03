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
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->text('bio')->nullable();
            $table->date('birthday')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['name', 'bio', 'birthday', 'country', 'phone', 'website', 'file']);
        });
    }
};
