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
        Schema::create('demand_notices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(instruction::class);
            $table->string('notice_file');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demand_notices');
    }
};
