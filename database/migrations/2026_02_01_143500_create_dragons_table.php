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
        Schema::create('dragons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('sex', ['male', 'female']);
            $table->date('dob');
            $table->string('morph');
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->enum('status', ['available', 'sold', 'reserved', 'breeding_stock'])->default('available');
            $table->boolean('is_hidden')->default(false);
            $table->foreignId('parent_male_id')->nullable()->constrained('dragons')->onDelete('set null');
            $table->foreignId('parent_female_id')->nullable()->constrained('dragons')->onDelete('set null');
            $table->string('clutch_id')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->date('date_listed')->nullable();
            $table->date('date_sold')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dragons');
    }
};
