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
        Schema::create('menu_item_order', function (Blueprint $table) {

            // COLONNA PER MENU ITEM FK
            $table->unsignedBigInteger('menu_item_id');  //creo la colonna in relazione con post

            // assegno FK
            $table->foreign('menu_item_id')
                ->references('id')
                ->on('menu_items')
                ->cascadeOnDelete();    //se il tag viene eliminato elimina la connessione con l'elemento


            // COLONNA PER ORDER FK
            $table->unsignedBigInteger('order_id');  //creo la colonna in relazione con tag

            // assegno FK
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->cascadeOnDelete();    //se il tag viene eliminato elimina la connessione con l'elemento
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_order');
    }
};
