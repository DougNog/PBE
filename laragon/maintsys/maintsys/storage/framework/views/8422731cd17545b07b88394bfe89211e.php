

<?php $__env->startSection('title', 'Técnicos'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <span>técnicos</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// equipe de manutenção</small>
        Técnicos
    </div>
    <a href="<?php echo e(route('tecnicos.create')); ?>" class="btn btn-primary">+ Novo Técnico</a>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>O.S.</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $tecnicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="mono" style="color:var(--muted);font-size:11px"><?php echo e($t->id); ?></td>
                <td class="mono" style="color:var(--accent);font-size:11px"><?php echo e($t->matricula); ?></td>
                <td style="font-weight:500"><?php echo e($t->nome); ?></td>
                <td style="color:var(--muted)"><?php echo e($t->especialidade ?? '—'); ?></td>
                <td style="color:var(--muted);font-size:12px"><?php echo e($t->email); ?></td>
                <td class="mono" style="font-size:11px;color:var(--muted)">
                    <?php if($t->telefone): ?>
                        <?php
                            $tel = preg_replace('/\D/', '', $t->telefone);
                            $formatted = strlen($tel) === 11
                                ? '('.substr($tel,0,2).') '.substr($tel,2,5).'-'.substr($tel,7)
                                : (strlen($tel) === 10
                                    ? '('.substr($tel,0,2).') '.substr($tel,2,4).'-'.substr($tel,6)
                                    : $t->telefone);
                        ?>
                        <?php echo e($formatted); ?>

                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
                <td class="mono" style="text-align:center"><?php echo e($t->ordens_count); ?></td>
                <td>
                    <span class="badge <?php echo e($t->ativo ? 'badge-green' : 'badge-gray'); ?>">
                        <?php echo e($t->ativo ? 'Ativo' : 'Inativo'); ?>

                    </span>
                </td>
                <td>
                    <div class="actions">
                        <a href="<?php echo e(route('tecnicos.show', $t)); ?>" class="btn btn-secondary btn-sm">Ver</a>
                        <a href="<?php echo e(route('tecnicos.edit', $t)); ?>" class="btn btn-secondary btn-sm">Editar</a>
                        <form method="POST" action="<?php echo e(route('tecnicos.destroy', $t)); ?>"
                              onsubmit="confirmDelete(this, 'Excluir o técnico <?php echo e($t->nome); ?>?'); return false;">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Del</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="9" style="text-align:center;color:var(--muted);font-family:var(--mono);padding:32px">
                    — nenhum técnico cadastrado —
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="pagination"><?php echo e($tecnicos->links()); ?></div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\maintsys\maintsys\resources\views/tecnicos/index.blade.php ENDPATH**/ ?>