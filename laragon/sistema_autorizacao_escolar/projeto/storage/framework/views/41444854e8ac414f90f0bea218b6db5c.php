
<?php $__env->startSection('title', 'Alunos'); ?>
<?php $__env->startSection('subtitle', 'Gestão de alunos cadastrados no sistema'); ?>

<?php $__env->startSection('content'); ?>

<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
    <form method="GET" class="flex-1 max-w-md relative">
        <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <input type="text" name="busca" value="<?php echo e(request('busca')); ?>" placeholder="Buscar por nome, matrícula ou turma..."
            class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
    </form>
    <a href="<?php echo e(route('alunos.create')); ?>" class="inline-flex items-center gap-2 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-senai-600/30 hover:shadow-xl hover:-translate-y-0.5 transition-all">
        <i class="ph-bold ph-plus"></i>
        Novo Aluno
    </a>
</div>

<?php if($alunos->isEmpty()): ?>
    <div class="bg-white rounded-2xl p-12 text-center shadow-soft border border-slate-100/80">
        <i class="ph ph-student text-6xl text-slate-300"></i>
        <p class="mt-3 text-slate-500">Nenhum aluno encontrado.</p>
    </div>
<?php else: ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php $__currentLoopData = $alunos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aluno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-2xl p-5 shadow-soft hover:shadow-lg border border-slate-100/80 transition-all group">
        <div class="flex items-start gap-3 mb-4">
            <?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['nome' => $aluno->nome,'foto' => $aluno->foto_path,'size' => '14']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nome' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($aluno->nome),'foto' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($aluno->foto_path),'size' => '14']); ?>
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
                <p class="font-bold text-slate-900 truncate"><?php echo e($aluno->nome); ?></p>
                <p class="text-xs text-slate-500">Mat. <?php echo e($aluno->matricula); ?></p>
                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'brand','class' => 'mt-1.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'brand','class' => 'mt-1.5']); ?><?php echo e($aluno->turma); ?> <?php echo $__env->renderComponent(); ?>
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
            <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => $aluno->ativo ? 'green' : 'gray']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($aluno->ativo ? 'green' : 'gray')]); ?>
                <?php echo e($aluno->ativo ? 'Ativo' : 'Inativo'); ?>

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

        <div class="text-xs text-slate-500 mb-4 min-h-[36px]">
            <?php if($aluno->responsaveis->isNotEmpty()): ?>
                <p class="flex items-start gap-1.5">
                    <i class="ph ph-users-three text-slate-400 mt-0.5"></i>
                    <span class="line-clamp-2"><?php echo e($aluno->responsaveis->pluck('nome')->join(', ')); ?></span>
                </p>
            <?php else: ?>
                <p class="text-slate-400 italic flex items-center gap-1.5">
                    <i class="ph ph-warning-circle text-amber-500"></i>
                    Nenhum responsável vinculado
                </p>
            <?php endif; ?>
        </div>

        <div class="flex gap-2 pt-4 border-t border-slate-100">
            <a href="<?php echo e(route('alunos.edit', $aluno)); ?>" class="flex-1 text-center bg-senai-50 hover:bg-senai-100 text-senai-700 font-semibold py-2 rounded-lg text-xs flex items-center justify-center gap-1.5">
                <i class="ph ph-pencil-simple"></i> Editar
            </a>
            <form method="POST" action="<?php echo e(route('alunos.destroy', $aluno)); ?>" class="flex-1"
                  x-data @submit.prevent="if(confirm('Desativar este aluno?')) $event.target.submit()">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="w-full bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold py-2 rounded-lg text-xs flex items-center justify-center gap-1.5">
                    <i class="ph ph-trash"></i> Desativar
                </button>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="mt-6"><?php echo e($alunos->links()); ?></div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\resources\views/alunos/index.blade.php ENDPATH**/ ?>