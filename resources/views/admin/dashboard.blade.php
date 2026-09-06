@extends('layouts.admin')

@section('content')
    <div class="mx-auto max-w-7xl">
        <div class="mb-9 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="mb-3 text-sm font-semibold tracking-[0.16em] text-[#2563eb] uppercase">Overview</p>
                <h1 class="text-3xl font-semibold tracking-tight text-[#0f172a] sm:text-4xl">Selamat datang, {{ $user->name }}.</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-[#64748b]">Ini adalah pusat kendali editorial Anda. Semua yang dibutuhkan untuk menerbitkan cerita dimulai dari sini.</p>
            </div>
            <div class="flex items-center gap-2 text-xs text-[#64748b]"><span class="h-2 w-2 rounded-full bg-emerald-500"></span>Sistem siap digunakan</div>
        </div>

        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Ringkasan statistik">
            @foreach ($statistics as $statistic)
                <article class="rounded-2xl border border-[#e2e8f0] bg-white p-5 shadow-sm shadow-slate-200/50">
                    <div class="mb-6 flex items-start justify-between"><p class="text-sm font-medium text-[#64748b]">{{ $statistic['label'] }}</p><span class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-[#2563eb]">↗</span></div>
                    <p class="text-3xl font-semibold tracking-tight text-[#0f172a]">{{ $statistic['value'] }}</p>
                    <p class="mt-2 text-xs text-[#94a3b8]">{{ $statistic['detail'] }}</p>
                </article>
            @endforeach
        </section>

        <div class="mt-6 grid gap-6 xl:grid-cols-[1.3fr_0.7fr]">
            <section class="rounded-2xl border border-[#e2e8f0] bg-white p-6 shadow-sm shadow-slate-200/50 sm:p-7">
                <div class="flex items-start justify-between gap-4">
                    <div><p class="text-lg font-semibold text-[#0f172a]">Aktivitas terbaru</p><p class="mt-1 text-sm text-[#64748b]">Pantau denyut ruang redaksi Anda.</p></div><span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-500">Belum ada data</span>
                </div>
                <div class="mt-10 flex flex-col items-center justify-center rounded-2xl border border-dashed border-[#cbd5e1] px-6 py-12 text-center">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-[#2563eb]"><svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 19V9m7 10V5m7 14v-7" stroke-linecap="round"/></svg></div>
                    <p class="text-sm font-semibold text-[#0f172a]">Aktivitas akan tampil di sini</p>
                    <p class="mt-2 max-w-sm text-xs leading-5 text-[#64748b]">Mulai kelola berita dan podcast untuk melihat perkembangan aktivitas editorial Anda.</p>
                </div>
            </section>

            <section class="rounded-2xl bg-[#0f172a] p-6 text-white shadow-xl shadow-slate-300/30 sm:p-7">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/20 text-blue-300"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3v18m9-9H3" stroke-linecap="round"/></svg></div>
                <p class="mt-8 text-xl font-semibold">Bangun cerita berikutnya.</p>
                <p class="mt-3 text-sm leading-6 text-slate-300">Dashboard ini siap dikembangkan menjadi workflow editorial lengkap untuk tim Anda.</p>
                <div class="mt-8 flex items-center gap-2 text-xs font-medium text-blue-300"><span class="h-1.5 w-1.5 rounded-full bg-blue-400"></span>Newsroom foundation</div>
            </section>
        </div>

        <p class="mt-8 text-center text-xs text-[#94a3b8]">Masuk sebagai {{ $user->email }} · Dashboard admin Website Berita &amp; Podcast</p>
    </div>
@endsection
