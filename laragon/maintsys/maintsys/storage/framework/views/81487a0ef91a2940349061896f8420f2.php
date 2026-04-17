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
     <?php $__env->slot('header', null, []); ?> 
        
     <?php $__env->endSlot(); ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap');

        :root {
            --ink:     #0a0a0f;
            --surface: #f5f4f0;
            --card:    #ffffff;
            --accent:  #e05c1a;
            --accent2: #f59e0b;
            --muted:   #888;
            --border:  #e8e6e1;
            --green:   #1dbb87;
            --red:     #ff4c4c;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        .forn-root {
            font-family: 'DM Sans', sans-serif;
            background: var(--surface);
            min-height: 100vh;
            color: var(--ink);
        }

        /* ─── HERO ─── */
        .page-hero {
            position: relative;
            overflow: hidden;
            background: var(--ink);
            padding: 3rem 2.5rem 2.5rem;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 80% at 85% -10%, rgba(224,92,26,.5) 0%, transparent 65%),
                radial-gradient(ellipse 40% 60% at -5% 110%, rgba(245,158,11,.3) 0%, transparent 60%);
            pointer-events: none;
        }

        .page-hero::after {
            content: 'FORNECEDORES';
            position: absolute;
            right: -1rem;
            top: 50%;
            transform: translateY(-50%);
            font-family: 'Syne', sans-serif;
            font-size: clamp(3.5rem, 10vw, 8rem);
            font-weight: 800;
            color: rgba(255,255,255,.04);
            letter-spacing: -.04em;
            pointer-events: none;
            white-space: nowrap;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
            max-width: 1280px;
            margin: 0 auto;
        }

        .hero-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2rem, 5vw, 3.25rem);
            font-weight: 800;
            color: #fff;
            letter-spacing: -.03em;
            line-height: 1.05;
        }

        .hero-title span {
            color: transparent;
            -webkit-text-stroke: 1.5px rgba(255,255,255,.4);
        }

        .hero-sub {
            margin-top: .5rem;
            font-size: .9rem;
            color: rgba(255,255,255,.45);
            font-weight: 300;
        }

        .btn-new {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: var(--accent);
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: .85rem;
            letter-spacing: .04em;
            text-transform: uppercase;
            padding: .85rem 1.75rem;
            border-radius: 100px;
            text-decoration: none;
            transition: transform .2s, box-shadow .2s, background .2s;
            white-space: nowrap;
        }

        .btn-new:hover {
            background: #f26a28;
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(224,92,26,.4);
        }

        .btn-new svg { width: 16px; height: 16px; }

        /* ─── BODY ─── */
        .page-body {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2.5rem 2rem 4rem;
        }

        /* ─── FLASH ─── */
        .flash-success {
            display: flex;
            align-items: center;
            gap: .75rem;
            background: linear-gradient(135deg, #e6fff6, #d0fff0);
            border: 1px solid #a3ecd4;
            border-left: 4px solid var(--green);
            color: #0d7a58;
            border-radius: 14px;
            padding: 1rem 1.25rem;
            font-size: .9rem;
            font-weight: 500;
            margin-bottom: 2rem;
            animation: slideDown .4s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── STATS ─── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 260px));
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 1.5rem 1.75rem;
            position: relative;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
            animation: fadeUp .5s .05s ease both;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 48px rgba(0,0,0,.07);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 120px; height: 120px;
            border-radius: 50%;
            background: var(--accent);
            opacity: .1;
        }

        .stat-icon {
            width: 40px; height: 40px;
            border-radius: 12px;
            background: #fff0e9;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 1.1rem;
        }

        .stat-label {
            font-size: .78rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--muted);
        }

        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -.03em;
            color: var(--ink);
            margin-top: .3rem;
            line-height: 1;
        }

        /* ─── SEARCH ─── */
        .search-wrap { margin-bottom: 1.5rem; }

        .search-inner {
            position: relative;
            max-width: 420px;
        }

        .search-inner svg {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 100px;
            padding: .75rem 1.25rem .75rem 2.75rem;
            font-family: 'DM Sans', sans-serif;
            font-size: .88rem;
            color: var(--ink);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .search-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(224,92,26,.12);
        }

        .search-input::placeholder { color: #bbb; }

        /* ─── TABLE CARD ─── */
        .table-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,.04);
        }

        .table-header {
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            gap: 1rem;
            flex-wrap: wrap;
        }

        .table-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--ink);
        }

        .table-badge {
            background: var(--surface);
            border: 1px solid var(--border);
            color: var(--muted);
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            padding: .3rem .85rem;
            border-radius: 100px;
        }

        /* ─── EMPTY ─── */
        .empty-state {
            padding: 5rem 2rem;
            text-align: center;
        }

        .empty-icon {
            width: 80px; height: 80px;
            border-radius: 24px;
            background: var(--surface);
            border: 2px dashed var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
        }

        .empty-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .empty-sub { color: var(--muted); font-size: .9rem; margin-top: .4rem; }

        .btn-empty {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: var(--ink);
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: .82rem;
            letter-spacing: .04em;
            text-transform: uppercase;
            padding: .8rem 1.6rem;
            border-radius: 100px;
            text-decoration: none;
            margin-top: 1.75rem;
            transition: transform .2s, background .2s;
        }

        .btn-empty:hover { background: var(--accent); transform: translateY(-2px); }

        /* ─── TABLE ─── */
        .data-table { width: 100%; border-collapse: collapse; }

        .data-table thead th {
            padding: 1rem 1.5rem;
            text-align: left;
            font-size: .7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--muted);
            background: #fafaf8;
            border-bottom: 1px solid var(--border);
        }

        .data-table thead th:last-child { text-align: center; }

        .data-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
            animation: fadeRow .35s ease both;
        }

        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #fff8f4; }

        .data-table td { padding: 1.1rem 1.5rem; font-size: .88rem; }

        /* row stagger */
        .data-table tbody tr:nth-child(1)  { animation-delay: .04s; }
        .data-table tbody tr:nth-child(2)  { animation-delay: .08s; }
        .data-table tbody tr:nth-child(3)  { animation-delay: .12s; }
        .data-table tbody tr:nth-child(4)  { animation-delay: .16s; }
        .data-table tbody tr:nth-child(5)  { animation-delay: .20s; }
        .data-table tbody tr:nth-child(6)  { animation-delay: .24s; }
        .data-table tbody tr:nth-child(7)  { animation-delay: .28s; }
        .data-table tbody tr:nth-child(8)  { animation-delay: .32s; }
        .data-table tbody tr:nth-child(9)  { animation-delay: .36s; }
        .data-table tbody tr:nth-child(10) { animation-delay: .40s; }

        /* ─── SUPPLIER CELL ─── */
        .supplier-cell {
            display: flex;
            align-items: center;
            gap: .85rem;
        }

        .avatar {
            flex-shrink: 0;
            width: 38px; height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: .85rem;
            color: #fff;
        }

        .td-nome { font-weight: 600; color: var(--ink); font-size: .92rem; }
        .td-id   { font-family: 'Syne', sans-serif; font-size: .72rem; font-weight: 700; letter-spacing: .06em; color: var(--muted); }
        .td-info { color: #555; }

        .td-actions { text-align: center; }

        .actions-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }

        .btn-edit {
            display: inline-flex; align-items: center; gap: .35rem;
            background: #fff8ec; border: 1px solid #f5d99a; color: #a06000;
            font-size: .75rem; font-weight: 700; font-family: 'Syne', sans-serif;
            letter-spacing: .04em; text-transform: uppercase;
            padding: .45rem 1rem; border-radius: 100px; text-decoration: none;
            transition: all .2s;
        }
        .btn-edit:hover { background: #ffebc7; transform: translateY(-1px); }

        .btn-delete {
            display: inline-flex; align-items: center; gap: .35rem;
            background: #fff3f3; border: 1px solid #fbc4c4; color: #c0000a;
            font-size: .75rem; font-weight: 700; font-family: 'Syne', sans-serif;
            letter-spacing: .04em; text-transform: uppercase;
            padding: .45rem 1rem; border-radius: 100px; cursor: pointer;
            transition: all .2s;
        }
        .btn-delete:hover { background: #ffe0e0; transform: translateY(-1px); }

        /* ─── PAGINATION ─── */
        .pagination-wrap {
            padding: 1.25rem 1.75rem;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
        }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeRow {
            from { opacity: 0; transform: translateX(-8px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 640px) {
            .page-hero { padding: 2rem 1.25rem; }
            .page-body { padding: 1.5rem 1rem 3rem; }
            .data-table thead { display: none; }
            .data-table td { display: block; padding: .4rem 1.25rem; }
            .data-table td::before {
                content: attr(data-label);
                font-size: .7rem; text-transform: uppercase;
                letter-spacing: .07em; color: var(--muted);
                display: block; margin-bottom: .15rem;
            }
            .data-table tbody tr { display: block; padding: .75rem 0; border-bottom: 1px solid var(--border); }
            .actions-wrap { justify-content: flex-start; padding-left: 1.25rem; padding-bottom: .5rem; }
        }
    </style>

    <div class="forn-root">

        
        <div class="page-hero">
            <div class="hero-inner">
                <div>
                    <h1 class="hero-title">
                        Gestão de<br><span>Fornecedores</span>
                    </h1>
                    <p class="hero-sub">Gerencie os fornecedores cadastrados no sistema.</p>
                </div>

                <a href="<?php echo e(route('fornecedores.create')); ?>" class="btn-new">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Novo fornecedor
                </a>
            </div>
        </div>

        
        <div class="page-body">

            <?php if(session('success')): ?>
                <div class="flash-success">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">🏭</div>
                    <div class="stat-label">Total de fornecedores</div>
                    <div class="stat-value"><?php echo e($fornecedores->total() ?? $fornecedores->count()); ?></div>
                </div>
            </div>

            
            <div class="search-wrap">
                <div class="search-inner">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input
                        type="text"
                        class="search-input"
                        placeholder="Buscar por nome, CNPJ ou e-mail..."
                        id="searchInput"
                        onkeyup="filterTable()"
                    >
                </div>
            </div>

            
            <div class="table-card">
                <div class="table-header">
                    <span class="table-title">Lista de fornecedores</span>
                    <span class="table-badge" id="countBadge">
                        <?php echo e($fornecedores->total() ?? $fornecedores->count()); ?> registros
                    </span>
                </div>

                <?php if($fornecedores->isEmpty()): ?>
                    <div class="empty-state">
                        <div class="empty-icon">🏭</div>
                        <div class="empty-title">Nenhum fornecedor cadastrado</div>
                        <p class="empty-sub">Cadastre o primeiro fornecedor para começar.</p>
                        <a href="<?php echo e(route('fornecedores.create')); ?>" class="btn-empty">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Cadastrar fornecedor
                        </a>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="data-table" id="fornTable">
                            <thead>
                                <tr>
                                    <th>Fornecedor</th>
                                    <th>CNPJ</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $fornecedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td data-label="Fornecedor">
                                            <div class="supplier-cell">
                                                <div class="avatar">
                                                    <?php echo e(strtoupper(substr($f->nome, 0, 1))); ?><?php echo e(strtoupper(substr(strstr($f->nome, ' ') ?: ' ', 1, 1))); ?>

                                                </div>
                                                <div>
                                                    <div class="td-nome"><?php echo e($f->nome); ?></div>
                                                    <div class="td-id">#<?php echo e($f->id); ?></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td data-label="CNPJ">
                                            <span class="td-info"><?php echo e($f->cnpj ?? '—'); ?></span>
                                        </td>

                                        <td data-label="Telefone">
                                            <span class="td-info"><?php echo e($f->telefone ?? '—'); ?></span>
                                        </td>

                                        <td data-label="E-mail">
                                            <span class="td-info"><?php echo e($f->email ?? '—'); ?></span>
                                        </td>

                                        <td data-label="Ações" class="td-actions">
                                            <div class="actions-wrap">
                                                <a href="<?php echo e(route('fornecedores.edit', $f->id)); ?>" class="btn-edit">
                                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                    </svg>
                                                    Editar
                                                </a>

                                                <form action="<?php echo e(route('fornecedores.destroy', $f->id)); ?>" method="POST"
                                                      onsubmit="return confirm('Excluir o fornecedor «<?php echo e($f->nome); ?>»?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn-delete">
                                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="3 6 5 6 21 6"/>
                                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                            <path d="M10 11v6"/><path d="M14 11v6"/>
                                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                                        </svg>
                                                        Excluir
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-wrap">
                        <?php echo e($fornecedores->links()); ?>

                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <script>
        function filterTable() {
            const q = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#fornTable tbody tr');
            let visible = 0;
            rows.forEach(row => {
                const show = row.innerText.toLowerCase().includes(q);
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            document.getElementById('countBadge').textContent = visible + ' registros';
        }
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
<?php endif; ?><?php /**PATH C:\laragon\www\confeccao\resources\views/fornecedores/index.blade.php ENDPATH**/ ?>