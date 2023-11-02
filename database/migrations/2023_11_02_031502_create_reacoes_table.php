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
        Schema::create('reacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_id')->constrained('perfis')->nullable();

            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('comentario_id')->nullable();

            $table->string('target_type');

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('comentario_id')->references('id')->on('comentarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reacoes');
    }
};
