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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('brand_model')->nullable();
            $table->string('serial_number')->nullable();
            $table->text('description')->nullable();
            $table->string('id_tag')->unique(); // Format: GBIL-ICT-XXXXXX
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('assigned_to')->nullable();
            $table->string('department_location')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('return_date')->nullable();
            $table->string('vendor_supplier')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('invoice_po_no')->nullable();
            $table->decimal('unit_price', 15, 2)->nullable();
            $table->date('warranty_expiry')->nullable();
            $table->string('condition')->default('Good'); // New, Good, Fair, Needs Repair, Defective, Disposed
            $table->string('status')->default('In Stock'); // In Use, In Stock, Under Repair, Returned, Lost, Disposed, Reserved
            $table->text('remarks')->nullable();
            $table->integer('total_qty')->default(1);
            $table->integer('in_use_qty')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
