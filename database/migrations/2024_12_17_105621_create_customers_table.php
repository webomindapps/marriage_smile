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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('name');
            $table->string('nationality');
            $table->string('religion');
            $table->string('qualification');
            $table->date('dob');
            $table->string('mother_tongue');
            $table->string('caste');
            $table->string('sub_caste');
            $table->string('gotra');
            $table->string('sun_star');
            $table->string('birth_star');
            $table->bigInteger('annual_income');
            $table->string('company_name');
            $table->string('experience');
            $table->bigInteger('phone');
            $table->string('email');
            $table->string('password');
            $table->string('conf_password');
            $table->string('aadhar_no');
            $table->string('hobbies');
            $table->string('facebook_profile');
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
            $table->string('permanent_locations');
            $table->string('house_status');
            $table->string('asset_value');
            $table->string('preferreday');
            $table->dateTime('timings')->nullable();
            $table->bigInteger('preferred_contact_no');
            $table->string('contact_related_to');
            $table->timestamp('email_verified_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
