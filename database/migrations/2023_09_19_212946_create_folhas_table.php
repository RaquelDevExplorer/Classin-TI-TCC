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
        Schema::create('folhas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('caderno_id');
            $table->string('caminho')->nullable();
            $table->string('image')->default('folha-default.jpg');

            $table->foreign('caderno_id')->references('id')->on('cadernos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folhas');
    }
};
