
<?php $__env->startSection('title', 'Movimentações'); ?>
<?php $__env->startSection('subtitle', 'Histórico completo de entradas e saídas'); ?>

<?php $__env->startSection('content'); ?>

<div x-data="{ view: 'timeline' }">


<div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-4 mb-5">
    <form method="GET" class="flex flex-wrap gap-2 items-center">
        <div class="relative flex-1 min-w-[180px]">
            <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="aluno" value="<?php echo e(request('aluno')); ?>" placeholder="Aluno ou matrícula..."
                class="w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
        </div>
        <select name="tipo" class="border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
            <option value="">Todos</option>
            <option value="entrada" <?php echo e(request('tipo') === 'entrada' ? 'selected' : ''); ?>>Entradas</option>
            <option value="saida"   <?php echo e(request('tipo') === 'saida' ? 'selected' : ''); ?>>Saídas</option>
        </select>
        <input type="date" name="data" value="<?php echo e(request('data')); ?>"
            class="border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
        <button type="submit" class="bg-senai-600 text-white font-semibold px-4 py-2 rounded-lg text-sm hover:bg-senai-700">
            <i class="ph-bold ph-funnel"></i> Filtrar
        </button>
        <?php if(request()->hasAny(['aluno','tipo','data'])): ?>
        <a href="<?php echo e(route('movimentacoes.index')); ?>" class="text-xs text-slate-500 hover:text-slate-700 ml-1">
            Limpar
        </a>
        <?php endif; ?>

        <div class="ml-auto flex bg-slate-100 rounded-lg p-1">
            <button type="button" @click="view='timeline'" :class="view==='timeline' ? 'bg-white shadow-sm text-senai-700' : 'text-slate-500'"
                    class="px-3 py-1 rounded-md text-xs font-semibold transition-all">
                <i class="ph ph-list-bullets"></i> Timeline
            </button>
            <button type="button" @click="view='table'" :class="view==='table' ? 'bg-white shadow-sm text-senai-700' : 'text-slate-500'"
                    class="px-3 py-1 rounded-md text-xs font-semibold transition-all">
                <i class="ph ph-table"></i> Tabela
            </button>
        </div>
    </form>
</div>

<?php if($movimentacoes->isEmpty()): ?>
    <div class="bg-white rounded-2xl p-16 text-center shadow-soft border border-slate-100/80">
        <i class="ph ph-empty text-6xl text-slate-300"></i>
        <p class="mt-3 text-slate-500">Nenhuma movimentação encontrada.</p>
    </div>
<?php else: ?>


<div x-show="view==='timeline'">
    <?php $grupos = $movimentacoes->groupBy(fn($m) => $m->created_at->format('d/m/Y')); ?>
    <div class="space-y-6">
        <?php $__currentLoopData = $grupos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data => $movs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <div class="flex items-center gap-3 mb-3 sticky top-16 bg-slate-50 z-10 py-2">
                    <div class="px-3 py-1 bg-white rounded-lg shadow-sm border border-slate-200 text-xs font-bold text-slate-700">
                        <?php echo e($data); ?>

                    </div>
                    <div class="flex-1 h-px bg-slate-200"></div>
                    <span class="text-xs text-slate-500"><?php echo e($movs->count()); ?> <?php echo e(Str::plural('registro', $movs->count())); ?></span>
                </div>

                <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
                    <?php $__currentLoopData = $movs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="relative flex items-center gap-4 px-5 py-4 hover:bg-slate-50/50 transition-colors border-b border-slate-50 last:border-0">
                        
                        <div class="shrink-0 w-12 h-12 rounded-xl flex items-center justify-center
                                    <?php echo e($mov->tipo === 'saida' ? 'bg-orange-100 text-orange-600' : 'bg-emerald-100 text-emerald-600'); ?>">
                            <i class="ph-fill text-xl <?php echo e($mov->tipo === 'saida' ? 'ph-sign-out' : 'ph-sign-in'); ?>"></i>
                        </div>

                        
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-1">
                                <p class="font-bold text-slate-800"><?php echo e($mov->aluno->nome); ?></p>
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
                            </div>
                            <p class="text-xs text-slate-500">
                                <span class="font-medium"><?php echo e($mov->aluno->turma); ?></span> ·
                                Registrado por <?php echo e($mov->registradoPor->name); ?>

                                <?php if($mov->autorizacao): ?>
                                    · <span class="text-slate-400">Motivo: <?php echo e($mov->autorizacao->motivo); ?></span>
                                <?php endif; ?>
                            </p>
                            <?php if($mov->observacao): ?>
                                <p class="text-xs text-slate-400 mt-1 italic">"<?php echo e($mov->observacao); ?>"</p>
                            <?php endif; ?>
                        </div>

                        
                        <div class="text-right shrink-0">
                            <p class="text-base font-bold text-slate-800"><?php echo e($mov->created_at->format('H:i')); ?></p>
                            <p class="text-[10px] text-slate-400 uppercase tracking-wider"><?php echo e($mov->created_at->diffForHumans()); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div x-show="view==='table'" x-cloak>
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] tracking-wider">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold">Aluno</th>
                    <th class="px-5 py-3 text-left font-semibold">Tipo</th>
                    <th class="px-5 py-3 text-left font-semibold">Data/Hora</th>
                    <th class="px-5 py-3 text-left font-semibold">Porteiro</th>
                    <th class="px-5 py-3 text-left font-semibold">Motivo/Obs.</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php $__currentLoopData = $movimentacoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-slate-50/50">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['nome' => $mov->aluno->nome,'foto' => $mov->aluno->foto_path,'size' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nome' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mov->aluno->nome),'foto' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mov->aluno->foto_path),'size' => '8']); ?>
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
                            <div>
                                <p class="font-semibold text-slate-800"><?php echo e($mov->aluno->nome); ?></p>
                                <p class="text-xs text-slate-400"><?php echo e($mov->aluno->turma); ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3">
                        <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => $mov->tipo === 'saida' ? 'orange' : 'green','icon' => $mov->tipo === 'saida' ? 'ph-sign-out' : 'ph-sign-in']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mov->tipo === 'saida' ? 'orange' : 'green'),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mov->tipo === 'saida' ? 'ph-sign-out' : 'ph-sign-in')]); ?>
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
                    </td>
                    <td class="px-5 py-3 text-slate-600 whitespace-nowrap"><?php echo e($mov->created_at->format('d/m/Y H:i')); ?></td>
                    <td class="px-5 py-3 text-slate-600"><?php echo e($mov->registradoPor->name); ?></td>
                    <td class="px-5 py-3 text-xs text-slate-500 max-w-xs truncate">
                        <?php echo e($mov->autorizacao?->motivo ?? $mov->observacao ?? '—'); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-5"><?php echo e($movimentacoes->links()); ?></div>

<?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\projeto\resources\views/movimentacoes/index.blade.php ENDPATH**/ ?>