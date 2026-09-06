<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_feature_vectors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('ml_model_run_id')->index()->constrained()->cascadeOnDelete();
            $table->json('vector');
            $table->timestamp('created_at')->useCurrent();
            $table->unique(['article_id', 'ml_model_run_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_feature_vectors');
    }
};
