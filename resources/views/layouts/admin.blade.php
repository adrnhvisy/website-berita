<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'Dashboard' }} · Newsroom Admin</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-[#f8fafc] font-sans text-[#0f172a] antialiased">
        <div class="flex min-h-screen">
            <aside class="hidden w-72 shrink-0 flex-col border-r border-[#1e293b] bg-[#0f172a] text-white lg:flex">
                <div class="flex h-24 items-center gap-3 border-b border-white/10 px-8">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#2563eb] shadow-lg shadow-blue-500/20">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 19V5m0 14h16M8 15V9m4 6V6m4 9v-4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div><p class="text-sm font-bold tracking-[0.18em] uppercase">Newsroom</p><p class="text-xs text-slate-400">Admin workspace</p></div>
                </div>

                <nav class="flex-1 space-y-8 px-4 py-8" aria-label="Navigasi utama">
                    <div>
                        <p class="mb-3 px-4 text-[11px] font-semibold tracking-[0.18em] text-slate-500 uppercase">Workspace</p>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-900/20" aria-current="page">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 13h6V4H4v9Zm0 7h6v-4H4v4Zm10 0h6v-9h-6v9Zm0-16v4h6V4h-6Z" stroke-linejoin="round"/></svg>
                            Dashboard
                        </a>
                    </div>
                    <div>
                        <p class="mb-3 px-4 text-[11px] font-semibold tracking-[0.18em] text-slate-500 uppercase">Konten</p>
                        <div class="space-y-1 text-sm text-slate-400">
                            <span class="flex cursor-not-allowed items-center justify-between rounded-xl px-4 py-3" title="Segera hadir"><span class="flex items-center gap-3"><span class="text-lg">▤</span>Berita</span><span class="text-[10px] uppercase">Soon</span></span>
                            <span class="flex cursor-not-allowed items-center justify-between rounded-xl px-4 py-3" title="Segera hadir"><span class="flex items-center gap-3"><span class="text-lg">◉</span>Podcast</span><span class="text-[10px] uppercase">Soon</span></span>
                            <span class="flex cursor-not-allowed items-center justify-between rounded-xl px-4 py-3" title="Segera hadir"><span class="flex items-center gap-3"><span class="text-lg">#</span>Kategori</span><span class="text-[10px] uppercase">Soon</span></span>
                            <span class="flex cursor-not-allowed items-center justify-between rounded-xl px-4 py-3" title="Segera hadir"><span class="flex items-center gap-3"><span class="text-lg">⌁</span>Tag</span><span class="text-[10px] uppercase">Soon</span></span>
                        </div>
                    </div>
                </nav>

                <div class="border-t border-white/10 p-5">
                    <div class="flex items-center gap-3 rounded-2xl bg-white/5 p-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-500/20 text-sm font-bold text-blue-300">{{ str($user->name)->substr(0, 1)->upper() }}</div>
                        <div class="min-w-0"><p class="truncate text-sm font-semibold">{{ $user->name }}</p><p class="truncate text-xs text-slate-400">{{ $user->email }}</p></div>
                    </div>
                </div>
            </aside>

            <div class="flex min-w-0 flex-1 flex-col">
                <header class="flex min-h-24 items-center justify-between border-b border-[#e2e8f0] bg-white px-5 sm:px-8 lg:px-10">
                    <div>
                        <p class="text-xs font-semibold tracking-[0.16em] text-[#2563eb] uppercase">Admin workspace</p>
                        <p class="mt-1 text-sm text-[#64748b]">Kelola ruang redaksi Anda dengan lebih terarah.</p>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 rounded-xl border border-[#e2e8f0] px-3.5 py-2.5 text-sm font-medium text-[#475569] transition hover:border-red-200 hover:bg-red-50 hover:text-red-600 focus:outline-none focus:ring-4 focus:ring-red-100">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M10 17l5-5-5-5m5 5H3m8-9h6a2 2 0 0 1 2 2v2m0 10v2a2 2 0 0 1-2 2h-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span class="hidden sm:inline">Keluar</span>
                        </button>
                    </form>
                </header>

                @if (session('status'))
                    <div class="mx-5 mt-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 sm:mx-8 lg:mx-10" role="status">{{ session('status') }}</div>
                @endif

                <main class="flex-1 px-5 py-8 sm:px-8 lg:px-10">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
