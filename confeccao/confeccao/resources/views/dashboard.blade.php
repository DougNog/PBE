<x-app-layout>
    <x-slot name="header">
        {{-- Hidden default header, we build our own --}}
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap');

        :root {
            --ink:     #0a0a0f;
            --surface: #f5f4f0;
            --card:    #ffffff;
            --muted:   #888;
            --border:  #e8e6e1;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        .dash-root {
            font-family: 'DM Sans', sans-serif;
            background: var(--surface);
            min-height: 100vh;
            color: var(--ink);
        }

        /* ─── HERO ─── */
        .dash-hero {
            position: relative;
            overflow: hidden;
            background: var(--ink);
            padding: 3.5rem 2.5rem 3rem;
        }

        .dash-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 50% 90% at 100%   0%, rgba(91,74,255,.4)  0%, transparent 60%),
                radial-gradient(ellipse 40% 60% at   0% 100%, rgba(14,168,126,.3) 0%, transparent 60%),
                radial-gradient(ellipse 30% 50% at  50%  50%, rgba(255,107,53,.15) 0%, transparent 70%);
            pointer-events: none;
        }

        /* subtle grid */
        .dash-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .hero-greeting {
            font-size: .85rem;
            font-weight: 500;
            color: rgba(255,255,255,.4);
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: .6rem;
        }

        .hero-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            color: #fff;
            letter-spacing: -.03em;
            line-height: 1.05;
        }

        .hero-title span {
            color: transparent;
            -webkit-text-stroke: 1.5px rgba(255,255,255,.35);
        }

        .hero-sub {
            margin-top: .6rem;
            font-size: .92rem;
            color: rgba(255,255,255,.4);
            font-weight: 300;
        }

        .hero-meta {
            text-align: right;
        }

        .hero-date {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: rgba(255,255,255,.6);
            letter-spacing: .02em;
        }

        .hero-time {
            font-family: 'Syne', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.03em;
            line-height: 1;
            margin-top: .2rem;
        }

        /* ─── BODY ─── */
        .dash-body {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2.5rem 2rem 4rem;
        }

        /* ─── SECTION LABEL ─── */
        .section-label {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--muted);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ─── NAV GRID ─── */
        .nav-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
            margin-bottom: 3rem;
        }

        /* ─── NAV CARD ─── */
        .nav-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2rem;
            text-decoration: none;
            color: var(--ink);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            transition: transform .28s cubic-bezier(.34,1.56,.64,1), box-shadow .28s ease, border-color .2s;
            animation: fadeUp .5s ease both;
        }

        .nav-card:nth-child(1) { animation-delay: .05s; }
        .nav-card:nth-child(2) { animation-delay: .10s; }
        .nav-card:nth-child(3) { animation-delay: .15s; }
        .nav-card:nth-child(4) { animation-delay: .20s; }

        .nav-card:hover {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 0 24px 56px rgba(0,0,0,.1);
        }

        /* colored top bar */
        .nav-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 24px 24px 0 0;
            transition: height .2s;
        }

        .nav-card:hover::before { height: 5px; }

        .nav-card.clientes::before   { background: linear-gradient(90deg, #0ea87e, #3b82f6); }
        .nav-card.estoque::before    { background: linear-gradient(90deg, #5b4aff, #ff6b35); }
        .nav-card.fornecedores::before { background: linear-gradient(90deg, #e05c1a, #f59e0b); }
        .nav-card.pedidos::before    { background: linear-gradient(90deg, #3b5bdb, #7048e8); }

        /* bg glow blob */
        .nav-card::after {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 160px; height: 160px;
            border-radius: 50%;
            opacity: .07;
            transition: opacity .2s, transform .3s;
        }

        .nav-card:hover::after { opacity: .13; transform: scale(1.2); }

        .nav-card.clientes::after   { background: #0ea87e; }
        .nav-card.estoque::after    { background: #5b4aff; }
        .nav-card.fornecedores::after { background: #e05c1a; }
        .nav-card.pedidos::after    { background: #3b5bdb; }

        /* icon */
        .card-icon-wrap {
            width: 52px; height: 52px;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            position: relative; z-index: 1;
        }

        .nav-card.clientes   .card-icon-wrap { background: #d9fff3; }
        .nav-card.estoque    .card-icon-wrap { background: #ede9ff; }
        .nav-card.fornecedores .card-icon-wrap { background: #fff0e9; }
        .nav-card.pedidos    .card-icon-wrap { background: #e0e7ff; }

        .card-body { position: relative; z-index: 1; flex: 1; }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: -.02em;
            color: var(--ink);
        }

        .card-desc {
            margin-top: .35rem;
            font-size: .85rem;
            color: var(--muted);
            font-weight: 300;
            line-height: 1.5;
        }

        .card-footer {
            position: relative; z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-action {
            font-family: 'Syne', sans-serif;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .nav-card.clientes   .card-action { color: #0ea87e; }
        .nav-card.estoque    .card-action { color: #5b4aff; }
        .nav-card.fornecedores .card-action { color: #e05c1a; }
        .nav-card.pedidos    .card-action { color: #3b5bdb; }

        .card-arrow {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            transition: transform .2s;
        }

        .nav-card:hover .card-arrow { transform: translateX(4px); }

        .nav-card.clientes   .card-arrow { background: #d9fff3; color: #0ea87e; }
        .nav-card.estoque    .card-arrow { background: #ede9ff; color: #5b4aff; }
        .nav-card.fornecedores .card-arrow { background: #fff0e9; color: #e05c1a; }
        .nav-card.pedidos    .card-arrow { background: #e0e7ff; color: #3b5bdb; }

        /* ─── QUICK ACTIONS ─── */
        .quick-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .quick-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 1.1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: var(--ink);
            font-size: .88rem;
            font-weight: 500;
            transition: transform .2s, box-shadow .2s, background .2s;
            animation: fadeUp .5s ease both;
        }

        .quick-card:nth-child(1) { animation-delay: .25s; }
        .quick-card:nth-child(2) { animation-delay: .30s; }
        .quick-card:nth-child(3) { animation-delay: .35s; }
        .quick-card:nth-child(4) { animation-delay: .40s; }

        .quick-card:hover {
            background: var(--ink);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0,0,0,.12);
            border-color: var(--ink);
        }

        .quick-icon {
            font-size: 1.1rem;
            width: 36px; height: 36px;
            border-radius: 10px;
            background: var(--surface);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: background .2s;
        }

        .quick-card:hover .quick-icon { background: rgba(255,255,255,.12); }

        .quick-label { font-family: 'Syne', sans-serif; font-weight: 700; font-size: .82rem; letter-spacing: .02em; }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 640px) {
            .dash-hero { padding: 2rem 1.25rem 2rem; }
            .dash-body { padding: 1.5rem 1rem 3rem; }
            .hero-meta { display: none; }
            .nav-grid  { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 420px) {
            .nav-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="dash-root">

        {{-- ── HERO ── --}}
        <div class="dash-hero">
            <div class="hero-inner">
                <div>
                    <p class="hero-greeting">Painel de controle</p>
                    <h1 class="hero-title">
                        Olá,<br><span>{{ Auth::user()->name }}</span> 👋
                    </h1>
                    <p class="hero-sub">O que vamos gerenciar hoje?</p>
                </div>

                <div class="hero-meta">
                    <div class="hero-date" id="heroDate"></div>
                    <div class="hero-time" id="heroTime"></div>
                </div>
            </div>
        </div>

        {{-- ── BODY ── --}}
        <div class="dash-body">

            {{-- ── MÓDULOS ── --}}
            <div class="section-label">Módulos do sistema</div>

            <div class="nav-grid">

                {{-- CLIENTES --}}
                <a href="{{ route('clientes.index') }}" class="nav-card clientes">
                    <div class="card-icon-wrap">👥</div>
                    <div class="card-body">
                        <div class="card-title">Clientes</div>
                        <div class="card-desc">Cadastre e gerencie sua base de clientes, consulte CPF e telefone.</div>
                    </div>
                    <div class="card-footer">
                        <span class="card-action">Acessar</span>
                        <span class="card-arrow">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </span>
                    </div>
                </a>

                {{-- ESTOQUE --}}
                <a href="{{ route('estoque.index') }}" class="nav-card estoque">
                    <div class="card-icon-wrap">📦</div>
                    <div class="card-body">
                        <div class="card-title">Estoque</div>
                        <div class="card-desc">Controle produtos, quantidades e o valor estimado do inventário.</div>
                    </div>
                    <div class="card-footer">
                        <span class="card-action">Acessar</span>
                        <span class="card-arrow">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </span>
                    </div>
                </a>

                {{-- FORNECEDORES --}}
                <a href="{{ route('fornecedores.index') }}" class="nav-card fornecedores">
                    <div class="card-icon-wrap">🏭</div>
                    <div class="card-body">
                        <div class="card-title">Fornecedores</div>
                        <div class="card-desc">Gerencie fornecedores, CNPJ, telefone e e-mail de contato.</div>
                    </div>
                    <div class="card-footer">
                        <span class="card-action">Acessar</span>
                        <span class="card-arrow">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </span>
                    </div>
                </a>

                {{-- PEDIDOS --}}
                <a href="{{ route('pedidos.index') }}" class="nav-card pedidos">
                    <div class="card-icon-wrap">📋</div>
                    <div class="card-body">
                        <div class="card-title">Pedidos</div>
                        <div class="card-desc">Acompanhe pedidos, status de entrega e histórico de solicitações.</div>
                    </div>
                    <div class="card-footer">
                        <span class="card-action">Acessar</span>
                        <span class="card-arrow">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </span>
                    </div>
                </a>

            </div>

            {{-- ── AÇÕES RÁPIDAS ── --}}
            <div class="section-label">Ações rápidas</div>

            <div class="quick-grid">
                <a href="{{ route('clientes.create') }}" class="quick-card">
                    <div class="quick-icon">➕</div>
                    <span class="quick-label">Novo cliente</span>
                </a>

                <a href="{{ route('estoque.create') }}" class="quick-card">
                    <div class="quick-icon">📥</div>
                    <span class="quick-label">Novo item de estoque</span>
                </a>

                <a href="{{ route('fornecedores.create') }}" class="quick-card">
                    <div class="quick-icon">🏭</div>
                    <span class="quick-label">Novo fornecedor</span>
                </a>

                <a href="{{ route('pedidos.create') }}" class="quick-card">
                    <div class="quick-icon">📋</div>
                    <span class="quick-label">Novo pedido</span>
                </a>
            </div>

        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const days = ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'];
            const months = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
            document.getElementById('heroDate').textContent =
                days[now.getDay()] + ', ' + now.getDate() + ' ' + months[now.getMonth()];
            document.getElementById('heroTime').textContent =
                String(now.getHours()).padStart(2,'0') + ':' + String(now.getMinutes()).padStart(2,'0');
        }
        updateClock();
        setInterval(updateClock, 1000);
    </script>

</x-app-layout>