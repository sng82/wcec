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
            $table->string('phone_1')->nullable()->default(null);
            $table->string('phone_2')->nullable()->default(null);
            $table->string('phone_3')->nullable()->default(null);
            $table->timestamp('submitted_at')->nullable()->default(null);
            $table->integer('submission_count')->default(0);
            $table->timestamp('accepted_at')->nullable()->default(null);
            $table->unsignedBigInteger('accepted_by')->nullable()->default(null);
            $table->timestamp('became_member_at')->nullable()->default(null);
            $table->timestamp('membership_expires_at')->nullable()->default(null);
            $table->timestamp('declined_at')->nullable()->default(null);
            $table->unsignedBigInteger('declined_by')->nullable()->default(null);
            $table->boolean('eoi_fee_paid')->default(false);
            $table->boolean('submission_fee_paid')->default(false);
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
