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
        Schema::create('cadernos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perfil_id');

            $table->foreign('perfil_id')->references('id')->on('perfis');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cadernos');
    }
};
