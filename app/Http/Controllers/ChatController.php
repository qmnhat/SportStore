<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $message = trim((string) $request->input('message', ''));

        if ($message === '') {
            return response()->json([
                'reply' => 'Xin chào! Bạn cần hỗ trợ gì về sản phẩm hoặc đơn hàng?',
                'messages' => [
                    ['role' => 'customer', 'text' => ''],
                    ['role' => 'admin', 'text' => 'Xin chào! Bạn cần hỗ trợ gì về sản phẩm hoặc đơn hàng?'],
                ],
            ]);
        }

        $reply = $this->generateReply($message);

        return response()->json([
            'reply' => $reply,
            'messages' => [
                ['role' => 'customer', 'text' => $message],
                ['role' => 'admin', 'text' => $reply],
            ],
        ]);
    }

    private function generateReply(string $message): string
    {
        $text = strtolower($message);

        if (str_contains($text, 'giá') || str_contains($text, 'price') || str_contains($text, 'bao nhiêu')) {
            return 'Hiện tại cửa hàng có nhiều sản phẩm với mức giá phù hợp. Bạn có thể xem danh mục sản phẩm hoặc cho tôi biết bạn cần sản phẩm nào để tôi gợi ý tốt hơn.';
        }

        if (str_contains($text, 'ship') || str_contains($text, 'giao hàng') || str_contains($text, 'vận chuyển')) {
            return 'Chúng tôi hỗ trợ giao hàng trong nội thành và các khu vực lân cận. Thời gian giao hàng thường từ 1 đến 3 ngày làm việc.';
        }

        if (str_contains($text, 'đổi') || str_contains($text, 'trả') || str_contains($text, 'bảo hành')) {
            return 'Sản phẩm được hỗ trợ đổi/trả trong thời gian quy định và có chính sách bảo hành theo từng dòng sản phẩm. Bạn có thể liên hệ bộ phận hỗ trợ để được hướng dẫn chi tiết.';
        }

        if (str_contains($text, 'xin chào') || str_contains($text, 'hello') || str_contains($text, 'chào')) {
            return 'Xin chào! Tôi là trợ lý hỗ trợ khách hàng. Bạn cần tư vấn sản phẩm, giá cả hay đơn hàng?';
        }

        return 'Cảm ơn bạn đã liên hệ. Tôi có thể hỗ trợ về giá, giao hàng, đổi trả hoặc tư vấn sản phẩm. Bạn có thể hỏi trực tiếp để được giúp đỡ.';
    }
}
