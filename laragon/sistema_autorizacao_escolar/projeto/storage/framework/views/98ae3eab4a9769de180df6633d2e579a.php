
<?php $__env->startSection('title', 'Nova Autorização'); ?>
<?php $__env->startSection('subtitle', 'Pré-autorize a entrada ou saída de um aluno'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto">
    <form method="POST" action="<?php echo e(route('autorizacoes.store')); ?>" class="space-y-5">
        <?php echo csrf_field(); ?>

        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6">
            <h3 class="font-bold text-slate-800 mb-1 flex items-center gap-2">
                <i class="ph ph-seal-check text-senai-600"></i>
                Dados da autorização
            </h3>
            <p class="text-xs text-slate-500 mb-5">Defina aluno, responsável e tipo de autorização</p>

            <div class="grid sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Aluno</label>
                    <select name="aluno_id" required
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        <option value="">— Selecione o aluno —</option>
                        <?php $__currentLoopData = $alunos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aluno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($aluno->id); ?>" <?php echo e(old('aluno_id') == $aluno->id ? 'selected' : ''); ?>>
                            <?php echo e($aluno->nome); ?> · <?php echo e($aluno->turma); ?> (Mat. <?php echo e($aluno->matricula); ?>)
                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Responsável autorizante</label>
                    <select name="responsavel_id" required
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        <option value="">— Selecione o responsável —</option>
                        <?php $__currentLoopData = $responsaveis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($r->id); ?>" <?php echo e(old('responsavel_id') == $r->id ? 'selected' : ''); ?>>
                            <?php echo e($r->nome); ?> · <?php echo e($r->telefone); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Tipo</label>
                    <select name="tipo" required
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        <option value="saida" <?php echo e(old('tipo') === 'saida' ? 'selected' : ''); ?>>Saída</option>
                        <option value="entrada" <?php echo e(old('tipo') === 'entrada' ? 'selected' : ''); ?>>Entrada</option>
                        <option value="ambos" <?php echo e(old('tipo') === 'ambos' ? 'selected' : ''); ?>>Entrada e Saída</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Status inicial</label>
                    <select name="status"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        <option value="ativa">Ativa (aprovada)</option>
                        <option value="pendente_professor">Pendente aprovação do professor</option>
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Motivo</label>
                    <textarea name="motivo" rows="2" required placeholder="Ex: Consulta médica..."
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500"><?php echo e(old('motivo')); ?></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Válido de</label>
                    <input type="datetime-local" name="validade_inicio" value="<?php echo e(old('validade_inicio')); ?>"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Válido até</label>
                    <input type="datetime-local" name="validade_fim" value="<?php echo e(old('validade_fim')); ?>"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="<?php echo e(route('autorizacoes.index')); ?>"
                class="flex-1 text-center bg-white border-2 border-slate-200 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-50">
                Cancelar
            </a>
            <button type="submit"
                class="flex-1 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-senai-600/30 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                <i class="ph-fill ph-check-circle"></i> Salvar Autorização
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\projeto\resources\views/autorizacoes/create.blade.php ENDPATH**/ ?>