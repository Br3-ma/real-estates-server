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
        Schema::table('plans', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('duration')->nullable();
            $table->string('duration_type')->nullable(); //week. months. etc
            $table->float('amount', 9, 2)->nullable();
            $table->float('discount', 9, 2)->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alt_plans');
    }
};
