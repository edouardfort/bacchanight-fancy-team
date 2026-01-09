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
        Schema::create('questions', function (Blueprint $table) {
    $table->id();
    $table->string('text');
    $table->integer('position'); // De 1 à 16
    // Si NULL = Question Générale (1-11)
    // Si REMPLI = Question Personnalisée (12-16) liée à une équipe
    $table->foreignId('team_id')->nullable()->constrained();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
