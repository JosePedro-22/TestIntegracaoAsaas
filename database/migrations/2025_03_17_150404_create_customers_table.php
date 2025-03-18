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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('asaas_id')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('cpf_cnpj');
            $table->string('phone');
            $table->string('mobile_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('address_number')->nullable();
            $table->string('complement')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('external_reference')->nullable();
            $table->boolean('notification_disabled')->default(false);
            $table->string('additional_emails')->nullable();
            $table->string('municipal_inscription')->nullable();
            $table->string('state_inscription')->nullable();
            $table->string('observations')->nullable();
            $table->string('group_name')->nullable();
            $table->string('company')->nullable();
            $table->boolean('foreign_customer')->default(false);
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
