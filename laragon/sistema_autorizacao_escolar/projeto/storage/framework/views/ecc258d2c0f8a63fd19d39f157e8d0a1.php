
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('subtitle', 'Visão geral do sistema · ' . now()->isoFormat('dddd, D [de] MMMM [de] YYYY')); ?>

<?php $__env->startSection('content'); ?>


<div class="mb-6">
    <div class="bg-gradient-to-r from-senai-600 via-senai-500 to-senai-700 rounded-2xl p-6 lg:p-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/4"></div>
        <div class="absolute bottom-0 right-12 w-32 h-32 bg-senai-300/20 rounded-full translate-y-1/2"></div>
        <div class="relative">
            <p class="text-senai-100 text-sm font-medium mb-1">
                <?php
                    $h = now()->hour;
                    $saudacao = $h < 12 ? 'Bom dia' : ($h < 18 ? 'Boa tarde' : 'Boa noite');
                ?>
                <?php echo e($saudacao); ?>,
            </p>
            <h2 class="text-2xl lg:text-3xl font-bold mb-2"><?php echo e(explode(' ', auth()->user()->name)[0]); ?> 👋</h2>
            <p class="text-senai-100 max-w-xl">Acompanhe em tempo real o fluxo de entrada e saída de alunos.</p>

            <?php if(auth()->user()->isPorteiro() || auth()->user()->isAdmin()): ?>
            <a href="<?php echo e(route('portaria.index')); ?>" class="inline-flex items-center gap-2 mt-5 bg-white text-senai-700 font-semibold px-5 py-2.5 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                <i class="ph-fill ph-door-open"></i>
                Abrir Portaria
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Alunos Ativos','value' => ''.e($stats['total_alunos']).'','icon' => 'ph-student','color' => 'brand']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Alunos Ativos','value' => ''.e($stats['total_alunos']).'','icon' => 'ph-student','color' => 'brand']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Entradas Hoje','value' => ''.e($stats['entradas_hoje']).'','icon' => 'ph-sign-in','color' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Entradas Hoje','value' => ''.e($stats['entradas_hoje']).'','icon' => 'ph-sign-in','color' => 'green']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Saídas Hoje','value' => ''.e($stats['saidas_hoje']).'','icon' => 'ph-sign-out','color' => 'orange']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Saídas Hoje','value' => ''.e($stats['saidas_hoje']).'','icon' => 'ph-sign-out','color' => 'orange']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Movimentações Hoje','value' => ''.e($stats['movimentacoes_hoje']).'','icon' => 'ph-arrows-left-right','color' => 'purple','trend' => $stats['trend_movimentacoes'] !== null ? abs($stats['trend_movimentacoes']) . '%' : null,'trendUp' => ($stats['trend_movimentacoes'] ?? 0) >= 0]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Movimentações Hoje','value' => ''.e($stats['movimentacoes_hoje']).'','icon' => 'ph-arrows-left-right','color' => 'purple','trend' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($stats['trend_movimentacoes'] !== null ? abs($stats['trend_movimentacoes']) . '%' : null),'trendUp' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($stats['trend_movimentacoes'] ?? 0) >= 0)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Autorizações Ativas','value' => ''.e($stats['autorizacoes_ativas']).'','icon' => 'ph-seal-check','color' => 'cyan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Autorizações Ativas','value' => ''.e($stats['autorizacoes_ativas']).'','icon' => 'ph-seal-check','color' => 'cyan']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Pendentes Aprovação','value' => ''.e($stats['pendentes_professor']).'','icon' => 'ph-clock-countdown','color' => 'rose']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Pendentes Aprovação','value' => ''.e($stats['pendentes_professor']).'','icon' => 'ph-clock-countdown','color' => 'rose']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
</div>


<div class="grid lg:grid-cols-3 gap-4 mb-6">
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-soft border border-slate-100/80">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="font-bold text-slate-800">Movimentações dos últimos 7 dias</h3>
                <p class="text-xs text-slate-500">Entradas e saídas por dia</p>
            </div>
            <div class="flex items-center gap-4 text-xs">
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Entradas</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span> Saídas</span>
            </div>
        </div>
        <div class="relative h-64 lg:h-72">
            <canvas id="chartMov"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-soft border border-slate-100/80">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-slate-800">Pendências</h3>
            <?php if($pendentes->isNotEmpty()): ?>
                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'rose']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'rose']); ?><?php echo e($pendentes->count()); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
        <?php if($pendentes->isEmpty()): ?>
            <div class="text-center py-8 text-slate-400">
                <i class="ph-fill ph-check-circle text-4xl text-emerald-300"></i>
                <p class="text-sm mt-2">Sem pendências.</p>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $pendentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                    <?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['nome' => $p->aluno->nome,'size' => '9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nome' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($p->aluno->nome),'size' => '9']); ?>
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
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate"><?php echo e($p->aluno->nome); ?></p>
                        <p class="text-xs text-slate-500 truncate"><?php echo e($p->motivo); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if(auth()->user()->isProfessor() || auth()->user()->isAdmin()): ?>
            <a href="<?php echo e(route('autorizacoes.index')); ?>" class="mt-3 block text-center text-xs font-semibold text-senai-600 hover:text-senai-700 py-2">
                Ver todas →
            </a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>


<div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="font-bold text-slate-800">Últimas Movimentações</h3>
            <p class="text-xs text-slate-500">Atividade mais recente</p>
        </div>
        <a href="<?php echo e(route('movimentacoes.index')); ?>" class="text-xs font-semibold text-senai-600 hover:text-senai-700 flex items-center gap-1">
            Ver tudo <i class="ph ph-arrow-right"></i>
        </a>
    </div>

    <?php if($ultimasMovimentacoes->isEmpty()): ?>
        <div class="text-center py-12 text-slate-400">
            <i class="ph ph-empty text-5xl"></i>
            <p class="mt-2 text-sm">Nenhuma movimentação ainda.</p>
        </div>
    <?php else: ?>
        <div class="divide-y divide-slate-50">
        <?php $__currentLoopData = $ultimasMovimentacoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="px-6 py-4 hover:bg-slate-50/50 transition-colors flex items-center gap-4">
                <div class="relative">
                    <?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['nome' => $mov->aluno->nome,'size' => '10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nome' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mov->aluno->nome),'size' => '10']); ?>
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
                    <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full ring-2 ring-white flex items-center justify-center text-[10px]
                        <?php echo e($mov->tipo === 'saida' ? 'bg-orange-500 text-white' : 'bg-emerald-500 text-white'); ?>">
                        <i class="ph-fill <?php echo e($mov->tipo === 'saida' ? 'ph-sign-out' : 'ph-sign-in'); ?>"></i>
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800"><?php echo e($mov->aluno->nome); ?></p>
                    <p class="text-xs text-slate-500"><?php echo e($mov->aluno->turma); ?> · Por <?php echo e($mov->registradoPor->name); ?></p>
                </div>
                <div class="text-right">
                    <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => $mov->tipo === 'saida' ? 'orange' : 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mov->tipo === 'saida' ? 'orange' : 'green')]); ?>
                        <?php echo e($mov->tipo_label); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                    <p class="text-xs text-slate-400 mt-1"><?php echo e($mov->created_at->diffForHumans()); ?></p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    const ctx = document.getElementById('chartMov').getContext('2d');
    const gradEntrada = ctx.createLinearGradient(0, 0, 0, 240);
    gradEntrada.addColorStop(0, 'rgba(16, 185, 129, 0.35)');
    gradEntrada.addColorStop(1, 'rgba(16, 185, 129, 0.02)');
    const gradSaida = ctx.createLinearGradient(0, 0, 0, 240);
    gradSaida.addColorStop(0, 'rgba(249, 115, 22, 0.35)');
    gradSaida.addColorStop(1, 'rgba(249, 115, 22, 0.02)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dias->pluck('label'), 15, 512) ?>,
            datasets: [
                {
                    label: 'Entradas',
                    data: <?php echo json_encode($dias->pluck('entradas'), 15, 512) ?>,
                    borderColor: '#10b981',
                    backgroundColor: gradEntrada,
                    borderWidth: 2.5, fill: true, tension: 0.4,
                    pointBackgroundColor: '#10b981', pointRadius: 4, pointHoverRadius: 6,
                },
                {
                    label: 'Saídas',
                    data: <?php echo json_encode($dias->pluck('saidas'), 15, 512) ?>,
                    borderColor: '#f97316',
                    backgroundColor: gradSaida,
                    borderWidth: 2.5, fill: true, tension: 0.4,
                    pointBackgroundColor: '#f97316', pointRadius: 4, pointHoverRadius: 6,
                },
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a', padding: 12, cornerRadius: 8,
                    titleFont: { weight: 'bold' }, bodySpacing: 6,
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#64748b' } },
                y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { font: { size: 11 }, color: '#94a3b8', stepSize: 1 } },
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\resources\views/dashboard.blade.php ENDPATH**/ ?>