

<?php $__env->startSection('title', 'Novo Técnico'); ?>
<?php $__env->startSection('breadcrumb', '<a href="'.route('tecnicos.index').'" style="color:var(--muted);text-decoration:none">técnicos</a> <span class="sep">/</span> <span>novo</span>'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// cadastro</small>
        Novo Técnico
    </div>
    <a href="<?php echo e(route('tecnicos.index')); ?>" class="btn btn-secondary">← Voltar</a>
</div>

<div class="form-card">
    <form method="POST" action="<?php echo e(route('tecnicos.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-row">
            <div class="form-group">
                <label>Nome Completo *</label>
                <input type="text" name="nome" class="form-control"
                       value="<?php echo e(old('nome')); ?>" placeholder="ex: João da Silva" required>
                <?php $__errorArgs = ['nome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Matrícula *</label>
                <input type="text" name="matricula" class="form-control"
                       value="<?php echo e(old('matricula')); ?>" placeholder="ex: TEC-001" required>
                <?php $__errorArgs = ['matricula'];
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
                <label>E-mail *</label>
                <input type="email" name="email" class="form-control"
                       value="<?php echo e(old('email')); ?>" placeholder="tecnico@empresa.com" required>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Especialidade</label>
                <input type="text" name="especialidade" class="form-control"
                       value="<?php echo e(old('especialidade')); ?>" placeholder="ex: Elétrica, Hidráulica, Mecânica">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Senha *</label>
                <input type="password" name="password" class="form-control"
                       placeholder="Mínimo 8 caracteres" required>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label>Confirmar Senha *</label>
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Repita a senha" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control"
                       value="<?php echo e(old('telefone')); ?>" placeholder="(19) 99999-9999">
            </div>
            <div class="form-group" style="display:flex;align-items:center;gap:10px;padding-top:22px">
                <input type="hidden" name="ativo" value="0">
                <input type="checkbox" name="ativo" value="1" id="ativo"
                       <?php echo e(old('ativo', '1') ? 'checked' : ''); ?>

                       style="width:16px;height:16px;accent-color:var(--accent)">
                <label for="ativo" style="font-family:var(--cond);font-size:14px;color:var(--text);letter-spacing:0">
                    Técnico Ativo
                </label>
            </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary">Cadastrar Técnico</button>
            <a href="<?php echo e(route('tecnicos.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\maintsys\resources\views/tecnicos/create.blade.php ENDPATH**/ ?>