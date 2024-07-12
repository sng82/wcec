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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
//            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_main')->nullable()->default(null);
            $table->string('phone_mobile')->nullable()->default(null);
            $table->boolean('registration_fee_paid')->default(false);
            $table->string('eoi_status')->nullable()->default(null);
//            $table->timestamp('eoi_submitted_at')->nullable()->default(null);
//            $table->timestamp('submission_submitted_at')->nullable()->default(null);
            $table->integer('submission_count')->default(0);
            $table->boolean('submission_fee_paid')->default(false);
            $table->string('submission_status')->nullable()->default(null);
            $table->timestamp('submission_accepted_at')->nullable()->default(null);
            $table->unsignedBigInteger('submission_accepted_by')->nullable()->default(null);
            $table->timestamp('became_registrant_at')->nullable()->default(null);
            $table->timestamp('registration_expires_at')->nullable()->default(null);
            $table->string('registration_pathway')->default('standard');
            $table->timestamp('declined_at')->nullable()->default(null);
            $table->unsignedBigInteger('declined_by')->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
