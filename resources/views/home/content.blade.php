<header class="site-header">
    <div class="shell header-inner">
        <a class="logo" href="{{ route('home') }}"><span class="logo-dot"></span>Dengar</a>
        <nav class="main-nav" aria-label="Navigasi utama">
            <a href="#rangkuman">Rangkuman</a>
            <a href="#cara-kerja">Cara kerja</a>
            <a href="#tentang">Tentang proyek</a>
        </nav>
        <a class="admin-link" href="{{ route('admin.login') }}">Admin <span>↗</span></a>
    </div>
</header>

<main>
    <section class="hero shell">
        <div class="hero-copy">
            <p class="eyebrow">RANGKUMAN PODCAST · {{ $podcastCount }} PODCAST</p>
            <h1>Podcast panjang,<br><em>dirangkum</em> jadi bacaan singkat.</h1>
            <p class="hero-lede">Dengar menuliskan ulang episode pilihan menjadi rangkuman yang bisa dibaca dalam beberapa menit — lalu mengelompokkannya otomatis berdasarkan kemiripan topik.</p>
            <a class="primary-button" href="#rangkuman">Jelajahi rangkuman <span>↓</span></a>
        </div>
        <div class="hero-note">
            <div class="note-mark">✦</div>
            <p><strong>{{ $articles->count() }} rangkuman</strong> tersedia untuk dibaca.</p>
            <p><strong>K-Means</strong> membaca kemiripan kata melalui TF-IDF.</p>
            <p>Tidak ada kategori manual — mesin yang menemukan polanya.</p>
        </div>
    </section>

    <section class="lab shell" id="rangkuman">
        <div class="section-heading">
            <div>
                <p class="eyebrow">MESIN PEMBACA</p>
                <h2>Rangkuman & klaster topik</h2>
                <p class="muted">Buka satu rangkuman untuk menemukan bacaan lain yang memiliki pola kata serupa.</p>
            </div>
            <div class="model-badge"><span></span> K-MEANS · K={{ $clusterCount ?: 3 }}</div>
        </div>

        <div class="cluster-tabs" role="tablist" aria-label="Filter klaster">
            <button class="cluster-tab is-active" data-filter="all" role="tab">Semua rangkuman</button>
            @foreach ($clusters as $cluster)
                <button class="cluster-tab" data-filter="cluster-{{ $cluster->id }}" role="tab">{{ $cluster->name }}</button>
            @endforeach
        </div>

        <div class="article-grid" id="article-grid">
            @forelse ($articles as $article)
                @php($assignment = $article->contentClusterAssignments->first())
                @php($cluster = $assignment?->contentCluster)
                <article class="article-card" data-cluster="cluster-{{ $cluster?->id }}" tabindex="0">
                    <div class="card-topline">
                        <span class="cluster-label"><i></i>{{ $cluster?->name ?? 'Rangkuman' }}</span>
                        <span class="card-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <h3>{{ $article->title }}</h3>
                    <p>{{ $article->excerpt }}</p>
                    <div class="card-footer">
                        <span>{{ $article->episode?->podcast?->title ?? 'Podcast' }}</span>
                        <span>{{ $article->published_at?->translatedFormat('d M Y') }}</span>
                    </div>
                    <div class="article-detail">
                        <p>{{ $article->content }}</p>
                        <a href="#cara-kerja">Lihat cara pengelompokan →</a>
                    </div>
                </article>
            @empty
                <div class="empty-state">Belum ada rangkuman yang dipublikasikan.</div>
            @endforelse
        </div>
    </section>

    <section class="how-it-works" id="cara-kerja">
        <div class="shell how-grid">
            <div>
                <p class="eyebrow eyebrow-light">DI BALIK LAYAR</p>
                <h2>Bagaimana klaster ini terbentuk</h2>
                <p class="how-lede">Sistem membaca teks setiap rangkuman dan mengelompokkannya sendiri. Sederhana bagi pembaca, bermakna di balik layar.</p>
            </div>
            <div class="steps">
                <div class="step"><b>01</b><div><h3>Ekstraksi teks</h3><p>Judul dan isi diubah menjadi vektor angka dengan bobot TF-IDF.</p></div></div>
                <div class="step"><b>02</b><div><h3>Menentukan kelompok</h3><p>K-Means mencari pusat kelompok berdasarkan kemiripan vektor.</p></div></div>
                <div class="step"><b>03</b><div><h3>Rekomendasi otomatis</h3><p>Rangkuman dengan klaster yang sama tampil sebagai bacaan terkait.</p></div></div>
            </div>
        </div>
    </section>

    <section class="project-note shell" id="tentang">
        <p class="quote">“Konten disusun dengan metode Amati · Tiru · Modifikasi, lalu diperkaya dengan machine learning agar pembaca tidak berhenti pada satu cerita.”</p>
        <p class="quote-by">CATATAN PROYEK · DIBANGUN UNTUK MEMBUAT PODCAST LEBIH MUDAH DICERNA</p>
    </section>
</main>

<footer class="shell site-footer">
    <span>Dengar<span class="footer-dot">.</span></span>
    <span>Rangkuman podcast berbasis K-Means clustering</span>
</footer>
