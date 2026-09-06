<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_feature_vectors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->restrictOnDelete();
            $table->foreignId('ml_model_run_id')->index()->constrained()->cascadeOnDelete();
            $table->json('vector');
            $table->timestamp('created_at')->useCurrent();
            $table->unique(['user_id', 'ml_model_run_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_feature_vectors');
    }
};
