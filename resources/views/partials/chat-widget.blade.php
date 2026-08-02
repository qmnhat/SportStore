<button class="btn btn-primary chat-widget-toggle" type="button" id="chatToggle" aria-label="Mở chat">
    <i class="fas fa-comments"></i>
</button>

<div class="chat-widget-panel" id="chatWidgetPanel">
    <div class="chat-widget-header">
        <div class="fw-bold">Hỗ trợ khách hàng</div>
        <small>Trợ lý 24/7</small>
    </div>
    <div class="chat-widget-body" id="chatMessages">
        <div class="chat-bubble admin">Xin chào! Tôi có thể giúp bạn về sản phẩm, giá cả hoặc đơn hàng.</div>
    </div>
    <div class="chat-widget-footer">
        <div class="input-group">
            <input type="text" id="chatInput" class="form-control" placeholder="Nhập câu hỏi...">
            <button class="btn btn-primary" type="button" id="chatSendBtn">Gửi</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('chatToggle');
        const panel = document.getElementById('chatWidgetPanel');
        const input = document.getElementById('chatInput');
        const sendBtn = document.getElementById('chatSendBtn');
        const messages = document.getElementById('chatMessages');

        toggle?.addEventListener('click', function () {
            panel.classList.toggle('show');
            if (panel.classList.contains('show')) {
                input.focus();
            }
        });

        function addMessage(role, text) {
            const bubble = document.createElement('div');
            bubble.className = `chat-bubble ${role}`;
            bubble.textContent = text;
            messages.appendChild(bubble);
            messages.scrollTop = messages.scrollHeight;
        }

        async function sendMessage() {
            const message = input.value.trim();
            if (!message) return;

            addMessage('customer', message);
            input.value = '';

            const response = await fetch('{{ route('chat.send') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message })
            });

            const data = await response.json();
            if (data.reply) {
                addMessage('admin', data.reply);
            }
        }

        sendBtn?.addEventListener('click', sendMessage);
        input?.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                sendMessage();
            }
        });
    });
</script>
