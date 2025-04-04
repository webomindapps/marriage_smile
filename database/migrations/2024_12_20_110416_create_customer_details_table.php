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
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customers_id')->unsigned();
            $table->foreign('customers_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->string('nationality');
            $table->string('religion');
            $table->string('gender');
            $table->string('height');
            $table->string('colour');
            $table->string('qualification');
            $table->date('dob');
            $table->bigInteger('age');
            $table->string('mother_tongue');
            $table->string('caste');
            $table->string('gotra');
            $table->string('sun_star')->nullable();
            $table->string('birth_star')->nullable();
            $table->string('annual_income');
            $table->string('company_name');
            $table->string('experience');
            $table->string('aadhar_no');
            $table->string('hobbies');
            $table->string('facebook_profile')->nullable();
            $table->string('image_path');
            $table->string('marritialstatus');
            $table->bigInteger('no_of_children')->nullable();
            $table->string('req_rel_manager');
            $table->string('expectations');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('father_occupation');
            $table->string('mother_occupation');
            $table->string('siblings');
            $table->string('locations');
            $table->string('present_house_status');
            $table->string('permanent_locations');
            $table->string('permanent_house_status');
            $table->string('asset_value');
            $table->string('preferreday');
            $table->dateTime('timings')->nullable();
            $table->bigInteger('preferred_contact_no');
            $table->string('contact_related_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_details');
    }
};
