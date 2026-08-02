<?php

namespace Tests\Feature;

use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    public function test_customer_can_send_message_and_receive_auto_reply(): void
    {
        $response = $this->postJson('/chat/send', [
            'message' => 'Giá sản phẩm như thế nào?',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['reply', 'messages'])
            ->assertJsonPath('messages.0.role', 'customer')
            ->assertJsonPath('messages.1.role', 'admin');

        $this->assertNotEmpty($response->json('reply'));
    }
}
