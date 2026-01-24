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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('spot_id')->constrained('spots')->cascadeOnDelete();
            $table->foreignId('subscription_id')->nullable()->constrained('subscriptions')->nullOnDelete();

            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status', ['active','completed','cancelled'])->default('active');

            $table->enum('unit', ['hours','days'])->default('hours');
            $table->integer('unit_value')->default(1);

            $table->timestamps();

            $table->index(['spot_id','status']);
            $table->index(['parking_id','status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
