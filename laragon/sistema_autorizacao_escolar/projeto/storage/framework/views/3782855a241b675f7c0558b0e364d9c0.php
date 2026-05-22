
<?php $__env->startSection('title', 'Autorizações'); ?>
<?php $__env->startSection('subtitle', 'Gerencie as autorizações de saída dos alunos'); ?>

<?php $__env->startSection('content'); ?>

<?php
    $contadores = [
        'todos'              => \App\Models\Autorizacao::count(),
        'ativa'              => \App\Models\Autorizacao::where('status','ativa')->count(),
        'pendente_professor' => \App\Models\Autorizacao::where('status','pendente_professor')->count(),
        'revogada'           => \App\Models\Autorizacao::where('status','revogada')->count(),
    ];
    $abas = [
        'todos'              => ['label' => 'Todos',     'icon' => 'ph-list',         'cor' => 'text-ink-700'],
        'ativa'              => ['label' => 'Ativas',    'icon' => 'ph-check-circle', 'cor' => 'text-emerald-600'],
        'pendente_professor' => ['label' => 'Pendentes', 'icon' => 'ph-clock',        'cor' => 'text-amber-600'],
        'revogada'           => ['label' => 'Revogadas', 'icon' => 'ph-x-circle',     'cor' => 'text-senai-600'],
    ];
    $filtroAtivo = request('filtro', 'todos');
?>

<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 mb-5">
    <a href="<?php echo e(route('autorizacoes.create')); ?>" class="lg:order-2 self-start lg:self-auto inline-flex items-center gap-2 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-senai hover:-translate-y-0.5 transition-all">
        <i class="ph-bold ph-plus"></i>
        Nova Autorização
    </a>

    
    <div class="lg:order-1 inline-flex bg-white p-1 rounded-xl border border-slate-200 shadow-soft overflow-x-auto">
        <?php $__currentLoopData = $abas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aba): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $isActive = $filtroAtivo === $key; ?>
            <a href="?filtro=<?php echo e($key); ?>" class="relative flex items-center gap-1.5 px-3 lg:px-4 py-2 rounded-lg text-sm font-semibold transition-all whitespace-nowrap
                <?php echo e($isActive ? 'bg-senai-600 text-white shadow-senai' : 'text-slate-600 hover:bg-slate-50'); ?>">
                <i class="ph <?php echo e($aba['icon']); ?> <?php echo e($isActive ? 'text-white' : $aba['cor']); ?>"></i>
                <?php echo e($aba['label']); ?>

                <span class="text-[11px] font-bold ml-1 px-1.5 rounded-md
                    <?php echo e($isActive ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'); ?>">
                    <?php echo e($contadores[$key]); ?>

                </span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
    <?php if($autorizacoes->isEmpty()): ?>
        <div class="text-center py-16 text-slate-400">
            <i class="ph ph-seal text-6xl text-slate-300"></i>
            <p class="mt-3">Nenhuma autorização encontrada.</p>
        </div>
    <?php else: ?>
    <table class="w-full text-sm">
        <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] tracking-wider">
            <tr>
                <th class="px-5 py-3 text-left font-semibold">Aluno</th>
                <th class="px-5 py-3 text-left font-semibold">Tipo</th>
                <th class="px-5 py-3 text-left font-semibold">Responsável</th>
                <th class="px-5 py-3 text-left font-semibold">Motivo</th>
                <th class="px-5 py-3 text-left font-semibold">Validade</th>
                <th class="px-5 py-3 text-left font-semibold">Status</th>
                <th class="px-5 py-3 text-right font-semibold">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            <?php $__currentLoopData = $autorizacoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['nome' => $aut->aluno->nome,'foto' => $aut->aluno->foto_path,'size' => '9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nome' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($aut->aluno->nome),'foto' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($aut->aluno->foto_path),'size' => '9']); ?>
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
                            <p class="font-semibold text-slate-800"><?php echo e($aut->aluno->nome); ?></p>
                            <p class="text-xs text-slate-400"><?php echo e($aut->aluno->turma); ?></p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-3.5">
                    <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'brand','icon' => ''.e($aut->tipo === 'saida' ? 'ph-sign-out' : ($aut->tipo === 'entrada' ? 'ph-sign-in' : 'ph-arrows-left-right')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'brand','icon' => ''.e($aut->tipo === 'saida' ? 'ph-sign-out' : ($aut->tipo === 'entrada' ? 'ph-sign-in' : 'ph-arrows-left-right')).'']); ?>
                        <?php echo e($aut->tipo_label); ?>

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
                <td class="px-5 py-3.5 text-slate-600"><?php echo e($aut->responsavel->nome); ?></td>
                <td class="px-5 py-3.5 max-w-xs">
                    <p class="text-slate-600 truncate" title="<?php echo e($aut->motivo); ?>"><?php echo e($aut->motivo); ?></p>
                </td>
                <td class="px-5 py-3.5 text-xs text-slate-500">
                    <?php if($aut->validade_fim): ?>
                        até <?php echo e($aut->validade_fim->format('d/m/Y')); ?>

                    <?php else: ?>
                        <span class="text-slate-400 italic">indefinido</span>
                    <?php endif; ?>
                </td>
                <td class="px-5 py-3.5">
                    <?php
                        $variants = ['ativa'=>'green','pendente_professor'=>'yellow','revogada'=>'red','expirada'=>'gray'];
                    ?>
                    <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => $variants[$aut->status] ?? 'gray']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variants[$aut->status] ?? 'gray')]); ?>
                        <?php echo e($aut->status_label); ?>

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
                <td class="px-5 py-3.5">
                    <div class="flex justify-end gap-1">
                        <?php if($aut->status === 'pendente_professor'): ?>
                        <form method="POST" action="<?php echo e(route('autorizacoes.aprovar', $aut)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <button class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg" title="Aprovar">
                                <i class="ph-fill ph-check-circle text-lg"></i>
                            </button>
                        </form>
                        <?php endif; ?>
                        <?php if($aut->status === 'ativa'): ?>
                        <form method="POST" action="<?php echo e(route('autorizacoes.revogar', $aut)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <button class="p-1.5 text-orange-600 hover:bg-orange-50 rounded-lg" title="Revogar"
                                    onclick="return confirm('Revogar esta autorização?')">
                                <i class="ph ph-x-circle text-lg"></i>
                            </button>
                        </form>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo e(route('autorizacoes.destroy', $aut)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg" title="Excluir"
                                    onclick="return confirm('Excluir esta autorização?')">
                                <i class="ph ph-trash text-lg"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="p-4 border-t border-slate-100"><?php echo e($autorizacoes->links()); ?></div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\projeto\resources\views/autorizacoes/index.blade.php ENDPATH**/ ?>