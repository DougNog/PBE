<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Conta — <?php echo e(config('app.name', 'MaintSys')); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --accent: #e8c547;
            --accent2: #f0d76a;
            --text: #f0ede6;
            --muted: #8a8f9e;
            --border: rgba(255,255,255,0.07);
            --border-input: rgba(255,255,255,0.12);
            --card: #13161d;
        }

        html, body {
            background: #0d0f14;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .glow {
            position: fixed; top: -150px; left: 50%; transform: translateX(-50%);
            width: 600px; height: 400px;
            background: radial-gradient(ellipse at center, rgba(232,197,71,0.07) 0%, transparent 70%);
            pointer-events: none; z-index: 0;
        }

        nav {
            position: relative; z-index: 10;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 3rem;
            border-bottom: 1px solid var(--border);
        }

        .logo {
            display: flex; align-items: center; gap: 10px;
            font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.1rem;
            letter-spacing: 0.08em; color: var(--text);
            text-decoration: none;
        }

        .logo-icon {
            width: 30px; height: 30px;
            background: var(--accent);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
        }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.5rem;
            position: relative; z-index: 5;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 460px;
        }

        .card-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .card-icon {
            width: 52px; height: 52px;
            background: rgba(232,197,71,0.1);
            border: 1px solid rgba(232,197,71,0.2);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.2rem;
        }

        .card-icon svg {
            width: 26px; height: 26px;
            stroke: var(--accent); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
        }

        .card-header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem; font-weight: 700;
            color: var(--text);
            margin-bottom: 0.35rem;
        }

        .card-header p {
            font-size: 0.875rem;
            color: var(--muted);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        label {
            display: block;
            font-size: 0.82rem;
            color: var(--muted);
            margin-bottom: 0.45rem;
            letter-spacing: 0.02em;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-input);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            color: var(--text);
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }

        input:focus {
            border-color: var(--accent);
            background: rgba(232,197,71,0.04);
        }

        input::placeholder { color: rgba(138,143,158,0.5); }

        .error-msg {
            font-size: 0.78rem;
            color: #f08080;
            margin-top: 0.4rem;
        }

        .password-strength {
            margin-top: 6px;
            display: flex;
            gap: 4px;
        }

        .strength-bar {
            height: 3px;
            flex: 1;
            border-radius: 2px;
            background: rgba(255,255,255,0.08);
            transition: background 0.3s;
        }

        .strength-bar.active-weak   { background: #f85149; }
        .strength-bar.active-medium { background: var(--accent); }
        .strength-bar.active-strong { background: #3fb950; }

        .strength-label {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 4px;
        }

        .btn-submit {
            width: 100%;
            background: var(--accent);
            color: #0d0f14;
            border: none;
            border-radius: 10px;
            padding: 0.85rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 600; font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            letter-spacing: 0.02em;
            margin-top: 0.5rem;
        }
        .btn-submit:hover { background: var(--accent2); transform: translateY(-1px); }
        .btn-submit:active { transform: translateY(0); }

        .divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 1.5rem 0;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1;
            height: 1px; background: var(--border);
        }
        .divider span { font-size: 0.75rem; color: var(--muted); }

        .login-link {
            display: flex; align-items: center; justify-content: center; gap: 6px;
            font-size: 0.85rem; color: var(--muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        .login-link a { color: var(--accent); text-decoration: none; }
        .login-link a:hover { color: var(--accent2); }

        footer {
            position: relative; z-index: 5;
            text-align: center;
            padding: 1.5rem;
            border-top: 1px solid var(--border);
            font-size: 0.78rem; color: var(--muted);
        }

        @media (max-width: 500px) {
            .form-row { grid-template-columns: 1fr; }
            .card { padding: 1.75rem; }
            nav { padding: 1rem 1.5rem; }
        }
    </style>
</head>
<body>

<div class="glow"></div>

<nav>
    <a href="<?php echo e(url('/')); ?>" class="logo">
        <div class="logo-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0d0f14" stroke-width="2.5" stroke-linecap="round">
                <circle cx="12" cy="12" r="3"/>
                <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/>
            </svg>
        </div>
        <?php echo e(config('app.name', 'MaintSys')); ?>

    </a>
</nav>

<main>
    <div class="card">
        <div class="card-header">
            <div class="card-icon">
                <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
            </div>
            <h1>Criar conta</h1>
            <p>Preencha os dados para acessar o sistema</p>
        </div>

        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Nome -->
            <div class="form-group">
                <label for="name">Nome completo</label>
                <input type="text" id="name" name="name"
                    value="<?php echo e(old('name')); ?>"
                    placeholder="Seu nome"
                    required autofocus autocomplete="name">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-msg"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email"
                    value="<?php echo e(old('email')); ?>"
                    placeholder="seu@email.com"
                    required autocomplete="username">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-msg"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Senhas -->
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password"
                        placeholder="••••••••"
                        required autocomplete="new-password"
                        oninput="checkStrength(this.value)">
                    <div class="password-strength">
                        <div class="strength-bar" id="bar1"></div>
                        <div class="strength-bar" id="bar2"></div>
                        <div class="strength-bar" id="bar3"></div>
                        <div class="strength-bar" id="bar4"></div>
                    </div>
                    <div class="strength-label" id="strength-label"></div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="error-msg"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="••••••••"
                        required autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="btn-submit">Criar minha conta</button>
        </form>

        <div class="divider"><span>já tem conta?</span></div>

        <p class="login-link">
            <a href="<?php echo e(route('login')); ?>">← Entrar no sistema</a>
        </p>
    </div>
</main>

<footer>
    &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'MaintSys')); ?> &mdash; Sistema de Gestão de Manutenção
</footer>

<script>
    function checkStrength(val) {
        const bars = [
            document.getElementById('bar1'),
            document.getElementById('bar2'),
            document.getElementById('bar3'),
            document.getElementById('bar4'),
        ];
        const label = document.getElementById('strength-label');

        bars.forEach(b => b.className = 'strength-bar');

        if (!val) { label.textContent = ''; return; }

        let score = 0;
        if (val.length >= 8)               score++;
        if (/[A-Z]/.test(val))             score++;
        if (/[0-9]/.test(val))             score++;
        if (/[^A-Za-z0-9]/.test(val))      score++;

        const cls   = score <= 1 ? 'active-weak' : score <= 2 ? 'active-medium' : 'active-strong';
        const texts = ['', 'Fraca', 'Razoável', 'Boa', 'Forte'];

        for (let i = 0; i < score; i++) bars[i].classList.add(cls);
        label.textContent = texts[score] || '';
        label.style.color = score <= 1 ? '#f85149' : score <= 2 ? 'var(--accent)' : '#3fb950';
    }
</script>

</body>
</html><?php /**PATH C:\laragon\www\doug\PBE\laragon\maintsys\maintsys\resources\views/auth/register.blade.php ENDPATH**/ ?>