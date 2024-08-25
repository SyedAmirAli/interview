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
        Schema::create('general_information', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('image')->nullable();
            $table->string('passport')->nullable();
            $table->string('bank_name');
            $table->string('account_no');
            $table->string('ibn');
            $table->string('account_type');
            $table->string('nid');
            $table->string('country_name');
            $table->string('country_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_information');
    }
};
