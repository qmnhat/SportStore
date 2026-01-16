<?php

namespace Database\Seeders;

use App\Models\CompanyFaq;
use Illuminate\Database\Seeder;

class CompanyFaqSeeder extends Seeder
{
    public function run(): void
    {
        CompanyFaq::create([
            'question' => 'Làm sao tôi có thể biết sản phẩm là hàng chính hãng?',
            'answer' => 'Tất cả sản phẩm của SportStore đều có giấy chứng nhận chính hãng, phiếu bảo hành từ nhà sản xuất. Nếu phát hiện hàng giả, chúng tôi hoàn tiền 200% và không cần lý do.',
            'order' => 1,
        ]);

        CompanyFaq::create([
            'question' => 'Thời gian giao hàng mất bao lâu?',
            'answer' => '- Nội thành TP.HCM & Hà Nội: 2 giờ (giao hàng hỏa tốc)<br>- Các tỉnh khác: 3-5 ngày làm việc<br>- Bạn có thể theo dõi đơn hàng real-time qua website.',
            'order' => 2,
        ]);

        CompanyFaq::create([
            'question' => 'Tôi có thể đổi trả hàng được không nếu sản phẩm không vừa size?',
            'answer' => 'Có, bạn có thể đổi hoặc trả hàng trong vòng 30 ngày nếu sản phẩm chưa sử dụng hoặc có lỗi. Chúng tôi sẽ hoàn tiền 100% nếu đơn hàng chưa qua sử dụng.',
            'order' => 3,
        ]);

        CompanyFaq::create([
            'question' => 'Có chương trình khuyến mãi nào cho khách hàng mới không?',
            'answer' => 'Có! Khách hàng mới được giảm 10% khi mua hàng lần đầu tiên. Ngoài ra, bạn cũng có thể tham gia chương trình tích điểm và nhập mã khuyến mãi.',
            'order' => 4,
        ]);
    }
}
