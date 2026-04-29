# Campus Content RBAC

Campus Content RBAC adalah project Laravel untuk tugas kuliah yang mendemonstrasikan Role-Based Access Control berbasis database tanpa package eksternal seperti Spatie.

Studi kasus project ini adalah sistem manajemen konten kampus. Setiap user memiliki role berbeda, role memiliki permission, lalu menu dan aksi CRUD ditampilkan berdasarkan permission user yang sedang login.

## Tujuan Project

Project ini dibuat untuk menunjukkan konsep berikut:

- Authentication menggunakan Laravel Breeze.
- RBAC manual berbasis database.
- Relasi many-to-many antara user, role, dan permission.
- Middleware authorization berbasis permission.
- Blade directive untuk menyembunyikan/menampilkan menu.
- Activity log untuk mencatat aktivitas penting.
- Dashboard yang berubah sesuai permission user.

## Studi Kasus

Bayangkan kampus memiliki portal internal untuk mengelola artikel, pengumuman, laporan, dan data user.

- Super Admin mengatur semua data sistem.
- Admin mengatur user dan role.
- Manager melihat laporan, audit log, dan melakukan approval publish.
- Editor membuat dan mengubah konten.
- Viewer melihat dashboard, informasi kampus, dan laporan.

Dengan studi kasus ini, RBAC menjadi lebih mudah dipahami karena setiap role punya tugas nyata.

## Role dan Permission

| Role | Fungsi | Menu yang Terlihat |
| --- | --- | --- |
| super-admin | Pemilik sistem | Semua menu |
| admin | Mengelola user dan role | Informasi Kampus, Users, Roles, Activity Logs |
| manager | Melihat laporan dan audit | Informasi Kampus, Approval Posts, Reports, Activity Logs |
| editor | Mengelola konten | Informasi Kampus, Post Management |
| viewer | Melihat informasi | Dashboard, Informasi Kampus, Reports |

## Permission

- view-dashboard
- manage-users
- manage-roles
- manage-permissions
- view-activity-logs
- create-post
- edit-post
- delete-post
- publish-post
- view-reports

## Akun Demo

Akun demo dibuat otomatis oleh `DatabaseSeeder`. Untuk alasan keamanan, detail email dan password tidak ditampilkan di dokumentasi ini. Lihat file seeder saat menjalankan demo lokal.

## Fitur

- Login, register, logout.
- Redirect dashboard berdasarkan role.
- CRUD User.
- Assign role ke user.
- CRUD Role.
- Assign permission ke role.
- CRUD Permission.
- CRUD Post Management.
- Kategori konten untuk Informasi Kampus.
- Approval Posts untuk manager/publisher.
- Publish post berdasarkan permission.
- Reports sederhana dari data post.
- Activity Logs untuk aksi penting.
- Sidebar menu otomatis berdasarkan permission.
- Helper `auth()->user()->hasPermission('permission-slug')`.
- Blade directive `@canPermission('permission-slug')`.

## Struktur Database Utama

```txt
users
roles
permissions
role_user
permission_role
posts
activity_logs
```

Relasi:

```txt
User many-to-many Role
Role many-to-many Permission
User one-to-many Post
User one-to-many ActivityLog
```

Ringkasan ERD:

```txt
users --< role_user >-- roles --< permission_role >-- permissions
users --< posts
users --< activity_logs
```

## Cara Menjalankan

Install dependency:

```bash
composer install
npm install
```

Atur database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lavtugas
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration dan seeder:

```bash
php artisan migrate:fresh --seed
```

Build asset:

```bash
npm run build
```

Jalankan server:

```bash
php artisan serve
```

Buka:

```txt
http://127.0.0.1:8000
```

## Alur Demo Presentasi

1. Login sebagai `superadmin@example.com`.
2. Tunjukkan bahwa super-admin melihat semua menu.
3. Buka Users dan tunjukkan role serta permission tiap user.
4. Logout, lalu login sebagai `editor@example.com`.
5. Buat draft post dari Post Management.
6. Logout, lalu login sebagai `manager@example.com`.
7. Publish draft dari Approval Posts.
8. Logout, lalu login sebagai `viewer@example.com`.
9. Buka Informasi Kampus dan baca post yang sudah published.
10. Login kembali sebagai super-admin atau admin.
11. Buka Activity Logs untuk menunjukkan aktivitas yang tercatat.

## File Penting

- `app/Models/User.php`
- `app/Models/Role.php`
- `app/Models/Permission.php`
- `app/Models/Post.php`
- `app/Models/ActivityLog.php`
- `app/Http/Middleware/CheckPermission.php`
- `app/Helpers/permission.php`
- `database/seeders/DatabaseSeeder.php`
- `routes/web.php`
- `resources/views/layouts/app.blade.php`
- `resources/views/demo-guide.blade.php`

## Catatan

Project ini sengaja tidak menggunakan package eksternal RBAC agar konsep dasarnya terlihat jelas:

```php
auth()->user()->hasPermission('manage-users')
```

dan:

```blade
@canPermission('manage-users')
    <a href="{{ route('users.index') }}">Users</a>
@endcanPermission
```
