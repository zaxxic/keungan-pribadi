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
        Schema::create('recruing_xpenditures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('amount');
            $table->string('payment_method');
            $table->date('date');
            $table->text('deskripsi', 400);
            $table->string('recruing')->nullable();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('expenditure_id')
            ->constrained('expenditures');
            $table->foreignId('expenditure_category_id')
                ->constrained('expenditure_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruing_xpenditures');
    }
};
