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
            $table->unsignedBigInteger('perfil_id');
            $table->unsignedBigInteger('post_ref_id');
            $table->unsignedBigInteger('folha_id');
            $table->string('corpo');

            $table->foreign('perfil_id')->references('id')->on('perfis');
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
