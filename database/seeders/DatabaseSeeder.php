<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Tự động tạo tài khoản quản lý mỗi khi reset DB
        DB::table('nhaquanly')->insert([
            'HoTen' => 'nghia',
            'Email' => 'nghia@gmail.com',
            'MatKhau' => Hash::make('12345678'), // Password đã mã hóa
            'DiaChi' => 'TP.HCM',
            'SDT' => '0987654321',
            'NgaySinh' => '2000-01-01',
            'VaiTro' => 1,
            'TrangThai' => 1,
            'NgayTao' => now(),
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed blog data
        $this->call([
            BlogCategorySeeder::class,
            BaiVietSeeder::class,
        ]);
    }
}
