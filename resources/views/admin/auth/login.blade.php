@extends('layouts.admin-auth')

@section('content')
    <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-5 py-10 sm:px-8">
        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-blue-100/70 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 -right-20 h-96 w-96 rounded-full bg-indigo-100/70 blur-3xl"></div>

        <div class="relative grid w-full max-w-5xl overflow-hidden rounded-[2rem] border border-[#e2e8f0] bg-white shadow-[0_24px_80px_rgba(15,23,42,0.12)] lg:grid-cols-[1.05fr_0.95fr]">
            <section class="relative hidden min-h-[620px] overflow-hidden bg-[#0f172a] p-10 text-white lg:flex lg:flex-col lg:justify-between xl:p-14">
                <div class="absolute -right-20 top-16 h-72 w-72 rounded-full border border-blue-300/20"></div>
                <div class="absolute -right-8 top-28 h-56 w-56 rounded-full border border-blue-300/20"></div>
                <div class="absolute bottom-10 left-10 h-32 w-32 rounded-full bg-blue-500/20 blur-2xl"></div>

                <div class="relative">
                    <div class="mb-12 flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#2563eb] shadow-lg shadow-blue-500/30">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M4 19V5m0 14h16M8 15V9m4 6V6m4 9v-4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold tracking-[0.2em] text-blue-300 uppercase">Newsroom</p>
                            <p class="text-xs text-slate-400">Admin workspace</p>
                        </div>
                    </div>

                    <p class="mb-5 max-w-sm text-sm font-medium tracking-[0.18em] text-blue-300 uppercase">Editorial control center</p>
                    <h1 class="max-w-lg text-4xl font-semibold leading-tight tracking-tight xl:text-5xl">Cerita yang baik dimulai dari ruang redaksi yang terorganisir.</h1>
                    <p class="mt-6 max-w-md text-base leading-7 text-slate-300">Kelola berita, podcast, dan insight audiens dari satu ruang kerja yang tenang dan terarah.</p>
                </div>

                <div class="relative rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <span class="text-xs font-medium text-slate-300">Live editorial signal</span>
                        <span class="flex items-center gap-2 text-xs text-emerald-300"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>Operational</span>
                    </div>
                    <div class="flex h-12 items-end gap-1.5" aria-hidden="true">
                        @foreach ([18, 31, 24, 42, 28, 52, 35, 25, 46, 34, 58, 39, 28, 44, 22, 36, 50, 30, 42, 25, 48, 34, 56, 29] as $height)
                            <span class="flex-1 rounded-full bg-blue-400/80" style="height: {{ $height }}%"></span>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="flex min-h-[620px] items-center justify-center p-7 sm:p-12 lg:p-14">
                <div class="w-full max-w-sm">
                    <div class="mb-10 lg:hidden">
                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#2563eb] text-white">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 19V5m0 14h16M8 15V9m4 6V6m4 9v-4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <div><p class="text-sm font-bold tracking-[0.15em] uppercase">Newsroom</p><p class="text-xs text-slate-500">Admin workspace</p></div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <p class="mb-3 text-sm font-semibold tracking-[0.16em] text-[#2563eb] uppercase">Panel administrasi</p>
                        <h2 class="text-3xl font-semibold tracking-tight text-[#0f172a]">Selamat Datang Kembali</h2>
                        <p class="mt-3 text-sm leading-6 text-[#64748b]">Masuk ke panel administrasi untuk mengelola konten berita dan podcast.</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                            <p class="font-semibold">Tidak dapat masuk</p>
                            <ul class="mt-1 list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5" id="login-form">
                        @csrf
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-[#0f172a]">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="admin@example.com" autocomplete="email" required autofocus class="block w-full rounded-xl border border-[#e2e8f0] bg-white px-4 py-3 text-sm text-[#0f172a] outline-none transition placeholder:text-slate-400 focus:border-[#2563eb] focus:ring-4 focus:ring-blue-100 @error('email') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror">
                        </div>

                        <div>
                            <div class="mb-2 flex items-center justify-between">
                                <label for="password" class="block text-sm font-medium text-[#0f172a]">Password</label>
                            </div>
                            <div class="relative">
                                <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-xl border border-[#e2e8f0] bg-white px-4 py-3 pr-14 text-sm text-[#0f172a] outline-none transition placeholder:text-slate-400 focus:border-[#2563eb] focus:ring-4 focus:ring-blue-100">
                                <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-slate-400 transition hover:text-[#2563eb] focus:text-[#2563eb] focus:outline-none" aria-label="Tampilkan password">
                                    <svg id="eye-icon" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/><circle cx="12" cy="12" r="2.5"/></svg>
                                </button>
                            </div>
                        </div>

                        <label class="flex items-center gap-3 text-sm text-[#64748b]">
                            <input name="remember" type="checkbox" value="1" @checked(old('remember')) class="h-4 w-4 rounded border-slate-300 text-[#2563eb] focus:ring-2 focus:ring-blue-200">
                            <span>Ingat saya</span>
                        </label>

                        <button type="submit" id="login-submit" class="flex w-full items-center justify-center rounded-xl bg-[#2563eb] px-4 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200 disabled:cursor-not-allowed disabled:opacity-70">
                            <span id="login-submit-label">Masuk</span>
                        </button>
                    </form>

                    <p class="mt-8 text-center text-xs leading-5 text-slate-400">Akses ini khusus untuk administrator aplikasi. Jaga kerahasiaan kredensial Anda.</p>
                </div>
            </section>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('login-form');
            const submit = document.getElementById('login-submit');
            const label = document.getElementById('login-submit-label');
            const password = document.getElementById('password');
            const toggle = document.getElementById('toggle-password');

            form?.addEventListener('submit', () => {
                submit.disabled = true;
                label.textContent = 'Memproses...';
            });

            toggle?.addEventListener('click', () => {
                const visible = password.type === 'text';
                password.type = visible ? 'password' : 'text';
                toggle.setAttribute('aria-label', visible ? 'Tampilkan password' : 'Sembunyikan password');
            });
        });
    </script>
@endsection
