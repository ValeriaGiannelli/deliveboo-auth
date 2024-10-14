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
        Schema::table('projects', function (Blueprint $table) {
            // Creo la colonna per la foreign key
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            // Creo la FK sulla colonna creata
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                // Quando cancello un tipo, metterà null nella foreign key
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Rimuovo la foreign key prima di rimuovere la colonna
            $table->dropForeign(['type_id']);

            // Rimuovo la colonna 'type_id'
            $table->dropColumn('type_id');
        });
    }
};
