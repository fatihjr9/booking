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
            $table->string('name');
            $table->string('email');
            $table->string('country');
            $table->string('phone');
            $table->string('person');
            $table->date('book_date');
            $table->string('book_time');
            $table->text('menu');
            $table->string('amount');
            $table->string('payment');
            $table->enum('status', ['Paid','Unpaid'])->default('Unpaid');
            $table->string('affiliate')->nullable();
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
