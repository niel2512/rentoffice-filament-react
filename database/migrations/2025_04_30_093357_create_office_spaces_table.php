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
        Schema::create('office_spaces', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('thumbnail');
            $table->string('address');
            $table->string('slug')->unique();

            $table->boolean('is_open');
            $table->boolean('is_full_booked');

            $table->unsignedInteger('price'); //pake unsignedInteger untuk angka yang tidak bisa negatif
            $table->unsignedInteger('duration');

            $table->text('about');

            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_spaces');
    }
};
