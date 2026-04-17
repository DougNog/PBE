<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <span>dashboard</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// visão geral</small>
        Dashboard
    </div>
    <div style="font-family:var(--mono);font-size:11px;color:var(--muted)">
        <?php echo e(now()->format('d/m/Y H:i')); ?>

    </div>
</div>


<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Máquinas</div>
        <div class="stat-value"><?php echo e($stats['maquinas_total']); ?></div>
    </div>
    <div class="stat-card green">
        <div class="stat-label">Operacionais</div>
        <div class="stat-value" style="color:var(--green)"><?php echo e($stats['operacionais']); ?></div>
    </div>
    <div class="stat-card yellow">
        <div class="stat-label">Em Manutenção</div>
        <div class="stat-value" style="color:var(--yellow)"><?php echo e($stats['em_manutencao']); ?></div>
    </div>
    <div class="stat-card red">
        <div class="stat-label">Parada Crítica</div>
        <div class="stat-value" style="color:var(--red)"><?php echo e($stats['parada_critica']); ?></div>
    </div>
    <div class="stat-card blue">
        <div class="stat-label">Técnicos Ativos</div>
        <div class="stat-value" style="color:var(--blue)"><?php echo e($stats['tecnicos_ativos']); ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">O.S. Abertas</div>
        <div class="stat-value"><?php echo e($stats['os_abertas']); ?></div>
    </div>
    <div class="stat-card yellow">
        <div class="stat-label">Em Andamento</div>
        <div class="stat-value" style="color:var(--yellow)"><?php echo e($stats['os_em_andamento']); ?></div>
    </div>
    <div class="stat-card green">
        <div class="stat-label">Concluídas Hoje</div>
        <div class="stat-value" style="color:var(--green)"><?php echo e($stats['os_concluidas_hoje']); ?></div>
    </div>
</div>


<?php if($alertas->count() > 0): ?>
<div style="margin-bottom:24px;border:1px solid rgba(248,81,73,.3);background:rgba(248,81,73,.04);padding:16px;border-radius:4px;">
    <div style="font-family:var(--mono);font-size:10px;color:var(--red);letter-spacing:2px;margin-bottom:12px;display:flex;align-items:center;gap:8px;">
        ⚠ // ALERTAS — MÁQUINAS EM PARADA CRÍTICA
        <span style="background:rgba(248,81,73,.15);color:var(--red);padding:1px 8px;font-size:10px;border:1px solid rgba(248,81,73,.3);">
            <?php echo e($alertas->count()); ?>

        </span>
    </div>
    <?php $__currentLoopData = $alertas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid rgba(248,81,73,.1);gap:12px;">
        <span style="font-family:var(--cond);font-size:15px;font-weight:600;flex:1;"><?php echo e($m->modelo); ?></span>
        <span style="font-family:var(--mono);font-size:11px;color:var(--muted);flex:1;"><?php echo e($m->localizacao); ?></span>
        <a href="<?php echo e(route('ordens.create')); ?>?maquina_id=<?php echo e($m->id); ?>" class="btn btn-danger btn-sm">
            + Abrir O.S.
        </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>


<div style="display:grid;grid-template-columns:1.6fr 1fr;gap:20px;">

    
    <div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
            <div style="font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:2px;">
                // ORDENS DE SERVIÇO ATIVAS
            </div>
            <a href="<?php echo e(route('ordens.index')); ?>" style="font-family:var(--mono);font-size:10px;color:var(--accent);text-decoration:none;letter-spacing:1px;">
                ver todas →
            </a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Máquina</th>
                        <th>Técnico</th>
                        <th>Prior.</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $ordensRecentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr style="cursor:pointer;" onclick="window.location='<?php echo e(route('ordens.show', $ordem)); ?>'">
                        <td class="mono" style="font-size:11px;color:var(--accent)"><?php echo e($ordem->numero); ?></td>
                        <td><?php echo e($ordem->maquina->modelo ?? '-'); ?></td>
                        <td style="color:var(--muted)"><?php echo e($ordem->tecnico->nome ?? '-'); ?></td>
                        <td>
                            <?php
                                $pc = match($ordem->prioridade) {
                                    'critica' => 'red',
                                    'alta'    => 'orange',
                                    'media'   => 'yellow',
                                    default   => 'gray'
                                };
                            ?>
                            <span class="badge badge-<?php echo e($pc); ?>"><?php echo e($ordem->prioridade_label); ?></span>
                        </td>
                        <td>
                            <?php
                                $sc = match($ordem->status) {
                                    'aberta'       => 'blue',
                                    'em_andamento' => 'yellow',
                                    default        => 'gray'
                                };
                            ?>
                            <span class="badge badge-<?php echo e($sc); ?>"><?php echo e($ordem->status_label); ?></span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" style="color:var(--muted);font-family:var(--mono);font-size:11px;text-align:center;padding:20px;">
                            — sem ordens ativas —
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div style="display:flex;flex-direction:column;gap:20px;">

        
        <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                <div style="font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:2px;">
                    // ÚLTIMAS MANUTENÇÕES
                </div>
                <a href="<?php echo e(route('historico.index')); ?>" style="font-family:var(--mono);font-size:10px;color:var(--accent);text-decoration:none;letter-spacing:1px;">
                    ver todas →
                </a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Máquina</th>
                            <th>Tipo</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $ultimasManutencoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($h->maquina->modelo ?? '-'); ?></td>
                            <td>
                                <span class="badge <?php echo e($h->tipo === 'corretiva' ? 'badge-orange' : 'badge-blue'); ?>">
                                    <?php echo e(ucfirst($h->tipo)); ?>

                                </span>
                            </td>
                            <td style="color:var(--muted);font-family:var(--mono);font-size:11px;">
                                <?php echo e($h->data_inicio->format('d/m H:i')); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" style="color:var(--muted);font-family:var(--mono);font-size:11px;text-align:center;padding:20px;">
                                — sem registros —
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div>
            <div style="font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:2px;margin-bottom:10px;">
                // AÇÕES RÁPIDAS
            </div>
            <div style="display:flex;flex-direction:column;gap:8px;">
                <a href="<?php echo e(route('ordens.create')); ?>" class="btn btn-primary" style="justify-content:center;">
                    + Nova Ordem de Serviço
                </a>
                <a href="<?php echo e(route('maquinas.create')); ?>" class="btn btn-secondary" style="justify-content:center;">
                    + Cadastrar Máquina
                </a>
                <a href="<?php echo e(route('tecnicos.create')); ?>" class="btn btn-secondary" style="justify-content:center;">
                    + Cadastrar Técnico
                </a>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\maintsys\maintsys\resources\views/dashboard.blade.php ENDPATH**/ ?>