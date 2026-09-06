<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ml_model_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ml_model_id')->index()->constrained()->restrictOnDelete();
            $table->string('run_identifier', 100)->unique();
            $table->unsignedInteger('k_value');
            $table->json('feature_schema')->nullable();
            $table->unsignedInteger('dataset_size');
            $table->json('metrics')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('status', 30)->default('running')->index();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ml_model_runs');
    }
};
