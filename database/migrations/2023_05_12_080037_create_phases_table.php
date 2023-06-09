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
        Schema::create('phases', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('name');
            $table->longText('description');
            $table->string('budget_percentage');
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date');

            // Relationships
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phases');
    }
};
