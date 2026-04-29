-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2026 pada 15.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lavtugas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `created_at`) VALUES
(1, 1, 'login', 'User logged in.', '127.0.0.1', '2026-04-29 05:27:46'),
(2, 4, 'login', 'User logged in.', '127.0.0.1', '2026-04-29 05:34:34'),
(3, 4, 'create-post', 'Created post halo', '127.0.0.1', '2026-04-29 05:35:26'),
(4, 4, 'publish-post', 'Published post halo', '127.0.0.1', '2026-04-29 05:35:35'),
(5, 4, 'logout', 'User logged out.', '127.0.0.1', '2026-04-29 05:37:47'),
(6, 3, 'login', 'User logged in.', '127.0.0.1', '2026-04-29 05:37:54'),
(7, 1, 'login', 'User logged in.', '127.0.0.1', '2026-04-29 05:43:48'),
(8, 1, 'login', 'User logged in.', '127.0.0.1', '2026-04-29 05:44:26'),
(9, 1, 'logout', 'User logged out.', '127.0.0.1', '2026-04-29 05:46:14'),
(10, 5, 'login', 'User logged in.', '127.0.0.1', '2026-04-29 05:46:20'),
(11, 5, 'logout', 'User logged out.', '127.0.0.1', '2026-04-29 05:58:06'),
(12, 4, 'login', 'User logged in.', '127.0.0.1', '2026-04-29 05:58:13'),
(13, 4, 'create-post', 'Created post test', '127.0.0.1', '2026-04-29 05:58:57'),
(14, 4, 'logout', 'User logged out.', '127.0.0.1', '2026-04-29 05:59:27'),
(15, 3, 'login', 'User logged in.', '127.0.0.1', '2026-04-29 05:59:40'),
(16, 3, 'publish-post', 'Published post test', '127.0.0.1', '2026-04-29 05:59:55'),
(17, 3, 'publish-post', 'Published post Editorial Workflow Checklist', '127.0.0.1', '2026-04-29 05:59:59'),
(18, 3, 'logout', 'User logged out.', '127.0.0.1', '2026-04-29 06:00:05'),
(19, 5, 'login', 'User logged in.', '127.0.0.1', '2026-04-29 06:00:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_29_120208_create_roles_table', 1),
(5, '2026_04_29_120209_create_activity_logs_table', 1),
(6, '2026_04_29_120209_create_permissions_table', 1),
(7, '2026_04_29_122902_create_posts_table', 2),
(8, '2026_04_29_130000_add_category_to_posts_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'View Dashboard', 'view-dashboard', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(2, 'Manage Users', 'manage-users', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(3, 'Manage Roles', 'manage-roles', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(4, 'Manage Permissions', 'manage-permissions', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(5, 'View Activity Logs', 'view-activity-logs', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(6, 'Create Post', 'create-post', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(7, 'Edit Post', 'edit-post', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(8, 'Delete Post', 'delete-post', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(9, 'Publish Post', 'publish-post', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(10, 'View Reports', 'view-reports', '2026-04-29 05:25:11', '2026-04-29 06:16:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(1, 2, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(1, 3, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(1, 4, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(1, 5, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(1, 6, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(1, 7, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(1, 8, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(1, 9, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(1, 10, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(2, 1, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(2, 2, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(2, 3, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(2, 5, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(3, 1, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(3, 5, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(3, 9, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(3, 10, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(4, 1, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(4, 6, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(4, 7, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(5, 1, '2026-04-29 05:25:11', '2026-04-29 05:25:11'),
(5, 10, '2026-04-29 05:25:11', '2026-04-29 05:25:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Umum',
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `category`, `excerpt`, `content`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'Getting Started With RBAC', 'getting-started-with-rbac', 'IT', 'Pengantar singkat tentang bagaimana role dan permission mengatur akses menu di portal kampus.', 'RBAC adalah konsep untuk membatasi akses berdasarkan role dan permission. Dalam portal kampus ini, user tidak diberi akses langsung berdasarkan nama role saja. Sistem mengecek permission seperti view-dashboard, view-reports, create-post, atau manage-users.\n\nContohnya, viewer hanya dapat membaca informasi dan laporan. Editor dapat membuat konten. Admin dapat mengelola user dan role. Dengan pola ini, aturan akses menjadi lebih rapi dan mudah diuji.', 'published', '2026-04-29 06:16:46', '2026-04-29 05:31:42', '2026-04-29 06:16:46'),
(2, 4, 'Editorial Workflow Checklist', 'editorial-workflow-checklist', 'Umum', 'Checklist internal untuk editor sebelum sebuah informasi dipublish ke pembaca.', 'Sebelum konten dipublish, editor perlu memastikan judul jelas, isi tidak kosong, dan informasi sudah sesuai konteks kampus. Konten draft tidak akan tampil di menu Informasi Kampus.\n\nSetelah siap, user dengan permission publish-post dapat mempublish konten. Aktivitas publish akan tercatat di Activity Logs.', 'draft', NULL, '2026-04-29 05:31:42', '2026-04-29 06:05:48'),
(3, 4, 'Quarterly Content Performance', 'quarterly-content-performance', 'Umum', 'Ringkasan performa konten kampus untuk membantu manager membaca kondisi publikasi.', 'Laporan konten membantu manager melihat jumlah informasi yang sudah published dan yang masih draft. Data ini berguna untuk mengevaluasi apakah proses editorial berjalan lancar.\n\nViewer dapat membaca informasi yang sudah published, tetapi tidak dapat mengubah, menghapus, atau mempublish konten.', 'published', '2026-04-29 06:16:46', '2026-04-29 05:31:42', '2026-04-29 06:16:46'),
(4, 4, 'halo', 'halo', 'Umum', 'halo', 'halo', 'published', '2026-04-29 05:35:35', '2026-04-29 05:35:26', '2026-04-29 05:35:35'),
(5, 4, 'test', 'test', 'Umum', 'test percobaan', 'ini adalah test percobaan', 'published', '2026-04-29 05:59:55', '2026-04-29 05:58:57', '2026-04-29 05:59:55'),
(6, 4, 'Jadwal Pengisian KRS Semester Genap', 'jadwal-pengisian-krs-semester-genap', 'Akademik', 'Pengumuman jadwal pengisian KRS untuk mahasiswa aktif semester genap.', 'Pengisian KRS semester genap dibuka mulai tanggal yang sudah ditentukan oleh bagian akademik. Mahasiswa wajib melakukan konsultasi dengan dosen pembimbing akademik sebelum memilih mata kuliah.\n\nPastikan tidak ada bentrok jadwal kuliah dan jumlah SKS sesuai ketentuan akademik. Jika mengalami kendala sistem, mahasiswa dapat menghubungi layanan akademik melalui helpdesk kampus.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(7, 4, 'Informasi Beasiswa Prestasi Mahasiswa', 'informasi-beasiswa-prestasi-mahasiswa', 'Beasiswa', 'Pendaftaran beasiswa prestasi dibuka untuk mahasiswa dengan capaian akademik dan non-akademik.', 'Program beasiswa prestasi diberikan kepada mahasiswa yang memiliki IPK baik dan aktif dalam kegiatan akademik maupun organisasi. Pendaftar perlu menyiapkan transkrip nilai, surat rekomendasi, dan bukti prestasi.\n\nSeleksi dilakukan berdasarkan kelengkapan dokumen, capaian prestasi, dan wawancara singkat. Informasi hasil seleksi akan diumumkan melalui portal kampus.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(8, 4, 'Panduan Penggunaan Perpustakaan Digital', 'panduan-penggunaan-perpustakaan-digital', 'Layanan Mahasiswa', 'Mahasiswa dapat mengakses jurnal, ebook, dan repository kampus melalui layanan perpustakaan digital.', 'Perpustakaan digital menyediakan koleksi ebook, jurnal ilmiah, dan repository tugas akhir. Mahasiswa dapat login menggunakan akun kampus yang aktif.\n\nGunakan fitur pencarian berdasarkan judul, penulis, atau kata kunci. Untuk akses jurnal tertentu, pastikan koneksi menggunakan jaringan kampus atau VPN resmi yang disediakan oleh bagian IT.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(9, 4, 'Agenda Seminar Karier dan Magang', 'agenda-seminar-karier-dan-magang', 'Karier', 'Career Center mengadakan seminar karier untuk membantu mahasiswa menyiapkan magang dan dunia kerja.', 'Seminar karier akan membahas penyusunan CV, persiapan wawancara, etika komunikasi profesional, dan strategi mencari tempat magang. Kegiatan ini terbuka untuk seluruh mahasiswa aktif.\n\nPeserta disarankan membawa draft CV agar dapat mengikuti sesi review singkat. Sertifikat kegiatan akan diberikan kepada peserta yang mengikuti acara sampai selesai.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(10, 4, 'Pemeliharaan Sistem Akademik', 'pemeliharaan-sistem-akademik', 'IT', 'Sistem akademik akan mengalami pemeliharaan berkala untuk peningkatan keamanan dan performa.', 'Tim IT akan melakukan pemeliharaan sistem akademik pada jam yang sudah dijadwalkan. Selama proses pemeliharaan, beberapa layanan seperti KRS, nilai, dan pembayaran mungkin tidak dapat diakses sementara.\n\nMahasiswa dan dosen diminta menyelesaikan aktivitas penting sebelum jadwal pemeliharaan dimulai. Setelah proses selesai, layanan akan kembali berjalan normal.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(11, 4, 'Pendaftaran Kegiatan Organisasi Mahasiswa', 'pendaftaran-kegiatan-organisasi-mahasiswa', 'Kegiatan', 'Unit kegiatan mahasiswa membuka pendaftaran anggota baru untuk periode kepengurusan tahun ini.', 'Pendaftaran organisasi mahasiswa dibuka untuk mahasiswa dari semua program studi. Setiap calon anggota dapat memilih unit kegiatan sesuai minat, seperti seni, olahraga, teknologi, kewirausahaan, atau sosial.\n\nKegiatan organisasi dapat membantu mahasiswa mengembangkan kepemimpinan, komunikasi, dan kerja sama tim. Jadwal wawancara dan orientasi akan diumumkan oleh masing-masing unit kegiatan.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(12, 4, 'Tips Keamanan Akun Kampus', 'tips-keamanan-akun-kampus', 'Keamanan', 'Panduan singkat untuk menjaga keamanan akun kampus dan mencegah penyalahgunaan akses.', 'Mahasiswa dan staff disarankan menggunakan password yang kuat dan tidak membagikan akun kepada orang lain. Hindari login melalui perangkat publik tanpa logout setelah selesai.\n\nJika menemukan aktivitas mencurigakan, segera ubah password dan hubungi bagian IT. Keamanan akun penting karena akun kampus terhubung dengan data akademik dan layanan internal.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(13, 4, 'Layanan Konseling Mahasiswa', 'layanan-konseling-mahasiswa', 'Layanan Mahasiswa', 'Kampus menyediakan layanan konseling untuk mendukung kesehatan mental dan adaptasi mahasiswa.', 'Layanan konseling tersedia bagi mahasiswa yang membutuhkan dukungan dalam menghadapi tekanan akademik, adaptasi lingkungan kampus, atau masalah pribadi. Konseling dilakukan secara rahasia oleh petugas yang berwenang.\n\nMahasiswa dapat membuat janji melalui bagian kemahasiswaan. Layanan ini bertujuan membantu mahasiswa tetap sehat secara mental dan mampu menjalani perkuliahan dengan baik.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(14, 4, 'Pengumuman Ujian Tengah Semester', 'pengumuman-ujian-tengah-semester', 'Akademik', 'Informasi umum pelaksanaan UTS, tata tertib, dan persiapan yang perlu diperhatikan mahasiswa.', 'Ujian Tengah Semester akan dilaksanakan sesuai kalender akademik. Mahasiswa wajib memeriksa jadwal ujian, ruang, dan ketentuan masing-masing mata kuliah.\n\nPeserta ujian harus hadir tepat waktu dan membawa kartu ujian atau identitas mahasiswa. Pelanggaran tata tertib ujian akan diproses sesuai aturan akademik yang berlaku.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(15, 4, 'Kegiatan Bakti Sosial Kampus', 'kegiatan-bakti-sosial-kampus', 'Kegiatan', 'Kampus mengadakan kegiatan bakti sosial sebagai bentuk kontribusi kepada masyarakat sekitar.', 'Bakti sosial kampus melibatkan mahasiswa, dosen, dan staff dalam kegiatan pengabdian masyarakat. Bentuk kegiatan meliputi edukasi, donasi, pendampingan belajar, dan pemeriksaan kesehatan sederhana.\n\nMahasiswa yang ingin berpartisipasi dapat mendaftar melalui bagian kemahasiswaan. Kegiatan ini menjadi kesempatan untuk menerapkan nilai kepedulian sosial dalam kehidupan nyata.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(16, 4, 'Panduan Pengajuan Surat Keterangan Aktif', 'panduan-pengajuan-surat-keterangan-aktif', 'Layanan Mahasiswa', 'Langkah-langkah pengajuan surat keterangan aktif kuliah melalui layanan administrasi kampus.', 'Surat keterangan aktif kuliah dapat diajukan oleh mahasiswa melalui layanan administrasi. Mahasiswa perlu mengisi formulir, menyertakan identitas, dan memastikan status akademik masih aktif.\n\nDokumen biasanya digunakan untuk keperluan beasiswa, magang, administrasi keluarga, atau persyaratan instansi. Proses penerbitan mengikuti antrean dan validasi bagian akademik.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(17, 4, 'Workshop Dasar Penulisan Karya Ilmiah', 'workshop-dasar-penulisan-karya-ilmiah', 'Akademik', 'Workshop untuk membantu mahasiswa memahami struktur, sitasi, dan etika penulisan karya ilmiah.', 'Workshop penulisan karya ilmiah membahas pemilihan topik, penyusunan latar belakang, teknik sitasi, dan cara menghindari plagiarisme. Kegiatan ini cocok untuk mahasiswa yang sedang menyiapkan tugas akhir atau artikel ilmiah.\n\nPeserta akan mendapatkan contoh format penulisan dan latihan singkat menyusun kerangka tulisan. Dosen pembimbing juga akan memberikan masukan terhadap beberapa contoh kasus.', 'published', '2026-04-29 06:16:46', '2026-04-29 06:05:49', '2026-04-29 06:16:46'),
(18, 4, 'Draft Panduan Event Kampus', 'draft-panduan-event-kampus', 'Kegiatan', 'Draft internal mengenai tata cara pengajuan dan publikasi event kampus.', 'Draft ini masih perlu diperiksa oleh manager sebelum dipublish. Informasi draft tidak tampil di halaman Informasi Kampus sampai proses approval selesai.\n\nEditor dapat memperbaiki isi tulisan, lalu manager mempublish jika konten sudah sesuai standar.', 'draft', NULL, '2026-04-29 06:05:49', '2026-04-29 06:16:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(2, 'Admin', 'admin', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(3, 'Manager', 'manager', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(4, 'Editor', 'editor', '2026-04-29 05:25:11', '2026-04-29 06:16:44'),
(5, 'Viewer', 'viewer', '2026-04-29 05:25:11', '2026-04-29 06:16:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-04-29 05:25:12', '2026-04-29 05:25:12'),
(2, 2, '2026-04-29 05:25:12', '2026-04-29 05:25:12'),
(3, 3, '2026-04-29 05:25:13', '2026-04-29 05:25:13'),
(4, 4, '2026-04-29 05:25:13', '2026-04-29 05:25:13'),
(5, 5, '2026-04-29 05:25:13', '2026-04-29 05:25:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4ty3YJ6CWZ5ZE31i9lx5g3wrXXAsj7mvIUu6xDBc', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Codex/26.422.62136 Chrome/146.0.7680.179 Electron/41.2.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSDhKd0h4OENFbXBDV2xIRDhHQlhxQkhKYW9nQm5uOUV5N2FJdGc2VyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGVtby1ndWlkZSI7czo1OiJyb3V0ZSI7czoxMDoiZGVtby1ndWlkZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1777466641),
('BH80BauDCJt0fKwusqFc6sTpvQA6rrylnZ3AMzs1', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Codex/26.422.62136 Chrome/146.0.7680.179 Electron/41.2.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibEw4N2RUQlhSNGNJVU1wZlI0U3hvMk5TS0lCdEY2V0tVRGxwVjRRUSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcG9zdHMiO3M6NToicm91dGUiO3M6MTE6InBvc3RzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1777465937),
('nx5CinnvDZvB1356BB92UFZg6T17ur2IxfY6EDHg', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOFNGcGw2S3dyT3J0RXVaY09TQU1uaVBkQXc5bXlQSTI4SEpwODlKVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXBvcnRzIjtzOjU6InJvdXRlIjtzOjEzOiJyZXBvcnRzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1777466284),
('ZQqtdvTCXwqaoHu1n46vQQr9WNlCXogvqzhCro9z', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYTNvb2JZNGFiQTlGcGlkQVlYY3gzcnk3ODJGM080alRSMjF4WHRZYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXBvcnRzIjtzOjU6InJvdXRlIjtzOjEzOiJyZXBvcnRzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1777468764);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'superadmin@example.com', '2026-04-29 06:16:45', '$2y$12$k9BeL02VEeGkm96mucNxoOrVBYnJVMstVHfcAsySg4/xKlxl15H6q', '7ptijQPEzKDiQoBk6ROLwB7HdKtjUCqw0KZPr53i2oO7KeTdWRFP8QtHqHAA', '2026-04-29 05:25:12', '2026-04-29 06:16:45', NULL),
(2, 'Admin', 'admin@example.com', '2026-04-29 06:16:45', '$2y$12$ekaw2tv2NRgwz9vVA8.V3OnUx54Jzkv.mbrXGJy2anAB32wbrqkiu', NULL, '2026-04-29 05:25:12', '2026-04-29 06:16:45', NULL),
(3, 'Manager', 'manager@example.com', '2026-04-29 06:16:45', '$2y$12$RWvO3niLGsujrRWZepM94ew5D5PaH/rGZccKYXrD3jd2FmvU.Lu.C', NULL, '2026-04-29 05:25:13', '2026-04-29 06:16:45', NULL),
(4, 'Editor', 'editor@example.com', '2026-04-29 06:16:46', '$2y$12$sAaPLHLGp2k1rw3HngI4n.pm7EsJAI7UxfCHRIQywfI56dkG/EO12', '8ftayIj59mq0BTsg4EE6IbgcLIbih1cP4fmenoFpnUFzmQ2XJcR0BCBfKDoE', '2026-04-29 05:25:13', '2026-04-29 06:16:46', NULL),
(5, 'Viewer', 'viewer@example.com', '2026-04-29 06:16:46', '$2y$12$fHdeLbDWwRj9TkNgUekSH.owKYL4QZLWuGxmuEqh5IH944ugGfto2', NULL, '2026-04-29 05:25:13', '2026-04-29 06:16:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indeks untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indeks untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
