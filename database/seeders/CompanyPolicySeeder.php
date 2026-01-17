<?php

namespace Database\Seeders;

use App\Models\CompanyPolicy;
use Illuminate\Database\Seeder;

class CompanyPolicySeeder extends Seeder
{
    public function run(): void
    {
        // CHÍNH SÁCH VẬN CHUYỂN
        CompanyPolicy::create([
            'type' => 'shipping',
            'title' => 'Chính sách vận chuyển',
            'content' => '<ul class="mt-2">
                            <li>Miễn phí giao hàng cho đơn hàng từ <strong>500.000đ</strong> trở lên.</li>
                            <li>Giao hàng hỏa tốc 2H trong nội thành TP.HCM và Hà Nội.</li>
                            <li>Giao hàng tiêu chuẩn (3-5 ngày) cho các tỉnh khác.</li>
                            <li>Được kiểm tra hàng trước khi thanh toán (COD).</li>
                            <li>Bảo hiểm vận chuyển toàn bộ hàng hoá.</li>
                        </ul>',
            'order' => 1,
        ]);

        // CHÍNH SÁCH THANH TOÁN
        CompanyPolicy::create([
            'type' => 'payment',
            'title' => 'Chính sách thanh toán',
            'content' => '<ul class="mt-2">
                            <li><strong>Thanh toán khi nhận hàng (COD):</strong> Không tính phí, miễn phí.</li>
                            <li><strong>Chuyển khoản ngân hàng:</strong> Không tính phí, miễn phí.</li>
                            <li><strong>Ví điện tử:</strong> Momo, Zalo Pay, AirPay.</li>
                        </ul>',
            'order' => 2,
        ]);

        // CHÍNH SÁCH ĐỔI TRẢ - BẢO HÀNH
        CompanyPolicy::create([
            'type' => 'return',
            'title' => 'Chính sách đổi trả - Bảo hành',
            'content' => '<ul class="mt-2">
                            <li><strong>Đổi trả 1-1 trong 30 ngày:</strong> Nếu sản phẩm có lỗi từ nhà sản xuất hoặc không vừa size.</li>
                            <li><strong>Bảo hành chính hãng:</strong> Từ 6 tháng đến 24 tháng tùy loại dụng cụ.</li>
                            <li><strong>Bảo hành mở rộng:</strong> Có thể mua bảo hành thêm 12 tháng.</li>
                            <li>Hoàn tiền 200% nếu phát hiện hàng giả, hàng nhái (không cần lý do).</li>
                            <li>Dịch vụ bảo trì miễn phí cho thiết bị thể thao trong 1 năm.</li>
                        </ul>',
            'order' => 3,
        ]);

        // CHÍNH SÁCH BẢO MẬT
        CompanyPolicy::create([
            'type' => 'security',
            'title' => 'Chính sách bảo mật',
            'content' => '<p class="small text-muted mt-2">Chúng tôi cam kết bảo mật tuyệt đối thông tin cá nhân của khách hàng theo quy định của pháp luật Việt Nam. Thông tin của quý khách chỉ được sử dụng cho mục đích xử lý đơn hàng, chăm sóc khách hàng và gửi thông tin khuyến mãi (có thể hủy bất cứ lúc nào). Chúng tôi sử dụng mã hóa SSL 256-bit cho tất cả giao dịch trực tuyến.</p>',
            'order' => 4,
        ]);
    }
}
