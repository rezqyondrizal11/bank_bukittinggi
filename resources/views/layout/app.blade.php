<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.css') }}">
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">

    <div class="app-wrapper">

        {{-- HEADER --}}
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item text-center fw-bold">
                                {{ auth()->user()->email }}
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <i class="bi bi-person"></i> Profile
                                </a>
                            </li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>
        </nav>

        {{-- SIDEBAR --}}
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <span class="brand-text fw-light px-3">BANK</span>
            </div>

            <div class="sidebar-wrapper">
                <nav>
                    <ul class="nav sidebar-menu flex-column">

                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">
                                <i class="bi bi-speedometer"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @if (auth()->user()->role === 'ao')
                            <li class="nav-item">
                                <a href="/verifikasi-nasabah"
                                    class="nav-link {{ request()->is('verifikasi-nasabah*') ? 'active' : '' }}">
                                    <i class="bi bi-people"></i>
                                    <p>Verifikasi Nasabah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/perhitungan-prioritas-survei"
                                    class="nav-link {{ request()->is('perhitungan-prioritas-survei*') ? 'active' : '' }}">
                                    <i class="bi bi-calculator"></i>
                                    <p>Perhitungan Prioritas Survei</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/prioritas-survei"
                                    class="nav-link {{ request()->is('prioritas-survei*') ? 'active' : '' }}">
                                    <i class="bi bi-people"></i>
                                    <p>Prioritas Survei</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role === 'ao' || auth()->user()->role === 'direksi')
                            <li class="nav-item">
                                <a href="/nasabah-disetujui"
                                    class="nav-link {{ request()->is('nasabah-disetujui*') ? 'active' : '' }}">
                                    <i class="bi bi-people"></i>
                                    <p>Nasabah Disetujui</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role === 'nasabah')
                            <li class="nav-item">
                                <a href="/pengajuan-nasabah"
                                    class="nav-link {{ request()->is('pengajuan-nasabah*') ? 'active' : '' }}">
                                    <i class="bi bi-people"></i>
                                    <p>Pengajuan Pinjaman</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-header">MASTER</li>
                            <li class="nav-item">
                                <a href="/kriterias"
                                    class="nav-link {{ request()->is('kriterias*') ? 'active' : '' }}">
                                    <i class="bi bi-boxes"></i>
                                    <p>Kriteria</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/sub-kriterias"
                                    class="nav-link {{ request()->is('sub-kriterias*') ? 'active' : '' }}">
                                    <i class="bi bi-boxes"></i>
                                    <p>Sub Kriteria</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/users" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                                    <i class="bi bi-people"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/master_chatbots"
                                    class="nav-link {{ request()->is('master_chatbots*') ? 'active' : '' }}  ">
                                    <i class="bi bi-robot"></i>
                                    <p>Master Chatbots</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="app-main p-4">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer class="app-footer text-center py-2">
            © {{ date('Y') }} AdminLTE 4
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
    <div id="chatbot-bubble">💬</div>

    <div id="chatbot-widget" class="minimized">
        <div id="chatbot-header">
            Chatbot
            <span id="chatbot-close">—</span>
        </div>
        <div id="chatbot-body"></div>
        <div id="chatbot-input">
            <input type="text" id="chatbot-text" placeholder="Ketik pesan...">
            <button id="chatbot-send">Send</button>
        </div>
    </div>

    <style>
        #chatbot-widget * {
            box-sizing: border-box;
        }

        #chatbot-bubble {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background: #0d6efd;
            color: #fff;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .3);
            z-index: 9999;
        }

        /* CHATBOX */
        #chatbot-widget {
            position: fixed;
            right: 20px;
            bottom: 90px;
            width: 330px;
            height: 450px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .25);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            resize: both;
            min-width: 280px;
            min-height: 350px;
            z-index: 9999;
        }

        /* HIDDEN */
        #chatbot-widget.minimized {
            display: none;
        }

        /* HEADER */
        #chatbot-header {
            background: #0d6efd;
            color: white;
            padding: 10px 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
        }

        /* BODY */
        #chatbot-body {
            flex: 1;
            padding: 12px;
            overflow-y: auto;
            background: #f4f6f9;

            box-sizing: border-box;
            scrollbar-gutter: stable both-edges;
        }


        /* INPUT */
        #chatbot-input {
            display: flex;
            border-top: 1px solid #ddd;
        }

        #chatbot-text {
            flex: 1;
            border: none;
            padding: 10px;
            outline: none;
        }

        #chatbot-send {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 0 16px;
        }

        /* MESSAGES */
        .msg {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            max-width: calc(100% - 40px);

        }

        .msg-user {
            align-self: flex-end;
            text-align: right;
        }

        .msg-bot {
            align-self: flex-start;
        }

        .msg-user div:first-child {
            background: #0d6efd;
            color: white;
        }

        .msg-bot div:first-child {
            background: white;
            border: 1px solid #ddd;
        }

        .msg div:first-child {
            padding: 8px 12px;
            border-radius: 14px;
            word-break: break-word;
        }

        .time {
            font-size: 11px;
            color: #777;
            margin-top: 2px;
        }
    </style>


    <script>
        const widget = document.getElementById('chatbot-widget');
        const bubble = document.getElementById('chatbot-bubble');
        const closeBtn = document.getElementById('chatbot-close');
        const body = document.getElementById('chatbot-body');

        bubble.onclick = () => widget.classList.remove('minimized');
        closeBtn.onclick = () => widget.classList.add('minimized');

        document.getElementById('chatbot-send').onclick = sendMessage;

        // LOAD HISTORY
        fetch('/chatbot/history')
            .then(res => res.json())
            .then(data => {
                data.forEach(row => {
                    appendMsg(row.pertanyaan, 'user', formatTime(row.created_at));
                    appendMsg(row.jawaban, 'bot', formatTime(row.created_at));
                })
            });

        function formatTime(t) {
            return new Date(t).toLocaleString();
        }

        function sendMessage() {
            let input = document.getElementById('chatbot-text');
            let msg = input.value.trim();
            if (!msg) return;

            appendMsg(msg, 'user');
            input.value = '';

            fetch('/chatbot/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: msg
                    })
                })
                .then(res => res.json())
                .then(data => {
                    appendMsg(data.reply, 'bot');
                });
        }

        function appendMsg(text, type, time = null) {
            let div = document.createElement('div');
            div.className = 'msg ' + (type === 'user' ? 'msg-user' : 'msg-bot');

            let content = document.createElement('div');
            content.innerText = text;

            let t = document.createElement('div');
            t.className = 'time';

            if (time) {
                t.innerText = time;
            } else {
                t.innerText = new Date().toLocaleString();
            }

            div.appendChild(content);
            div.appendChild(t);

            body.appendChild(div);
            body.scrollTop = body.scrollHeight;
        }
    </script>
    @stack('js')
</body>

</html>
