<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_cluster_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->restrictOnDelete();
            $table->foreignId('user_cluster_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('ml_model_run_id')->index()->constrained()->cascadeOnDelete();
            $table->decimal('distance_to_centroid', 12, 6)->nullable();
            $table->timestamp('assigned_at')->useCurrent();
            $table->unique(['user_id', 'ml_model_run_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_cluster_assignments');
    }
};
