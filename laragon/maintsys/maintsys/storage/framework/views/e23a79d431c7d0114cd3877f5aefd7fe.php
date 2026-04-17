

<?php $__env->startSection('title', 'Nova Máquina'); ?>
<?php $__env->startSection('breadcrumb', '<a href="'.route('maquinas.index').'" style="color:var(--muted);text-decoration:none">máquinas</a> <span class="sep">/</span> <span>nova</span>'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// cadastro</small>
        Nova Máquina
    </div>
    <a href="<?php echo e(route('maquinas.index')); ?>" class="btn btn-secondary">← Voltar</a>
</div>

<div class="form-card">
    <form method="POST" action="<?php echo e(route('maquinas.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-row">
            <div class="form-group">
                <label>Número de Série *</label>
                <input type="text" name="numero_serie" class="form-control"
                       value="<?php echo e(old('numero_serie')); ?>" placeholder="ex: SN-2024-001" required>
                <?php $__errorArgs = ['numero_serie'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Modelo *</label>
                <input type="text" name="modelo" class="form-control"
                       value="<?php echo e(old('modelo')); ?>" placeholder="ex: Torno CNC TL-500" required>
                <?php $__errorArgs = ['modelo'];
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
                <label>Fabricante</label>
                <input type="text" name="fabricante" class="form-control"
                       value="<?php echo e(old('fabricante')); ?>" placeholder="ex: Romi, Tornos...">
            </div>
            <div class="form-group">
                <label>Localização no Galpão *</label>
                <input type="text" name="localizacao" class="form-control"
                       value="<?php echo e(old('localizacao')); ?>" placeholder="ex: Galpão A — Setor 3" required>
                <?php $__errorArgs = ['localizacao'];
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
                <label>Data de Instalação</label>
                <input type="date" name="data_instalacao" class="form-control"
                       value="<?php echo e(old('data_instalacao')); ?>">
            </div>
            <div class="form-group">
                <label>Status *</label>
                <select name="status" class="form-control" required>
                    <option value="operacional"    <?php echo e(old('status','operacional')=='operacional'?'selected':''); ?>>Operacional</option>
                    <option value="em_manutencao"  <?php echo e(old('status')=='em_manutencao'?'selected':''); ?>>Em Manutenção</option>
                    <option value="parada_critica" <?php echo e(old('status')=='parada_critica'?'selected':''); ?>>Parada Crítica</option>
                    <option value="inativa"        <?php echo e(old('status')=='inativa'?'selected':''); ?>>Inativa</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Descrição / Observações</label>
            <textarea name="descricao" class="form-control" rows="3"
                      placeholder="Informações adicionais sobre o equipamento..."><?php echo e(old('descricao')); ?></textarea>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary">Cadastrar Máquina</button>
            <a href="<?php echo e(route('maquinas.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\maintsys\maintsys\resources\views/maquinas/create.blade.php ENDPATH**/ ?>