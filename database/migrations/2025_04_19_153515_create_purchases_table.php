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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('purchase_date');
            $table->string('purchase_number')->unique();
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->string('supplier_name')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->double('discount', 20, 3)->nullable();
            $table->double('discount_total', 20, 3)->nullable();
            $table->double('sub_total', 20, 3);
            $table->double('tax_amount', 15, 3)->nullable();
            $table->double('tax_percentage')->nullable();
            $table->double('total', 20, 3);
            $table->integer('status')->nullable();
            $table->text('notes')->nullable();
            $table->double('total_quantity')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('financial_year_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
