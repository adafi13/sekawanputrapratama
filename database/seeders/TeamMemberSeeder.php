<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Abdul Malik Ibrahim',
                'position' => 'App Developer',
                'bio' => 'Seorang App Developer berpengalaman dalam membangun aplikasi mobile dan desktop modern, responsif, dan berperforma tinggi. Spesialisasi dalam pengembangan aplikasi cross-platform menggunakan teknologi terbaru.',
                'email' => 'abdul.malik@sekawanputrapratama.com',
                'experience_years' => 7,
                'skills' => ['Flutter', 'React Native', 'Laravel', 'Node.js', 'Dart', 'JavaScript'],
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Aries Adityanto',
                'position' => 'Project Manager',
                'bio' => 'Profesional dalam manajemen proyek IT, memastikan setiap tahap pengembangan berjalan presisi, tepat waktu, dan sesuai kebutuhan klien. Berpengalaman mengelola proyek dari skala kecil hingga enterprise.',
                'email' => 'aries@sekawanputrapratama.com',
                'experience_years' => 5,
                'skills' => ['Project Management', 'Agile/Scrum', 'Client Relations', 'Team Leadership'],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'M. Aditya Novaldy',
                'position' => 'Server & Networking Specialist',
                'bio' => 'Ahli Office Server dan Networking. Terampil memastikan koneksi stabil, aman, serta sistem internal perusahaan berjalan lancar. Spesialisasi dalam setup server, konfigurasi jaringan, dan maintenance infrastruktur IT.',
                'email' => 'aditya.novaldy@sekawanputrapratama.com',
                'experience_years' => 6,
                'skills' => ['Linux Server', 'Network Administration', 'Docker', 'Kubernetes', 'Cloud Infrastructure'],
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'M. Naufal Fathuroni',
                'position' => 'UI/UX Designer',
                'bio' => 'Ahli merancang antarmuka aplikasi dan website yang intuitif. Fokus pada pengalaman pengguna, estetika visual, dan interaksi yang efisien. Membuat desain yang tidak hanya cantik tetapi juga fungsional dan user-friendly.',
                'email' => 'naufal@sekawanputrapratama.com',
                'experience_years' => 2,
                'skills' => ['Figma', 'Adobe XD', 'UI/UX Design', 'Prototyping', 'User Research'],
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Alfario Dafa Mustofa',
                'position' => 'Office Server Engineer',
                'bio' => 'Fokus dalam setup server kantor, konfigurasi jaringan internal, dan manajemen data perusahaan. Menjamin server berjalan aman, stabil, dan teroptimasi. Spesialisasi dalam infrastruktur IT untuk perusahaan.',
                'email' => 'alfario@sekawanputrapratama.com',
                'experience_years' => 5,
                'skills' => ['Windows Server', 'Active Directory', 'Backup Solutions', 'IT Infrastructure'],
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                $member
            );
        }
    }
}
