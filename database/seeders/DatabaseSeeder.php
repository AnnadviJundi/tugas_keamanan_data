<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = collect([
            'view-dashboard',
            'manage-users',
            'manage-roles',
            'manage-permissions',
            'view-activity-logs',
            'create-post',
            'edit-post',
            'delete-post',
            'publish-post',
            'view-reports',
        ])->mapWithKeys(fn (string $permission) => [
            $permission => Permission::updateOrCreate(
                ['slug' => $permission],
                ['name' => str($permission)->replace('-', ' ')->title()]
            ),
        ]);

        Role::where('slug', 'user')->delete();

        $roles = collect([
            'super-admin' => $permissions->keys()->all(),
            'admin' => [
                'view-dashboard',
                'manage-users',
                'manage-roles',
                'view-activity-logs',
            ],
            'manager' => [
                'view-dashboard',
                'view-reports',
                'publish-post',
                'view-activity-logs',
            ],
            'editor' => [
                'view-dashboard',
                'create-post',
                'edit-post',
            ],
            'viewer' => [
                'view-dashboard',
                'view-reports',
            ],
        ])->mapWithKeys(function (array $permissionSlugs, string $roleSlug) use ($permissions) {
            $role = Role::updateOrCreate(
                ['slug' => $roleSlug],
                ['name' => str($roleSlug)->replace('-', ' ')->title()]
            );

            $role->permissions()->sync(
                collect($permissionSlugs)->map(fn (string $slug) => $permissions[$slug]->id)
            );

            return [$roleSlug => $role];
        });

        collect([
            ['name' => 'Super Admin', 'email' => 'superadmin@example.com', 'role' => 'super-admin'],
            ['name' => 'Admin', 'email' => 'admin@example.com', 'role' => 'admin'],
            ['name' => 'Manager', 'email' => 'manager@example.com', 'role' => 'manager'],
            ['name' => 'Editor', 'email' => 'editor@example.com', 'role' => 'editor'],
            ['name' => 'Viewer', 'email' => 'viewer@example.com', 'role' => 'viewer'],
        ])->each(function (array $dummyUser) use ($roles) {
            $user = User::updateOrCreate(
                ['email' => $dummyUser['email']],
                [
                    'name' => $dummyUser['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            $user->roles()->sync([$roles[$dummyUser['role']]->id]);
        });

        $editor = User::where('email', 'editor@example.com')->first();

        collect([
            [
                'title' => 'Getting Started With RBAC',
                'slug' => 'getting-started-with-rbac',
                'category' => 'IT',
                'status' => 'published',
                'excerpt' => 'Pengantar singkat tentang bagaimana role dan permission mengatur akses menu di portal kampus.',
                'content' => "RBAC adalah konsep untuk membatasi akses berdasarkan role dan permission. Dalam portal kampus ini, user tidak diberi akses langsung berdasarkan nama role saja. Sistem mengecek permission seperti view-dashboard, view-reports, create-post, atau manage-users.\n\nContohnya, viewer hanya dapat membaca informasi dan laporan. Editor dapat membuat konten. Admin dapat mengelola user dan role. Dengan pola ini, aturan akses menjadi lebih rapi dan mudah diuji.",
            ],
            [
                'title' => 'Editorial Workflow Checklist',
                'slug' => 'editorial-workflow-checklist',
                'category' => 'Umum',
                'status' => 'draft',
                'excerpt' => 'Checklist internal untuk editor sebelum sebuah informasi dipublish ke pembaca.',
                'content' => "Sebelum konten dipublish, editor perlu memastikan judul jelas, isi tidak kosong, dan informasi sudah sesuai konteks kampus. Konten draft tidak akan tampil di menu Informasi Kampus.\n\nSetelah siap, user dengan permission publish-post dapat mempublish konten. Aktivitas publish akan tercatat di Activity Logs.",
            ],
            [
                'title' => 'Quarterly Content Performance',
                'slug' => 'quarterly-content-performance',
                'category' => 'Umum',
                'status' => 'published',
                'excerpt' => 'Ringkasan performa konten kampus untuk membantu manager membaca kondisi publikasi.',
                'content' => "Laporan konten membantu manager melihat jumlah informasi yang sudah published dan yang masih draft. Data ini berguna untuk mengevaluasi apakah proses editorial berjalan lancar.\n\nViewer dapat membaca informasi yang sudah published, tetapi tidak dapat mengubah, menghapus, atau mempublish konten.",
            ],
            [
                'title' => 'Jadwal Pengisian KRS Semester Genap',
                'slug' => 'jadwal-pengisian-krs-semester-genap',
                'category' => 'Akademik',
                'status' => 'published',
                'excerpt' => 'Pengumuman jadwal pengisian KRS untuk mahasiswa aktif semester genap.',
                'content' => "Pengisian KRS semester genap dibuka mulai tanggal yang sudah ditentukan oleh bagian akademik. Mahasiswa wajib melakukan konsultasi dengan dosen pembimbing akademik sebelum memilih mata kuliah.\n\nPastikan tidak ada bentrok jadwal kuliah dan jumlah SKS sesuai ketentuan akademik. Jika mengalami kendala sistem, mahasiswa dapat menghubungi layanan akademik melalui helpdesk kampus.",
            ],
            [
                'title' => 'Informasi Beasiswa Prestasi Mahasiswa',
                'slug' => 'informasi-beasiswa-prestasi-mahasiswa',
                'category' => 'Beasiswa',
                'status' => 'published',
                'excerpt' => 'Pendaftaran beasiswa prestasi dibuka untuk mahasiswa dengan capaian akademik dan non-akademik.',
                'content' => "Program beasiswa prestasi diberikan kepada mahasiswa yang memiliki IPK baik dan aktif dalam kegiatan akademik maupun organisasi. Pendaftar perlu menyiapkan transkrip nilai, surat rekomendasi, dan bukti prestasi.\n\nSeleksi dilakukan berdasarkan kelengkapan dokumen, capaian prestasi, dan wawancara singkat. Informasi hasil seleksi akan diumumkan melalui portal kampus.",
            ],
            [
                'title' => 'Panduan Penggunaan Perpustakaan Digital',
                'slug' => 'panduan-penggunaan-perpustakaan-digital',
                'category' => 'Layanan Mahasiswa',
                'status' => 'published',
                'excerpt' => 'Mahasiswa dapat mengakses jurnal, ebook, dan repository kampus melalui layanan perpustakaan digital.',
                'content' => "Perpustakaan digital menyediakan koleksi ebook, jurnal ilmiah, dan repository tugas akhir. Mahasiswa dapat login menggunakan akun kampus yang aktif.\n\nGunakan fitur pencarian berdasarkan judul, penulis, atau kata kunci. Untuk akses jurnal tertentu, pastikan koneksi menggunakan jaringan kampus atau VPN resmi yang disediakan oleh bagian IT.",
            ],
            [
                'title' => 'Agenda Seminar Karier dan Magang',
                'slug' => 'agenda-seminar-karier-dan-magang',
                'category' => 'Karier',
                'status' => 'published',
                'excerpt' => 'Career Center mengadakan seminar karier untuk membantu mahasiswa menyiapkan magang dan dunia kerja.',
                'content' => "Seminar karier akan membahas penyusunan CV, persiapan wawancara, etika komunikasi profesional, dan strategi mencari tempat magang. Kegiatan ini terbuka untuk seluruh mahasiswa aktif.\n\nPeserta disarankan membawa draft CV agar dapat mengikuti sesi review singkat. Sertifikat kegiatan akan diberikan kepada peserta yang mengikuti acara sampai selesai.",
            ],
            [
                'title' => 'Pemeliharaan Sistem Akademik',
                'slug' => 'pemeliharaan-sistem-akademik',
                'category' => 'IT',
                'status' => 'published',
                'excerpt' => 'Sistem akademik akan mengalami pemeliharaan berkala untuk peningkatan keamanan dan performa.',
                'content' => "Tim IT akan melakukan pemeliharaan sistem akademik pada jam yang sudah dijadwalkan. Selama proses pemeliharaan, beberapa layanan seperti KRS, nilai, dan pembayaran mungkin tidak dapat diakses sementara.\n\nMahasiswa dan dosen diminta menyelesaikan aktivitas penting sebelum jadwal pemeliharaan dimulai. Setelah proses selesai, layanan akan kembali berjalan normal.",
            ],
            [
                'title' => 'Pendaftaran Kegiatan Organisasi Mahasiswa',
                'slug' => 'pendaftaran-kegiatan-organisasi-mahasiswa',
                'category' => 'Kegiatan',
                'status' => 'published',
                'excerpt' => 'Unit kegiatan mahasiswa membuka pendaftaran anggota baru untuk periode kepengurusan tahun ini.',
                'content' => "Pendaftaran organisasi mahasiswa dibuka untuk mahasiswa dari semua program studi. Setiap calon anggota dapat memilih unit kegiatan sesuai minat, seperti seni, olahraga, teknologi, kewirausahaan, atau sosial.\n\nKegiatan organisasi dapat membantu mahasiswa mengembangkan kepemimpinan, komunikasi, dan kerja sama tim. Jadwal wawancara dan orientasi akan diumumkan oleh masing-masing unit kegiatan.",
            ],
            [
                'title' => 'Tips Keamanan Akun Kampus',
                'slug' => 'tips-keamanan-akun-kampus',
                'category' => 'Keamanan',
                'status' => 'published',
                'excerpt' => 'Panduan singkat untuk menjaga keamanan akun kampus dan mencegah penyalahgunaan akses.',
                'content' => "Mahasiswa dan staff disarankan menggunakan password yang kuat dan tidak membagikan akun kepada orang lain. Hindari login melalui perangkat publik tanpa logout setelah selesai.\n\nJika menemukan aktivitas mencurigakan, segera ubah password dan hubungi bagian IT. Keamanan akun penting karena akun kampus terhubung dengan data akademik dan layanan internal.",
            ],
            [
                'title' => 'Layanan Konseling Mahasiswa',
                'slug' => 'layanan-konseling-mahasiswa',
                'category' => 'Layanan Mahasiswa',
                'status' => 'published',
                'excerpt' => 'Kampus menyediakan layanan konseling untuk mendukung kesehatan mental dan adaptasi mahasiswa.',
                'content' => "Layanan konseling tersedia bagi mahasiswa yang membutuhkan dukungan dalam menghadapi tekanan akademik, adaptasi lingkungan kampus, atau masalah pribadi. Konseling dilakukan secara rahasia oleh petugas yang berwenang.\n\nMahasiswa dapat membuat janji melalui bagian kemahasiswaan. Layanan ini bertujuan membantu mahasiswa tetap sehat secara mental dan mampu menjalani perkuliahan dengan baik.",
            ],
            [
                'title' => 'Pengumuman Ujian Tengah Semester',
                'slug' => 'pengumuman-ujian-tengah-semester',
                'category' => 'Akademik',
                'status' => 'published',
                'excerpt' => 'Informasi umum pelaksanaan UTS, tata tertib, dan persiapan yang perlu diperhatikan mahasiswa.',
                'content' => "Ujian Tengah Semester akan dilaksanakan sesuai kalender akademik. Mahasiswa wajib memeriksa jadwal ujian, ruang, dan ketentuan masing-masing mata kuliah.\n\nPeserta ujian harus hadir tepat waktu dan membawa kartu ujian atau identitas mahasiswa. Pelanggaran tata tertib ujian akan diproses sesuai aturan akademik yang berlaku.",
            ],
            [
                'title' => 'Kegiatan Bakti Sosial Kampus',
                'slug' => 'kegiatan-bakti-sosial-kampus',
                'category' => 'Kegiatan',
                'status' => 'published',
                'excerpt' => 'Kampus mengadakan kegiatan bakti sosial sebagai bentuk kontribusi kepada masyarakat sekitar.',
                'content' => "Bakti sosial kampus melibatkan mahasiswa, dosen, dan staff dalam kegiatan pengabdian masyarakat. Bentuk kegiatan meliputi edukasi, donasi, pendampingan belajar, dan pemeriksaan kesehatan sederhana.\n\nMahasiswa yang ingin berpartisipasi dapat mendaftar melalui bagian kemahasiswaan. Kegiatan ini menjadi kesempatan untuk menerapkan nilai kepedulian sosial dalam kehidupan nyata.",
            ],
            [
                'title' => 'Panduan Pengajuan Surat Keterangan Aktif',
                'slug' => 'panduan-pengajuan-surat-keterangan-aktif',
                'category' => 'Layanan Mahasiswa',
                'status' => 'published',
                'excerpt' => 'Langkah-langkah pengajuan surat keterangan aktif kuliah melalui layanan administrasi kampus.',
                'content' => "Surat keterangan aktif kuliah dapat diajukan oleh mahasiswa melalui layanan administrasi. Mahasiswa perlu mengisi formulir, menyertakan identitas, dan memastikan status akademik masih aktif.\n\nDokumen biasanya digunakan untuk keperluan beasiswa, magang, administrasi keluarga, atau persyaratan instansi. Proses penerbitan mengikuti antrean dan validasi bagian akademik.",
            ],
            [
                'title' => 'Workshop Dasar Penulisan Karya Ilmiah',
                'slug' => 'workshop-dasar-penulisan-karya-ilmiah',
                'category' => 'Akademik',
                'status' => 'published',
                'excerpt' => 'Workshop untuk membantu mahasiswa memahami struktur, sitasi, dan etika penulisan karya ilmiah.',
                'content' => "Workshop penulisan karya ilmiah membahas pemilihan topik, penyusunan latar belakang, teknik sitasi, dan cara menghindari plagiarisme. Kegiatan ini cocok untuk mahasiswa yang sedang menyiapkan tugas akhir atau artikel ilmiah.\n\nPeserta akan mendapatkan contoh format penulisan dan latihan singkat menyusun kerangka tulisan. Dosen pembimbing juga akan memberikan masukan terhadap beberapa contoh kasus.",
            ],
            [
                'title' => 'Draft Panduan Event Kampus',
                'slug' => 'draft-panduan-event-kampus',
                'category' => 'Kegiatan',
                'status' => 'draft',
                'excerpt' => 'Draft internal mengenai tata cara pengajuan dan publikasi event kampus.',
                'content' => "Draft ini masih perlu diperiksa oleh manager sebelum dipublish. Informasi draft tidak tampil di halaman Informasi Kampus sampai proses approval selesai.\n\nEditor dapat memperbaiki isi tulisan, lalu manager mempublish jika konten sudah sesuai standar.",
            ],
        ])->each(function (array $post) use ($editor) {
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'user_id' => $editor->id,
                    'title' => $post['title'],
                    'category' => $post['category'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'status' => $post['status'],
                    'published_at' => $post['status'] === 'published' ? now() : null,
                ]
            );
        });
    }
}
