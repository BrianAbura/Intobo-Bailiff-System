<?php

use App\Models\User;
use App\Models\Instruction;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(instruction::class);
            $table->integer('loan_balance');
            $table->integer('amount');
            $table->double('commission_based_olb');
            $table->double('fees_based_olb')->nullable();
            $table->string('payment_proof');
            $table->date('payment_date');
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
