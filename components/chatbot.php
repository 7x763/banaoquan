<div id="ai-chatbot-container">
    <!-- Nút bong bóng chat -->
    <button id="chatbot-toggle-btn" title="Chat với AI">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"></path></svg>
    </button>

    <!-- Cửa sổ Chat -->
    <div id="chatbot-window" class="hidden">
        <div class="chatbot-header">
            <div class="chatbot-title">
                <div class="online-indicator"></div>
                <span>Hỗ trợ AI thông minh</span>
            </div>
            <button id="chatbot-close-btn">&times;</button>
        </div>
        
        <div id="chatbot-messages">
            <div class="message bot-message">
                Chào bạn! Tôi là trợ lý AI. Tôi có thể giúp gì được cho bạn?
            </div>
        </div>

        <div class="chatbot-input-area">
            <input type="text" id="chatbot-input" placeholder="Nhập tin nhắn..." autocomplete="off">
            <button id="chatbot-send-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
            </button>
        </div>
    </div>
</div>
