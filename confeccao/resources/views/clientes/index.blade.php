<x-app-layout>
    <x-slot name="header">
        <div class="nc-header">
            <div class="nc-header__meta">
                <span class="nc-header__eyebrow">Nossa Confecção</span>
                <h2 class="nc-header__title">Clientes</h2>
            </div>
            <a href="#" class="nc-btn-new">
                <span class="nc-btn-new__icon">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M8 2v12M2 8h12"/>
                    </svg>
                </span>
                <span>Novo cliente</span>
            </a>
        </div>
    </x-slot>

    <div class="nc-page">

        {{-- ░░ CANVAS BACKGROUND ░░ --}}
        <div class="nc-bg" aria-hidden="true">
            <div class="nc-bg__blob nc-bg__blob--a"></div>
            <div class="nc-bg__blob nc-bg__blob--b"></div>
            <div class="nc-bg__grid"></div>
        </div>

        <div class="nc-wrap">

            {{-- ░░ TOOLBAR ░░ --}}
            <div class="nc-toolbar">
                <div class="nc-search">
                    <svg class="nc-search__icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3a6 6 0 1 0 0 12A6 6 0 0 0 9 3Zm0 2a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm8.707 12.293-3.4-3.4a8 8 0 1 1 1.414-1.414l3.4 3.4a1 1 0 0 1-1.414 1.414Z" clip-rule="evenodd"/>
                    </svg>
                    <input type="text" placeholder="Buscar cliente..." class="nc-search__input" />
                </div>

                <div class="nc-chip">
                    <span class="nc-chip__dot"></span>
                    {{ $clientes->count() }} cadastrados
                </div>
            </div>

            {{-- ░░ GRID ░░ --}}
            <div class="nc-grid">
                @foreach ($clientes as $cliente)
                <article
                    class="nc-card"
                    style="--delay: {{ $loop->index * 60 }}ms"
                >
                    {{-- accent line --}}
                    <div class="nc-card__accent"></div>

                    {{-- avatar + name --}}
                    <div class="nc-card__head">
                        <div class="nc-avatar">
                            {{ strtoupper(substr($cliente->nome, 0, 2)) }}
                        </div>
                        <div class="nc-card__identity">
                            <h3 class="nc-card__name">{{ $cliente->nome }}</h3>
                            <span class="nc-card__cpf">{{ $cliente->cpf }}</span>
                        </div>
                        <div class="nc-badge">
                            <span class="nc-badge__dot"></span>
                            Ativo
                        </div>
                    </div>

                    {{-- info row --}}
                    <div class="nc-card__info">
                        <div class="nc-info-block">
                            <span class="nc-info-block__label">Telefone</span>
                            <span class="nc-info-block__value">{{ $cliente->telefone }}</span>
                        </div>
                        <div class="nc-info-block">
                            <span class="nc-info-block__label">Pedidos</span>
                            <span class="nc-info-block__value">—</span>
                        </div>
                    </div>

                    {{-- divider --}}
                    <div class="nc-card__divider"></div>

                    {{-- actions --}}
                    <div class="nc-card__actions">
                        <a href="#" class="nc-action-link">
                            Ver perfil
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 8h10M9 4l4 4-4 4"/>
                            </svg>
                        </a>

                        <div class="nc-action-btns">
                            <button class="nc-btn-edit" type="button">Editar</button>
                            <button class="nc-btn-delete" type="button" aria-label="Excluir">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 4h12M5 4V2h6v2M6 7v5M10 7v5M3 4l1 10h8l1-10"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- ░░ EMPTY STATE ░░ --}}
            @if(($clientes ?? collect())->isEmpty())
            <div class="nc-empty">
                <div class="nc-empty__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                        <path d="M17 3l2 2-2 2M19 5h-4"/>
                    </svg>
                </div>
                <p class="nc-empty__title">Nenhum cliente ainda</p>
                <p class="nc-empty__sub">Cadastre o primeiro cliente para começar.</p>
                <a href="#" class="nc-btn-new nc-btn-new--sm">
                    <span class="nc-btn-new__icon">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <path d="M8 2v12M2 8h12"/>
                        </svg>
                    </span>
                    Novo cliente
                </a>
            </div>
            @endif

        </div>{{-- /nc-wrap --}}
    </div>{{-- /nc-page --}}

    @push('styles')
    <style>
    /* ── GOOGLE FONTS ───────────────────────────── */
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,300&family=Instrument+Serif:ital@0;1&display=swap');

    /* ── TOKENS ─────────────────────────────────── */
    :root {
        --ink:      #0d0d12;
        --ink-2:    #3a3a4a;
        --ink-3:    #8585a0;
        --border:   rgba(0,0,0,.08);
        --border-2: rgba(0,0,0,.13);
        --brand:    #5b47f5;
        --brand-2:  #9b59f7;
        --brand-3:  #f05bba;
        --green:    #22c55e;
        --red:      #ef4444;
        --r-card:   20px;
        --r-sm:     12px;
        --shadow:   0 2px 12px rgba(0,0,0,.06), 0 0 0 1px var(--border);
        --shadow-h: 0 12px 36px rgba(91,71,245,.13), 0 0 0 1px rgba(91,71,245,.2);
        --fd:       'Instrument Serif', Georgia, serif;
        --fb:       'DM Sans', system-ui, sans-serif;
    }

    /* ── PAGE ───────────────────────────────────── */
    .nc-page {
        position: relative;
        min-height: 100vh;
        padding: 2.5rem 0 5rem;
        font-family: var(--fb);
        color: var(--ink);
        overflow: hidden;
    }

    /* ── BACKGROUND ─────────────────────────────── */
    .nc-bg { position: fixed; inset: 0; pointer-events: none; z-index: 0; }
    .nc-bg__blob {
        position: absolute; border-radius: 50%;
        filter: blur(100px); opacity: .45;
    }
    .nc-bg__blob--a {
        width: 600px; height: 600px; top: -180px; left: -160px;
        background: radial-gradient(circle, #c7bffd 0%, transparent 70%);
    }
    .nc-bg__blob--b {
        width: 500px; height: 500px; bottom: -120px; right: -100px;
        background: radial-gradient(circle, #f9b8e5 0%, transparent 70%);
    }
    .nc-bg__grid {
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(0,0,0,.032) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,0,0,.032) 1px, transparent 1px);
        background-size: 48px 48px;
        mask-image: radial-gradient(ellipse 80% 80% at 50% 40%, black 30%, transparent 100%);
    }

    /* ── HEADER ─────────────────────────────────── */
    .nc-header {
        display: flex; align-items: center;
        justify-content: space-between; gap: 1rem; flex-wrap: wrap;
        font-family: var(--fb);
    }
    .nc-header__eyebrow {
        display: block; font-size: .7rem; font-weight: 600;
        letter-spacing: .12em; text-transform: uppercase;
        color: var(--ink-3); margin-bottom: .25rem;
    }
    .nc-header__title {
        font-family: var(--fd); font-size: 1.75rem; font-weight: 400;
        font-style: italic; color: var(--ink); line-height: 1; margin: 0;
    }

    /* ── NEW BUTTON ─────────────────────────────── */
    .nc-btn-new {
        display: inline-flex; align-items: center; gap: .55rem;
        padding: .6rem 1.15rem .6rem .6rem; border-radius: 100px;
        background: var(--ink); color: #fff; font-size: .8rem;
        font-weight: 600; text-decoration: none;
        transition: transform .2s, box-shadow .2s, background .2s;
        box-shadow: 0 4px 16px rgba(13,13,18,.2);
    }
    .nc-btn-new:hover { background: #1e1e2e; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(13,13,18,.3); }
    .nc-btn-new:active { transform: translateY(0); }
    .nc-btn-new__icon {
        display: grid; place-items: center;
        width: 26px; height: 26px; border-radius: 50%;
        background: rgba(255,255,255,.12);
    }
    .nc-btn-new__icon svg { width: 13px; height: 13px; }
    .nc-btn-new--sm { margin-top: 1.5rem; }

    /* ── WRAP ───────────────────────────────────── */
    .nc-wrap { position: relative; z-index: 1; max-width: 1280px; margin: 0 auto; padding: 0 1.5rem; }

    /* ── TOOLBAR ────────────────────────────────── */
    .nc-toolbar { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem; }

    .nc-search { position: relative; flex: 1; max-width: 380px; }
    .nc-search__icon {
        position: absolute; left: .85rem; top: 50%; transform: translateY(-50%);
        width: 16px; height: 16px; color: var(--ink-3); pointer-events: none;
    }
    .nc-search__input {
        width: 100%; padding: .65rem .9rem .65rem 2.35rem;
        border-radius: 100px; border: 1px solid var(--border-2);
        background: rgba(255,255,255,.85); backdrop-filter: blur(12px);
        font-family: var(--fb); font-size: .85rem; color: var(--ink);
        transition: border-color .2s, box-shadow .2s; outline: none;
    }
    .nc-search__input::placeholder { color: var(--ink-3); }
    .nc-search__input:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(91,71,245,.12); }

    .nc-chip {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .55rem 1rem; border-radius: 100px;
        background: rgba(255,255,255,.85); border: 1px solid var(--border-2);
        font-size: .78rem; font-weight: 600; color: var(--ink-2);
        white-space: nowrap; backdrop-filter: blur(12px);
    }
    .nc-chip__dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: linear-gradient(135deg, var(--brand), var(--brand-3));
    }

    /* ── GRID ───────────────────────────────────── */
    .nc-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.25rem; }

    /* ── CARD ───────────────────────────────────── */
    .nc-card {
        position: relative; background: rgba(255,255,255,.88);
        border-radius: var(--r-card); padding: 1.35rem;
        box-shadow: var(--shadow); backdrop-filter: blur(16px);
        transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s;
        animation: ncFadeUp .5s cubic-bezier(.22,1,.36,1) both;
        animation-delay: var(--delay, 0ms); overflow: hidden;
    }
    .nc-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-h); }
    .nc-card:hover .nc-card__accent { opacity: 1; }

    .nc-card__accent {
        position: absolute; inset: 0 0 auto 0; height: 2.5px;
        background: linear-gradient(90deg, var(--brand), var(--brand-2), var(--brand-3));
        border-radius: var(--r-card) var(--r-card) 0 0;
        opacity: .5; transition: opacity .3s;
    }

    /* head */
    .nc-card__head { display: flex; align-items: center; gap: .85rem; margin-bottom: 1rem; }

    .nc-avatar {
        flex-shrink: 0; width: 44px; height: 44px; border-radius: 14px;
        display: grid; place-items: center; font-size: .8rem; font-weight: 700;
        letter-spacing: .03em; color: #fff;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-3) 100%);
        box-shadow: 0 4px 12px rgba(91,71,245,.3);
    }

    .nc-card__identity { flex: 1; min-width: 0; }
    .nc-card__name { font-size: .95rem; font-weight: 650; color: var(--ink); margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .nc-card__cpf { display: block; margin-top: .15rem; font-size: .72rem; font-weight: 500; color: var(--ink-3); }

    .nc-badge {
        display: inline-flex; align-items: center; gap: .35rem;
        padding: .3rem .65rem; border-radius: 100px;
        background: #dcfce7; font-size: .68rem; font-weight: 700;
        color: #15803d; white-space: nowrap; letter-spacing: .02em;
    }
    .nc-badge__dot { width: 6px; height: 6px; border-radius: 50%; background: var(--green); animation: ncPulse 2s infinite; }

    /* info */
    .nc-card__info { display: grid; grid-template-columns: 1fr 1fr; gap: .6rem; margin-bottom: 1rem; }
    .nc-info-block { padding: .65rem .8rem; border-radius: var(--r-sm); background: #f7f7fb; border: 1px solid var(--border); }
    .nc-info-block__label { display: block; font-size: .68rem; font-weight: 600; text-transform: uppercase; letter-spacing: .08em; color: var(--ink-3); margin-bottom: .2rem; }
    .nc-info-block__value { font-size: .85rem; font-weight: 600; color: var(--ink); }

    /* divider */
    .nc-card__divider { height: 1px; background: var(--border); margin-bottom: .9rem; }

    /* actions */
    .nc-card__actions { display: flex; align-items: center; justify-content: space-between; gap: .5rem; }

    .nc-action-link {
        display: inline-flex; align-items: center; gap: .4rem;
        font-size: .8rem; font-weight: 650; color: var(--brand);
        text-decoration: none; transition: gap .2s, color .2s;
    }
    .nc-action-link:hover { gap: .65rem; color: var(--ink); }
    .nc-action-link svg { width: 14px; height: 14px; }

    .nc-action-btns { display: flex; gap: .45rem; }

    .nc-btn-edit {
        padding: .45rem .85rem; border-radius: var(--r-sm);
        background: var(--ink); color: #fff; font-family: var(--fb);
        font-size: .75rem; font-weight: 600; border: none; cursor: pointer;
        transition: transform .18s, background .18s, box-shadow .18s;
    }
    .nc-btn-edit:hover { background: #1e1e2e; transform: translateY(-2px); box-shadow: 0 4px 14px rgba(13,13,18,.2); }
    .nc-btn-edit:active { transform: translateY(0); }

    .nc-btn-delete {
        width: 34px; height: 34px; display: grid; place-items: center;
        border-radius: var(--r-sm); background: #fff0f0;
        border: 1px solid #fecaca; color: var(--red); cursor: pointer;
        transition: transform .18s, background .18s;
    }
    .nc-btn-delete svg { width: 14px; height: 14px; }
    .nc-btn-delete:hover { background: #fee2e2; transform: translateY(-2px); }
    .nc-btn-delete:active { transform: translateY(0); }

    /* ── EMPTY ──────────────────────────────────── */
    .nc-empty {
        display: flex; flex-direction: column; align-items: center;
        justify-content: center; text-align: center; padding: 5rem 2rem;
        border-radius: var(--r-card); border: 2px dashed rgba(91,71,245,.2);
        background: rgba(255,255,255,.6); backdrop-filter: blur(8px);
    }
    .nc-empty__icon {
        display: grid; place-items: center; width: 64px; height: 64px;
        border-radius: 20px; background: #f0eeff; margin-bottom: 1.25rem;
    }
    .nc-empty__icon svg { width: 28px; height: 28px; color: var(--brand); }
    .nc-empty__title { font-family: var(--fd); font-style: italic; font-size: 1.4rem; color: var(--ink); margin: 0 0 .35rem; }
    .nc-empty__sub { font-size: .85rem; color: var(--ink-3); margin: 0; }

    /* ── ANIMATIONS ─────────────────────────────── */
    @keyframes ncFadeUp {
        from { opacity: 0; transform: translateY(18px) scale(.98); }
        to   { opacity: 1; transform: translateY(0)    scale(1); }
    }
    @keyframes ncPulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50%       { transform: scale(1.6); opacity: .4; }
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
    </style>
    @endpush
</x-app-layout>