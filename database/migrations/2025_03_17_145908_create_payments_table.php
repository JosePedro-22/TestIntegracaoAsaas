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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('asaas_id')->unique();
            $table->string('customer_id');
            $table->decimal('value', 10, 2);
            $table->date('due_date');
            $table->string('status');
            $table->string('billing_type');
            $table->string('description')->nullable();
            $table->string('invoice_url')->nullable();
            $table->string('barcode')->nullable();
            $table->text('pix_code')->nullable();
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
