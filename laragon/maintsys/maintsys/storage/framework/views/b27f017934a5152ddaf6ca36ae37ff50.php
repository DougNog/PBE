

<?php $__env->startSection('title', 'Nova O.S.'); ?>
<?php $__env->startSection('breadcrumb', '<a href="'.route('ordens.index').'" style="color:var(--muted);text-decoration:none">ordens</a> <span class="sep">/</span> <span>nova</span>'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// abertura de ordem</small>
        Nova Ordem de Serviço
    </div>
    <a href="<?php echo e(route('ordens.index')); ?>" class="btn btn-secondary">← Voltar</a>
</div>

<div class="form-card">
    <form method="POST" action="<?php echo e(route('ordens.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-row">
            <div class="form-group">
                <label>Máquina *</label>
                <select name="maquina_id" class="form-control" required>
                    <option value="">— Selecione a máquina —</option>
                    <?php $__currentLoopData = $maquinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($m->id); ?>"
                        <?php echo e((old('maquina_id', request('maquina_id')) == $m->id) ? 'selected' : ''); ?>>
                        <?php echo e($m->modelo); ?> — <?php echo e($m->numero_serie); ?> [<?php echo e($m->localizacao); ?>]
                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['maquina_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Técnico Responsável *</label>
                <select name="tecnico_id" class="form-control" required>
                    <option value="">— Selecione o técnico —</option>
                    <?php $__currentLoopData = $tecnicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($t->id); ?>" <?php echo e(old('tecnico_id') == $t->id ? 'selected' : ''); ?>>
                        <?php echo e($t->nome); ?> — <?php echo e($t->especialidade ?? 'Geral'); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['tecnico_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tipo de Manutenção *</label>
                <select name="tipo" class="form-control" required>
                    <option value="">— Selecione —</option>
                    <option value="preventiva" <?php echo e(old('tipo')=='preventiva'?'selected':''); ?>>Preventiva</option>
                    <option value="corretiva"  <?php echo e(old('tipo')=='corretiva'?'selected':''); ?>>Corretiva</option>
                </select>
                <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Prioridade *</label>
                <select name="prioridade" class="form-control" required>
                    <option value="baixa"  <?php echo e(old('prioridade')=='baixa'?'selected':''); ?>>Baixa</option>
                    <option value="media"  <?php echo e(old('prioridade','media')=='media'?'selected':''); ?>>Média</option>
                    <option value="alta"   <?php echo e(old('prioridade')=='alta'?'selected':''); ?>>Alta</option>
                    <option value="critica"<?php echo e(old('prioridade')=='critica'?'selected':''); ?>>🚨 Crítica</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Descrição do Problema / Serviço *</label>
            <textarea name="descricao" class="form-control" rows="4"
                      placeholder="Descreva detalhadamente o problema identificado ou o serviço a ser executado..."
                      required><?php echo e(old('descricao')); ?></textarea>
            <?php $__errorArgs = ['descricao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Data Prevista para Conclusão</label>
            <input type="date" name="data_prevista" class="form-control"
                   value="<?php echo e(old('data_prevista')); ?>" style="max-width:200px">
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary">Abrir Ordem de Serviço</button>
            <a href="<?php echo e(route('ordens.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\maintsys\resources\views/ordens/create.blade.php ENDPATH**/ ?>