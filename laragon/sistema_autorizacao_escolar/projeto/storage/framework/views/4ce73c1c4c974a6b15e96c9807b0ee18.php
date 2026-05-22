
<?php $__env->startSection('title', 'Responsáveis'); ?>
<?php $__env->startSection('subtitle', 'Cadastro de pais e responsáveis'); ?>

<?php $__env->startSection('content'); ?>

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-slate-500"><?php echo e($responsaveis->total()); ?> responsáveis cadastrados</p>
    <a href="<?php echo e(route('responsaveis.create')); ?>" class="inline-flex items-center gap-2 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-senai-600/30 hover:-translate-y-0.5 transition-all">
        <i class="ph-bold ph-plus"></i>
        Novo Responsável
    </a>
</div>

<?php if($responsaveis->isEmpty()): ?>
    <div class="bg-white rounded-2xl p-12 text-center shadow-soft border border-slate-100/80">
        <i class="ph ph-users-three text-6xl text-slate-300"></i>
        <p class="mt-3 text-slate-500">Nenhum responsável cadastrado.</p>
    </div>
<?php else: ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php $__currentLoopData = $responsaveis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-2xl p-5 shadow-soft hover:shadow-lg border border-slate-100/80 transition-all">
        <div class="flex items-center gap-3 mb-4">
            <?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['nome' => $r->nome,'size' => '12']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nome' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($r->nome),'size' => '12']); ?>
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
                <p class="font-bold text-slate-900 truncate"><?php echo e($r->nome); ?></p>
                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'brand']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'brand']); ?><?php echo e($r->alunos_count); ?> <?php echo e(Str::plural('aluno', $r->alunos_count)); ?> <?php echo $__env->renderComponent(); ?>
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
        </div>

        <div class="space-y-2 text-sm mb-4">
            <p class="flex items-center gap-2 text-slate-600">
                <i class="ph ph-envelope text-slate-400"></i>
                <span class="truncate"><?php echo e($r->email); ?></span>
            </p>
            <p class="flex items-center gap-2 text-slate-600">
                <i class="ph ph-phone text-slate-400"></i>
                <?php echo e($r->telefone); ?>

            </p>
        </div>

        <div class="flex gap-2 pt-3 border-t border-slate-100">
            <a href="<?php echo e(route('responsaveis.edit', $r)); ?>" class="flex-1 text-center bg-senai-50 hover:bg-senai-100 text-senai-700 font-semibold py-2 rounded-lg text-xs flex items-center justify-center gap-1.5">
                <i class="ph ph-pencil-simple"></i> Editar
            </a>
            <form method="POST" action="<?php echo e(route('responsaveis.destroy', $r)); ?>" class="flex-1">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" onclick="return confirm('Remover este responsável?')"
                        class="w-full bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold py-2 rounded-lg text-xs flex items-center justify-center gap-1.5">
                    <i class="ph ph-trash"></i> Remover
                </button>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="mt-6"><?php echo e($responsaveis->links()); ?></div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\resources\views/responsaveis/index.blade.php ENDPATH**/ ?>