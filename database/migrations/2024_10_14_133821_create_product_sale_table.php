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
        Schema::create('product_sale', function (Blueprint $table) {
            // Definizione delle colonne per le chiavi esterne
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sale_id');
            //Record table
            $table->string('product_name', 255);
            $table->unsignedSmallInteger('amount');
            $table->decimal('price', 6, 2);

            // Definizione delle foreign key con cancellazione in cascata
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnDelete();

            $table->foreign('sale_id')
                ->references('id')
                ->on('sales')
                ->cascadeOnDelete();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sale');
    }
};
