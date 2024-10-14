<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            //creo la colonna per la foregin key
            $table->unsignedBigInteger('user_id')->nullable()->after('id');

            //Creo la FK sulla colonna creata
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                //quando cancello una categoria metterà null nella foregin key
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign(['user_id']);


            $table->dropColumn('user_id');
        });
    }
};
