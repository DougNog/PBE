<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> · SAFE</title>

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
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="bg-slate-50 text-ink-900 antialiased"
      x-data="{ sidebarOpen: false, userMenu: false, notifMenu: false }">


<aside class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-slate-200 flex flex-col transform transition-transform duration-200 lg:translate-x-0"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    
    <div class="px-5 py-5 border-b border-slate-200 flex items-center gap-3">
        <div class="w-11 h-11 rounded-lg bg-senai-600 flex items-center justify-center shadow-senai">
            <i class="ph-fill ph-shield-check text-white text-xl"></i>
        </div>
        <div>
            <p class="font-bold text-ink-900 leading-tight">SAFE</p>
            <p class="text-[10px] text-senai-600 uppercase tracking-widest font-bold">SENAI</p>
        </div>
    </div>

    
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
        <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['route' => 'dashboard','icon' => 'ph-squares-four','label' => 'Dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'dashboard','icon' => 'ph-squares-four','label' => 'Dashboard']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>

        <?php if(auth()->user()->isPorteiro() || auth()->user()->isAdmin()): ?>
            <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['route' => 'portaria.*','href' => ''.e(route('portaria.index')).'','icon' => 'ph-door-open','label' => 'Portaria']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'portaria.*','href' => ''.e(route('portaria.index')).'','icon' => 'ph-door-open','label' => 'Portaria']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if(auth()->user()->isProfessor() || auth()->user()->isAdmin()): ?>
            <?php $pendCount = \App\Models\Autorizacao::where('status','pendente_professor')->count(); ?>
            <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['route' => 'autorizacoes.*','href' => ''.e(route('autorizacoes.index')).'','icon' => 'ph-seal-check','label' => 'Autorizações','badge' => ''.e($pendCount ?: '').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'autorizacoes.*','href' => ''.e(route('autorizacoes.index')).'','icon' => 'ph-seal-check','label' => 'Autorizações','badge' => ''.e($pendCount ?: '').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['route' => 'movimentacoes.*','href' => ''.e(route('movimentacoes.index')).'','icon' => 'ph-arrows-left-right','label' => 'Movimentações']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'movimentacoes.*','href' => ''.e(route('movimentacoes.index')).'','icon' => 'ph-arrows-left-right','label' => 'Movimentações']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>

        <?php if(auth()->user()->isAdmin()): ?>
            <div class="pt-4 mt-2 border-t border-slate-100">
                <p class="px-3 mb-1 text-[10px] text-slate-400 uppercase tracking-widest font-semibold">Cadastros</p>
                <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['route' => 'alunos.*','href' => ''.e(route('alunos.index')).'','icon' => 'ph-student','label' => 'Alunos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'alunos.*','href' => ''.e(route('alunos.index')).'','icon' => 'ph-student','label' => 'Alunos']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['route' => 'responsaveis.*','href' => ''.e(route('responsaveis.index')).'','icon' => 'ph-users-three','label' => 'Responsáveis']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'responsaveis.*','href' => ''.e(route('responsaveis.index')).'','icon' => 'ph-users-three','label' => 'Responsáveis']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>
    </nav>

    
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


<div x-show="sidebarOpen" @click="sidebarOpen=false" x-cloak
     x-transition.opacity
     class="fixed inset-0 bg-ink-900/60 z-30 lg:hidden"></div>


<div class="lg:ml-64 flex flex-col min-h-screen">

    
    <header class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-slate-200">
        <div class="flex items-center justify-between px-4 lg:px-8 h-16">
            <div class="flex items-center gap-3 min-w-0">
                <button @click="sidebarOpen=true" class="lg:hidden p-2 -ml-2 text-ink-700 hover:bg-slate-100 rounded-lg">
                    <i class="ph ph-list text-xl"></i>
                </button>
                <div class="min-w-0">
                    <h1 class="text-base lg:text-lg font-bold text-ink-900 leading-tight truncate"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h1>
                    <?php if (! empty(trim($__env->yieldContent('subtitle')))): ?>
                        <p class="text-xs text-slate-500 truncate"><?php echo $__env->yieldContent('subtitle'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <?php
                    $pendencias = (auth()->user()->isProfessor() || auth()->user()->isAdmin())
                        ? \App\Models\Autorizacao::where('status', 'pendente_professor')->with('aluno')->latest()->limit(5)->get()
                        : collect();
                ?>
                <?php if($pendencias->isNotEmpty()): ?>
                <div class="relative" @click.away="notifMenu=false">
                    <button @click="notifMenu=!notifMenu" class="relative p-2 text-ink-700 hover:bg-slate-100 rounded-lg">
                        <i class="ph ph-bell text-xl"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-senai-600 rounded-full ring-2 ring-white"></span>
                    </button>
                    <div x-show="notifMenu" x-cloak x-transition
                         class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-200 overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between bg-senai-50">
                            <p class="font-semibold text-sm text-ink-900">Pendências</p>
                            <span class="text-xs bg-senai-600 text-white px-2 py-0.5 rounded-full font-bold"><?php echo e($pendencias->count()); ?></span>
                        </div>
                        <div class="max-h-72 overflow-y-auto">
                            <?php $__currentLoopData = $pendencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('autorizacoes.index')); ?>" class="block px-4 py-3 hover:bg-slate-50 border-b border-slate-50 last:border-0">
                                <p class="text-sm font-medium text-ink-900"><?php echo e($p->aluno->nome); ?></p>
                                <p class="text-xs text-slate-500 mt-0.5 line-clamp-1"><?php echo e($p->motivo); ?></p>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="relative" @click.away="userMenu=false">
                    <button @click="userMenu=!userMenu" class="flex items-center gap-2 p-1 pr-3 hover:bg-slate-100 rounded-lg">
                        <?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['nome' => auth()->user()->name,'size' => '9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nome' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(auth()->user()->name),'size' => '9']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b)): ?>
<?php $attributes = $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b; ?>
<?php unset($__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b)): ?>
<?php $component = $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b; ?>
<?php unset($__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b); ?>
<?php endif; ?>
                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-semibold text-ink-900 leading-tight"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-[10px] text-senai-600 uppercase tracking-widest font-bold"><?php echo e(auth()->user()->role_label); ?></p>
                        </div>
                        <i class="ph ph-caret-down text-slate-400 text-sm"></i>
                    </button>
                    <div x-show="userMenu" x-cloak x-transition
                         class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-200 overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-100 bg-senai-50">
                            <p class="text-sm font-semibold text-ink-900"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-xs text-slate-500"><?php echo e(auth()->user()->email); ?></p>
                        </div>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
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

    
    <main class="flex-1 p-4 lg:p-8 animate-fade-in">
        <?php echo $__env->make('partials.toasts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="text-center text-xs text-slate-400 py-4 border-t border-slate-100">
        SAFE · Sistema de Autorização e Fluxo Escolar · <span class="text-senai-600 font-semibold">SENAI</span>
    </footer>
</div>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\resources\views/layouts/app.blade.php ENDPATH**/ ?>