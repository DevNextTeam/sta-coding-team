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
        Schema::create('password_reset_codes', function (Blueprint $table) {

            $table->id();

            $table->string('email')->index();

            /*
             * Store the hashed verification code.
             * We never store the actual 6-digit code.
             */
            $table->string('code');

            /*
             * The code becomes invalid after this time.
             */
            $table->timestamp('expires_at');

            /*
             * Prevents the same code from being used twice.
             */
            $table->timestamp('used_at')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_codes');
    }
};
