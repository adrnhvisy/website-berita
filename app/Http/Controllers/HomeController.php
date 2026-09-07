<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\MlModelRun;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $run = Schema::hasTable('ml_model_runs')
            ? MlModelRun::query()
                ->where('status', 'completed')
                ->latest('completed_at')
                ->first()
            : null;

        $articles = Schema::hasTable('articles')
            ? Article::query()
                ->with([
                    'episode.podcast',
                    'contentClusterAssignments' => fn ($query) => $query
                        ->when($run, fn ($query) => $query->where('ml_model_run_id', $run->id))
                        ->with('contentCluster'),
                ])
                ->where('status', 'published')
                ->latest('published_at')
                ->get()
            : collect();

        $clusters = $run?->contentClusters()->orderBy('cluster_index')->get() ?? collect();

        return view('welcome', [
            'articles' => $articles,
            'clusters' => $clusters,
            'clusterCount' => $clusters->count(),
            'podcastCount' => $articles->pluck('episode.podcast_id')->filter()->unique()->count(),
        ]);
    }
}
