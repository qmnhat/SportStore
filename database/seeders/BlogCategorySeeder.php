<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'TenDanhMuc' => 'Hướng Dẫn Chọn Giày',
                'slug' => 'huong-dan-chon-giay',
                'MoTa' => 'Những bài viết hướng dẫn chọn giày thể thao phù hợp',
                'TrangThai' => 1,
            ],
            [
                'TenDanhMuc' => 'Yoga & Pilates',
                'slug' => 'yoga-pilates',
                'MoTa' => 'Các bài tập yoga và pilates hiệu quả',
                'TrangThai' => 1,
            ],
            [
                'TenDanhMuc' => 'Tập Gym',
                'slug' => 'tap-gym',
                'MoTa' => 'Hướng dẫn tập gym cho người mới bắt đầu',
                'TrangThai' => 1,
            ],
            [
                'TenDanhMuc' => 'Bóng Đá',
                'slug' => 'bong-da',
                'MoTa' => 'Tin tức và hướng dẫn về bóng đá',
                'TrangThai' => 1,
            ],
            [
                'TenDanhMuc' => 'Tin Khác',
                'slug' => 'tin-khac',
                'MoTa' => 'Những bài viết liên quan đến thể thao khác',
                'TrangThai' => 1,
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }
    }
}
