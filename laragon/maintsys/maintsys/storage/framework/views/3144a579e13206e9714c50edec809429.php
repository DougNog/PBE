

<?php $__env->startSection('title', 'Ordens de Serviço'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <span>ordens de serviço</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// gestão de O.S.</small>
        Ordens de Serviço
    </div>
    <a href="<?php echo e(route('ordens.create')); ?>" class="btn btn-primary">+ Nova O.S.</a>
</div>

<div class="stats-grid" style="grid-template-columns:repeat(4,1fr)">
    <div class="stat-card blue">
        <div class="stat-label">Abertas</div>
        <div class="stat-value" style="color:var(--blue)"><?php echo e($stats['abertas']); ?></div>
    </div>
    <div class="stat-card yellow">
        <div class="stat-label">Em Andamento</div>
        <div class="stat-value" style="color:var(--yellow)"><?php echo e($stats['em_andamento']); ?></div>
    </div>
    <div class="stat-card green">
        <div class="stat-label">Concluídas</div>
        <div class="stat-value" style="color:var(--green)"><?php echo e($stats['concluidas']); ?></div>
    </div>
    <div class="stat-card red">
        <div class="stat-label">Críticas Ativas</div>
        <div class="stat-value" style="color:var(--red)"><?php echo e($stats['criticas']); ?></div>
    </div>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Tipo</th>
                <th>Máquina</th>
                <th>Técnico</th>
                <th>Prioridade</th>
                <th>Status</th>
                <th>Abertura</th>
                <th>Prevista</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $ordens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $os): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="mono" style="font-size:11px;color:var(--accent)"><?php echo e($os->numero); ?></td>
                <td>
                    <span class="badge <?php echo e($os->tipo === 'corretiva' ? 'badge-orange' : 'badge-blue'); ?>">
                        <?php echo e($os->tipo_label); ?>

                    </span>
                </td>
                <td style="font-weight:500"><?php echo e($os->maquina->modelo ?? '—'); ?></td>
                <td style="color:var(--muted)"><?php echo e($os->tecnico->nome ?? '—'); ?></td>
                <td>
                    <?php $pc = match($os->prioridade){
                        'critica' => 'red',
                        'alta'    => 'orange',
                        'media'   => 'yellow',
                        default   => 'gray'
                    }; ?>
                    <span class="badge badge-<?php echo e($pc); ?>"><?php echo e($os->prioridade_label); ?></span>
                </td>
                <td>
                    <?php $sc = match($os->status){
                        'aberta'       => 'blue',
                        'em_andamento' => 'yellow',
                        'concluida'    => 'green',
                        default        => 'gray'
                    }; ?>
                    <span class="badge badge-<?php echo e($sc); ?>"><?php echo e($os->status_label); ?></span>
                </td>
                <td class="mono" style="font-size:11px;color:var(--muted)"><?php echo e($os->data_abertura->format('d/m/Y')); ?></td>
                <td class="mono" style="font-size:11px;color:var(--muted)">
                    <?php echo e($os->data_prevista ? $os->data_prevista->format('d/m/Y') : '—'); ?>

                </td>
                <td>
                    <div class="actions">
                        <a href="<?php echo e(route('ordens.show', $os)); ?>" class="btn btn-secondary btn-sm">Ver</a>
                        <a href="<?php echo e(route('ordens.edit', $os)); ?>" class="btn btn-secondary btn-sm">Editar</a>
                        <form method="POST" action="<?php echo e(route('ordens.destroy', $os)); ?>"
                              onsubmit="confirmDelete(this, 'Excluir O.S. <?php echo e($os->numero); ?>?'); return false;">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Del</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="9" style="text-align:center;color:var(--muted);font-family:var(--mono);padding:32px">
                    — nenhuma ordem de serviço —
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="pagination"><?php echo e($ordens->links()); ?></div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\maintsys\maintsys\resources\views/ordens/index.blade.php ENDPATH**/ ?>