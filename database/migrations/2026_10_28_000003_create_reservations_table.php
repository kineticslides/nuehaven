<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 30);
            $table->text('special_requests')->nullable();
            $table->date('check_in');
            $table->date('check_out');
            $table->unsignedTinyInteger('guests');
            $table->boolean('parking')->default(false);
            $table->boolean('welcome_set')->default(false);
            $table->string('payment_plan', 20);
            $table->unsignedInteger('total_amount');
            $table->unsignedInteger('amount_due');
            $table->string('payment_method', 20)->default('gcash');
            $table->string('proof_path');
            $table->string('status', 30)->default('pending_verification');
            $table->timestamp('terms_accepted_at');
            $table->timestamps();

            $table->index(['check_in', 'check_out', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
