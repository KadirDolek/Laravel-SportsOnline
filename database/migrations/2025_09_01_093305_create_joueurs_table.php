<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('joueurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->integer('age');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('pays');
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->foreignId('equipe_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->foreignId('photo_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_reserve')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueurs');
    }
};
