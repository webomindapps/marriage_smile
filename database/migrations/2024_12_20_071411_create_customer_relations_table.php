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
        Schema::create('customer_relations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customers_id')->unsigned(); 
            $table->foreign('customers_id') 
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->string('child_gender')->nullable();
            $table->string('child_age')->nullable();
            $table->string('sibling_maritial_status')->nullable();
            $table->string('sibling_age_relation')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_relations');
    }
};
