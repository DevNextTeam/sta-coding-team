<div id="devnext-ai">

{{-- FLOATING BUTTON --}}
<button
    id="ai-toggle"
    type="button"
    aria-label="Open DevNext AI"
    class="ai-toggle"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.8"
        stroke-linecap="round"
        stroke-linejoin="round"
    >
        <path d="M12 3l1.25 5.75L19 10l-5.75 1.25L12 17l-1.25-5.75L5 10l5.75-1.25L12 3Z"/>
        <path d="M19 16l.5 2.5L22 19l-2.5.5L19 22l-.5-2.5L16 19l2.5-.5L19 16Z"/>
    </svg>
</button>


{{-- CHAT WINDOW --}}
<div id="ai-window">

    {{-- HEADER --}}
    <header class="ai-header">

        <div class="ai-header-left">

            <div class="ai-logo">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M12 3l1.25 5.75L19 10l-5.75 1.25L12 17l-1.25-5.75L5 10l5.75-1.25L12 3Z"/>
                    <path d="M19 16l.5 2.5L22 19l-2.5.5L19 22l-.5-2.5L16 19l2.5-.5L19 16Z"/>
                </svg>
            </div>

            <div class="ai-title">

                <strong>DevNext AI</strong>

                <span>
                    <i></i>
                    AI Assistant
                </span>

            </div>

        </div>


        <div class="ai-header-actions">

            {{-- CLEAR --}}
            <button
                id="ai-clear"
                type="button"
                aria-label="Clear conversation"
                title="Clear conversation"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M3 6h18"/>
                    <path d="M8 6V4h8v2"/>
                    <path d="M19 6l-1 15H6L5 6"/>
                    <path d="M10 11v6"/>
                    <path d="M14 11v6"/>
                </svg>
            </button>


            {{-- CLOSE --}}
            <button
                id="ai-close"
                type="button"
                aria-label="Close DevNext AI"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M6 6l12 12"/>
                    <path d="M18 6L6 18"/>
                </svg>
            </button>

        </div>

    </header>


    {{-- MESSAGES --}}
    <main id="ai-messages">

        {{-- WELCOME --}}
        <div class="ai-message ai-message-assistant">

            <div class="ai-avatar">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M12 3l1.25 5.75L19 10l-5.75 1.25L12 17l-1.25-5.75L5 10l5.75-1.25L12 3Z"/>
                </svg>
            </div>

            <div class="ai-bubble ai-bubble-assistant">

                <p>
                    Hi! 👋 I'm <strong>DevNext AI</strong>.
                </p>

                <p>
                    I can help you with programming, web development,
                    debugging, technical concepts, and DevNext features.
                </p>

            </div>

        </div>

    </main>


    {{-- LOADING --}}
    <div id="ai-loading">

        <div class="ai-avatar">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M12 3l1.25 5.75L19 10l-5.75 1.25L12 17l-1.25-5.75L5 10l5.75-1.25L12 3Z"/>
            </svg>

        </div>

        <div class="ai-typing">
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>


    {{-- INPUT --}}
    <footer class="ai-input-area">

        <form id="ai-form">

            @csrf

            <div class="ai-input-wrapper">

                <textarea
                    id="ai-input"
                    rows="1"
                    maxlength="4000"
                    placeholder="Ask DevNext AI..."
                    autocomplete="off"
                ></textarea>

                <span id="ai-counter">
                    0/4000
                </span>

            </div>


            <button
                id="ai-send"
                type="submit"
                aria-label="Send message"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M22 2L11 13"/>
                    <path d="M22 2l-7 20-4-9-9-4 20-7z"/>
                </svg>

            </button>

        </form>


        <p class="ai-disclaimer">
            DevNext AI can make mistakes. Check important information.
        </p>

    </footer>

</div>

</div>

<style>

    /* ============================================================
       CONTAINER
    ============================================================ */

    #devnext-ai {
        position: fixed;
        right: 20px;
        bottom: 20px;

        z-index: 99999;

        font-family: inherit;
    }


    /* ============================================================
       FLOATING BUTTON
    ============================================================ */

    .ai-toggle {
        width: 58px;
        height: 58px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: none;
        border-radius: 50%;

        background: #0F3F4A;
        color: white;

        cursor: pointer;

        box-shadow:
            0 10px 30px rgba(15, 63, 74, 0.25);

        transition:
            transform 0.25s ease,
            background 0.25s ease,
            box-shadow 0.25s ease;
    }


    .ai-toggle:hover {
        transform: scale(1.07);
        background: #29483D;

        box-shadow:
            0 14px 35px rgba(15, 63, 74, 0.30);
    }


    .ai-toggle svg {
        width: 28px;
        height: 28px;
    }


    /* ============================================================
       CHAT WINDOW
    ============================================================ */

    #ai-window {
        position: absolute;

        right: 0;
        bottom: 78px;

        width: min(390px, calc(100vw - 40px));

        height: min(620px, calc(100dvh - 120px));

        min-height: 400px;

        display: flex;
        flex-direction: column;

        overflow: hidden;

        background: #F5F1E8;

        border: 1px solid #D9DED9;
        border-radius: 24px;

        box-shadow:
            0 20px 60px rgba(15, 63, 74, 0.20);

        opacity: 0;
        visibility: hidden;
        pointer-events: none;

        transform:
            translateY(10px)
            scale(0.97);

        transform-origin: bottom right;

        transition:
            opacity 0.2s ease,
            transform 0.2s ease,
            visibility 0.2s ease;
    }


    /* OPEN STATE */

    #devnext-ai.ai-open #ai-window {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;

        transform:
            translateY(0)
            scale(1);
    }


    #devnext-ai.ai-open .ai-toggle {
        transform: rotate(90deg);
    }


    /* ============================================================
       HEADER
    ============================================================ */

    .ai-header {
        flex-shrink: 0;

        min-height: 72px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 14px 16px;

        background: #0F3F4A;
        color: white;
    }


    .ai-header-left {
        min-width: 0;

        display: flex;
        align-items: center;

        gap: 11px;
    }


    .ai-logo {
        width: 40px;
        height: 40px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 13px;

        background: rgba(255,255,255,0.10);
    }


    .ai-logo svg {
        width: 23px;
        height: 23px;
    }


    .ai-title {
        min-width: 0;

        display: flex;
        flex-direction: column;

        gap: 3px;
    }


    .ai-title strong {
        overflow: hidden;

        font-size: 14px;
        font-weight: 700;

        white-space: nowrap;
        text-overflow: ellipsis;
    }


    .ai-title span {
        display: flex;
        align-items: center;

        gap: 6px;

        color: rgba(255,255,255,0.68);

        font-size: 11px;
    }


    .ai-title span i {
        width: 7px;
        height: 7px;

        display: block;

        border-radius: 50%;

        background: #65D391;
    }


    .ai-header-actions {
        display: flex;
        align-items: center;

        gap: 2px;
    }


    .ai-header-actions button {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: none;
        border-radius: 11px;

        background: transparent;
        color: rgba(255,255,255,0.72);

        cursor: pointer;

        transition:
            background 0.2s ease,
            color 0.2s ease;
    }


    .ai-header-actions button:hover {
        background: rgba(255,255,255,0.10);
        color: white;
    }


    .ai-header-actions svg {
        width: 19px;
        height: 19px;
    }


    /* ============================================================
       MESSAGES
    ============================================================ */

    #ai-messages {
        flex: 1;

        min-height: 0;

        overflow-y: auto;

        padding: 20px 16px;

        scroll-behavior: smooth;
    }


    #ai-messages::-webkit-scrollbar {
        width: 5px;
    }


    #ai-messages::-webkit-scrollbar-track {
        background: transparent;
    }


    #ai-messages::-webkit-scrollbar-thumb {
        background: #C7D0CB;

        border-radius: 999px;
    }


    .ai-message {
        display: flex;

        width: 100%;

        margin-bottom: 16px;
    }


    .ai-message-assistant {
        align-items: flex-start;

        gap: 9px;
    }


    .ai-message-user {
        justify-content: flex-end;
    }


    .ai-avatar {
        width: 32px;
        height: 32px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: #0F3F4A;
        color: white;
    }


    .ai-avatar svg {
        width: 16px;
        height: 16px;
    }


    .ai-bubble {
        max-width: 80%;

        padding: 11px 14px;

        font-size: 14px;
        line-height: 1.55;

        border-radius: 17px;
    }


    .ai-bubble p {
        margin: 0;
    }


    .ai-bubble p + p {
        margin-top: 8px;
    }


    .ai-bubble-assistant {
        background: white;
        color: #29483D;

        border-top-left-radius: 5px;

        box-shadow:
            0 2px 8px rgba(15, 63, 74, 0.06);
    }


    .ai-bubble-user {
        background: #0F3F4A;
        color: white;

        border-top-right-radius: 5px;
    }


    /* ============================================================
       LOADING
    ============================================================ */

    #ai-loading {
        display: none;

        align-items: center;

        gap: 9px;

        flex-shrink: 0;

        padding:
            0 16px
            12px;
    }


    #ai-loading.active {
        display: flex;
    }


    .ai-typing {
        display: flex;

        align-items: center;

        gap: 4px;

        padding: 12px 15px;

        border-radius: 17px;
        border-top-left-radius: 5px;

        background: white;
    }


    .ai-typing span {
        width: 6px;
        height: 6px;

        border-radius: 50%;

        background: #4F806D;

        animation: aiTyping 1.3s infinite ease-in-out;
    }


    .ai-typing span:nth-child(2) {
        animation-delay: 0.15s;
    }


    .ai-typing span:nth-child(3) {
        animation-delay: 0.3s;
    }


    @keyframes aiTyping {

        0%,
        60%,
        100% {
            transform: translateY(0);
            opacity: 0.45;
        }

        30% {
            transform: translateY(-4px);
            opacity: 1;
        }

    }


    /* ============================================================
       INPUT
    ============================================================ */

    .ai-input-area {
        flex-shrink: 0;

        padding: 11px 12px 10px;

        border-top: 1px solid #D9DED9;

        background: rgba(255,255,255,0.82);
    }


    #ai-form {
        display: flex;

        align-items: flex-end;

        gap: 8px;
    }


    .ai-input-wrapper {
        position: relative;

        min-width: 0;

        flex: 1;
    }


    #ai-input {
        width: 100%;

        min-height: 46px;
        max-height: 130px;

        resize: none;

        overflow-y: auto;

        padding:
            13px
            48px
            13px
            14px;

        border: 1px solid #D9DED9;
        border-radius: 16px;

        background: white;

        color: #29483D;

        font-family: inherit;
        font-size: 14px;

        line-height: 20px;

        outline: none;

        box-sizing: border-box;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }


    #ai-input:focus {
        border-color: #4F806D;

        box-shadow:
            0 0 0 3px rgba(79,128,109,0.10);
    }


    #ai-input::placeholder {
        color: #8A9690;
    }


    #ai-counter {
        position: absolute;

        right: 11px;
        bottom: 7px;

        color: #9AA59F;

        font-size: 9px;

        pointer-events: none;
    }


    #ai-send {
        width: 46px;
        height: 46px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border: none;
        border-radius: 15px;

        background: #0F3F4A;
        color: white;

        cursor: pointer;

        transition:
            background 0.2s ease,
            transform 0.2s ease;
    }


    #ai-send:hover {
        background: #29483D;

        transform: translateY(-1px);
    }


    #ai-send:disabled {
        opacity: 0.4;

        cursor: not-allowed;

        transform: none;
    }


    #ai-send svg {
        width: 19px;
        height: 19px;
    }


    .ai-disclaimer {
        margin: 7px 0 0;

        text-align: center;

        color: #8A9690;

        font-size: 9px;
    }


    /* ============================================================
       TABLET
    ============================================================ */

    @media (max-width: 900px) and (min-width: 641px) {

        #devnext-ai {
            right: 16px;
            bottom: 16px;
        }

        #ai-window {
            width: min(390px, calc(100vw - 32px));

            height: min(600px, calc(100dvh - 100px));
        }

    }


    /* ============================================================
       MOBILE
    ============================================================ */

    @media (max-width: 640px) {

        #devnext-ai {
            position: fixed;

            inset: 0;

            width: 100%;
            height: 100dvh;

            right: auto;
            bottom: auto;

            pointer-events: none;
        }


        /* Floating button */

        .ai-toggle {
            position: fixed;

            right: 16px;
            bottom: max(16px, env(safe-area-inset-bottom));

            width: 54px;
            height: 54px;

            pointer-events: auto;

            z-index: 3;
        }


        .ai-toggle svg {
            width: 26px;
            height: 26px;
        }


        /* Full screen chat */

        #ai-window {
            position: fixed;

            inset: 0;

            width: 100vw;
            height: 100dvh;

            min-height: 0;

            max-height: none;

            border: none;
            border-radius: 0;

            box-shadow: none;

            transform-origin: center;

            z-index: 2;
        }


        #devnext-ai.ai-open {
            pointer-events: auto;
        }


        /* Hide floating button when open */

        #devnext-ai.ai-open .ai-toggle {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;

            transform: scale(0.8);
        }


        /* Header safe area */

        .ai-header {
            min-height:
                calc(64px + env(safe-area-inset-top));

            padding-top:
                calc(12px + env(safe-area-inset-top));
        }


        /* Messages */

        #ai-messages {
            padding:
                16px
                14px;
        }


        .ai-bubble {
            max-width: 84%;

            font-size: 14px;
        }


        /* Input */

        .ai-input-area {
            padding:
                10px
                10px
                max(10px, env(safe-area-inset-bottom));
        }


        #ai-input {
            min-height: 45px;
        }


        #ai-send {
            width: 45px;
            height: 45px;
        }

    }


    /* ============================================================
       SMALL PHONES
    ============================================================ */

    @media (max-width: 380px) {

        .ai-header {
            padding-left: 12px;
            padding-right: 12px;
        }


        .ai-logo {
            width: 37px;
            height: 37px;
        }


        .ai-title strong {
            font-size: 13px;
        }


        .ai-header-actions button {
            width: 35px;
            height: 35px;
        }


        #ai-messages {
            padding-left: 10px;
            padding-right: 10px;
        }


        .ai-bubble {
            max-width: 87%;

            padding:
                10px
                12px;
        }

    }

</style>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const container =
        document.getElementById('devnext-ai');

    const toggle =
        document.getElementById('ai-toggle');

    const close =
        document.getElementById('ai-close');

    const clear =
        document.getElementById('ai-clear');

    const form =
        document.getElementById('ai-form');

    const input =
        document.getElementById('ai-input');

    const send =
        document.getElementById('ai-send');

    const messages =
        document.getElementById('ai-messages');

    const loading =
        document.getElementById('ai-loading');

    const counter =
        document.getElementById('ai-counter');


    const storageKey =
        'devnext_ai_messages';


    let conversation = [];

    let isSending = false;


    /* ============================================================
       OPEN
    ============================================================ */

    function openChat() {

        container.classList.add('ai-open');

        document.body.classList.add('ai-chat-open');

        setTimeout(function () {

            input.focus();

            scrollMessages();

        }, 150);

    }


    /* ============================================================
       CLOSE
    ============================================================ */

    function closeChat() {

        container.classList.remove('ai-open');

        document.body.classList.remove('ai-chat-open');

    }


    toggle.addEventListener(
        'click',
        function () {

            if (
                container.classList.contains('ai-open')
            ) {

                closeChat();

            } else {

                openChat();

            }

        }
    );


    close.addEventListener(
        'click',
        closeChat
    );


    /* ============================================================
       SCROLL
    ============================================================ */

    function scrollMessages() {

        messages.scrollTop =
            messages.scrollHeight;

    }


    /* ============================================================
       ESCAPE HTML
    ============================================================ */

    function escapeHtml(text) {

        return text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

    }


    /* ============================================================
       FORMAT
    ============================================================ */

    function formatText(text) {

        return escapeHtml(text)
            .replace(/\n/g, '<br>');

    }


    /* ============================================================
       AI ICON
    ============================================================ */

    function aiIcon() {

        return `
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M12 3l1.25 5.75L19 10l-5.75 1.25L12 17l-1.25-5.75L5 10l5.75-1.25L12 3Z"/>
            </svg>
        `;

    }


    /* ============================================================
       ADD MESSAGE
    ============================================================ */

    function addMessage(
        role,
        text,
        save = true
    ) {

        const wrapper =
            document.createElement('div');


        if (role === 'user') {

            wrapper.className =
                'ai-message ai-message-user';


            wrapper.innerHTML = `
                <div class="ai-bubble ai-bubble-user">
                    ${formatText(text)}
                </div>
            `;

        } else {

            wrapper.className =
                'ai-message ai-message-assistant';


            wrapper.innerHTML = `
                <div class="ai-avatar">
                    ${aiIcon()}
                </div>

                <div class="ai-bubble ai-bubble-assistant">
                    ${formatText(text)}
                </div>
            `;

        }


        messages.appendChild(wrapper);


        if (save) {

            conversation.push({
                role: role,
                content: text
            });

            saveConversation();

        }


        scrollMessages();

    }


    /* ============================================================
       SAVE
    ============================================================ */

    function saveConversation() {

        sessionStorage.setItem(
            storageKey,
            JSON.stringify(conversation)
        );

    }


    /* ============================================================
       LOAD
    ============================================================ */

    function loadConversation() {

        const saved =
            sessionStorage.getItem(storageKey);


        if (!saved) {

            return;

        }


        try {

            conversation =
                JSON.parse(saved);


            conversation.forEach(
                function (message) {

                    addMessage(
                        message.role,
                        message.content,
                        false
                    );

                }
            );


        } catch (error) {

            sessionStorage.removeItem(
                storageKey
            );

            conversation = [];

        }

    }


    /* ============================================================
       CLEAR
    ============================================================ */

    clear.addEventListener(
        'click',
        function () {

            conversation = [];

            sessionStorage.removeItem(
                storageKey
            );


            messages.innerHTML = `
                <div class="ai-message ai-message-assistant">

                    <div class="ai-avatar">
                        ${aiIcon()}
                    </div>

                    <div class="ai-bubble ai-bubble-assistant">

                        <p>
                            Conversation cleared. 👋
                        </p>

                        <p>
                            What would you like to work on?
                        </p>

                    </div>

                </div>
            `;

            input.focus();

        }
    );


    /* ============================================================
       LOADING
    ============================================================ */

    function setLoading(state) {

        isSending = state;

        loading.classList.toggle(
            'active',
            state
        );

        send.disabled = state;

        input.disabled = state;


        if (state) {

            scrollMessages();

        }

    }


    /* ============================================================
       SEND
    ============================================================ */

    form.addEventListener(
        'submit',
        async function (event) {

            event.preventDefault();


            if (isSending) {

                return;

            }


            const message =
                input.value.trim();


            if (!message) {

                return;

            }


            addMessage(
                'user',
                message
            );


            input.value = '';

            updateCounter();

            resizeInput();

            setLoading(true);


            try {

                const response =
                    await fetch(
                        '{{ route('ai.chat') }}',
                        {
                            method: 'POST',

                            headers: {
                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    '{{ csrf_token() }}',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            },

                            body: JSON.stringify({
                                message: message
                            })
                        }
                    );


                const data =
                    await response.json();


                if (
                    !response.ok ||
                    !data.success
                ) {

                    throw new Error(
                        data.message ||
                        'DevNext AI could not process your request.'
                    );

                }


                addMessage(
                    'assistant',
                    data.reply
                );


            } catch (error) {

                addMessage(
                    'assistant',
                    'Sorry! Something went wrong while connecting to DevNext AI.\n\n' +
                    error.message
                );


            } finally {

                setLoading(false);

                input.disabled = false;

                input.focus();

            }

        }
    );


    /* ============================================================
       ENTER TO SEND
    ============================================================ */

    input.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Enter' &&
                !event.shiftKey
            ) {

                event.preventDefault();


                if (!isSending) {

                    form.requestSubmit();

                }

            }

        }
    );


    /* ============================================================
       COUNTER
    ============================================================ */

    function updateCounter() {

        counter.textContent =
            `${input.value.length}/4000`;

    }


    input.addEventListener(
        'input',
        function () {

            updateCounter();

            resizeInput();

        }
    );


    /* ============================================================
       RESIZE
    ============================================================ */

    function resizeInput() {

        input.style.height = 'auto';

        input.style.height =
            Math.min(
                input.scrollHeight,
                130
            ) + 'px';

    }


    /* ============================================================
       START
    ============================================================ */

    loadConversation();

    updateCounter();

    resizeInput();

});

</script>
