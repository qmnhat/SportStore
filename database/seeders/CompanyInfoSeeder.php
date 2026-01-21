<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;
class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CompanyInfo::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ SPORTSTORE VIỆT NAM',
                'description' => 'Đồng hành cùng đam mê thể thao của bạn từ năm 2025',
                'address' => '109 Khánh Hội, Phường 3, Quận 4, Thành phố Hồ Chí Minh 700000, Việt Nam',
                'hotline' => '1900 888 999',
                'email' => 'support@sportstore.vn',
                'tax_code' => '0316xxxxxx',
                'opening_hours' => 'Thứ 2 - Chủ nhật: 08:00 - 21:00',
                'vision' => 'Trở thành hệ thống bán lẻ đồ thể thao số 1 tại Việt Nam, mang đến trải nghiệm mua sắm tiện lợi, hiện đại và đáng tin cậy nhất cho người yêu vận động.',
                'mission' => 'SportStore không chỉ bán sản phẩm, chúng tôi bán "sức khỏe" và "phong cách sống". Cam kết 100% sản phẩm chính hãng, chất lượng vượt trội và dịch vụ tuyệt vời.',
                'employee_count' => 50,
                'facebook_url' => 'https://www.facebook.com/',
                'instagram_url' => 'https://www.instagram.com/',
                'twitter_url' => 'https://x.com/home?lang=vi',
                'youtube_url' => 'https://www.youtube.com/',
                'zalo_phone' => '+84 123 456 789',
            ]
        );
    }
}
