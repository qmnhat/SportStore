<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SportStoreSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // ==================== 1. DANH MỤC ====================
        $danhMucs = [
            ['TenDM' => 'Giày thể thao', 'slug' => 'giay-the-thao', 'MoTa' => 'Các loại giày thể thao chính hãng'],
            ['TenDM' => 'Áo thể thao', 'slug' => 'ao-the-thao', 'MoTa' => 'Áo thể thao nam nữ đa dạng mẫu mã'],
            ['TenDM' => 'Quần thể thao', 'slug' => 'quan-the-thao', 'MoTa' => 'Quần thể thao thoáng mát'],
            ['TenDM' => 'Phụ kiện thể thao', 'slug' => 'phu-kien-the-thao', 'MoTa' => 'Phụ kiện hỗ trợ tập luyện'],
            ['TenDM' => 'Dụng cụ tập gym', 'slug' => 'dung-cu-tap-gym', 'MoTa' => 'Dụng cụ tập gym chuyên nghiệp'],
            ['TenDM' => 'Đồ bơi', 'slug' => 'do-boi', 'MoTa' => 'Đồ bơi và phụ kiện bơi lội'],
        ];
        DB::table('danhmuc')->insert($danhMucs);

        // ==================== 2. THƯƠNG HIỆU ====================
        $thuongHieus = [
            ['TenTH' => 'Nike', 'MoTa' => 'Thương hiệu thể thao hàng đầu thế giới từ Mỹ'],
            ['TenTH' => 'Adidas', 'MoTa' => 'Thương hiệu thể thao nổi tiếng từ Đức'],
            ['TenTH' => 'Puma', 'MoTa' => 'Thương hiệu thể thao phong cách từ Đức'],
            ['TenTH' => 'Under Armour', 'MoTa' => 'Thương hiệu đồ thể thao cao cấp Mỹ'],
            ['TenTH' => 'New Balance', 'MoTa' => 'Thương hiệu giày thể thao từ Mỹ'],
            ['TenTH' => 'Reebok', 'MoTa' => 'Thương hiệu thể thao và fitness'],
            ['TenTH' => 'Asics', 'MoTa' => 'Thương hiệu giày chạy bộ hàng đầu Nhật Bản'],
            ['TenTH' => 'Mizuno', 'MoTa' => 'Thương hiệu thể thao chất lượng từ Nhật'],
        ];
        DB::table('thuonghieu')->insert($thuongHieus);

        // ==================== 3. KÍCH THƯỚC ====================
        $kichThuocs = [
            ['TenKT' => 'S'],
            ['TenKT' => 'M'],
            ['TenKT' => 'L'],
            ['TenKT' => 'XL'],
            ['TenKT' => 'XXL'],
            ['TenKT' => '38'],
            ['TenKT' => '39'],
            ['TenKT' => '40'],
            ['TenKT' => '41'],
            ['TenKT' => '42'],
            ['TenKT' => '43'],
            ['TenKT' => '44'],
            ['TenKT' => 'Free Size'],
        ];
        DB::table('kichthuoc')->insert($kichThuocs);

        // ==================== 4. SẢN PHẨM (25+ sản phẩm) ====================
        $sanPhams = [
            // Giày thể thao (MaDM = 1)
            ['TenSP' => 'Nike Air Max 270', 'slug' => 'nike-air-max-270', 'MaDM' => 1, 'MaTH' => 1, 'MoTa' => 'Giày Nike Air Max 270 với đệm khí lớn, êm ái tối đa. Thiết kế hiện đại, phù hợp chạy bộ và đi chơi.', 'TrangThai' => 1, 'NoiBat' => 1],
            ['TenSP' => 'Nike Air Force 1', 'slug' => 'nike-air-force-1', 'MaDM' => 1, 'MaTH' => 1, 'MoTa' => 'Giày Nike Air Force 1 huyền thoại, phong cách classic. Đế cao su bền bỉ, upper da cao cấp.', 'TrangThai' => 1, 'NoiBat' => 1],
            ['TenSP' => 'Adidas Ultraboost 22', 'slug' => 'adidas-ultraboost-22', 'MaDM' => 1, 'MaTH' => 2, 'MoTa' => 'Giày chạy bộ Adidas Ultraboost 22 với công nghệ Boost trả lại năng lượng. Primeknit+ ôm chân hoàn hảo.', 'TrangThai' => 1, 'NoiBat' => 1],
            ['TenSP' => 'Adidas Stan Smith', 'slug' => 'adidas-stan-smith', 'MaDM' => 1, 'MaTH' => 2, 'MoTa' => 'Giày Adidas Stan Smith kinh điển, thiết kế tối giản. Da cao cấp, đế cupsole bền bỉ.', 'TrangThai' => 1, 'NoiBat' => 0],
            ['TenSP' => 'Puma RS-X', 'slug' => 'puma-rs-x', 'MaDM' => 1, 'MaTH' => 3, 'MoTa' => 'Giày Puma RS-X phong cách retro-futuristic. Đệm Running System êm ái, thiết kế chunky thời thượng.', 'TrangThai' => 1, 'NoiBat' => 0],
            ['TenSP' => 'New Balance 574', 'slug' => 'new-balance-574', 'MaDM' => 1, 'MaTH' => 5, 'MoTa' => 'Giày New Balance 574 classic với công nghệ ENCAP. Phong cách retro, êm ái suốt ngày dài.', 'TrangThai' => 1, 'NoiBat' => 0],
            ['TenSP' => 'Asics Gel-Kayano 29', 'slug' => 'asics-gel-kayano-29', 'MaDM' => 1, 'MaTH' => 7, 'MoTa' => 'Giày chạy bộ Asics Gel-Kayano 29 với công nghệ GEL và FF BLAST+. Hỗ trợ tối đa cho người chạy.', 'TrangThai' => 1, 'NoiBat' => 1],

            // Áo thể thao (MaDM = 2)
            ['TenSP' => 'Áo Nike Dri-FIT', 'slug' => 'ao-nike-dri-fit', 'MaDM' => 2, 'MaTH' => 1, 'MoTa' => 'Áo thể thao Nike Dri-FIT công nghệ thấm hút mồ hôi. Chất liệu nhẹ, thoáng khí, phù hợp mọi hoạt động thể thao.', 'TrangThai' => 1, 'NoiBat' => 1],
            ['TenSP' => 'Áo Adidas Climalite', 'slug' => 'ao-adidas-climalite', 'MaDM' => 2, 'MaTH' => 2, 'MoTa' => 'Áo Adidas Climalite công nghệ thoát mồ hôi. Form regular fit thoải mái, 3 sọc kinh điển.', 'TrangThai' => 1, 'NoiBat' => 0],
            ['TenSP' => 'Áo Under Armour Tech', 'slug' => 'ao-under-armour-tech', 'MaDM' => 2, 'MaTH' => 4, 'MoTa' => 'Áo Under Armour Tech 2.0 với chất liệu UA Tech siêu nhẹ. Khô nhanh, chống khuẩn, thoáng mát.', 'TrangThai' => 1, 'NoiBat' => 1],
            ['TenSP' => 'Áo Puma Training', 'slug' => 'ao-puma-training', 'MaDM' => 2, 'MaTH' => 3, 'MoTa' => 'Áo Puma Training với công nghệ dryCELL. Thiết kế năng động, phù hợp tập gym và chạy bộ.', 'TrangThai' => 1, 'NoiBat' => 0],
            ['TenSP' => 'Áo Nike Pro Compression', 'slug' => 'ao-nike-pro-compression', 'MaDM' => 2, 'MaTH' => 1, 'MoTa' => 'Áo giữ nhiệt Nike Pro với thiết kế bó sát cơ thể. Hỗ trợ cơ bắp, tăng hiệu suất tập luyện.', 'TrangThai' => 1, 'NoiBat' => 0],

            // Quần thể thao (MaDM = 3)
            ['TenSP' => 'Quần Nike Flex', 'slug' => 'quan-nike-flex', 'MaDM' => 3, 'MaTH' => 1, 'MoTa' => 'Quần short Nike Flex với chất liệu co giãn 4 chiều. Túi tiện dụng, thích hợp chạy bộ và tập gym.', 'TrangThai' => 1, 'NoiBat' => 1],
            ['TenSP' => 'Quần Adidas Tiro', 'slug' => 'quan-adidas-tiro', 'MaDM' => 3, 'MaTH' => 2, 'MoTa' => 'Quần dài Adidas Tiro 23 với công nghệ AEROREADY. Form slim fit năng động, 3 sọc đặc trưng.', 'TrangThai' => 1, 'NoiBat' => 1],
            ['TenSP' => 'Quần Under Armour Sportstyle', 'slug' => 'quan-under-armour-sportstyle', 'MaDM' => 3, 'MaTH' => 4, 'MoTa' => 'Quần jogger Under Armour Sportstyle thoải mái. Chất liệu cotton pha polyester, phù hợp mọi hoạt động.', 'TrangThai' => 1, 'NoiBat' => 0],
            ['TenSP' => 'Quần Puma Essentials', 'slug' => 'quan-puma-essentials', 'MaDM' => 3, 'MaTH' => 3, 'MoTa' => 'Quần short Puma Essentials với chất liệu nhẹ, thoáng. Logo Puma nổi bật, phong cách thể thao.', 'TrangThai' => 1, 'NoiBat' => 0],

            // Phụ kiện (MaDM = 4)
            ['TenSP' => 'Balo Nike Brasilia', 'slug' => 'balo-nike-brasilia', 'MaDM' => 4, 'MaTH' => 1, 'MoTa' => 'Balo Nike Brasilia dung tích lớn với nhiều ngăn tiện dụng. Chất liệu bền, chống nước nhẹ.', 'TrangThai' => 1, 'NoiBat' => 1],
            ['TenSP' => 'Túi đeo Adidas Linear', 'slug' => 'tui-deo-adidas-linear', 'MaDM' => 4, 'MaTH' => 2, 'MoTa' => 'Túi đeo chéo Adidas Linear nhỏ gọn. Ngăn chính rộng rãi, quai đeo điều chỉnh được.', 'TrangThai' => 1, 'NoiBat' => 0],
            ['TenSP' => 'Mũ Nike Dri-FIT', 'slug' => 'mu-nike-dri-fit', 'MaDM' => 4, 'MaTH' => 1, 'MoTa' => 'Mũ lưỡi trai Nike Dri-FIT với công nghệ thấm hút mồ hôi. Thiết kế unisex, điều chỉnh được.', 'TrangThai' => 1, 'NoiBat' => 0],
            ['TenSP' => 'Găng tay tập gym Under Armour', 'slug' => 'gang-tay-tap-gym-under-armour', 'MaDM' => 4, 'MaTH' => 4, 'MoTa' => 'Găng tay tập gym Under Armour với lớp đệm bảo vệ lòng bàn tay. Chống trượt, thoáng khí.', 'TrangThai' => 1, 'NoiBat' => 1],

            // Dụng cụ gym (MaDM = 5)
            ['TenSP' => 'Tạ tay Nike 5kg', 'slug' => 'ta-tay-nike-5kg', 'MaDM' => 5, 'MaTH' => 1, 'MoTa' => 'Tạ tay Nike 5kg với lớp phủ vinyl chống trầy. Thiết kế ergonomic, grip chống trượt.', 'TrangThai' => 1, 'NoiBat' => 0],
            ['TenSP' => 'Dây kháng lực Adidas', 'slug' => 'day-khang-luc-adidas', 'MaDM' => 5, 'MaTH' => 2, 'MoTa' => 'Bộ dây kháng lực Adidas 3 mức độ. Latex cao cấp, bền bỉ, kèm túi đựng tiện lợi.', 'TrangThai' => 1, 'NoiBat' => 1],
            ['TenSP' => 'Thảm yoga Puma', 'slug' => 'tham-yoga-puma', 'MaDM' => 5, 'MaTH' => 3, 'MoTa' => 'Thảm yoga Puma 6mm chống trượt. Chất liệu TPE thân thiện môi trường, kèm dây đeo.', 'TrangThai' => 1, 'NoiBat' => 0],
            ['TenSP' => 'Bóng tập Pilates Reebok', 'slug' => 'bong-tap-pilates-reebok', 'MaDM' => 5, 'MaTH' => 6, 'MoTa' => 'Bóng tập Pilates Reebok 65cm chống nổ. PVC cao cấp, bơm tay đi kèm.', 'TrangThai' => 1, 'NoiBat' => 0],

            // Đồ bơi (MaDM = 6)
            ['TenSP' => 'Kính bơi Speedo', 'slug' => 'kinh-boi-speedo', 'MaDM' => 6, 'MaTH' => 8, 'MoTa' => 'Kính bơi Speedo chống sương mù, chống UV. Đệm silicon mềm, dây đeo điều chỉnh.', 'TrangThai' => 1, 'NoiBat' => 1],
            ['TenSP' => 'Mũ bơi Adidas Silicone', 'slug' => 'mu-boi-adidas-silicone', 'MaDM' => 6, 'MaTH' => 2, 'MoTa' => 'Mũ bơi Adidas silicone cao cấp. Ôm đầu thoải mái, bảo vệ tóc khỏi clo.', 'TrangThai' => 1, 'NoiBat' => 0],
        ];
        DB::table('sanpham')->insert($sanPhams);

        // ==================== 5. BIẾN THỂ SẢN PHẨM ====================
        $bienThes = [];

        // Giày (size 38-44)
        for ($sp = 1; $sp <= 7; $sp++) {
            for ($kt = 6; $kt <= 12; $kt++) { // MaKT 6-12 là size giày
                $bienThes[] = [
                    'MaSP' => $sp,
                    'MaKT' => $kt,
                    'GiaGoc' => rand(15, 45) * 100000,
                    'SoLuong' => rand(5, 30),
                    'TrangThai' => 1
                ];
            }
        }

        // Áo (size S-XXL)
        for ($sp = 8; $sp <= 13; $sp++) {
            for ($kt = 1; $kt <= 5; $kt++) { // MaKT 1-5 là S-XXL
                $bienThes[] = [
                    'MaSP' => $sp,
                    'MaKT' => $kt,
                    'GiaGoc' => rand(3, 12) * 100000,
                    'SoLuong' => rand(10, 50),
                    'TrangThai' => 1
                ];
            }
        }

        // Quần (size S-XXL)
        for ($sp = 14; $sp <= 17; $sp++) {
            for ($kt = 1; $kt <= 5; $kt++) {
                $bienThes[] = [
                    'MaSP' => $sp,
                    'MaKT' => $kt,
                    'GiaGoc' => rand(4, 10) * 100000,
                    'SoLuong' => rand(10, 40),
                    'TrangThai' => 1
                ];
            }
        }

        // Phụ kiện (Free Size)
        for ($sp = 18; $sp <= 21; $sp++) {
            $bienThes[] = [
                'MaSP' => $sp,
                'MaKT' => 13, // Free Size
                'GiaGoc' => rand(2, 8) * 100000,
                'SoLuong' => rand(20, 60),
                'TrangThai' => 1
            ];
        }

        // Dụng cụ gym (Free Size)
        for ($sp = 22; $sp <= 25; $sp++) {
            $bienThes[] = [
                'MaSP' => $sp,
                'MaKT' => 13,
                'GiaGoc' => rand(1, 5) * 100000,
                'SoLuong' => rand(15, 40),
                'TrangThai' => 1
            ];
        }

        // Đồ bơi (Free Size)
        for ($sp = 26; $sp <= 27; $sp++) {
            $bienThes[] = [
                'MaSP' => $sp,
                'MaKT' => 13,
                'GiaGoc' => rand(1, 3) * 100000,
                'SoLuong' => rand(20, 50),
                'TrangThai' => 1
            ];
        }

        DB::table('bienthesanpham')->insert($bienThes);

        // ==================== 6. HÌNH ẢNH SẢN PHẨM ====================
        // Gán hình ảnh thật từ các thư mục có sẵn
        $hinhAnhs = [
            // Giày thể thao (SP 1-7) - dùng hình từ img/giay/
            ['MaSP' => 1, 'DuongDan' => 'img/giay/giay_1.jpg'],
            ['MaSP' => 1, 'DuongDan' => 'img/giay/giay_2.jpg'],
            ['MaSP' => 2, 'DuongDan' => 'img/giay/giay_3.jpg'],
            ['MaSP' => 2, 'DuongDan' => 'img/giay/giay_4.jpg'],
            ['MaSP' => 3, 'DuongDan' => 'img/giay/giay_5.jpg'],
            ['MaSP' => 3, 'DuongDan' => 'img/giay/giay_6.jpg'],
            ['MaSP' => 4, 'DuongDan' => 'img/giay/giay_7.jpg'],
            ['MaSP' => 4, 'DuongDan' => 'img/giay/giay_8.jpg'],
            ['MaSP' => 5, 'DuongDan' => 'img/giay/giay_9.jpg'],
            ['MaSP' => 5, 'DuongDan' => 'img/giay/giay_10.jpg'],
            ['MaSP' => 6, 'DuongDan' => 'img/giay/giay_11.jpg'],
            ['MaSP' => 6, 'DuongDan' => 'img/giay/giay_12.jpg'],
            ['MaSP' => 7, 'DuongDan' => 'img/giay/giay_13.jpg'],
            ['MaSP' => 7, 'DuongDan' => 'img/giay/giay_1.jpg'],

            // Áo thể thao (SP 8-13) - dùng hình từ img/ao/
            ['MaSP' => 8, 'DuongDan' => 'img/ao/ao_1.jpg'],
            ['MaSP' => 8, 'DuongDan' => 'img/ao/ao_2.jpg'],
            ['MaSP' => 9, 'DuongDan' => 'img/ao/ao_3.jpg'],
            ['MaSP' => 9, 'DuongDan' => 'img/ao/ao_4.jpg'],
            ['MaSP' => 10, 'DuongDan' => 'img/ao/ao_5.jpg'],
            ['MaSP' => 10, 'DuongDan' => 'img/ao/ao_6.jpg'],
            ['MaSP' => 11, 'DuongDan' => 'img/ao/ao_7.jpg'],
            ['MaSP' => 11, 'DuongDan' => 'img/ao/ao_8.jpg'],
            ['MaSP' => 12, 'DuongDan' => 'img/ao/ao_9.jpg'],
            ['MaSP' => 12, 'DuongDan' => 'img/ao/ao_10.jpg'],
            ['MaSP' => 13, 'DuongDan' => 'img/ao/ao_11.jpg'],
            ['MaSP' => 13, 'DuongDan' => 'img/ao/ao_12.jpg'],

            // Quần thể thao (SP 14-17) - dùng hình từ img/quan/
            ['MaSP' => 14, 'DuongDan' => 'img/quan/quan_1.jpg'],
            ['MaSP' => 14, 'DuongDan' => 'img/quan/quan_2.jpg'],
            ['MaSP' => 15, 'DuongDan' => 'img/quan/quan_3.jpg'],
            ['MaSP' => 15, 'DuongDan' => 'img/quan/quan_4.jpg'],
            ['MaSP' => 16, 'DuongDan' => 'img/quan/quan_5.jpg'],
            ['MaSP' => 16, 'DuongDan' => 'img/quan/quan_6.jpg'],
            ['MaSP' => 17, 'DuongDan' => 'img/quan/quan_7.jpg'],
            ['MaSP' => 17, 'DuongDan' => 'img/quan/quan_8.jpg'],

            // Phụ kiện (SP 18-21) - dùng hình ao làm placeholder
            ['MaSP' => 18, 'DuongDan' => 'img/ao/ao_13.jpg'],
            ['MaSP' => 18, 'DuongDan' => 'img/ao/ao_14.jpg'],
            ['MaSP' => 19, 'DuongDan' => 'img/ao/ao_15.jpg'],
            ['MaSP' => 19, 'DuongDan' => 'img/ao/ao_16.jpg'],
            ['MaSP' => 20, 'DuongDan' => 'img/ao/ao_17.jpg'],
            ['MaSP' => 20, 'DuongDan' => 'img/ao/ao_18.jpg'],
            ['MaSP' => 21, 'DuongDan' => 'img/quan/quan_9.jpg'],
            ['MaSP' => 21, 'DuongDan' => 'img/quan/quan_10.jpg'],

            // Dụng cụ gym (SP 22-25) - dùng hình quần làm placeholder
            ['MaSP' => 22, 'DuongDan' => 'img/quan/quan_11.jpg'],
            ['MaSP' => 22, 'DuongDan' => 'img/quan/quan_12.jpg'],
            ['MaSP' => 23, 'DuongDan' => 'img/quan/quan_13.jpg'],
            ['MaSP' => 23, 'DuongDan' => 'img/quan/quan_14.jpg'],
            ['MaSP' => 24, 'DuongDan' => 'img/quan/quan_15.jpg'],
            ['MaSP' => 24, 'DuongDan' => 'img/quan/quan_16.jpg'],
            ['MaSP' => 25, 'DuongDan' => 'img/quan/quan_17.jpg'],
            ['MaSP' => 25, 'DuongDan' => 'img/quan/quan_1.jpg'],

            // Đồ bơi (SP 26-27) - dùng hình giày làm placeholder
            ['MaSP' => 26, 'DuongDan' => 'img/giay/giay_1.jpg'],
            ['MaSP' => 26, 'DuongDan' => 'img/giay/giay_2.jpg'],
            ['MaSP' => 27, 'DuongDan' => 'img/giay/giay_3.jpg'],
            ['MaSP' => 27, 'DuongDan' => 'img/giay/giay_4.jpg'],
        ];
        DB::table('hinhanhsanpham')->insert($hinhAnhs);

        // ==================== 7. NHÀ QUẢN LÝ ====================
        DB::table('nhaquanly')->insert([
            [
                'HoTen' => 'Nguyễn Văn Hiếu Nghĩa',
                'Email' => 'nghia@gmail.com',
                'MatKhau' => Hash::make('123456'),
                'DiaChi' => '123 Nguyễn Huệ, Quận 1, TP.HCM',
                'SDT' => '0901234567',
                'NgaySinh' => '1990-05-15',
                'VaiTro' => 1,
                'TrangThai' => 1
            ],
            [
                'HoTen' => 'Trần Thị Quản Lý',
                'Email' => 'manager@sportstore.vn',
                'MatKhau' => Hash::make('123456'),
                'DiaChi' => '456 Lê Lợi, Quận 3, TP.HCM',
                'SDT' => '0912345678',
                'NgaySinh' => '1992-08-20',
                'VaiTro' => 2,
                'TrangThai' => 1
            ]
        ]);

        // ==================== 8. KHÁCH HÀNG ====================
        DB::table('khachhang')->insert([
            [
                'HoTen' => 'Nguyễn Văn An',
                'Email' => 'nguyenvanan@gmail.com',
                'MatKhau' => Hash::make('123456'),
                'DiaChi' => '789 Cách Mạng Tháng 8, Quận 10, TP.HCM',
                'SDT' => '0923456789',
                'NgaySinh' => '1995-03-10',
                'GioiTinh' => 1,
                'TrangThai' => 1
            ],
            [
                'HoTen' => 'Trần Thị Bình',
                'Email' => 'tranthibinh@gmail.com',
                'MatKhau' => Hash::make('123456'),
                'DiaChi' => '321 Hai Bà Trưng, Quận 1, TP.HCM',
                'SDT' => '0934567890',
                'NgaySinh' => '1998-07-25',
                'GioiTinh' => 0,
                'TrangThai' => 1
            ],
            [
                'HoTen' => 'Lê Minh Cường',
                'Email' => 'leminhcuong@gmail.com',
                'MatKhau' => Hash::make('123456'),
                'DiaChi' => '555 Nguyễn Thị Minh Khai, Quận 3, TP.HCM',
                'SDT' => '0945678901',
                'NgaySinh' => '1993-12-05',
                'GioiTinh' => 1,
                'TrangThai' => 1
            ],
            [
                'HoTen' => 'Phạm Thị Dung',
                'Email' => 'phamthidung@gmail.com',
                'MatKhau' => Hash::make('123456'),
                'DiaChi' => '777 Võ Văn Tần, Quận 3, TP.HCM',
                'SDT' => '0956789012',
                'NgaySinh' => '1997-09-18',
                'GioiTinh' => 0,
                'TrangThai' => 1
            ],
            [
                'HoTen' => 'Hoàng Văn Em',
                'Email' => 'hoangvanem@gmail.com',
                'MatKhau' => Hash::make('123456'),
                'DiaChi' => '999 Điện Biên Phủ, Bình Thạnh, TP.HCM',
                'SDT' => '0967890123',
                'NgaySinh' => '2000-01-30',
                'GioiTinh' => 1,
                'TrangThai' => 1
            ]
        ]);

        // ==================== 9. NHÀ CUNG CẤP ====================
        DB::table('nhacungcap')->insert([
            [
                'TenNCC' => 'Công ty TNHH Nike Việt Nam',
                'DiaChi' => 'Tầng 10, Tòa nhà Bitexco, Quận 1, TP.HCM',
                'SDT' => '02838123456',
                'Email' => 'contact@nike.vn',
                'TrangThai' => 1
            ],
            [
                'TenNCC' => 'Công ty TNHH Adidas Việt Nam',
                'DiaChi' => 'Tầng 5, Vincom Center, Quận 1, TP.HCM',
                'SDT' => '02838234567',
                'Email' => 'info@adidas.vn',
                'TrangThai' => 1
            ],
            [
                'TenNCC' => 'Công ty CP Thể Thao Puma Đông Nam Á',
                'DiaChi' => '123 Nguyễn Văn Trỗi, Phú Nhuận, TP.HCM',
                'SDT' => '02838345678',
                'Email' => 'puma.sea@puma.com',
                'TrangThai' => 1
            ]
        ]);

        // ==================== 10. KHUYẾN MÃI ====================
        DB::table('khuyenmai')->insert([
            [
                'TenKM' => 'Khuyến mãi Tết 2026',
                'PhanTramGiam' => 20,
                'NgayBatDau' => '2026-01-15',
                'NgayKetThuc' => '2026-02-15',
                'TrangThai' => 1
            ],
            [
                'TenKM' => 'Flash Sale cuối tuần',
                'PhanTramGiam' => 15,
                'NgayBatDau' => '2026-01-20',
                'NgayKetThuc' => '2026-01-25',
                'TrangThai' => 1
            ],
            [
                'TenKM' => 'Ưu đãi thành viên mới',
                'PhanTramGiam' => 10,
                'NgayBatDau' => '2026-01-01',
                'NgayKetThuc' => '2026-12-31',
                'TrangThai' => 1
            ]
        ]);

        // ==================== 11. SẢN PHẨM KHUYẾN MÃI ====================
        DB::table('sanphamkhuyenmai')->insert([
            ['MaSP' => 1, 'MaKM' => 1],
            ['MaSP' => 2, 'MaKM' => 1],
            ['MaSP' => 3, 'MaKM' => 1],
            ['MaSP' => 8, 'MaKM' => 2],
            ['MaSP' => 9, 'MaKM' => 2],
            ['MaSP' => 14, 'MaKM' => 2],
        ]);

        // ==================== 12. ĐƠN HÀNG ====================
        DB::table('donhang')->insert([
            ['MaKH' => 1, 'NgayDat' => '2026-01-15 10:30:00', 'TrangThai' => 2],
            ['MaKH' => 2, 'NgayDat' => '2026-01-16 14:20:00', 'TrangThai' => 1],
            ['MaKH' => 3, 'NgayDat' => '2026-01-17 09:15:00', 'TrangThai' => 0],
            ['MaKH' => 1, 'NgayDat' => '2026-01-18 16:45:00', 'TrangThai' => 2],
            ['MaKH' => 4, 'NgayDat' => '2026-01-19 11:00:00', 'TrangThai' => 1],
        ]);

        // ==================== 13. CHI TIẾT ĐƠN HÀNG ====================
        DB::table('chitietdonhang')->insert([
            ['MaDH' => 1, 'MaBT' => 1, 'SoLuong' => 1],
            ['MaDH' => 1, 'MaBT' => 50, 'SoLuong' => 2],
            ['MaDH' => 2, 'MaBT' => 15, 'SoLuong' => 1],
            ['MaDH' => 2, 'MaBT' => 60, 'SoLuong' => 1],
            ['MaDH' => 3, 'MaBT' => 8, 'SoLuong' => 1],
            ['MaDH' => 4, 'MaBT' => 3, 'SoLuong' => 1],
            ['MaDH' => 4, 'MaBT' => 55, 'SoLuong' => 2],
            ['MaDH' => 5, 'MaBT' => 22, 'SoLuong' => 1],
        ]);

        // ==================== 14. HÓA ĐƠN ====================
        DB::table('hoadon')->insert([
            ['MaDH' => 1, 'NgayLap' => '2026-01-15 10:35:00', 'TongTien' => 3500000],
            ['MaDH' => 4, 'NgayLap' => '2026-01-18 16:50:00', 'TongTien' => 4200000],
        ]);

        // ==================== 15. CHI TIẾT HÓA ĐƠN ====================
        DB::table('chitiethoadon')->insert([
            ['MaHD' => 1, 'MaBT' => 1, 'SoLuong' => 1, 'DonGia' => 2500000],
            ['MaHD' => 1, 'MaBT' => 50, 'SoLuong' => 2, 'DonGia' => 500000],
            ['MaHD' => 2, 'MaBT' => 3, 'SoLuong' => 1, 'DonGia' => 3200000],
            ['MaHD' => 2, 'MaBT' => 55, 'SoLuong' => 2, 'DonGia' => 500000],
        ]);

        // ==================== 16. ĐÁNH GIÁ ====================
        DB::table('danhgia')->insert([
            ['MaKH' => 1, 'MaSP' => 1, 'SoSao' => 5, 'NoiDung' => 'Giày rất đẹp, đi êm chân. Giao hàng nhanh, đóng gói cẩn thận. Sẽ ủng hộ shop dài dài!', 'NgayDanhGia' => '2026-01-16 08:00:00'],
            ['MaKH' => 2, 'MaSP' => 3, 'SoSao' => 4, 'NoiDung' => 'Chất lượng tốt, đúng mô tả. Chỉ tiếc là size hơi nhỏ so với bình thường.', 'NgayDanhGia' => '2026-01-17 15:30:00'],
            ['MaKH' => 3, 'MaSP' => 8, 'SoSao' => 5, 'NoiDung' => 'Áo mặc rất thoáng mát, chất vải mềm mịn. Tập gym cả buổi mà không bị ướt mồ hôi.', 'NgayDanhGia' => '2026-01-18 10:00:00'],
            ['MaKH' => 4, 'MaSP' => 14, 'SoSao' => 4, 'NoiDung' => 'Quần đẹp, form chuẩn. Chất co giãn tốt. Giao hàng hơi chậm một chút.', 'NgayDanhGia' => '2026-01-19 14:00:00'],
            ['MaKH' => 5, 'MaSP' => 18, 'SoSao' => 5, 'NoiDung' => 'Balo chắc chắn, nhiều ngăn tiện lợi. Đựng được cả laptop 15 inch. Rất hài lòng!', 'NgayDanhGia' => '2026-01-20 09:30:00'],
        ]);

        // ==================== 17. THÔNG TIN CÔNG TY ====================
        DB::table('company_infos')->insert([
            'name' => 'Công ty TNHH SportStore Việt Nam',
            'description' => 'SportStore là hệ thống cửa hàng thể thao hàng đầu Việt Nam, chuyên cung cấp các sản phẩm thể thao chính hãng từ các thương hiệu nổi tiếng thế giới như Nike, Adidas, Puma, Under Armour...',
            'address' => '123 Nguyễn Huệ, Phường Bến Nghé, Quận 1, TP. Hồ Chí Minh',
            'hotline' => '1900 1234 56',
            'email' => 'support@sportstore.vn',
            'tax_code' => '0123456789',
            'opening_hours' => '8:00 - 22:00 (Thứ 2 - Chủ nhật)',
            'vision' => 'Trở thành hệ thống bán lẻ thể thao số 1 Việt Nam, mang đến cho khách hàng những sản phẩm chất lượng nhất với dịch vụ tốt nhất.',
            'mission' => 'Khuyến khích lối sống năng động, khỏe mạnh thông qua việc cung cấp các sản phẩm thể thao chất lượng cao với giá cả hợp lý.',
            'employee_count' => 150,
            'facebook_url' => 'https://facebook.com/sportstore.vn',
            'instagram_url' => 'https://instagram.com/sportstore.vn',
            'youtube_url' => 'https://youtube.com/sportstore',
            'zalo_phone' => '0901234567',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // ==================== 18. CÂU HỎI THƯỜNG GẶP ====================
        DB::table('company_faqs')->insert([
            ['question' => 'Làm thế nào để kiểm tra hàng chính hãng?', 'answer' => 'Tất cả sản phẩm tại SportStore đều có tem chống hàng giả, mã QR code để kiểm tra và hóa đơn VAT đầy đủ. Quý khách có thể kiểm tra trực tiếp trên website của hãng.', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Chính sách đổi trả như thế nào?', 'answer' => 'SportStore hỗ trợ đổi trả trong vòng 30 ngày với điều kiện sản phẩm còn nguyên tem mác, chưa qua sử dụng. Riêng sản phẩm lỗi do nhà sản xuất sẽ được đổi mới 100%.', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Thời gian giao hàng mất bao lâu?', 'answer' => 'Nội thành TP.HCM: 1-2 ngày. Các tỉnh thành khác: 3-5 ngày. Đơn hàng trên 500.000đ được miễn phí vận chuyển toàn quốc.', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Tôi có thể thanh toán bằng những hình thức nào?', 'answer' => 'SportStore hỗ trợ thanh toán COD (nhận hàng trả tiền), chuyển khoản ngân hàng, ví điện tử (MoMo, ZaloPay, VNPay) và thẻ tín dụng/ghi nợ quốc tế.', 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ==================== 19. CHÍNH SÁCH ====================
        DB::table('company_policies')->insert([
            ['type' => 'shipping', 'title' => 'Chính sách giao hàng', 'content' => 'Miễn phí vận chuyển cho đơn hàng từ 500.000đ. Giao hàng nhanh trong 24h với nội thành. Đóng gói cẩn thận, an toàn.', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'return', 'title' => 'Chính sách đổi trả', 'content' => 'Đổi trả miễn phí trong 30 ngày. Hoàn tiền 100% nếu sản phẩm lỗi từ nhà sản xuất. Hỗ trợ đổi size miễn phí 1 lần.', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'warranty', 'title' => 'Chính sách bảo hành', 'content' => 'Bảo hành 6 tháng cho giày thể thao, 3 tháng cho quần áo. Bảo hành không áp dụng với lỗi do người dùng.', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'privacy', 'title' => 'Chính sách bảo mật', 'content' => 'Cam kết bảo mật thông tin khách hàng tuyệt đối. Không chia sẻ thông tin cho bên thứ ba. Mã hóa dữ liệu thanh toán.', 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ==================== 20. DANH MỤC BLOG ====================
        DB::table('blog_categories')->insert([
            ['TenDanhMuc' => 'Tin tức thể thao', 'slug' => 'tin-tuc-the-thao', 'MoTa' => 'Cập nhật tin tức thể thao mới nhất', 'TrangThai' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['TenDanhMuc' => 'Hướng dẫn tập luyện', 'slug' => 'huong-dan-tap-luyen', 'MoTa' => 'Các bài tập và kỹ thuật tập luyện', 'TrangThai' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['TenDanhMuc' => 'Review sản phẩm', 'slug' => 'review-san-pham', 'MoTa' => 'Đánh giá chi tiết các sản phẩm', 'TrangThai' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['TenDanhMuc' => 'Khuyến mãi', 'slug' => 'khuyen-mai', 'MoTa' => 'Thông tin khuyến mãi và ưu đãi', 'TrangThai' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ==================== 21. BÀI VIẾT ====================
        DB::table('baiviet')->insert([
            [
                'TieuDe' => 'Top 5 đôi giày chạy bộ tốt nhất 2026',
                'slug' => 'top-5-doi-giay-chay-bo-tot-nhat-2026',
                'NoiDung' => 'Giày chạy bộ là trang bị quan trọng nhất cho mọi runner. Trong bài viết này, chúng tôi sẽ giới thiệu top 5 đôi giày chạy bộ được đánh giá cao nhất năm 2026...\n\n1. Nike Air Zoom Pegasus 40\n2. Adidas Ultraboost 23\n3. Asics Gel-Nimbus 25\n4. New Balance Fresh Foam 1080v13\n5. Brooks Ghost 15',
                'HinhAnh' => 'img/giay/giay_1.jpg',
                'TomTat' => 'Khám phá top 5 đôi giày chạy bộ được các runner đánh giá cao nhất năm 2026',
                'MaDanhMuc' => 3,
                'NguoiTao' => 1,
                'LuotXem' => 1250,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-10 09:00:00',
                'NgayCapNhat' => '2026-01-10 09:00:00'
            ],
            [
                'TieuDe' => 'Hướng dẫn tập gym cho người mới bắt đầu',
                'slug' => 'huong-dan-tap-gym-cho-nguoi-moi-bat-dau',
                'NoiDung' => 'Bắt đầu tập gym có thể khiến nhiều người cảm thấy bỡ ngỡ. Dưới đây là hướng dẫn chi tiết giúp bạn có một khởi đầu suôn sẻ...\n\nTuần 1-2: Làm quen với các bài tập cơ bản\nTuần 3-4: Tăng dần cường độ\nTuần 5-8: Xây dựng chương trình tập riêng',
                'HinhAnh' => 'img/ao/ao_1.jpg',
                'TomTat' => 'Hướng dẫn từng bước cho người mới bắt đầu hành trình tập gym',
                'MaDanhMuc' => 2,
                'NguoiTao' => 1,
                'LuotXem' => 2340,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-12 14:30:00',
                'NgayCapNhat' => '2026-01-12 14:30:00'
            ],
            [
                'TieuDe' => 'Flash Sale cuối tuần - Giảm đến 50%',
                'slug' => 'flash-sale-cuoi-tuan-giam-den-50',
                'NoiDung' => 'Chương trình Flash Sale cuối tuần với hàng ngàn sản phẩm giảm giá đến 50%. Áp dụng từ thứ 6 đến Chủ nhật hàng tuần.\n\nCác sản phẩm hot:\n- Giày Nike Air Max: Giảm 40%\n- Áo Adidas Climalite: Giảm 35%\n- Quần Under Armour: Giảm 30%',
                'HinhAnh' => 'img/quan/quan_1.jpg',
                'TomTat' => 'Đừng bỏ lỡ cơ hội sở hữu đồ thể thao chính hãng với giá cực sốc',
                'MaDanhMuc' => 4,
                'NguoiTao' => 1,
                'LuotXem' => 5680,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-18 08:00:00',
                'NgayCapNhat' => '2026-01-18 08:00:00'
            ],
            [
                'TieuDe' => 'So sánh Nike Air Max vs Adidas Ultraboost - Đâu là lựa chọn tốt hơn?',
                'slug' => 'so-sanh-nike-air-max-vs-adidas-ultraboost',
                'NoiDung' => 'Nike Air Max và Adidas Ultraboost là hai dòng giày thể thao được yêu thích nhất hiện nay. Hãy cùng so sánh chi tiết để tìm ra đôi giày phù hợp với bạn.\n\n**Nike Air Max:**\n- Công nghệ đệm Air Max nổi tiếng\n- Thiết kế bắt mắt, nhiều màu sắc\n- Giá từ 3.500.000đ\n\n**Adidas Ultraboost:**\n- Công nghệ Boost trả lại năng lượng\n- Upper Primeknit ôm chân\n- Giá từ 4.200.000đ\n\n**Kết luận:** Nếu bạn thích style đường phố, chọn Air Max. Nếu bạn cần giày chạy bộ chuyên nghiệp, Ultraboost là lựa chọn tốt hơn.',
                'HinhAnh' => 'img/giay/giay_2.jpg',
                'TomTat' => 'Đánh giá chi tiết và so sánh hai dòng giày thể thao hot nhất: Nike Air Max và Adidas Ultraboost',
                'MaDanhMuc' => 3,
                'NguoiTao' => 1,
                'LuotXem' => 3420,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-08 10:00:00',
                'NgayCapNhat' => '2026-01-08 10:00:00'
            ],
            [
                'TieuDe' => '10 bài tập cardio đốt mỡ hiệu quả tại nhà',
                'slug' => '10-bai-tap-cardio-dot-mo-hieu-qua-tai-nha',
                'NoiDung' => 'Không cần đến phòng gym, bạn vẫn có thể đốt cháy calories hiệu quả với 10 bài tập cardio sau:\n\n1. Jumping Jacks - 3 phút\n2. High Knees - 2 phút\n3. Burpees - 10 lần x 3 hiệp\n4. Mountain Climbers - 1 phút\n5. Jump Squats - 15 lần x 3 hiệp\n6. Lunges - 12 lần mỗi chân\n7. Plank Jacks - 1 phút\n8. Box Jumps - 10 lần x 3 hiệp\n9. Jump Rope - 3 phút\n10. Sprint tại chỗ - 30 giây x 5 hiệp\n\nThực hiện đều đặn 4-5 lần/tuần để có kết quả tốt nhất!',
                'HinhAnh' => 'img/ao/ao_2.jpg',
                'TomTat' => 'Tổng hợp 10 bài tập cardio đơn giản, hiệu quả có thể thực hiện tại nhà không cần dụng cụ',
                'MaDanhMuc' => 2,
                'NguoiTao' => 1,
                'LuotXem' => 4560,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-05 08:30:00',
                'NgayCapNhat' => '2026-01-05 08:30:00'
            ],
            [
                'TieuDe' => 'Cách chọn size giày thể thao chuẩn nhất',
                'slug' => 'cach-chon-size-giay-the-thao-chuan-nhat',
                'NoiDung' => 'Chọn đúng size giày là yếu tố quan trọng để đảm bảo sự thoải mái và tránh chấn thương.\n\n**Cách đo chân:**\n1. Đo vào buổi chiều (chân nở ra sau một ngày hoạt động)\n2. Đứng thẳng khi đo\n3. Đo cả chiều dài và chiều rộng\n\n**Bảng quy đổi size:**\n- 38 EU = 24cm\n- 39 EU = 24.5cm\n- 40 EU = 25cm\n- 41 EU = 25.5cm\n- 42 EU = 26cm\n- 43 EU = 27cm\n- 44 EU = 28cm\n\n**Lưu ý:** Nên chọn size lớn hơn 0.5-1cm so với chiều dài chân thực tế.',
                'HinhAnh' => 'img/giay/giay_3.jpg',
                'TomTat' => 'Hướng dẫn chi tiết cách đo chân và chọn size giày thể thao phù hợp',
                'MaDanhMuc' => 2,
                'NguoiTao' => 1,
                'LuotXem' => 2890,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-03 11:00:00',
                'NgayCapNhat' => '2026-01-03 11:00:00'
            ],
            [
                'TieuDe' => 'Review áo Under Armour Tech 2.0 - Đáng mua hay không?',
                'slug' => 'review-ao-under-armour-tech-2-0',
                'NoiDung' => 'Under Armour Tech 2.0 là một trong những mẫu áo tập gym được yêu thích nhất. Hãy cùng đánh giá chi tiết sản phẩm này.\n\n**Ưu điểm:**\n- Chất liệu UA Tech siêu nhẹ, thoáng khí\n- Khô nhanh, chống khuẩn\n- Form áo vừa vặn, không gò bó\n- Nhiều màu sắc lựa chọn\n\n**Nhược điểm:**\n- Giá cao hơn các hãng khác\n- Size có thể hơi nhỏ so với size Việt Nam\n\n**Đánh giá:** 4.5/5 sao\n**Giá:** 890.000đ\n\n**Kết luận:** Đáng mua nếu bạn tập gym thường xuyên và cần áo chất lượng cao.',
                'HinhAnh' => 'img/ao/ao_3.jpg',
                'TomTat' => 'Đánh giá chi tiết áo tập gym Under Armour Tech 2.0 sau 3 tháng sử dụng',
                'MaDanhMuc' => 3,
                'NguoiTao' => 1,
                'LuotXem' => 1870,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-15 09:00:00',
                'NgayCapNhat' => '2026-01-15 09:00:00'
            ],
            [
                'TieuDe' => 'Chế độ dinh dưỡng cho người tập gym tăng cơ',
                'slug' => 'che-do-dinh-duong-cho-nguoi-tap-gym-tang-co',
                'NoiDung' => 'Dinh dưỡng chiếm 70% thành công trong việc tăng cơ. Dưới đây là hướng dẫn chi tiết:\n\n**Nguyên tắc cơ bản:**\n- Protein: 1.6-2.2g/kg cân nặng/ngày\n- Carbs: 4-6g/kg cân nặng/ngày\n- Fat: 0.5-1g/kg cân nặng/ngày\n\n**Thực đơn mẫu:**\n- Sáng: Trứng, yến mạch, chuối\n- Trưa: Ức gà, cơm gạo lứt, rau xanh\n- Chiều (trước tập): Bánh mì, bơ đậu phộng\n- Tối (sau tập): Cá hồi, khoai lang, salad\n\n**Supplement gợi ý:**\n- Whey Protein\n- Creatine\n- BCAA',
                'HinhAnh' => 'img/ao/ao_4.jpg',
                'TomTat' => 'Hướng dẫn chế độ dinh dưỡng khoa học cho người tập gym muốn tăng cơ giảm mỡ',
                'MaDanhMuc' => 2,
                'NguoiTao' => 1,
                'LuotXem' => 6230,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-07 14:00:00',
                'NgayCapNhat' => '2026-01-07 14:00:00'
            ],
            [
                'TieuDe' => 'Mua 1 tặng 1 - Ưu đãi đặc biệt tháng 1',
                'slug' => 'mua-1-tang-1-uu-dai-dac-biet-thang-1',
                'NoiDung' => 'Chương trình khuyến mãi đặc biệt chào mừng năm mới 2026!\n\n**Thời gian:** 01/01 - 31/01/2026\n\n**Ưu đãi:**\n- Mua 1 đôi giày tặng 1 đôi tất thể thao\n- Mua 2 áo giảm 20% tổng bill\n- Mua 3 sản phẩm bất kỳ giảm 25%\n- Freeship cho đơn từ 500.000đ\n\n**Sản phẩm áp dụng:**\n- Tất cả giày Nike, Adidas, Puma\n- Áo thể thao các loại\n- Quần short, quần dài\n\n**Lưu ý:** Không áp dụng cùng các khuyến mãi khác.',
                'HinhAnh' => 'img/quan/quan_2.jpg',
                'TomTat' => 'Chương trình khuyến mãi Mua 1 Tặng 1 và giảm giá đến 25% trong tháng 1/2026',
                'MaDanhMuc' => 4,
                'NguoiTao' => 1,
                'LuotXem' => 8920,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-01 00:00:00',
                'NgayCapNhat' => '2026-01-01 00:00:00'
            ],
            [
                'TieuDe' => 'Bí quyết bảo quản giày thể thao đúng cách',
                'slug' => 'bi-quyet-bao-quan-giay-the-thao-dung-cach',
                'NoiDung' => 'Giày thể thao là khoản đầu tư không nhỏ. Hãy bảo quản đúng cách để kéo dài tuổi thọ.\n\n**Vệ sinh thường xuyên:**\n- Dùng bàn chải mềm chải bụi bẩn\n- Lau bằng khăn ẩm với nước xà phòng loãng\n- Không ngâm giày trong nước\n\n**Phơi khô đúng cách:**\n- Phơi ở nơi thoáng mát, tránh ánh nắng trực tiếp\n- Nhét giấy báo vào giày để hút ẩm\n- Không dùng máy sấy\n\n**Bảo quản:**\n- Để giày trong hộp hoặc túi vải\n- Sử dụng gói hút ẩm\n- Xoay vòng giày để giày có thời gian nghỉ\n\n**Mẹo hay:** Dùng baking soda để khử mùi hôi giày hiệu quả.',
                'HinhAnh' => 'img/giay/giay_4.jpg',
                'TomTat' => 'Hướng dẫn cách vệ sinh và bảo quản giày thể thao để luôn như mới',
                'MaDanhMuc' => 2,
                'NguoiTao' => 1,
                'LuotXem' => 3150,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-13 16:00:00',
                'NgayCapNhat' => '2026-01-13 16:00:00'
            ],
            [
                'TieuDe' => 'Top 7 thương hiệu giày thể thao tốt nhất thế giới',
                'slug' => 'top-7-thuong-hieu-giay-the-thao-tot-nhat-the-gioi',
                'NoiDung' => 'Điểm qua 7 thương hiệu giày thể thao được yêu thích nhất toàn cầu:\n\n**1. Nike (Mỹ)**\nThương hiệu số 1 thế giới với công nghệ Air, Zoom, React.\n\n**2. Adidas (Đức)**\nNổi tiếng với Boost, Primeknit và thiết kế 3 sọc kinh điển.\n\n**3. Puma (Đức)**\nPhong cách thể thao pha streetwear độc đáo.\n\n**4. New Balance (Mỹ)**\nGiày chạy bộ chất lượng, "Made in USA".\n\n**5. Asics (Nhật)**\nChuyên gia giày chạy bộ với công nghệ GEL.\n\n**6. Under Armour (Mỹ)**\nThương hiệu trẻ với công nghệ HOVR.\n\n**7. Reebok (Mỹ)**\nTiên phong trong fitness và CrossFit.',
                'HinhAnh' => 'img/giay/giay_5.jpg',
                'TomTat' => 'Điểm danh 7 thương hiệu giày thể thao hàng đầu thế giới và đặc điểm nổi bật',
                'MaDanhMuc' => 1,
                'NguoiTao' => 1,
                'LuotXem' => 4780,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-16 10:30:00',
                'NgayCapNhat' => '2026-01-16 10:30:00'
            ],
            [
                'TieuDe' => 'Lịch tập gym 5 ngày cho người bận rộn',
                'slug' => 'lich-tap-gym-5-ngay-cho-nguoi-ban-ron',
                'NoiDung' => 'Lịch tập tối ưu cho người đi làm văn phòng:\n\n**Thứ 2 - Ngực + Vai:**\n- Bench Press: 4x10\n- Incline Dumbbell Press: 3x12\n- Shoulder Press: 4x10\n- Lateral Raise: 3x15\n\n**Thứ 3 - Lưng + Tay sau:**\n- Deadlift: 4x8\n- Lat Pulldown: 4x12\n- Barbell Row: 3x10\n- Tricep Pushdown: 3x15\n\n**Thứ 4 - Nghỉ hoặc Cardio nhẹ**\n\n**Thứ 5 - Chân:**\n- Squat: 4x10\n- Leg Press: 4x12\n- Leg Curl: 3x15\n- Calf Raise: 4x20\n\n**Thứ 6 - Tay trước + Bụng:**\n- Barbell Curl: 4x12\n- Hammer Curl: 3x15\n- Plank: 3x60s\n- Crunches: 3x20\n\n**Thứ 7-CN:** Nghỉ ngơi, phục hồi.',
                'HinhAnh' => 'img/ao/ao_5.jpg',
                'TomTat' => 'Lịch tập gym khoa học 5 ngày/tuần dành cho dân văn phòng bận rộn',
                'MaDanhMuc' => 2,
                'NguoiTao' => 1,
                'LuotXem' => 7340,
                'TrangThai' => 1,
                'NgayTao' => '2026-01-19 08:00:00',
                'NgayCapNhat' => '2026-01-19 08:00:00'
            ],
        ]);

        // ==================== 22. THỐNG KÊ SẢN PHẨM ====================
        $thongKes = [];
        for ($sp = 1; $sp <= 27; $sp++) {
            $thongKes[] = [
                'MaSP' => $sp,
                'LuotXem' => rand(100, 5000),
                'LuotYeuThich' => rand(10, 500)
            ];
        }
        DB::table('thongkesanpham')->insert($thongKes);

        // ==================== 23. THÔNG SỐ SẢN PHẨM ====================
        // Thông số cho giày Nike Air Max 270
        DB::table('thongsosanpham')->insert([
            ['MaSP' => 1, 'TenTS' => 'Chất liệu upper', 'GiaTri' => 'Mesh thoáng khí', 'SapXep' => 1],
            ['MaSP' => 1, 'TenTS' => 'Đế giữa', 'GiaTri' => 'Foam + Air Max', 'SapXep' => 2],
            ['MaSP' => 1, 'TenTS' => 'Đế ngoài', 'GiaTri' => 'Cao su', 'SapXep' => 3],
            ['MaSP' => 1, 'TenTS' => 'Trọng lượng', 'GiaTri' => '310g (size 42)', 'SapXep' => 4],
            ['MaSP' => 1, 'TenTS' => 'Xuất xứ', 'GiaTri' => 'Việt Nam', 'SapXep' => 5],
        ]);

        // Thông số cho áo Nike Dri-FIT
        DB::table('thongsosanpham')->insert([
            ['MaSP' => 8, 'TenTS' => 'Chất liệu', 'GiaTri' => '100% Polyester Dri-FIT', 'SapXep' => 1],
            ['MaSP' => 8, 'TenTS' => 'Công nghệ', 'GiaTri' => 'Dri-FIT thấm hút mồ hôi', 'SapXep' => 2],
            ['MaSP' => 8, 'TenTS' => 'Form áo', 'GiaTri' => 'Regular Fit', 'SapXep' => 3],
            ['MaSP' => 8, 'TenTS' => 'Xuất xứ', 'GiaTri' => 'Việt Nam', 'SapXep' => 4],
        ]);

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
