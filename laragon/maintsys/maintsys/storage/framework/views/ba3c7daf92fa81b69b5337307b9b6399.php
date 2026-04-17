

<?php $__env->startSection('title', 'Histórico de Manutenções'); ?>
<?php $__env->startSection('breadcrumb', '<span>histórico</span>'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// log de intervenções</small>
        Histórico de Manutenções
    </div>
</div>


<div class="table-wrap" style="padding:16px;margin-bottom:16px">
    <form method="GET" action="<?php echo e(route('historico.index')); ?>">
        <div style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end">
            <div>
                <div style="font-family:var(--mono);font-size:9px;color:var(--muted);letter-spacing:1.5px;margin-bottom:5px">MÁQUINA</div>
                <select name="maquina_id" class="form-control" style="width:200px">
                    <option value="">Todas</option>
                    <?php $__currentLoopData = $maquinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($m->id); ?>" <?php echo e(request('maquina_id')==$m->id?'selected':''); ?>><?php echo e($m->modelo); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <div style="font-family:var(--mono);font-size:9px;color:var(--muted);letter-spacing:1.5px;margin-bottom:5px">TIPO</div>
                <select name="tipo" class="form-control" style="width:150px">
                    <option value="">Todos</option>
                    <option value="preventiva" <?php echo e(request('tipo')=='preventiva'?'selected':''); ?>>Preventiva</option>
                    <option value="corretiva"  <?php echo e(request('tipo')=='corretiva'?'selected':''); ?>>Corretiva</option>
                </select>
            </div>
            <div>
                <div style="font-family:var(--mono);font-size:9px;color:var(--muted);letter-spacing:1.5px;margin-bottom:5px">TÉCNICO</div>
                <select name="tecnico_id" class="form-control" style="width:180px">
                    <option value="">Todos</option>
                    <?php $__currentLoopData = $tecnicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($t->id); ?>" <?php echo e(request('tecnico_id')==$t->id?'selected':''); ?>><?php echo e($t->nome); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <div style="font-family:var(--mono);font-size:9px;color:var(--muted);letter-spacing:1.5px;margin-bottom:5px">DE</div>
                <input type="date" name="data_inicio" class="form-control" style="width:150px" value="<?php echo e(request('data_inicio')); ?>">
            </div>
            <div>
                <div style="font-family:var(--mono);font-size:9px;color:var(--muted);letter-spacing:1.5px;margin-bottom:5px">ATÉ</div>
                <input type="date" name="data_fim" class="form-control" style="width:150px" value="<?php echo e(request('data_fim')); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="<?php echo e(route('historico.index')); ?>" class="btn btn-secondary">Limpar</a>
        </div>
    </form>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Máquina</th>
                <th>Tipo</th>
                <th>Técnico</th>
                <th>O.S. Vinculada</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Parada (h)</th>
                <th>Custo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $historicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="mono" style="color:var(--muted);font-size:11px"><?php echo e($h->id); ?></td>
                <td style="font-weight:500"><?php echo e($h->maquina->modelo ?? '—'); ?></td>
                <td><span class="badge <?php echo e($h->tipo==='corretiva'?'badge-orange':'badge-blue'); ?>"><?php echo e(ucfirst($h->tipo)); ?></span></td>
                <td style="color:var(--muted)"><?php echo e($h->tecnico->nome ?? '—'); ?></td>
                <td class="mono" style="font-size:11px">
                    <?php if($h->ordem): ?>
                        <a href="<?php echo e(route('ordens.show', $h->ordem)); ?>" style="color:var(--accent)"><?php echo e($h->ordem->numero); ?></a>
                    <?php else: ?>
                        <span style="color:var(--muted)">—</span>
                    <?php endif; ?>
                </td>
                <td class="mono" style="font-size:11px;color:var(--muted)"><?php echo e($h->data_inicio->format('d/m/Y H:i')); ?></td>
                <td class="mono" style="font-size:11px;color:var(--muted)"><?php echo e($h->data_fim ? $h->data_fim->format('d/m/Y H:i') : '—'); ?></td>
                <td class="mono" style="font-size:11px;text-align:center">
                    <?php echo e($h->tempo_parada_horas > 0 ? number_format($h->tempo_parada_horas, 1) : '—'); ?>

                </td>
                <td class="mono" style="font-size:11px;color:<?php echo e($h->custo > 0 ? 'var(--accent)' : 'var(--muted)'); ?>">
                    <?php echo e($h->custo > 0 ? 'R$ '.number_format($h->custo, 2, ',', '.') : '—'); ?>

                </td>
                <td>
                    <div class="actions">
                        <a href="<?php echo e(route('historico.show', $h)); ?>" class="btn btn-secondary btn-sm">Ver</a>
                        <form method="POST" action="<?php echo e(route('historico.destroy', $h)); ?>"
                              onsubmit="return confirm('Excluir este registro?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Del</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="10" style="text-align:center;color:var(--muted);font-family:var(--mono);padding:32px">
                    — nenhum registro no histórico —
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="pagination"><?php echo e($historicos->links()); ?></div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\maintsys\resources\views/historico/index.blade.php ENDPATH**/ ?>