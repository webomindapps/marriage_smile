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
        Schema::create('customer_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customers_id')->unsigned();
            $table->foreign('customers_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_images');
    }
};
