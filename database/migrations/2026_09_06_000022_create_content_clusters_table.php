<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_clusters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ml_model_run_id')->index()->constrained()->cascadeOnDelete();
            $table->unsignedInteger('cluster_index');
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('centroid');
            $table->timestamps();
            $table->unique(['ml_model_run_id', 'cluster_index']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_clusters');
    }
};
