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
    Schema::table('tableaux', function (Blueprint $table) {
        // On ajoute une colonne pour le code secret (ex: "A12", "8888", "POMME")
        $table->string('secret_code')->default('0000'); 
    });
}

public function down(): void
{
    Schema::table('tableaux', function (Blueprint $table) {
        $table->dropColumn('secret_code');
    });
}
};
