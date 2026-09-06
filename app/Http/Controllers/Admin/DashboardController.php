<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'user' => auth()->user(),
            'statistics' => [
                ['label' => 'Total Berita', 'value' => 0, 'detail' => 'Siap diisi'],
                ['label' => 'Total Podcast', 'value' => 0, 'detail' => 'Siap diisi'],
                ['label' => 'Draft', 'value' => 0, 'detail' => 'Perlu ditinjau'],
                ['label' => 'Pengguna Aktif', 'value' => 0, 'detail' => 'Dalam sistem'],
            ],
        ]);
    }
}
