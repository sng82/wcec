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
        Schema::create('expression_of_interests', function (Blueprint $table) {
            $table->id();
            $table->longText('current_role')->nullable()->default(null);
            $table->longText('employment_history')->nullable()->default(null);
            $table->longText('qualifications')->nullable()->default(null);
            $table->longText('training')->nullable()->default(null);
            $table->dateTime('submitted_at')->nullable()->default(null);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::dropIfExists('applications');
        Schema::dropIfExists('expression_of_interests');
    }
};
