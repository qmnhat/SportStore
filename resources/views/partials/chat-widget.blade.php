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
        </div>
    </div>
</div>

<script>
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
</script>
