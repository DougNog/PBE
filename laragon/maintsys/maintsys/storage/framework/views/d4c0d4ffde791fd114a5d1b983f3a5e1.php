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
        :root{--ink:#0a0a0f;--surface:#f5f4f0;--card:#fff;--muted:#888;--border:#e8e6e1;--accent:#5b4aff;--red:#ff4c4c;}
        *{box-sizing:border-box;margin:0;padding:0;}
        .root{font-family:'DM Sans',sans-serif;background:var(--surface);min-height:100vh;color:var(--ink);}
        .hero{position:relative;overflow:hidden;background:var(--ink);padding:2.5rem 2.5rem 2rem;}
        .hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 85% -10%,rgba(91,74,255,.45) 0%,transparent 65%),radial-gradient(ellipse 35% 55% at -5% 110%,rgba(255,107,53,.25) 0%,transparent 60%);pointer-events:none;}
        .hero-inner{position:relative;z-index:1;max-width:720px;margin:0 auto;display:flex;align-items:center;gap:1rem;}
        .back{display:inline-flex;align-items:center;gap:.4rem;color:rgba(255,255,255,.5);font-size:.82rem;font-weight:500;text-decoration:none;transition:color .2s;flex-shrink:0;}
        .back:hover{color:#fff;}
        .divider{width:1px;height:28px;background:rgba(255,255,255,.15);flex-shrink:0;}
        .hero-title{font-family:'Syne',sans-serif;font-size:clamp(1.3rem,3vw,1.9rem);font-weight:800;color:#fff;letter-spacing:-.03em;}
        .body{max-width:720px;margin:0 auto;padding:2.5rem 2rem 4rem;}
        .card{background:var(--card);border:1px solid var(--border);border-radius:24px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.04);animation:up .45s ease both;}
        @keyframes up{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
        .card-head{padding:1.5rem 2rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.75rem;}
        .icon{width:40px;height:40px;border-radius:12px;background:#ede9ff;display:flex;align-items:center;justify-content:center;font-size:1.1rem;}
        .ct{font-family:'Syne',sans-serif;font-size:1rem;font-weight:700;}
        .cs{font-size:.8rem;color:var(--muted);margin-top:.1rem;}
        .card-body{padding:2rem;}
        .fg{display:grid;gap:1.25rem;}
        .fg.c2{grid-template-columns:1fr 1fr;}
        .field{display:flex;flex-direction:column;gap:.45rem;}
        .field label{font-size:.78rem;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);}
        .field input{width:100%;background:var(--surface);border:1.5px solid var(--border);border-radius:12px;padding:.8rem 1rem;font-family:'DM Sans',sans-serif;font-size:.92rem;color:var(--ink);outline:none;transition:border-color .2s,box-shadow .2s,background .2s;}
        .field input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(91,74,255,.12);background:#fff;}
        .ferr{font-size:.78rem;color:var(--red);font-weight:500;}
        .pbox{margin-top:1.5rem;background:var(--surface);border:1.5px solid var(--border);border-radius:14px;padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;}
        .plabel{font-size:.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;font-weight:600;}
        .pvalue{font-family:'Syne',sans-serif;font-size:1.4rem;font-weight:800;color:var(--accent);}
        .flash-error{display:flex;align-items:flex-start;gap:.75rem;background:#fff3f3;border:1px solid #fbc4c4;border-left:4px solid var(--red);color:#9b0000;border-radius:14px;padding:1rem 1.25rem;font-size:.88rem;margin-bottom:1.5rem;}
        .flash-error ul{margin-left:1rem;margin-top:.25rem;}
        .card-foot{padding:1.5rem 2rem;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;}
        .btn-cancel{display:inline-flex;align-items:center;background:transparent;border:1.5px solid var(--border);color:var(--muted);font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;letter-spacing:.04em;text-transform:uppercase;padding:.75rem 1.5rem;border-radius:100px;text-decoration:none;cursor:pointer;transition:all .2s;}
        .btn-cancel:hover{border-color:var(--ink);color:var(--ink);}
        .btn-save{display:inline-flex;align-items:center;gap:.5rem;background:var(--accent);color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;letter-spacing:.04em;text-transform:uppercase;padding:.75rem 1.75rem;border-radius:100px;border:none;cursor:pointer;transition:transform .2s,box-shadow .2s,filter .2s;}
        .btn-save:hover{filter:brightness(1.1);transform:translateY(-2px);box-shadow:0 10px 28px rgba(91,74,255,.35);}
        .btn-del{display:inline-flex;align-items:center;gap:.4rem;background:transparent;border:1.5px solid #fbc4c4;color:var(--red);font-family:'Syne',sans-serif;font-weight:700;font-size:.78rem;letter-spacing:.04em;text-transform:uppercase;padding:.65rem 1.2rem;border-radius:100px;cursor:pointer;transition:all .2s;}
        .btn-del:hover{background:#fff3f3;}
        @media(max-width:600px){.body{padding:1.5rem 1rem 3rem}.fg.c2{grid-template-columns:1fr}.hero{padding:1.75rem 1.25rem 1.5rem}.card-body{padding:1.25rem}.card-foot{padding:1.25rem;flex-direction:column-reverse}.btn-cancel,.btn-save,.btn-del{width:100%;justify-content:center}}
    </style>
    <div class="root">
        <div class="hero">
            <div class="hero-inner">
                <a href="<?php echo e(route('estoque.index')); ?>" class="back"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>Estoque</a>
                <div class="divider"></div>
                <span class="hero-title">Editar Item</span>
            </div>
        </div>
        <div class="body">
            <?php if($errors->any()): ?><div class="flash-error"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg><ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div><?php endif; ?>
            <form action="<?php echo e(route('estoque.update', $item->id)); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="card">
                    <div class="card-head"><div class="icon">📦</div><div><div class="ct">Editar item de estoque</div><div class="cs">#<?php echo e($item->id); ?> · <?php echo e($item->nome); ?></div></div></div>
                    <div class="card-body">
                        <div class="fg">
                            <div class="fg c2">
                                <div class="field"><label>Nome do item *</label><input type="text" name="nome" value="<?php echo e(old('nome',$item->nome)); ?>" required><?php $__errorArgs = ['nome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="ferr"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                                <div class="field"><label>Produto *</label><input type="text" name="produto" value="<?php echo e(old('produto',$item->produto)); ?>" required><?php $__errorArgs = ['produto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="ferr"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                            </div>
                            <div class="fg c2">
                                <div class="field"><label>Quantidade *</label><input type="number" id="qty" name="quantidade" value="<?php echo e(old('quantidade',$item->quantidade)); ?>" min="0" required oninput="calc()"><?php $__errorArgs = ['quantidade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="ferr"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                                <div class="field"><label>Custo unitário (R$) *</label><input type="number" id="cst" name="custo" value="<?php echo e(old('custo',$item->custo)); ?>" min="0" step="0.01" required oninput="calc()"><?php $__errorArgs = ['custo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="ferr"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                            </div>
                            <div class="pbox"><span class="plabel">Valor total estimado</span><span class="pvalue" id="tot">R$ 0,00</span></div>
                        </div>
                    </div>
                    <div class="card-foot">
                        <div style="display:flex;gap:.6rem;align-items:center;justify-content:flex-end;width:100%;">
                            <a href="<?php echo e(route('estoque.index')); ?>" class="btn-cancel">Cancelar</a>
                            <button type="submit" class="btn-save"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>Salvar alterações</button>
                        </div>
                    </div>
                </div>
            </form>

            
            <div style="margin-top:.75rem;">
                <form action="<?php echo e(route('estoque.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Excluir este item?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-del"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>Excluir item</button>
                </form>
            </div>
        </div>
    </div>
    <script>function calc(){const q=parseFloat(document.getElementById('qty').value)||0;const c=parseFloat(document.getElementById('cst').value)||0;document.getElementById('tot').textContent='R$ '+(q*c).toLocaleString('pt-BR',{minimumFractionDigits:2,maximumFractionDigits:2});}calc();</script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\confeccao\resources\views/estoque/edit.blade.php ENDPATH**/ ?>