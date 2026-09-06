<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->cascadeOnDelete();
            $table->string('event_type', 50)->index();
            $table->foreignId('article_id')->nullable()->index()->constrained()->nullOnDelete();
            $table->foreignId('episode_id')->nullable()->index()->constrained()->nullOnDelete();
            $table->foreignId('podcast_id')->nullable()->index()->constrained()->nullOnDelete();
            $table->json('metadata')->nullable();
            $table->timestamp('created_at')->useCurrent()->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_events');
    }
};
