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
        Schema::create('restourant_type_user', function (Blueprint $table) {

            // colonna FK
            $table->unsignedBigInteger('restourant_type_id');

            //valore FK
            $table->foreign('restourant_type_id')
                ->references('id')
                ->on('restourant_types')
                ->cascadeOnDelete();

            // colonna FK
            $table->unsignedBigInteger('user_id');

            //valore FK
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restourant_type_user');
    }
};
