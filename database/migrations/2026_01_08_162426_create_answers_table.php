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
       Schema::create('answers', function (Blueprint $table) {
    $table->id();
    $table->foreignId('question_id')->constrained();
    $table->string('text');
    
    // Pour les Q 1 à 11 : La réponse donne un point à une équipe
    $table->foreignId('team_id')->nullable()->constrained();
    
    // Pour la Q 16 : La réponse détermine le tableau final
    $table->foreignId('tableau_id')->nullable()->constrained('tableaux');
    
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
