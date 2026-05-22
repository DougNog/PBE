<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') · SAFE</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                    colors: {
                        senai: {
                            50:  '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#e30613',
                            700: '#b8050f',
                            800: '#8e040c',
                            900: '#5f0308',
                        },
                        ink: {
                            900: '#1d1d1b',
                            800: '#2a2a28',
                            700: '#3d3d3a',
                            500: '#6b6b67',
                        }
                    },
                    boxShadow: {
                        'soft': '0 2px 8px -2px rgb(0 0 0 / 0.06), 0 4px 16px -4px rgb(0 0 0 / 0.04)',
                        'senai': '0 8px 24px -8px rgb(227 6 19 / 0.30)',
                    },
                    animation: {
                        'fade-in':  'fadeIn .25s ease-out',
                        'slide-up': 'slideUp .3s ease-out',
                    },
                    keyframes: {
                        fadeIn:  { '0%': { opacity: 0 }, '100%': { opacity: 1 } },
                        slideUp: { '0%': { transform: 'translateY(8px)', opacity: 0 }, '100%': { transform: 'translateY(0)', opacity: 1 } },
                    }
                }
            }
        }
    </script>

    {{-- Store global: modal de confirmação --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('confirmModal', {
                open:    false,
                title:   '',
                message: '',
                type:    'danger', // 'danger' | 'warning'
                formId:  null,
                show(title, message, formId, type = 'danger') {
                    this.title   = title;
                    this.message = message;
                    this.formId  = formId;
                    this.type    = type;
                    this.open    = true;
                },
                confirm() {
                    if (this.formId) document.getElementById(this.formId).submit();
                    this.open = false;
                },
                cancel() { this.open = false; }
            });
        });
    </script>

    <script defer src="https://unpkg.com/alpinejs@3.13.5/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        html, body { height: auto; min-height: 100%; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d4d4d4; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #a3a3a3; }
        [x-cloak] { display: none !important; }
    </style>
    @stack('head')
</head>
<body class="bg-slate-50 text-ink-900 antialiased"
      x-data="{ sidebarOpen: false, userMenu: false, notifMenu: false }">

{{-- ============================================================
     SIDEBAR (fixo no desktop, drawer no mobile)
============================================================ --}}
<aside class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-slate-200 flex flex-col transform transition-transform duration-200 lg:translate-x-0"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    {{-- Logo / Header --}}
    <div class="px-5 py-5 border-b border-slate-200 flex items-center gap-3">
        <div class="w-11 h-11 rounded-lg bg-senai-600 flex items-center justify-center shadow-senai">
            <i class="ph-fill ph-shield-check text-white text-xl"></i>
        </div>
        <div>
            <p class="font-bold text-ink-900 leading-tight">SAFE</p>
            <p class="text-[10px] text-senai-600 uppercase tracking-widest font-bold">SENAI</p>
        </div>
    </div>

    {{-- Navegação --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
        <x-nav-link route="dashboard" icon="ph-squares-four" label="Dashboard" />

        @if(auth()->user()->isPorteiro() || auth()->user()->isAdmin())
            <x-nav-link route="portaria.*" href="{{ route('portaria.index') }}" icon="ph-door-open" label="Portaria" />
        @endif

        @if(auth()->user()->isProfessor() || auth()->user()->isAdmin())
            @php $pendCount = \App\Models\Autorizacao::where('status','pendente_professor')->count(); @endphp
            <x-nav-link route="autorizacoes.*" href="{{ route('autorizacoes.index') }}" icon="ph-seal-check" label="Autorizações"
                badge="{{ $pendCount ?: '' }}" />
        @endif

        <x-nav-link route="movimentacoes.*" href="{{ route('movimentacoes.index') }}" icon="ph-arrows-left-right" label="Movimentações" />

        @if(auth()->user()->isAdmin())
            <div class="pt-4 mt-2 border-t border-slate-100">
                <p class="px-3 mb-1 text-[10px] text-slate-400 uppercase tracking-widest font-semibold">Cadastros</p>
                <x-nav-link route="alunos.*" href="{{ route('alunos.index') }}" icon="ph-student" label="Alunos" />
                <x-nav-link route="responsaveis.*" href="{{ route('responsaveis.index') }}" icon="ph-users-three" label="Responsáveis" />
                <x-nav-link route="usuarios.*" href="{{ route('usuarios.index') }}" icon="ph-chalkboard-teacher" label="Professores" />
            </div>
        @endif
    </nav>

    {{-- Footer da sidebar --}}
    <div class="border-t border-slate-200 p-3">
        <div class="bg-gradient-to-br from-senai-600 to-senai-700 rounded-lg p-3 text-white">
            <div class="flex items-center gap-2 mb-0.5">
                <i class="ph-fill ph-graduation-cap text-sm"></i>
                <span class="font-bold text-xs uppercase tracking-wider">Sistema SAFE</span>
            </div>
            <p class="text-[10px] text-senai-100">Protótipo SENAI · v1.0</p>
        </div>
    </div>
</aside>

{{-- Backdrop mobile --}}
<div x-show="sidebarOpen" @click="sidebarOpen=false" x-cloak
     x-transition.opacity
     class="fixed inset-0 bg-ink-900/60 z-30 lg:hidden"></div>

{{-- ============================================================
     CONTAINER PRINCIPAL (com margem para sidebar)
============================================================ --}}
<div class="lg:ml-64 flex flex-col min-h-screen">

    {{-- TOPBAR --}}
    <header class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-slate-200">
        <div class="flex items-center justify-between px-4 lg:px-8 h-16">
            <div class="flex items-center gap-3 min-w-0">
                <button @click="sidebarOpen=true" class="lg:hidden p-2 -ml-2 text-ink-700 hover:bg-slate-100 rounded-lg">
                    <i class="ph ph-list text-xl"></i>
                </button>
                <div class="min-w-0">
                    <h1 class="text-base lg:text-lg font-bold text-ink-900 leading-tight truncate">@yield('title', 'Dashboard')</h1>
                    @hasSection('subtitle')
                        <p class="text-xs text-slate-500 truncate">@yield('subtitle')</p>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                @php
                    $notificacoes = auth()->user()->unreadNotifications()->latest()->limit(5)->get();
                @endphp
                @if($notificacoes->isNotEmpty())
                <div class="relative" @click.away="notifMenu=false">
                    <button @click="notifMenu=!notifMenu" class="relative p-2 text-ink-700 hover:bg-slate-100 rounded-lg">
                        <i class="ph ph-bell text-xl"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-senai-600 rounded-full ring-2 ring-white"></span>
                    </button>
                    <div x-show="notifMenu" x-cloak x-transition
                         class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-200 overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between bg-senai-50">
                            <p class="font-semibold text-sm text-ink-900">Novas autorizações</p>
                            <span class="text-xs bg-senai-600 text-white px-2 py-0.5 rounded-full font-bold">{{ $notificacoes->count() }}</span>
                        </div>
                        <div class="max-h-72 overflow-y-auto">
                            @foreach($notificacoes as $notif)
                            <form method="POST" action="{{ route('notificacoes.marcar-lida', $notif->id) }}" class="contents">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-3 hover:bg-slate-50 border-b border-slate-50 last:border-0">
                                    <p class="text-sm font-medium text-ink-900">{{ $notif->data['aluno_nome'] }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        Turma {{ $notif->data['aluno_turma'] }} ·
                                        Saída {{ $notif->data['horario_saida'] }} ·
                                        {{ $notif->data['faltas'] }} falta(s)
                                    </p>
                                    <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">{{ $notif->data['motivo'] }}</p>
                                </button>
                            </form>
                            @endforeach
                        </div>
                        <form method="POST" action="{{ route('notificacoes.marcar-todas') }}" class="border-t border-slate-100">
                            @csrf
                            <button type="submit" class="w-full text-xs text-slate-500 hover:text-slate-700 py-2.5 font-medium">
                                Marcar todas como lidas
                            </button>
                        </form>
                    </div>
                </div>
                @endif

                <div class="relative" @click.away="userMenu=false">
                    <button @click="userMenu=!userMenu" class="flex items-center gap-2 p-1 pr-3 hover:bg-slate-100 rounded-lg">
                        <x-avatar :nome="auth()->user()->name" size="9" />
                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-semibold text-ink-900 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-senai-600 uppercase tracking-widest font-bold">{{ auth()->user()->role_label }}</p>
                        </div>
                        <i class="ph ph-caret-down text-slate-400 text-sm"></i>
                    </button>
                    <div x-show="userMenu" x-cloak x-transition
                         class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-200 overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-100 bg-senai-50">
                            <p class="text-sm font-semibold text-ink-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-senai-600 hover:bg-senai-50 flex items-center gap-2 font-medium">
                                <i class="ph ph-sign-out"></i>
                                Sair
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Conteúdo --}}
    <main class="flex-1 p-4 lg:p-8 animate-fade-in">
        @include('partials.toasts')
        @yield('content')
    </main>

    <footer class="text-center text-xs text-slate-400 py-4 border-t border-slate-100">
        SAFE · Sistema de Autorização e Fluxo Escolar · <span class="text-senai-600 font-semibold">SENAI</span>
    </footer>
</div>

{{-- ============================================================
     MODAL DE CONFIRMAÇÃO GLOBAL
============================================================ --}}
<div x-show="$store.confirmModal.open"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.escape.window="$store.confirmModal.cancel()"
     @click="$store.confirmModal.cancel()"
     x-cloak
     class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-ink-900/60 backdrop-blur-sm">

    <div x-show="$store.confirmModal.open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-2"
         @click.stop
         class="bg-white rounded-2xl shadow-xl border border-slate-100 w-full max-w-sm p-6">

        <div class="flex items-start gap-4 mb-5">
            <div :class="$store.confirmModal.type === 'danger' ? 'bg-rose-100' : 'bg-amber-100'"
                 class="w-11 h-11 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                <i :class="$store.confirmModal.type === 'danger' ? 'text-rose-600' : 'text-amber-600'"
                   class="ph ph-warning text-xl"></i>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-slate-900 text-base leading-snug" x-text="$store.confirmModal.title"></h3>
                <p class="text-sm text-slate-500 mt-1 leading-relaxed" x-text="$store.confirmModal.message"></p>
            </div>
        </div>

        <div class="flex gap-3 justify-end">
            <button @click="$store.confirmModal.cancel()" type="button"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                Cancelar
            </button>
            <button @click="$store.confirmModal.confirm()" type="button"
                    :class="$store.confirmModal.type === 'danger'
                        ? 'from-rose-500 to-rose-600 hover:from-rose-600 hover:to-rose-700 shadow-rose-500/20'
                        : 'from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 shadow-amber-500/20'"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-br rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
                Confirmar
            </button>
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
