<!-- BUSCA POR ID -->
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - pokemon</title>
    <script src="Http://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2x1 shadow-2x1 text-center w-80" >
        <h1 class="text-2x1 font-bold text-gray-800 mb-4 uppercase">
            {{ $pokemon['name']}}
        </h1>

        <div class="bg-blue-50 rounded-full p-4 mb-4">
            <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default']}}" alt="{{ $pokemon['name']}}" class="w-full h-auto">
        </div>

        <div class="flex justify-center gap-2 mb-4">
            @foreach($pokemon['types'] as $tipo)
                <span class="px-3 py-1 bg-yellow-400 text-xs font-bold rounded-full uppercase">
                    {{ $tipo['type']['name'] }}
                </span>
            @endforeach
        </div>

        <p class="text-gray-500 text-sm">
            Altura: {{ $pokemon['height']/10}} m | Peso: {{ $pokemon['weight']/10 }}kg
        </p>

        <button onclick="window.location.reload()" class="mt-6 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition">
            Buscar Próximo
        </button>

    </div>

</body>
</html> -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        html, body {
            font-family: 'Inter', -apple-system, sans-serif;
            color: #0a0a0a;
            -webkit-font-smoothing: antialiased;
            letter-spacing: -0.01em;
            overflow-x: hidden;
            margin: 0;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(ellipse at top, #e0f2fe 0%, transparent 50%),
                radial-gradient(ellipse at bottom, #fef3c7 0%, transparent 50%),
                linear-gradient(180deg, #f0f9ff 0%, #f8fafc 50%, #f1f5f9 100%);
            position: relative;
        }

        /* ===========================================
           LABORATÓRIO — cenário em camadas
           =========================================== */
        .lab {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
            perspective: 1000px;
        }

        .lab-layer {
            position: absolute;
            inset: 0;
            will-change: transform;
            transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }

        /* Luz ambiente superior */
        .lab-light {
            position: absolute;
            top: -20%;
            left: 50%;
            transform: translateX(-50%);
            width: 120%;
            height: 60%;
            background: radial-gradient(ellipse at center, rgba(186, 230, 253, 0.5) 0%, transparent 60%);
            filter: blur(40px);
            animation: lightPulse 6s ease-in-out infinite;
        }
        @keyframes lightPulse {
            0%, 100% { opacity: 0.8; }
            50%      { opacity: 1; }
        }

        /* Grid de piso perspectivo */
        .lab-floor {
            position: absolute;
            bottom: 0;
            left: -20%;
            width: 140%;
            height: 40%;
            background-image:
                linear-gradient(rgba(59, 130, 246, 0.15) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.15) 1px, transparent 1px);
            background-size: 50px 50px;
            transform: perspective(400px) rotateX(60deg);
            transform-origin: center top;
            mask-image: linear-gradient(to bottom, black, transparent 80%);
            -webkit-mask-image: linear-gradient(to bottom, black, transparent 80%);
            animation: floorMove 8s linear infinite;
        }
        @keyframes floorMove {
            from { background-position: 0 0; }
            to   { background-position: 0 50px; }
        }

        /* ===========================================
           COMPUTADOR / MONITOR (fundo)
           =========================================== */
        .monitor {
            position: absolute;
            background: #1e293b;
            border-radius: 8px;
            border: 3px solid #0f172a;
            box-shadow:
                0 10px 30px rgba(0,0,0,0.15),
                inset 0 0 20px rgba(59, 130, 246, 0.2);
        }
        .monitor::before {
            content: '';
            position: absolute;
            inset: 4px;
            background: linear-gradient(180deg, #0c1e3a 0%, #1e293b 100%);
            border-radius: 4px;
            overflow: hidden;
        }
        .monitor-screen {
            position: absolute;
            inset: 8px;
            overflow: hidden;
            border-radius: 2px;
        }
        .monitor-1 {
            top: 8%;
            left: 4%;
            width: 200px;
            height: 140px;
        }
        .monitor-2 {
            top: 12%;
            right: 5%;
            width: 180px;
            height: 130px;
        }
        .monitor-3 {
            bottom: 30%;
            right: 3%;
            width: 160px;
            height: 110px;
        }

        /* Conteúdo da tela: gráfico de linha animado */
        .chart-line {
            position: absolute;
            bottom: 20%;
            left: 0;
            width: 100%;
            height: 60%;
        }
        .chart-line svg {
            width: 100%;
            height: 100%;
        }
        .chart-path {
            stroke: #60a5fa;
            stroke-width: 2;
            fill: none;
            filter: drop-shadow(0 0 4px #60a5fa);
            stroke-dasharray: 300;
            animation: drawLine 4s ease-in-out infinite;
        }
        @keyframes drawLine {
            0%   { stroke-dashoffset: 300; }
            50%  { stroke-dashoffset: 0; }
            100% { stroke-dashoffset: -300; }
        }

        /* Texto "dados" no monitor */
        .monitor-text {
            position: absolute;
            top: 8px;
            left: 8px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 8px;
            color: #60a5fa;
            line-height: 1.5;
            text-shadow: 0 0 4px #60a5fa;
        }
        .monitor-blink {
            display: inline-block;
            width: 4px;
            height: 8px;
            background: #60a5fa;
            animation: blink 1s step-end infinite;
            vertical-align: middle;
            margin-left: 2px;
        }
        @keyframes blink {
            50% { opacity: 0; }
        }

        /* Barras de progresso no monitor */
        .monitor-bars {
            position: absolute;
            top: 28px;
            left: 8px;
            right: 8px;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .monitor-bar {
            height: 4px;
            background: rgba(96, 165, 250, 0.2);
            border-radius: 2px;
            overflow: hidden;
        }
        .monitor-bar-fill {
            height: 100%;
            background: #60a5fa;
            box-shadow: 0 0 6px #60a5fa;
            animation: barFill 3s ease-in-out infinite;
        }
        @keyframes barFill {
            0%, 100% { width: 30%; }
            50%      { width: 85%; }
        }

        /* ===========================================
           SUPORTES DE POKÉBOLA (máquina clássica)
           =========================================== */
        .ball-holder {
            position: absolute;
            width: 80px;
            height: 100px;
        }
        .ball-holder-base {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 20px;
            background: linear-gradient(180deg, #cbd5e1 0%, #94a3b8 100%);
            border: 2px solid #475569;
            border-radius: 4px 4px 8px 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        .ball-holder-pillar {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 30px;
            background: linear-gradient(180deg, #64748b, #334155);
            border-radius: 2px;
        }
        .ball-holder-top {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 50px;
        }
        .holder-ball {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background:
                linear-gradient(to bottom,
                    #ef4444 0%, #ef4444 48%,
                    #1a1a1a 48%, #1a1a1a 52%,
                    #f8fafc 52%, #f8fafc 100%);
            border: 2.5px solid #1a1a1a;
            position: relative;
            box-shadow:
                0 6px 15px rgba(239, 68, 68, 0.3),
                inset -4px -4px 10px rgba(0,0,0,0.15),
                inset 4px 4px 10px rgba(255,255,255,0.3);
            animation: ballFloat 3s ease-in-out infinite;
        }
        .holder-ball::before {
            content: '';
            position: absolute;
            top: 15%;
            left: 20%;
            width: 25%;
            height: 15%;
            background: rgba(255,255,255,0.5);
            border-radius: 50%;
            filter: blur(3px);
        }
        .holder-ball::after {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            width: 30%; height: 30%;
            background: radial-gradient(circle at 35% 35%, #fff, #cbd5e1);
            border: 2.5px solid #1a1a1a;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
        @keyframes ballFloat {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-6px); }
        }

        /* Luz embaixo da pokébola no suporte */
        .ball-holder-glow {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 8px;
            background: radial-gradient(ellipse, #ef4444 0%, transparent 70%);
            filter: blur(4px);
            opacity: 0.6;
            animation: glowPulse 2s ease-in-out infinite;
        }
        @keyframes glowPulse {
            0%, 100% { opacity: 0.4; transform: translateX(-50%) scale(1); }
            50%      { opacity: 0.7; transform: translateX(-50%) scale(1.2); }
        }

        .bh-1 { top: 45%; left: 7%; }
        .bh-2 { top: 52%; left: 18%; }
        .bh-3 { top: 45%; right: 7%; }
        .bh-4 { top: 52%; right: 18%; }
        .bh-5 { top: 28%; left: 28%; transform: scale(0.8); }
        .bh-6 { top: 28%; right: 28%; transform: scale(0.8); }

        /* ===========================================
           TUBOS DE ENSAIO
           =========================================== */
        .tube {
            position: absolute;
            width: 24px;
            height: 80px;
            background: linear-gradient(180deg,
                rgba(255,255,255,0.4) 0%,
                rgba(255,255,255,0.2) 30%,
                rgba(59, 130, 246, 0.3) 40%,
                rgba(59, 130, 246, 0.6) 100%);
            border: 2px solid #1e293b;
            border-top: none;
            border-radius: 0 0 12px 12px;
            overflow: hidden;
        }
        .tube::before {
            content: '';
            position: absolute;
            top: 40%;
            left: 0; right: 0;
            height: 60%;
            background: linear-gradient(180deg,
                rgba(96, 165, 250, 0.8),
                rgba(59, 130, 246, 1));
            animation: bubble 3s ease-in-out infinite;
        }
        .tube::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 4px;
            height: 4px;
            background: rgba(255,255,255,0.7);
            border-radius: 50%;
            animation: bubbleRise 2s ease-in-out infinite;
        }
        @keyframes bubble {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-3px); }
        }
        @keyframes bubbleRise {
            0%   { transform: translate(-50%, 20px); opacity: 0; }
            50%  { opacity: 1; }
            100% { transform: translate(-50%, -30px); opacity: 0; }
        }

        .tube-1 { top: 60%; left: 15%; }
        .tube-2 { top: 63%; left: 22%; animation-delay: -1s; }
        .tube-3 { top: 60%; right: 15%; }
        .tube-4 { top: 63%; right: 22%; animation-delay: -1.5s; }

        /* Líquido diferente no tubo */
        .tube.tube-red::before { background: linear-gradient(180deg, rgba(252, 165, 165, 0.8), rgba(239, 68, 68, 1)); }
        .tube.tube-yellow::before { background: linear-gradient(180deg, rgba(253, 224, 71, 0.8), rgba(234, 179, 8, 1)); }
        .tube.tube-green::before { background: linear-gradient(180deg, rgba(134, 239, 172, 0.8), rgba(34, 197, 94, 1)); }

        /* ===========================================
           BANCADA
           =========================================== */
        .bench {
            position: absolute;
            bottom: 15%;
            left: -5%;
            right: -5%;
            height: 30px;
            background: linear-gradient(180deg,
                #cbd5e1 0%,
                #94a3b8 30%,
                #64748b 100%);
            border-top: 3px solid #475569;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }
        .bench::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg,
                transparent 0%,
                rgba(96, 165, 250, 0.3) 50%,
                transparent 100%);
        }

        /* ===========================================
           PAINÉIS LATERAIS (rack de equipamento)
           =========================================== */
        .panel {
            position: absolute;
            width: 60px;
            height: 120px;
            background: linear-gradient(180deg, #334155 0%, #1e293b 100%);
            border: 2px solid #0f172a;
            border-radius: 4px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }
        .panel-light {
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            left: 8px;
            box-shadow: 0 0 6px currentColor;
            animation: panelBlink 1.5s ease-in-out infinite;
        }
        @keyframes panelBlink {
            0%, 100% { opacity: 0.3; }
            50%      { opacity: 1; }
        }
        .panel-1 { top: 20%; left: 2%; }
        .panel-2 { top: 20%; right: 2%; }

        /* ===========================================
           PARTÍCULAS DE DADOS (números flutuando)
           =========================================== */
        .data-particle {
            position: absolute;
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            color: rgba(59, 130, 246, 0.5);
            animation: dataFloat 8s linear infinite;
            white-space: nowrap;
        }
        @keyframes dataFloat {
            0%   { transform: translateY(100vh); opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 1; }
            100% { transform: translateY(-20vh); opacity: 0; }
        }

        /* ===========================================
           CARD PRINCIPAL
           =========================================== */
        .fade-up { animation: fadeUp 0.8s cubic-bezier(0.22, 1, 0.36, 1); }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 24px;
            box-shadow:
                0 1px 2px rgba(0,0,0,0.04),
                0 20px 40px rgba(0,0,0,0.08),
                0 40px 80px rgba(59, 130, 246, 0.08);
            transition: all 0.4s ease;
            position: relative;
        }

        .card-corner {
            position: absolute;
            width: 16px;
            height: 16px;
            border: 2px solid #0a0a0a;
            opacity: 0.6;
        }
        .card-corner.tl { top: -1px; left: -1px; border-right: 0; border-bottom: 0; border-radius: 24px 0 0 0; }
        .card-corner.tr { top: -1px; right: -1px; border-left: 0; border-bottom: 0; border-radius: 0 24px 0 0; }
        .card-corner.bl { bottom: -1px; left: -1px; border-right: 0; border-top: 0; border-radius: 0 0 0 24px; }
        .card-corner.br { bottom: -1px; right: -1px; border-left: 0; border-top: 0; border-radius: 0 0 24px 0; }

        .input {
            background: #f4f4f5;
            border: 1px solid transparent;
            color: #0a0a0a;
            font-family: inherit;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .input:focus {
            outline: none;
            background: #fff;
            border-color: #0a0a0a;
            box-shadow: 0 0 0 4px rgba(0,0,0,0.05);
        }
        .input::placeholder { color: #a1a1aa; font-weight: 400; }

        .btn {
            background: #0a0a0a;
            color: #fff;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn:hover { background: #27272a; transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .pokemon-stage {
            background:
                radial-gradient(circle at center, rgba(59, 130, 246, 0.06) 0%, transparent 60%),
                linear-gradient(180deg, #fafafa 0%, #f4f4f5 100%);
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }
        .pokemon-stage::after {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 140px; height: 140px;
            border-radius: 50%;
            background: linear-gradient(to bottom,
                #ef4444 0%, #ef4444 48%,
                #1a1a1a 48%, #1a1a1a 52%,
                #ffffff 52%, #ffffff 100%);
            border: 4px solid #1a1a1a;
            opacity: 0.1;
        }
        .pokemon-stage::before {
            content: '';
            position: absolute;
            left: 50%; bottom: 18%;
            width: 60%; height: 10px;
            background: radial-gradient(ellipse, rgba(0,0,0,0.12) 0%, transparent 70%);
            transform: translateX(-50%);
            filter: blur(4px);
        }
        .pokemon-img {
            filter: drop-shadow(0 20px 30px rgba(0,0,0,0.12));
            transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
            animation: floatSoft 5s ease-in-out infinite;
            position: relative;
            z-index: 2;
        }
        .pokemon-img:hover { transform: scale(1.05); }
        @keyframes floatSoft {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-8px); }
        }

        .type-badge {
            font-size: 11px; font-weight: 600;
            letter-spacing: 0.04em; text-transform: uppercase;
            padding: 5px 12px; border-radius: 999px;
            border: 1px solid;
        }
        .type-fire     { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
        .type-water    { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
        .type-grass    { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
        .type-electric { background: #fefce8; color: #a16207; border-color: #fef08a; }
        .type-psychic  { background: #fdf2f8; color: #be185d; border-color: #fbcfe8; }
        .type-ice      { background: #ecfeff; color: #0e7490; border-color: #a5f3fc; }
        .type-dragon   { background: #eef2ff; color: #4338ca; border-color: #c7d2fe; }
        .type-dark     { background: #f4f4f5; color: #27272a; border-color: #d4d4d8; }
        .type-fairy    { background: #fdf2f8; color: #db2777; border-color: #fbcfe8; }
        .type-normal   { background: #fafaf9; color: #57534e; border-color: #e7e5e4; }
        .type-fighting { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
        .type-flying   { background: #f0f9ff; color: #0369a1; border-color: #bae6fd; }
        .type-poison   { background: #faf5ff; color: #7e22ce; border-color: #e9d5ff; }
        .type-ground   { background: #fef3c7; color: #92400e; border-color: #fde68a; }
        .type-rock     { background: #fafaf9; color: #44403c; border-color: #e7e5e4; }
        .type-bug      { background: #f7fee7; color: #4d7c0f; border-color: #d9f99d; }
        .type-ghost    { background: #f5f3ff; color: #6d28d9; border-color: #ddd6fe; }
        .type-steel    { background: #f8fafc; color: #334155; border-color: #cbd5e1; }

        .measure-card {
            background: #fafafa; border: 1px solid rgba(0,0,0,0.04);
            border-radius: 12px; padding: 12px; text-align: center;
        }
        .measure-label {
            font-size: 10px; font-weight: 500; color: #71717a;
            letter-spacing: 0.06em; text-transform: uppercase;
        }
        .measure-value {
            font-size: 18px; font-weight: 600; color: #0a0a0a;
            letter-spacing: -0.02em; font-variant-numeric: tabular-nums;
            margin-top: 2px;
        }

        .stat-row { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
        .stat-row:last-child { margin-bottom: 0; }
        .stat-name {
            font-size: 11px; font-weight: 500; color: #71717a;
            letter-spacing: 0.04em; text-transform: uppercase;
            width: 68px; flex-shrink: 0;
        }
        .stat-number {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px; font-weight: 500; color: #0a0a0a;
            width: 28px; text-align: right; flex-shrink: 0;
            font-variant-numeric: tabular-nums;
        }
        .stat-bar {
            flex: 1; height: 6px; background: #f4f4f5;
            border-radius: 999px; overflow: hidden;
        }
        .stat-fill {
            height: 100%; border-radius: 999px;
            transform-origin: left;
            animation: fillBar 1.2s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            transform: scaleX(0);
        }
        @keyframes fillBar { to { transform: scaleX(1); } }

        .stat-low   { background: #e4e4e7; }
        .stat-mid   { background: #71717a; }
        .stat-high  { background: #0a0a0a; }
        .stat-elite { background: linear-gradient(90deg, #0a0a0a, #ef4444); }

        .section-title {
            font-size: 10px; font-weight: 600; color: #a1a1aa;
            letter-spacing: 0.1em; text-transform: uppercase;
            margin-bottom: 12px; display: flex; align-items: center; gap: 8px;
        }
        .section-title::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(90deg, rgba(0,0,0,0.08), transparent);
        }

        .ability {
            display: inline-block; font-size: 11px; font-weight: 500;
            color: #52525b; background: #fafafa;
            border: 1px solid rgba(0,0,0,0.06); padding: 4px 10px;
            border-radius: 6px; margin-right: 4px; margin-bottom: 4px;
            text-transform: capitalize;
        }
        .ability.hidden-ability {
            background: #fff; border-style: dashed; color: #71717a;
        }

        .empty-dot {
            width: 8px; height: 8px; background: #0a0a0a;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%      { opacity: 0.3; transform: scale(0.8); }
        }

        .error {
            background: #fef2f2; border: 1px solid #fecaca;
            color: #991b1b; font-size: 13px; font-weight: 500;
        }

        .mono { font-family: 'JetBrains Mono', monospace; font-variant-numeric: tabular-nums; }

        .total-row {
            display: flex; justify-content: space-between; align-items: center;
            padding-top: 12px; margin-top: 12px;
            border-top: 1px solid rgba(0,0,0,0.06);
        }
        .total-label {
            font-size: 11px; font-weight: 600; color: #0a0a0a;
            letter-spacing: 0.04em; text-transform: uppercase;
        }
        .total-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 14px; font-weight: 600; color: #0a0a0a;
        }

        /* Cursor custom de visor */
        body {
            cursor: crosshair;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    {{-- ============ LABORATÓRIO ============ --}}
    <div class="lab">

        {{-- Luz ambiente --}}
        <div class="lab-light"></div>

        {{-- Piso com grid perspectivo --}}
        <div class="lab-floor"></div>

        {{-- CAMADA 1 - profundidade máxima (se move menos) --}}
        <div class="lab-layer" data-depth="0.02">
            {{-- Painéis laterais --}}
            <div class="panel panel-1">
                <div class="panel-light" style="top: 10px; color: #ef4444;"></div>
                <div class="panel-light" style="top: 20px; color: #facc15; animation-delay: 0.3s;"></div>
                <div class="panel-light" style="top: 30px; color: #22c55e; animation-delay: 0.6s;"></div>
                <div class="panel-light" style="top: 40px; color: #60a5fa; animation-delay: 0.9s;"></div>
                <div class="panel-light" style="top: 50px; color: #a855f7; animation-delay: 1.2s;"></div>
            </div>
            <div class="panel panel-2">
                <div class="panel-light" style="top: 10px; color: #22c55e;"></div>
                <div class="panel-light" style="top: 20px; color: #60a5fa; animation-delay: 0.4s;"></div>
                <div class="panel-light" style="top: 30px; color: #ef4444; animation-delay: 0.8s;"></div>
                <div class="panel-light" style="top: 40px; color: #facc15; animation-delay: 1.2s;"></div>
                <div class="panel-light" style="top: 50px; color: #a855f7; animation-delay: 1.6s;"></div>
            </div>
        </div>

        {{-- CAMADA 2 - monitores --}}
        <div class="lab-layer" data-depth="0.05">
            <div class="monitor monitor-1">
                <div class="monitor-screen">
                    <div class="monitor-text">&gt; SCAN_ACTIVE<br>&gt; DNA: 0x4A9F<span class="monitor-blink"></span></div>
                    <div class="monitor-bars">
                        <div class="monitor-bar"><div class="monitor-bar-fill" style="animation-delay: 0s;"></div></div>
                        <div class="monitor-bar"><div class="monitor-bar-fill" style="animation-delay: 0.4s;"></div></div>
                        <div class="monitor-bar"><div class="monitor-bar-fill" style="animation-delay: 0.8s;"></div></div>
                    </div>
                    <div class="chart-line">
                        <svg viewBox="0 0 200 60" preserveAspectRatio="none">
                            <path class="chart-path" d="M0,40 Q25,15 50,30 T100,20 T150,35 T200,15"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="monitor monitor-2">
                <div class="monitor-screen">
                    <div class="monitor-text">&gt; POKEDEX_V2.3<br>&gt; LOADING...<span class="monitor-blink"></span></div>
                    <div class="monitor-bars">
                        <div class="monitor-bar"><div class="monitor-bar-fill" style="animation-delay: 0.2s;"></div></div>
                        <div class="monitor-bar"><div class="monitor-bar-fill" style="animation-delay: 0.6s;"></div></div>
                    </div>
                    <div class="chart-line">
                        <svg viewBox="0 0 200 60" preserveAspectRatio="none">
                            <path class="chart-path" d="M0,30 L30,20 L60,45 L90,15 L120,35 L150,25 L180,40 L200,20" style="animation-delay: -2s;"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="monitor monitor-3">
                <div class="monitor-screen">
                    <div class="monitor-text">&gt; ANALYSIS<br>&gt; 94.7%<span class="monitor-blink"></span></div>
                    <div class="monitor-bars">
                        <div class="monitor-bar"><div class="monitor-bar-fill" style="animation-delay: 0.1s;"></div></div>
                        <div class="monitor-bar"><div class="monitor-bar-fill" style="animation-delay: 0.5s;"></div></div>
                        <div class="monitor-bar"><div class="monitor-bar-fill" style="animation-delay: 0.9s;"></div></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CAMADA 3 - suportes de pokébola (no meio) --}}
        <div class="lab-layer" data-depth="0.08">
            <div class="ball-holder bh-1">
                <div class="ball-holder-glow"></div>
                <div class="ball-holder-base"></div>
                <div class="ball-holder-pillar"></div>
                <div class="ball-holder-top"><div class="holder-ball"></div></div>
            </div>
            <div class="ball-holder bh-2">
                <div class="ball-holder-glow"></div>
                <div class="ball-holder-base"></div>
                <div class="ball-holder-pillar"></div>
                <div class="ball-holder-top"><div class="holder-ball" style="animation-delay: -0.5s;"></div></div>
            </div>
            <div class="ball-holder bh-3">
                <div class="ball-holder-glow"></div>
                <div class="ball-holder-base"></div>
                <div class="ball-holder-pillar"></div>
                <div class="ball-holder-top"><div class="holder-ball" style="animation-delay: -1s;"></div></div>
            </div>
            <div class="ball-holder bh-4">
                <div class="ball-holder-glow"></div>
                <div class="ball-holder-base"></div>
                <div class="ball-holder-pillar"></div>
                <div class="ball-holder-top"><div class="holder-ball" style="animation-delay: -1.5s;"></div></div>
            </div>
            <div class="ball-holder bh-5">
                <div class="ball-holder-glow"></div>
                <div class="ball-holder-base"></div>
                <div class="ball-holder-pillar"></div>
                <div class="ball-holder-top"><div class="holder-ball" style="animation-delay: -0.3s;"></div></div>
            </div>
            <div class="ball-holder bh-6">
                <div class="ball-holder-glow"></div>
                <div class="ball-holder-base"></div>
                <div class="ball-holder-pillar"></div>
                <div class="ball-holder-top"><div class="holder-ball" style="animation-delay: -2s;"></div></div>
            </div>
        </div>

        {{-- CAMADA 4 - tubos de ensaio (frente) --}}
        <div class="lab-layer" data-depth="0.12">
            <div class="tube tube-1 tube-red"></div>
            <div class="tube tube-2 tube-yellow"></div>
            <div class="tube tube-3 tube-green"></div>
            <div class="tube tube-4"></div>
        </div>

        {{-- Bancada (estática, no chão) --}}
        <div class="bench"></div>

        {{-- Partículas de dados flutuando --}}
        <div id="data-particles"></div>
    </div>

    {{-- ============ CARD PRINCIPAL ============ --}}
    <div class="card fade-up w-full max-w-sm p-7 relative" style="z-index: 10;">
        <div class="card-corner tl"></div>
        <div class="card-corner tr"></div>
        <div class="card-corner bl"></div>
        <div class="card-corner br"></div>

        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-black"></div>
                <span class="text-xs font-semibold tracking-wider uppercase text-zinc-900">Pokédex</span>
            </div>
            <span class="text-xs text-zinc-400 font-medium">Gen I</span>
        </div>

        <form method="GET" action="" class="mb-5">
            <div class="flex gap-2">
                <input type="text" name="pokemon" placeholder="Buscar por nome ou número"
                       value="{{ request('pokemon') }}"
                       class="input flex-1 rounded-xl px-4 py-2.5 text-sm">
                <button type="submit" class="btn rounded-xl px-5 py-2.5 text-sm">Buscar</button>
            </div>
        </form>

        @if(session('Erro'))
            <div class="error rounded-xl px-4 py-3 mb-5">{{ session('Erro') }}</div>
        @endif

        @isset($pokemon)
            <div class="fade-up">
                <div class="pokemon-stage flex items-center justify-center p-6 mb-5" style="height: 240px;">
                    <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}"
                         alt="{{ $pokemon['name'] }}"
                         class="pokemon-img max-h-full w-auto">
                </div>

                <div class="flex items-baseline justify-between mb-4">
                    <h1 class="text-2xl font-semibold capitalize tracking-tight text-zinc-900">
                        {{ $pokemon['name'] }}
                    </h1>
                    <span class="mono text-sm text-zinc-400">
                        #{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

                <div class="flex gap-2 mb-5">
                    @foreach($pokemon['types'] as $tipo)
                        <span class="type-badge type-{{ $tipo['type']['name'] }}">{{ $tipo['type']['name'] }}</span>
                    @endforeach
                </div>

                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="measure-card">
                        <div class="measure-label">Altura</div>
                        <div class="measure-value">{{ $pokemon['height'] / 10 }} m</div>
                    </div>
                    <div class="measure-card">
                        <div class="measure-label">Peso</div>
                        <div class="measure-value">{{ $pokemon['weight'] / 10 }} kg</div>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="section-title">Habilidades</div>
                    <div>
                        @foreach($pokemon['abilities'] as $ab)
                            <span class="ability {{ $ab['is_hidden'] ? 'hidden-ability' : '' }}">
                                {{ str_replace('-', ' ', $ab['ability']['name']) }}
                                @if($ab['is_hidden'])
                                    <span style="color: #a1a1aa; font-size: 9px;">· oculta</span>
                                @endif
                            </span>
                        @endforeach
                    </div>
                </div>

                <div>
                    <div class="section-title">Status base</div>

                    @php
                        $statNames = [
                            'hp' => 'HP', 'attack' => 'Ataque', 'defense' => 'Defesa',
                            'special-attack' => 'At. Esp.', 'special-defense' => 'Def. Esp.',
                            'speed' => 'Velocidade',
                        ];
                        $total = 0;
                    @endphp

                    @foreach($pokemon['stats'] as $i => $stat)
                        @php
                            $value = $stat['base_stat'];
                            $total += $value;
                            $percent = min(100, ($value / 180) * 100);

                            if ($value < 50)      $tier = 'stat-low';
                            elseif ($value < 90)  $tier = 'stat-mid';
                            elseif ($value < 120) $tier = 'stat-high';
                            else                  $tier = 'stat-elite';
                        @endphp

                        <div class="stat-row">
                            <span class="stat-name">{{ $statNames[$stat['stat']['name']] ?? $stat['stat']['name'] }}</span>
                            <span class="stat-number">{{ $value }}</span>
                            <div class="stat-bar">
                                <div class="stat-fill {{ $tier }}"
                                     style="width: {{ $percent }}%; animation-delay: {{ $i * 0.08 }}s;"></div>
                            </div>
                        </div>
                    @endforeach

                    <div class="total-row">
                        <span class="total-label">Total</span>
                        <span class="total-value">{{ $total }}</span>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-16 text-center">
                <div class="empty-dot mb-4"></div>
                <p class="text-sm font-medium text-zinc-900 mb-1">Nenhum Pokémon selecionado</p>
                <p class="text-xs text-zinc-500">Digite um nome ou número para buscar</p>
            </div>
        @endisset
    </div>

    <script>
        // ============ PARALLAX MULTICAMADA ============
        const layers = document.querySelectorAll('.lab-layer');
        let mouseX = 0, mouseY = 0;
        let currentX = 0, currentY = 0;

        window.addEventListener('mousemove', (e) => {
            mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
            mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
        });

        function animateParallax() {
            currentX += (mouseX - currentX) * 0.08;
            currentY += (mouseY - currentY) * 0.08;

            layers.forEach(layer => {
                const depth = parseFloat(layer.dataset.depth);
                const translateX = -currentX * 100 * depth;
                const translateY = -currentY * 100 * depth;
                layer.style.transform = `translate(${translateX}px, ${translateY}px)`;
            });

            requestAnimationFrame(animateParallax);
        }
        animateParallax();

        // ============ POKÉBOLAS CLICÁVEIS ============
        document.querySelectorAll('.holder-ball').forEach(ball => {
            ball.style.pointerEvents = 'auto';
            ball.style.cursor = 'pointer';
            ball.addEventListener('click', (e) => {
                e.stopPropagation();
                ball.style.animation = 'none';
                ball.style.transition = 'transform 0.3s';
                ball.style.transform = 'scale(1.3) rotate(20deg)';
                setTimeout(() => {
                    ball.style.transform = 'scale(1) rotate(0deg)';
                    setTimeout(() => {
                        ball.style.animation = '';
                    }, 300);
                }, 300);
            });
        });

        // ============ PARTÍCULAS DE DADOS ============
        const particles = document.getElementById('data-particles');
        const codes = ['0x4A9F', 'DNA++', 'SCAN', '0xFF', 'HP:45', 'ATK:49', 'DEF:49', '>>>', '0x7B3', 'DATA', 'SYNC', 'REC+'];
        for (let i = 0; i < 20; i++) {
            const p = document.createElement('div');
            p.className = 'data-particle';
            p.textContent = codes[Math.floor(Math.random() * codes.length)];
            p.style.left = Math.random() * 100 + 'vw';
            p.style.animationDuration = (10 + Math.random() * 8) + 's';
            p.style.animationDelay = -(Math.random() * 15) + 's';
            p.style.fontSize = (8 + Math.random() * 4) + 'px';
            particles.appendChild(p);
        }

        // ============ HOLOFOTE SEGUE O MOUSE ============
        const light = document.querySelector('.lab-light');
        window.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth) * 100;
            light.style.left = x + '%';
            light.style.transform = 'translateX(-50%)';
        });
    </script>

</body>
</html>