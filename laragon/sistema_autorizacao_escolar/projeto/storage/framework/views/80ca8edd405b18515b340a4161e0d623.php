
<?php $__env->startSection('title', $tipo === 'saida' ? 'Confirmar Saída' : 'Confirmar Entrada'); ?>
<?php $__env->startSection('subtitle', 'Revise os dados e confirme o registro'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">

    <?php
        $isSaida = $tipo === 'saida';
        $cor = $isSaida ? 'orange' : 'emerald';
        $gradient = $isSaida ? 'from-orange-500 to-amber-600' : 'from-emerald-500 to-teal-600';
    ?>

    
    <div class="bg-gradient-to-br <?php echo e($gradient); ?> rounded-2xl p-6 text-white mb-5 shadow-lg shadow-<?php echo e($cor); ?>-500/20 relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
        <div class="relative flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center">
                <i class="ph-fill <?php echo e($isSaida ? 'ph-sign-out' : 'ph-sign-in'); ?> text-3xl"></i>
            </div>
            <div>
                <p class="text-sm text-white/80 uppercase tracking-wider font-semibold">Registro de</p>
                <h2 class="text-3xl font-bold"><?php echo e($isSaida ? 'Saída' : 'Entrada'); ?></h2>
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6 mb-5">
        <div class="flex items-center gap-5 mb-5">
            <?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['nome' => $aluno->nome,'foto' => $aluno->foto_path,'size' => '20']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nome' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($aluno->nome),'foto' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($aluno->foto_path),'size' => '20']); ?>
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
            <div class="flex-1">
                <h3 class="text-xl font-bold text-slate-900"><?php echo e($aluno->nome); ?></h3>
                <p class="text-sm text-slate-500">Matrícula <strong><?php echo e($aluno->matricula); ?></strong> · <?php echo e($aluno->turma); ?></p>
                <?php if($aluno->responsaveis->isNotEmpty()): ?>
                <div class="flex items-center gap-1 mt-2">
                    <i class="ph ph-users-three text-slate-400 text-sm"></i>
                    <p class="text-xs text-slate-500">
                        <?php echo e($aluno->responsaveis->map(fn($r) => $r->nome . ' (' . $r->pivot->parentesco . ')')->join(', ')); ?>

                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if($isSaida && $autorizacao): ?>
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <i class="ph-fill ph-seal-check text-emerald-600 text-2xl shrink-0"></i>
                <div class="flex-1 text-sm">
                    <p class="font-bold text-emerald-900 mb-2">Autorização de Saída Ativa</p>
                    <div class="space-y-1 text-emerald-800">
                        <p><strong>Motivo:</strong> <?php echo e($autorizacao->motivo); ?></p>
                        <p><strong>Autorizado por:</strong> <?php echo e($autorizacao->responsavel->nome); ?></p>
                        <?php if($autorizacao->aprovadoPor): ?>
                            <p><strong>Aprovado por:</strong> <?php echo e($autorizacao->aprovadoPor->name); ?> (Professor)</p>
                        <?php endif; ?>
                        <?php if($autorizacao->validade_fim): ?>
                            <p class="text-emerald-700 text-xs mt-2 pt-2 border-t border-emerald-200">
                                <i class="ph ph-clock"></i> Válido até <?php echo e($autorizacao->validade_fim->format('d/m/Y H:i')); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php elseif(!$isSaida): ?>
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <i class="ph-fill ph-info text-blue-600 text-2xl shrink-0"></i>
                <div>
                    <p class="font-semibold text-blue-900 mb-0.5">Registrar entrada na escola</p>
                    <p class="text-sm text-blue-700">Os responsáveis serão notificados automaticamente por e-mail e WhatsApp.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    
    <form method="POST" action="<?php echo e(route('portaria.registrar', $aluno)); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="tipo" value="<?php echo e($tipo); ?>">

        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6 mb-4">
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                <i class="ph ph-note-pencil"></i> Observação <span class="text-slate-400 font-normal">(opcional)</span>
            </label>
            <textarea name="observacao" rows="3" placeholder="Ex: Saída antecipada por consulta médica..."
                class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500"></textarea>
        </div>

        <div class="flex gap-3">
            <a href="<?php echo e(route('portaria.index')); ?>"
                class="flex-1 text-center bg-white border-2 border-slate-200 text-slate-700 font-semibold py-3.5 rounded-xl hover:bg-slate-50 transition-colors">
                Cancelar
            </a>
            <button type="submit"
                class="flex-1 bg-gradient-to-br <?php echo e($gradient); ?> text-white font-bold py-3.5 rounded-xl shadow-lg shadow-<?php echo e($cor); ?>-500/30 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                <i class="ph-fill ph-check-circle text-lg"></i>
                Confirmar <?php echo e($isSaida ? 'Saída' : 'Entrada'); ?>

            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\projeto\resources\views/portaria/confirmar.blade.php ENDPATH**/ ?>