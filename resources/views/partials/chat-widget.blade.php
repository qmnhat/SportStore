<<<<<<< HEAD
<style>
.chat-float-btn{
    position: fixed; right: 18px; bottom: 18px; z-index: 9999;
    width: 54px; height: 54px; border-radius: 999px;
}
.chat-box{
    position: fixed; right: 18px; bottom: 82px; z-index: 9999;
    width: 320px; max-width: calc(100vw - 36px);
    display: none;
}
.chat-messages{ height: 260px; overflow: auto; }
</style>

<button class="btn btn-primary chat-float-btn" type="button" onclick="moChat()">
    <i class="fa fa-comments"></i>
</button>

<div class="card shadow chat-box" id="chatBox">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Ho tro khach hang</strong>
        <button class="btn btn-sm btn-outline-secondary" onclick="dongChat()">x</button>
    </div>
    <div class="card-body">
        <div class="chat-messages border rounded p-2 mb-2 bg-light" id="chatMessages"></div>

        <div class="input-group">
            <input id="chatInput" class="form-control" placeholder="Nhap tin nhan...">
            <button class="btn btn-primary" onclick="guiChat()">Gui</button>
        </div>

        <div class="small text-muted mt-2">
            * Demo UI. Neu muon chat that thi can backend + luu DB.
=======
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
>>>>>>> HieuNghia
        </div>
    </div>
</div>

<script>
<<<<<<< HEAD
function moChat(){ document.getElementById('chatBox').style.display='block'; }
function dongChat(){ document.getElementById('chatBox').style.display='none'; }

function guiChat(){
    const input = document.getElementById('chatInput');
    const msg = (input.value || '').trim();
    if(!msg) return;

    const box = document.getElementById('chatMessages');
    const div = document.createElement('div');
    div.className = 'mb-2';
    div.innerHTML = '<div class="text-end"><span class="badge bg-primary">'+ msg +'</span></div>';
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
    input.value = '';
}
=======
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
>>>>>>> HieuNghia
</script>
