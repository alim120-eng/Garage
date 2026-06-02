<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    
  public function up(): void {
    Schema::create('repair_orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 👈 تأكد من وجود هذا السطر بالظبط
        $table->string('type');
        $table->string('brand');
        $table->string('model');
        $table->integer('year');
        $table->text('issue');
        $table->string('image')->nullable();
        $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
        $table->decimal('cost', 10, 2)->nullable();
        $table->string('duration')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_orders');
    }
};
