<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?>  <?php $__env->endSlot(); ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap');
        :root{--ink:#0a0a0f;--surface:#f5f4f0;--card:#fff;--muted:#888;--border:#e8e6e1;--accent:#3b5bdb;--ar:59,91,219;--red:#ff4c4c;}
        *{box-sizing:border-box;margin:0;padding:0;}
        .root{font-family:'DM Sans',sans-serif;background:var(--surface);min-height:100vh;color:var(--ink);}
        .hero{position:relative;overflow:hidden;background:var(--ink);padding:2.5rem 2.5rem 2rem;}
        .hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 55% 80% at 90% -10%,rgba(var(--ar),.45) 0%,transparent 65%),radial-gradient(ellipse 35% 55% at -5% 110%,rgba(var(--ar),.2) 0%,transparent 60%);pointer-events:none;}
        .hero-inner{position:relative;z-index:1;max-width:860px;margin:0 auto;display:flex;align-items:center;gap:1rem;}
        .btn-back{display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.7);font-family:'Syne',sans-serif;font-size:.75rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:.5rem 1rem;border-radius:100px;text-decoration:none;transition:background .2s,color .2s;white-space:nowrap;flex-shrink:0;}
        .btn-back:hover{background:rgba(255,255,255,.14);color:#fff;}
        .hero-title{font-family:'Syne',sans-serif;font-size:clamp(1.5rem,4vw,2.4rem);font-weight:800;color:#fff;letter-spacing:-.03em;line-height:1.1;}
        .hero-sub{margin-top:.35rem;font-size:.85rem;color:rgba(255,255,255,.4);font-weight:300;}
        .body{max-width:860px;margin:0 auto;padding:2.5rem 2rem 4rem;}
        .card{background:var(--card);border:1px solid var(--border);border-radius:24px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.04);animation:fadeUp .45s ease both;}
        .card-head{padding:1.5rem 2rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.75rem;}
        .dot{width:10px;height:10px;border-radius:50%;background:var(--accent);box-shadow:0 0 0 3px rgba(var(--ar),.15);}
        .card-title{font-family:'Syne',sans-serif;font-size:1rem;font-weight:700;}
        .card-body{padding:2rem;}
        .grid{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;}
        .full{grid-column:1/-1;}
        .field{display:flex;flex-direction:column;gap:.45rem;}
        .field label{font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);}
        .field label span{color:var(--accent);}
        .field input,.field select,.field textarea{background:var(--surface);border:1.5px solid var(--border);border-radius:12px;padding:.85rem 1rem;font-family:'DM Sans',sans-serif;font-size:.92rem;color:var(--ink);outline:none;transition:border-color .2s,box-shadow .2s,background .2s;width:100%;}
        .field input:focus,.field select:focus,.field textarea:focus{border-color:var(--accent);background:#fff;box-shadow:0 0 0 3px rgba(var(--ar),.1);}
        .field input::placeholder,.field textarea::placeholder{color:#c0bdb8;}
        .field select{cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23888' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 1rem center;padding-right:2.5rem;}
        .field textarea{resize:vertical;min-height:100px;}
        .field-error{font-size:.78rem;color:var(--red);font-weight:500;}
        .alert-errors{background:#fff3f3;border:1px solid #fbc4c4;border-left:4px solid var(--red);border-radius:14px;padding:1rem 1.25rem;margin-bottom:1.5rem;font-size:.88rem;color:#900;}
        .alert-errors ul{padding-left:1.2rem;margin-top:.4rem;}
        .card-foot{padding:1.5rem 2rem;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:flex-end;gap:1rem;}
        .btn-cancel{display:inline-flex;align-items:center;background:transparent;border:1.5px solid var(--border);color:var(--muted);font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;letter-spacing:.04em;text-transform:uppercase;padding:.75rem 1.5rem;border-radius:100px;text-decoration:none;cursor:pointer;transition:all .2s;}
        .btn-cancel:hover{border-color:#ccc;color:var(--ink);}
        .btn-submit{display:inline-flex;align-items:center;gap:.5rem;background:var(--accent);color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:.85rem;letter-spacing:.04em;text-transform:uppercase;padding:.85rem 2rem;border-radius:100px;border:none;cursor:pointer;transition:transform .2s,box-shadow .2s,filter .2s;}
        .btn-submit:hover{filter:brightness(1.1);transform:translateY(-2px);box-shadow:0 12px 28px rgba(var(--ar),.35);}

        /* status pills preview */
        .status-pills{display:flex;gap:.5rem;flex-wrap:wrap;margin-top:.5rem;}
        .status-pill{font-size:.72rem;font-weight:700;font-family:'Syne',sans-serif;padding:.25rem .75rem;border-radius:100px;cursor:pointer;border:1.5px solid transparent;transition:all .15s;opacity:.5;}
        .status-pill.active{opacity:1;}
        .pill-aberto{background:#e0e7ff;color:#2d45a0;border-color:#b8c5f7;}
        .pill-pendente{background:#fef9ec;color:#92660a;border-color:#f5d99a;}
        .pill-aprovado{background:#d9fff3;color:#0c7a58;border-color:#a3dfc5;}
        .pill-entregue{background:#d9fff3;color:#0c7a58;border-color:#a3dfc5;}
        .pill-cancelado{background:#ffe4e4;color:#b00010;border-color:#fbc4c4;}

        @keyframes fadeUp{from{opacity:0;transform:translateY(18px);}to{opacity:1;transform:translateY(0);}}
        @media(max-width:600px){.hero{padding:1.75rem 1.25rem 1.5rem;}.body{padding:1.5rem 1rem 3rem;}.grid{grid-template-columns:1fr;}.card-body{padding:1.5rem;}.card-foot{padding:1.25rem 1.5rem;}}
    </style>

    <div class="root">
        <div class="hero">
            <div class="hero-inner">
                <a href="<?php echo e(route('pedidos.index')); ?>" class="btn-back">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Voltar
                </a>
                <div>
                    <div class="hero-title">Novo Pedido</div>
                    <div class="hero-sub">Registre um novo pedido no sistema.</div>
                </div>
            </div>
        </div>

        <div class="body">
            <?php if($errors->any()): ?>
                <div class="alert-errors">
                    <strong>Verifique os campos:</strong>
                    <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('pedidos.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card">
                    <div class="card-head"><span class="dot"></span><span class="card-title">Dados do pedido</span></div>
                    <div class="card-body">
                        <div class="grid">
                            <div class="field">
                                <label>Número do pedido <span>*</span></label>
                                <input type="text" name="numero" value="<?php echo e(old('numero')); ?>" placeholder="Ex: 001" required>
                                <?php $__errorArgs = ['numero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="field-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="field">
                                <label>Data <span>*</span></label>
                                <input type="date" name="data" value="<?php echo e(old('data', date('Y-m-d'))); ?>" required>
                                <?php $__errorArgs = ['data'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="field-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="field full">
                                <label>Status <span>*</span></label>
                                <select name="status" id="statusSelect" required>
                                    <option value="">Selecione...</option>
                                    <option value="aberto"       <?php echo e(old('status')=='aberto'       ? 'selected' : ''); ?>>Aberto</option>
                                    <option value="em_producao"  <?php echo e(old('status')=='em_producao'  ? 'selected' : ''); ?>>Em Produção</option>
                                    <option value="entregue"     <?php echo e(old('status')=='entregue'     ? 'selected' : ''); ?>>Entregue</option>
                                    <option value="cancelado"    <?php echo e(old('status')=='cancelado'    ? 'selected' : ''); ?>>Cancelado</option>
                                </select>
                                <div class="status-pills">
                                    <span class="status-pill pill-aberto"      onclick="setStatus('aberto')">● Aberto</span>
                                    <span class="status-pill pill-em_producao" onclick="setStatus('em_producao')">● Em Produção</span>
                                    <span class="status-pill pill-entregue"    onclick="setStatus('entregue')">● Entregue</span>
                                    <span class="status-pill pill-cancelado"   onclick="setStatus('cancelado')">● Cancelado</span>
                                </div>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="field-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="field full">
                                <label>Observação</label>
                                <textarea name="observacao" placeholder="Alguma observação sobre o pedido..."><?php echo e(old('observacao')); ?></textarea>
                                <?php $__errorArgs = ['observacao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="field-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-foot">
                        <a href="<?php echo e(route('pedidos.index')); ?>" class="btn-cancel">Cancelar</a>
                        <button type="submit" class="btn-submit">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Salvar pedido
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function setStatus(val){
            document.getElementById('statusSelect').value=val;
            document.querySelectorAll('.status-pill').forEach(p=>p.classList.remove('active'));
            document.querySelector('.pill-'+val)?.classList.add('active');
        }
        // sync pills on load (old value)
        const cur=document.getElementById('statusSelect').value;
        if(cur) setStatus(cur);
        // sync select → pills
        document.getElementById('statusSelect').addEventListener('change',function(){setStatus(this.value);});
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\confeccao\resources\views/pedidos/create.blade.php ENDPATH**/ ?>