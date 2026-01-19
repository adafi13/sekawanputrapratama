<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories and author
        $techCategory = BlogCategory::where('slug', 'technology')->first();
        $serverCategory = BlogCategory::where('slug', 'server')->first();
        $appDevCategory = BlogCategory::where('slug', 'app-dev')->first();
        $author = User::first();

        $posts = [
            [
                'title' => 'Pentingnya Website Responsif untuk Bisnis di Era Digital',
                'excerpt' => 'Mengapa website yang cepat dan ramah mobile sangat krusial di era smartphone saat ini?',
                'content' => '<p>Di era di mana penggunaan smartphone mendominasi akses internet, memiliki website yang responsif bukan lagi pilihan, melainkan keharusan. Website responsif memastikan tampilan halaman web Anda menyesuaikan diri secara otomatis dengan ukuran layar perangkat pengguna, baik itu desktop, tablet, maupun ponsel.</p>
                <h4>Mengapa Hal Ini Penting?</h4>
                <p>Google memprioritaskan website yang "Mobile-Friendly" dalam hasil pencarian mereka. Jika website Anda sulit dibaca di HP, besar kemungkinan pengunjung akan segera meninggalkannya (Bounce Rate tinggi), yang berdampak buruk pada reputasi bisnis Anda.</p>
                <p>Sekawan Putra Pratama berkomitmen membantu Anda membangun website yang tidak hanya indah secara visual, tetapi juga berkinerja tinggi di segala perangkat. Hubungi kami untuk audit website gratis.</p>',
                'category_id' => $techCategory?->id,
                'author_id' => $author?->id,
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'views' => 150,
                'meta_title' => 'Pentingnya Website Responsif untuk Bisnis',
                'meta_description' => 'Mengapa website yang cepat dan ramah mobile sangat krusial di era smartphone saat ini?',
            ],
            [
                'title' => 'Tips Mengamankan Server Kantor',
                'excerpt' => 'Langkah-langkah preventif untuk menjaga data perusahaan Anda dari serangan siber.',
                'content' => '<p>Keamanan server kantor adalah hal yang sangat penting untuk melindungi data perusahaan. Berikut beberapa tips untuk mengamankan server Anda:</p>
                <ul>
                    <li>Gunakan firewall yang kuat</li>
                    <li>Update sistem secara berkala</li>
                    <li>Gunakan password yang kuat</li>
                    <li>Backup data secara rutin</li>
                </ul>',
                'category_id' => $serverCategory?->id,
                'author_id' => $author?->id,
                'status' => 'published',
                'published_at' => now()->subDays(12),
                'views' => 89,
                'meta_title' => 'Tips Mengamankan Server Kantor',
                'meta_description' => 'Langkah-langkah preventif untuk menjaga data perusahaan Anda dari serangan siber.',
            ],
            [
                'title' => 'Membangun Aplikasi Android yang Stabil',
                'excerpt' => 'Teknik dasar dalam pengembangan aplikasi mobile agar minim bug dan crash.',
                'content' => '<p>Membangun aplikasi Android yang stabil memerlukan perhatian pada beberapa aspek penting:</p>
                <ul>
                    <li>Penggunaan memory yang efisien</li>
                    <li>Error handling yang baik</li>
                    <li>Testing yang komprehensif</li>
                    <li>Optimasi performa</li>
                </ul>',
                'category_id' => $appDevCategory?->id,
                'author_id' => $author?->id,
                'status' => 'published',
                'published_at' => now()->subDays(20),
                'views' => 120,
                'meta_title' => 'Membangun Aplikasi Android yang Stabil',
                'meta_description' => 'Teknik dasar dalam pengembangan aplikasi mobile agar minim bug dan crash.',
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}


