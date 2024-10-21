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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('is_promo')->nullable();
            $table->string('promo_name')->nullable();
            $table->string('promo_duration')->nullable(); //hour, day, week, month, year
            $table->string('promo_duration_value')->nullable(); //1, 2, 3, 4, 5
            $table->string('promo_code')->nullable();
            $table->string('status')->nullable();
            $table->string('discount')->nullable();
            $table->dateTime('cancellation_run_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
