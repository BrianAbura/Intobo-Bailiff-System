<?php

use App\Models\User;
use App\Models\Bank;
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
        Schema::create('instructions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bank::class);
            $table->string('branch');
            $table->enum('security_status', ['Secured', 'Non-Secured']);
            $table->string('debtor_name');
            $table->string('debtor_acc_no');
            $table->string('debtor_tell');
            $table->string('debtor_address');
            $table->string('loan_amount');
            $table->string('loan_status');
            $table->string('guarantor_name');
            $table->string('guarantor_tell');
            $table->date('instruction_date');
            $table->string('responsible_officer');
            $table->string('loan_security_file')->nullable();
            $table->string('instruction_file');
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructions');
    }
};
