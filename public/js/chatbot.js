document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('chatbot-toggle-btn');
    const closeBtn = document.getElementById('chatbot-close-btn');
    const windowChat = document.getElementById('chatbot-window');
    const input = document.getElementById('chatbot-input');
    const sendBtn = document.getElementById('chatbot-send-btn');
    const messagesContainer = document.getElementById('chatbot-messages');

    // Tải lịch sử chat từ sessionStorage
    const loadChatHistory = () => {
        const history = JSON.parse(sessionStorage.getItem('ai_chat_history') || '[]');
        const isOpen = sessionStorage.getItem('ai_chat_open') === 'true';

        if (history.length > 0) {
            // Xóa tin nhắn mặc định nếu có lịch sử
            messagesContainer.innerHTML = '';
            history.forEach(msg => {
                appendMessage(msg.text, msg.sender, false);
            });
        }

        if (isOpen) {
            windowChat.classList.remove('hidden');
        }
    };

    const saveMessage = (text, sender) => {
        const history = JSON.parse(sessionStorage.getItem('ai_chat_history') || '[]');
        history.push({ text, sender });
        sessionStorage.setItem('ai_chat_history', JSON.stringify(history));
    };

    // Mở/Đóng chat
    toggleBtn.addEventListener('click', () => {
        const isHidden = windowChat.classList.toggle('hidden');
        sessionStorage.setItem('ai_chat_open', !isHidden);
        if (!isHidden) {
            input.focus();
        }
    });

    closeBtn.addEventListener('click', () => {
        windowChat.classList.add('hidden');
        sessionStorage.setItem('ai_chat_open', 'false');
    });

    // Hàm gửi tin nhắn
    const sendMessage = async () => {
        const text = input.value.trim();
        if (!text) return;

        // Hiển thị tin nhắn user
        appendMessage(text, 'user');
        input.value = '';

        // Hiển thị trạng thái đang nhập
        const typingId = 'typing-' + Date.now();
        const typingDiv = document.createElement('div');
        typingDiv.id = typingId;
        typingDiv.className = 'message bot-message typing';
        typingDiv.innerText = 'AI đang suy nghĩ...';
        messagesContainer.appendChild(typingDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        try {
            const response = await fetch('chat-process.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'message=' + encodeURIComponent(text)
            });

            const data = await response.json();

            // Xóa hiệu ứng typing
            const typingElement = document.getElementById(typingId);
            if (typingElement) typingElement.remove();

            if (data.success) {
                appendMessage(data.reply, 'bot');
            } else {
                appendMessage('AI đang gặp lỗi: ' + (data.error || 'Vui lòng thử lại sau!'), 'bot');
            }
        } catch (error) {
            const typingElement = document.getElementById(typingId);
            if (typingElement) typingElement.remove();
            appendMessage('Lỗi kết nối server (Có thể do lỗi PHP hoặc Database)!', 'bot');
            console.error(error);
        }
    };

    const appendMessage = (text, sender, shouldSave = true) => {
        const div = document.createElement('div');
        div.className = `message ${sender}-message`;
        div.innerText = text;
        messagesContainer.appendChild(div);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        if (shouldSave) {
            saveMessage(text, sender);
        }
    };

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage();
    });

    // Khởi tạo
    loadChatHistory();
});
