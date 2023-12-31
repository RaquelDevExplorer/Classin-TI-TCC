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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfil_id')->constrained('perfis');

            $table->unsignedBigInteger('post_ref_id')->nullable();
            $table->unsignedBigInteger('folha_id')->nullable();

            $table->string('corpo');

            $table->string('image')->nullable();
            $table->string('file')->nullable();

            $table->foreign('post_ref_id')->references('id')->on('posts');
            $table->foreign('folha_id')->references('id')->on('folhas');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
