<?php

namespace Database\Seeders;

use App\Models\BaiViet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baiviet = [
            [
                'TieuDe' => 'Hướng Dẫn Chọn Giày Thể Thao Phù Hợp Với Loại Chân',
                'TomTat' => 'Khám phá cách chọn giày thể thao đúng chuẩn theo hình dáng bàn chân của bạn',
                'NoiDung' => '<h3>Giới Thiệu</h3>
<p>Chọn giày thể thao phù hợp là điều rất quan trọng không chỉ cho hiệu suất tập luyện mà còn cho sức khỏe chân của bạn. Bài viết này sẽ giúp bạn hiểu rõ hơn về các loại bàn chân và cách chọn giày phù hợp.</p>

<h3>Các Loại Bàn Chân</h3>
<p><strong>1. Bàn Chân Bình Thường (Neutral Foot):</strong> Đây là loại bàn chân phổ biến nhất. Nếu bạn có bàn chân này, hãy chọn giày có độ hỗ trợ cân bằng.</p>

<p><strong>2. Bàn Chân Vòng Vào (Overpronation):</strong> Nếu bàn chân bạn vòng vào quá nhiều, hãy chọn giày có công nghệ ổn định và hỗ trợ vòm cao.</p>

<p><strong>3. Bàn Chân Vòng Ra (Supination):</strong> Loại bàn chân này cần giày với đệm êm ái và hỗ trợ ngoài mạnh mẽ.</p>

<h3>Cách Chọn Giày Đúng Cách</h3>
<ul>
<li>Mua giày vào buổi chiều khi bàn chân sưng lên</li>
<li>Chọn giày có khoảng cách khoảng 1 cm từ ngón chân dài nhất đến đầu giày</li>
<li>Thử giày với tất giày thể thao mà bạn dự định mang</li>
<li>Đi bộ hoặc chạy để cảm nhận độ thoải mái</li>
</ul>

<h3>Kết Luận</h3>
<p>Chọn giày thể thao đúng cách sẽ giúp bạn tập luyện hiệu quả hơn và bảo vệ sức khỏe chân. Hãy ghé cửa hàng chúng tôi để được tư vấn chi tiết!</p>',
                'TrangThai' => 1,
                'NguoiTao' => 1,
            ],
            [
                'TieuDe' => '5 Bài Tập Yoga Hiệu Quả Cho Người Bận Rộn',
                'TomTat' => 'Các bài tập yoga đơn giản có thể thực hiện tại nhà trong 15 phút',
                'NoiDung' => '<h3>Yoga Cho Cuộc Sống Hiện Đại</h3>
<p>Yoga là một trong những hình thức tập luyện tốt nhất cho sức khỏe toàn diện. Nếu bạn không có nhiều thời gian, hãy thử các bài tập yoga này.</p>

<h3>5 Bài Tập Yoga Cơ Bản</h3>

<h4>1. Mountain Pose (Tadasana)</h4>
<p>Đứng thẳng, hai chân sát nhau, tay buông tự nhiên. Giữ vị trí này 5 hơi thở.</p>

<h4>2. Downward Dog (Adho Mukha Svanasana)</h4>
<p>Bài tập này giúp giãn cơ lưng và vai. Thực hiện 5-10 lần, mỗi lần khoảng 30 giây.</p>

<h4>3. Child\'s Pose (Balasana)</h4>
<p>Tư thế an toàn giúp thư giãn toàn bộ cơ thể, đặc biệt là lưng.</p>

<h4>4. Warrior I (Virabhadrasana I)</h4>
<p>Bài tập tuyệt vời để tăng cơ bắp chân và độ ổn định.</p>

<h4>5. Tree Pose (Vrksasana)</h4>
<p>Giúp cân bằng và tăng cảm giác thân thể.</p>

<h3>Lợi Ích Của Yoga</h3>
<ul>
<li>Tăng độ linh hoạt</li>
<li>Cải thiện sức khỏe tinh thần</li>
<li>Giảm stress</li>
<li>Tăng sức mạnh cơ thể</li>
</ul>',
                'TrangThai' => 1,
                'NguoiTao' => 1,
            ],
            [
                'TieuDe' => 'Các Loại Quần Áo Thể Thao Theo Môn Thể Thao',
                'TomTat' => 'Tìm hiểu những loại quần áo thể thao phù hợp cho từng môn thể thao khác nhau',
                'NoiDung' => '<h3>Tầm Quan Trọng Của Quần Áo Thể Thao Phù Hợp</h3>
<p>Mặc quần áo thể thao phù hợp với môn thể thao bạn chọn không chỉ giúp bạn cảm thấy thoải mái mà còn cải thiện hiệu suất.</p>

<h3>Quần Áo Cho Các Môn Thể Thao Khác Nhau</h3>

<h4>Chạy Bộ</h4>
<p>Cần áo có độ thoáng khí cao, quần thoải mái, giày chạy bộ chuyên dụng.</p>

<h4>Bơi Lội</h4>
<p>Áo tắm phù hợp kích thước, thoát nước tốt. Nên mặc nón bơi và kính bơi.</p>

<h4>Đạp Xe</h4>
<p>Quần áo đạp xe tight, áo jersey, giày đạp xe có cài chân.</p>

<h4>Yoga</h4>
<p>Quần áo co giãn được, thoải mái, cho phép tự do chuyển động.</p>

<h4>Bóng Chuyền</h4>
<p>Áo tank top, quần short, giày bóng chuyền chuyên dụng với đệm tốt.</p>

<h3>Chất Liệu Quần Áo Thể Thao Tốt</h3>
<ul>
<li>Polyester: Khô nhanh, thoáng khí</li>
<li>Nylon: Bền, co giãn tốt</li>
<li>Spandex: Cho phép chuyển động linh hoạt</li>
<li>Cotton mix: Thoái mái, thoáng khí</li>
</ul>',
                'TrangThai' => 1,
                'NguoiTao' => 1,
            ],
            [
                'TieuDe' => 'Cách Bảo Quản Giày Thể Thao Để Kéo Dài Tuổi Thọ',
                'TomTat' => 'Mẹo bảo quản giày thể thao sao cho giày tồn tại lâu hơn và luôn sạch sẽ',
                'NoiDung' => '<h3>Giới Thiệu</h3>
<p>Giày thể thao là một khoản đầu tư quan trọng. Bảo quản đúng cách sẽ giúp bạn sử dụng lâu hơn và tiết kiệm chi phí.</p>

<h3>Các Bước Bảo Quản Giày Thể Thao</h3>

<h4>1. Vệ Sinh Hàng Ngày</h4>
<p>Sau mỗi lần sử dụng, hãy lau sạch giày bằng khăn ẩm để loại bỏ bụi và mồ hôi.</p>

<h4>2. Phơi Khô Đúng Cách</h4>
<p>Phơi giày ở nơi thoáng khí, tránh ánh nắng trực tiếp hoặc nhiệt độ cao quá.</p>

<h4>3. Sử Dụng Lót Giày</h4>
<p>Lót giày không chỉ thoải mái mà còn giúp hút ẩm và mùi.</p>

<h4>4. Lưu Trữ Đúng Cách</h4>
<p>Để giày ở nơi khô ráo, nhiệt độ phòng, tránh độ ẩm cao.</p>

<h4>5. Sử Dụng Máy Sấy</h4>
<p>Nếu giày ướt, hãy nhồi giấy báo bên trong và để ở nhiệt độ phòng chứ không dùng máy sấy nóng.</p>

<h3>Vệ Sinh Sâu</h3>
<ul>
<li>Rửa tay bằng nước ấm và xà phòng nhẹ</li>
<li>Dùng bàn chải mềm để cọ bề ngoài</li>
<li>Rửa sạch và phơi khô hoàn toàn</li>
<li>Làm sạch đế giày bằng kem làm sạch chuyên dụng</li>
</ul>

<h3>Kết Luận</h3>
<p>Bảo quản giày thể thao đúng cách là khoản đầu tư cho sức khỏe và tiền bạc của bạn.</p>',
                'TrangThai' => 1,
                'NguoiTao' => 1,
            ],
            [
                'TieuDe' => 'Bí Quyết Tập Luyện Hiệu Quả Cho Người Mới Bắt Đầu',
                'TomTat' => 'Hướng dẫn chi tiết cho những ai muốn bắt đầu hành trình tập luyện của mình',
                'NoiDung' => '<h3>Bắt Đầu Hành Trình Tập Luyện</h3>
<p>Tập luyện là một hành trình dài, và việc bắt đầu đúng cách là rất quan trọng.</p>

<h3>Những Bước Cơ Bản Cho Người Mới</h3>

<h4>1. Đặt Mục Tiêu Rõ Ràng</h4>
<p>Xác định mục tiêu của bạn: giảm cân, tăng cơ bắp, hay chỉ là cải thiện sức khỏe?</p>

<h4>2. Bắt Đầu Từ Từ</h4>
<p>Không nên quá tham lam. Bắt đầu với các bài tập nhẹ và tăng dần theo tuần.</p>

<h4>3. Lên Kế Hoạch Tập Luyện</h4>
<p>Tập 3-4 lần mỗi tuần, với các ngày nghỉ để phục hồi.</p>

<h4>4. Chọn Loại Tập Luyện Phù Hợp</h4>
<p>Kết hợp cardio và strength training cho kết quả tốt nhất.</p>

<h4>5. Dinh Dưỡng Cân Bằng</h4>
<p>Ăn đủ protein, carbohydrate và chất béo lành mạnh.</p>

<h3>Những Lỗi Phổ Biến Cần Tránh</h3>
<ul>
<li>Tập quá sức ngay từ đầu</li>
<li>Không giãn cơ trước và sau tập</li>
<li>Bỏ qua bữa ăn trước tập</li>
<li>Tập luyện sai kỹ thuật</li>
<li>Không có sự kiên trì</li>
</ul>

<h3>Động Lực</h3>
<p>Hãy nhớ rằng bất cứ sự tiến bộ nào, dù nhỏ hay lớn, cũng là một thành công. Hãy kiên trì và niềm vui sẽ đến!</p>',
                'TrangThai' => 1,
                'NguoiTao' => 1,
            ],
        ];

        foreach ($baiviet as $item) {
            BaiViet::create([
                'TieuDe' => $item['TieuDe'],
                'slug' => Str::slug($item['TieuDe']) . '-' . time(),
                'TomTat' => $item['TomTat'],
                'NoiDung' => $item['NoiDung'],
                'HinhAnh' => null,
                'TrangThai' => $item['TrangThai'],
                'NguoiTao' => $item['NguoiTao'],
                'NgayTao' => now()->subDays(rand(1, 10)),
                'NgayCapNhat' => now(),
            ]);
        }
    }
}
