<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ContentCluster;
use App\Models\ContentClusterAssignment;
use App\Models\Episode;
use App\Models\MlModel;
use App\Models\MlModelRun;
use App\Models\Podcast;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PodcastHomepageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function (): void {
            $model = MlModel::updateOrCreate(
                ['name' => 'K-Means Content Clustering'],
                [
                    'model_type' => 'k-means',
                    'description' => 'Pengelompokan rangkuman berdasarkan kemiripan kata TF-IDF.',
                    'version' => '1.0.0',
                    'is_active' => true,
                ],
            );

            $run = MlModelRun::updateOrCreate(
                ['run_identifier' => 'homepage-demo-k3'],
                [
                    'ml_model_id' => $model->id,
                    'k_value' => 3,
                    'feature_schema' => ['method' => 'tf-idf', 'language' => 'id'],
                    'dataset_size' => 9,
                    'metrics' => ['inertia' => 0.42, 'source' => 'seed'],
                    'started_at' => now()->subMinute(),
                    'completed_at' => now(),
                    'status' => 'completed',
                ],
            );

            $podcast = Podcast::updateOrCreate(
                ['slug' => 'dengar-catatan-sehari-hari'],
                [
                    'title' => 'Dengar',
                    'description' => 'Rangkuman podcast pilihan untuk dibaca dalam beberapa menit.',
                    'host_name' => 'Tim Dengar',
                    'status' => 'active',
                ],
            );

            $articles = [
                ['title' => 'Menabung Bukan Cuma Sisa Gaji', 'slug' => 'menabung-bukan-cuma-sisa-gaji', 'excerpt' => 'Kebiasaan menabung sering gagal karena baru dilakukan di akhir bulan, bukan di awal.', 'cluster' => 0, 'body' => 'Kebiasaan menabung, gaji, investasi, anggaran, dana darurat, pengeluaran bulanan, target keuangan, dan tabungan otomatis.'],
                ['title' => 'Belajar Saham Tanpa Panik', 'slug' => 'belajar-saham-tanpa-panik', 'excerpt' => 'Langkah kecil sebelum mulai investasi di pasar saham bagi pemula yang masih ragu.', 'cluster' => 0, 'body' => 'Investasi saham pemula, risiko, portofolio, reksadana, pasar modal, keuangan pribadi, dana pensiun, dan modal usaha.'],
                ['title' => 'Merancang Anggaran yang Realistis', 'slug' => 'merancang-anggaran-yang-realistis', 'excerpt' => 'Tips menyusun anggaran bulanan yang benar-benar bisa diikuti, bukan cuma rencana di kertas.', 'cluster' => 0, 'body' => 'Anggaran bulanan, keuangan pribadi, pengeluaran, gaji, tabungan, dana darurat, dan target keuangan.'],
                ['title' => 'Sampah Rumah Tangga, Siapa yang Peduli', 'slug' => 'sampah-rumah-tangga-siapa-yang-peduli', 'excerpt' => 'Gerakan warga memilah sampah plastik di lingkungan padat penduduk kota besar.', 'cluster' => 1, 'body' => 'Lingkungan, sampah plastik, daur ulang, komunitas warga, kebersihan sungai, polusi kota, dan gerakan hijau.'],
                ['title' => 'Hutan Kota yang Menyusut', 'slug' => 'hutan-kota-yang-menyusut', 'excerpt' => 'Penyusutan ruang hijau di kota-kota besar dan upaya warga menanam ulang.', 'cluster' => 1, 'body' => 'Lingkungan, hutan kota, ruang hijau, penanaman pohon, udara bersih, polusi udara, komunitas peduli alam.'],
                ['title' => 'Donasi Kecil, Dampak Besar', 'slug' => 'donasi-kecil-dampak-besar', 'excerpt' => 'Gerakan patungan warganet untuk mendukung pelestarian alam.', 'cluster' => 1, 'body' => 'Donasi, patungan, warganet, penggalangan dana, pelestarian alam, hutan, lingkungan, komunitas peduli sosial.'],
                ['title' => 'Rutinitas Pagi yang Mengubah Fokus', 'slug' => 'rutinitas-pagi-yang-mengubah-fokus', 'excerpt' => 'Kebiasaan pagi sederhana yang membantu menjaga fokus sepanjang hari.', 'cluster' => 2, 'body' => 'Pengembangan diri, rutinitas pagi, fokus, produktivitas, kebiasaan, disiplin, waktu tidur, olahraga ringan.'],
                ['title' => 'Kenapa Kita Susah Berhenti Menunda', 'slug' => 'kenapa-kita-susah-berhenti-menunda', 'excerpt' => 'Kebiasaan menunda pekerjaan dan cara kecil untuk mulai melawannya.', 'cluster' => 2, 'body' => 'Kebiasaan menunda pekerjaan, produktivitas, motivasi, disiplin, target harian, pengembangan diri, dan fokus.'],
                ['title' => 'Belajar Bicara di Depan Umum', 'slug' => 'belajar-bicara-di-depan-umum', 'excerpt' => 'Cara mengatasi gugup saat harus tampil dan bicara di depan banyak orang.', 'cluster' => 2, 'body' => 'Pengembangan diri, bicara depan umum, rasa gugup, kepercayaan diri, latihan komunikasi, dan fokus.'],
            ];

            $clusterData = [
                ['name' => 'Keuangan', 'description' => 'Kebiasaan mengatur uang, investasi, dan rencana finansial.', 'centroid' => [0.8, 0.2, 0.1]],
                ['name' => 'Lingkungan', 'description' => 'Cerita warga dan gerakan menjaga ruang hidup bersama.', 'centroid' => [0.2, 0.8, 0.1]],
                ['name' => 'Pengembangan Diri', 'description' => 'Kebiasaan kecil untuk fokus, berani, dan produktif.', 'centroid' => [0.1, 0.2, 0.8]],
            ];

            $clusters = collect($clusterData)->mapWithKeys(function (array $data, int $index) use ($run): array {
                return [$index => ContentCluster::updateOrCreate(
                    ['ml_model_run_id' => $run->id, 'cluster_index' => $index],
                    $data,
                )];
            });

            foreach ($articles as $index => $data) {
                $episode = Episode::updateOrCreate(
                    ['slug' => $data['slug']],
                    [
                        'podcast_id' => $podcast->id,
                        'title' => $data['title'],
                        'description' => $data['excerpt'],
                        'audio_url' => 'https://example.com/audio/'.$data['slug'].'.mp3',
                        'duration_seconds' => 900 + ($index * 45),
                        'published_at' => now()->subDays(9 - $index),
                        'status' => 'published',
                    ],
                );

                $article = Article::updateOrCreate(
                    ['slug' => $data['slug']],
                    [
                        'episode_id' => $episode->id,
                        'title' => $data['title'],
                        'excerpt' => $data['excerpt'],
                        'content' => $data['body'],
                        'published_at' => $episode->published_at,
                        'status' => 'published',
                    ],
                );

                ContentClusterAssignment::updateOrCreate(
                    ['article_id' => $article->id, 'ml_model_run_id' => $run->id],
                    [
                        'content_cluster_id' => $clusters[$data['cluster']]->id,
                        'distance_to_centroid' => 0.12 + ($index * 0.01),
                        'assigned_at' => now(),
                    ],
                );
            }
        });
    }
}
