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
                radial-gradient(ellipse at top, #fef3f2 0%, transparent 60%),
                radial-gradient(ellipse at bottom, #fef9c3 0%, transparent 60%),
                linear-gradient(135deg, #fff1f2 0%, #fef3c7 50%, #dbeafe 100%);
            position: relative;
        }

        /* ============================================
           SCENE LAYER — arte imersiva por toda a tela
           ============================================ */
        .scene {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        /* Grid decorativo de fundo */
        .scene-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(239, 68, 68, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(239, 68, 68, 0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at center, black 20%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 20%, transparent 80%);
        }

        /* ============================================
           POKÉBOLAS GRANDES — com detalhes
           ============================================ */
        .pokeball {
            position: absolute;
            border-radius: 50%;
            background:
                linear-gradient(to bottom,
                    #ef4444 0%, #ef4444 48%,
                    #1a1a1a 48%, #1a1a1a 52%,
                    #ffffff 52%, #ffffff 100%);
            box-shadow:
                0 20px 40px rgba(0,0,0,0.12),
                inset -8px -8px 20px rgba(0,0,0,0.15),
                inset 8px 8px 20px rgba(255,255,255,0.2);
            border: 4px solid #1a1a1a;
        }
        .pokeball::after {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            width: 24%; height: 24%;
            background: radial-gradient(circle at 35% 35%, #fff, #e5e7eb);
            border: 4px solid #1a1a1a;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            box-shadow: inset -2px -2px 4px rgba(0,0,0,0.2);
        }
        /* Brilho na pokébola */
        .pokeball::before {
            content: '';
            position: absolute;
            top: 12%; left: 18%;
            width: 30%; height: 20%;
            background: rgba(255,255,255,0.4);
            border-radius: 50%;
            filter: blur(8px);
        }

        .pb-huge-1 {
            width: 320px; height: 320px;
            top: -80px; left: -80px;
            opacity: 0.35;
            animation: rotateSlow 40s linear infinite;
        }
        .pb-huge-2 {
            width: 280px; height: 280px;
            bottom: -60px; right: -60px;
            opacity: 0.35;
            animation: rotateSlow 50s linear infinite reverse;
        }
        .pb-med-1 {
            width: 140px; height: 140px;
            top: 12%; right: 8%;
            opacity: 0.5;
            animation: floatBall 12s ease-in-out infinite;
        }
        .pb-med-2 {
            width: 120px; height: 120px;
            bottom: 15%; left: 5%;
            opacity: 0.5;
            animation: floatBall 10s ease-in-out infinite -3s;
        }
        .pb-small-1 {
            width: 70px; height: 70px;
            top: 40%; left: 8%;
            opacity: 0.6;
            animation: floatBall 8s ease-in-out infinite -5s;
        }
        .pb-small-2 {
            width: 60px; height: 60px;
            top: 65%; right: 12%;
            opacity: 0.6;
            animation: floatBall 9s ease-in-out infinite -2s;
        }
        @keyframes rotateSlow {
            to { transform: rotate(360deg); }
        }
        @keyframes floatBall {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%      { transform: translateY(-25px) rotate(15deg); }
        }

        /* ============================================
           SILHUETAS DE POKÉMON (SVG) coloridas
           ============================================ */
        .mon {
            position: absolute;
            animation: floatMon 8s ease-in-out infinite;
        }
        .mon svg { width: 100%; height: auto; display: block; }
        @keyframes floatMon {
            0%, 100% { transform: translateY(0) rotate(-2deg); }
            50%      { transform: translateY(-15px) rotate(2deg); }
        }
        .mon-1 { width: 160px; top: 8%; left: 8%; animation-delay: 0s; opacity: 0.8; }
        .mon-2 { width: 130px; top: 20%; right: 20%; animation-delay: -2s; opacity: 0.7; }
        .mon-3 { width: 140px; bottom: 18%; right: 6%; animation-delay: -4s; opacity: 0.75; }
        .mon-4 { width: 110px; bottom: 10%; left: 18%; animation-delay: -6s; opacity: 0.7; }
        .mon-5 { width: 90px;  top: 55%; left: 14%; animation-delay: -3s; opacity: 0.65; }
        .mon-6 { width: 100px; top: 50%; right: 10%; animation-delay: -5s; opacity: 0.65; }

        /* ============================================
           FOLHAS / ELEMENTOS NATURAIS
           ============================================ */
        .leaf {
            position: absolute;
            width: 40px; height: 40px;
            animation: leafFall linear infinite;
            opacity: 0.4;
        }
        @keyframes leafFall {
            0%   { transform: translateY(-100px) rotate(0deg); }
            100% { transform: translateY(calc(100vh + 100px)) rotate(720deg); }
        }

        /* ============================================
           RAIOS ELÉTRICOS
           ============================================ */
        .bolt {
            position: absolute;
            color: #facc15;
            filter: drop-shadow(0 0 8px rgba(250, 204, 21, 0.6));
            animation: boltFlash 3s ease-in-out infinite;
            opacity: 0;
        }
        @keyframes boltFlash {
            0%, 90%, 100% { opacity: 0; transform: scale(0.8); }
            45%, 55%      { opacity: 0.7; transform: scale(1); }
        }

        /* ============================================
           ESTRELINHAS / PONTOS DE LUZ
           ============================================ */
        .sparkle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #facc15;
            border-radius: 50%;
            box-shadow: 0 0 12px #facc15;
            animation: sparkleFade 4s ease-in-out infinite;
            opacity: 0;
        }
        @keyframes sparkleFade {
            0%, 100% { opacity: 0; transform: scale(0); }
            50%      { opacity: 1; transform: scale(1); }
        }

        /* ============================================
           CARD — ilha de calma
           ============================================ */
        .fade-up {
            animation: fadeUp 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 24px;
            box-shadow:
                0 1px 2px rgba(0,0,0,0.04),
                0 20px 40px rgba(0,0,0,0.08),
                0 40px 80px rgba(239, 68, 68, 0.08);
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
                radial-gradient(circle at center, rgba(239, 68, 68, 0.06) 0%, transparent 60%),
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
            background:
                linear-gradient(to bottom,
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
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 999px;
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
            background: #fafafa;
            border: 1px solid rgba(0,0,0,0.04);
            border-radius: 12px;
            padding: 12px;
            text-align: center;
        }
        .measure-label {
            font-size: 10px;
            font-weight: 500;
            color: #71717a;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        .measure-value {
            font-size: 18px;
            font-weight: 600;
            color: #0a0a0a;
            letter-spacing: -0.02em;
            font-variant-numeric: tabular-nums;
            margin-top: 2px;
        }

        .stat-row { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
        .stat-row:last-child { margin-bottom: 0; }
        .stat-name {
            font-size: 11px;
            font-weight: 500;
            color: #71717a;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            width: 68px;
            flex-shrink: 0;
        }
        .stat-number {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            font-weight: 500;
            color: #0a0a0a;
            width: 28px;
            text-align: right;
            flex-shrink: 0;
            font-variant-numeric: tabular-nums;
        }
        .stat-bar {
            flex: 1;
            height: 6px;
            background: #f4f4f5;
            border-radius: 999px;
            overflow: hidden;
        }
        .stat-fill {
            height: 100%;
            border-radius: 999px;
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
            font-size: 10px;
            font-weight: 600;
            color: #a1a1aa;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, rgba(0,0,0,0.08), transparent);
        }

        .ability {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            color: #52525b;
            background: #fafafa;
            border: 1px solid rgba(0,0,0,0.06);
            padding: 4px 10px;
            border-radius: 6px;
            margin-right: 4px;
            margin-bottom: 4px;
            text-transform: capitalize;
        }
        .ability.hidden-ability {
            background: #fff;
            border-style: dashed;
            color: #71717a;
        }

        .empty-dot {
            width: 8px;
            height: 8px;
            background: #0a0a0a;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%      { opacity: 0.3; transform: scale(0.8); }
        }

        .error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            font-size: 13px;
            font-weight: 500;
        }

        .mono { font-family: 'JetBrains Mono', monospace; font-variant-numeric: tabular-nums; }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            margin-top: 12px;
            border-top: 1px solid rgba(0,0,0,0.06);
        }
        .total-label {
            font-size: 11px;
            font-weight: 600;
            color: #0a0a0a;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        .total-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 14px;
            font-weight: 600;
            color: #0a0a0a;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    {{-- ============ CENA DE FUNDO ============ --}}
    <div class="scene">
        <div class="scene-grid"></div>

        {{-- Pokébolas grandes decorativas --}}
        <div class="pokeball pb-huge-1"></div>
        <div class="pokeball pb-huge-2"></div>
        <div class="pokeball pb-med-1"></div>
        <div class="pokeball pb-med-2"></div>
        <div class="pokeball pb-small-1"></div>
        <div class="pokeball pb-small-2"></div>

        {{-- Pikachu (canto superior esquerdo) --}}
        <div class="mon mon-1">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="M60 40 L40 10 L55 45 Q75 42 100 45 Q125 42 145 45 L160 10 L140 40 Q170 60 170 110 Q170 160 130 175 Q100 182 70 175 Q30 160 30 110 Q30 60 60 40 Z"
                          fill="#fbbf24" stroke="#1a1a1a" stroke-width="3" stroke-linejoin="round"/>
                    <path d="M50 15 L55 40 L65 38 Z M150 15 L145 40 L135 38 Z"
                          fill="#1a1a1a"/>
                    <circle cx="75" cy="95" r="8" fill="#1a1a1a"/>
                    <circle cx="125" cy="95" r="8" fill="#1a1a1a"/>
                    <circle cx="77" cy="92" r="2.5" fill="#fff"/>
                    <circle cx="127" cy="92" r="2.5" fill="#fff"/>
                    <circle cx="55" cy="115" r="10" fill="#ef4444" opacity="0.8"/>
                    <circle cx="145" cy="115" r="10" fill="#ef4444" opacity="0.8"/>
                    <path d="M90 115 Q100 125 110 115" stroke="#1a1a1a" stroke-width="3" fill="none" stroke-linecap="round"/>
                    <circle cx="100" cy="108" r="3" fill="#1a1a1a"/>
                </g>
            </svg>
        </div>

        {{-- Pokébola com asas estilizada (superior direito) --}}
        <div class="mon mon-2">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <circle cx="100" cy="100" r="60" fill="#ef4444" stroke="#1a1a1a" stroke-width="4"/>
                <path d="M40 100 L160 100" stroke="#1a1a1a" stroke-width="8"/>
                <path d="M40 100 A60 60 0 0 0 160 100" fill="#fff"/>
                <circle cx="100" cy="100" r="15" fill="#fff" stroke="#1a1a1a" stroke-width="4"/>
                <circle cx="100" cy="100" r="6" fill="#e5e7eb"/>
                <path d="M40 100 Q10 70 0 90 Q15 100 40 100 Z" fill="#60a5fa" stroke="#1a1a1a" stroke-width="3"/>
                <path d="M160 100 Q190 70 200 90 Q185 100 160 100 Z" fill="#60a5fa" stroke="#1a1a1a" stroke-width="3"/>
            </svg>
        </div>

        {{-- Charmander (inferior direito) --}}
        <div class="mon mon-3">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="M140 60 Q155 40 165 20 Q170 35 160 55 Z" fill="#f97316" stroke="#1a1a1a" stroke-width="3"/>
                    <path d="M145 55 Q155 40 162 28 Q163 38 158 50 Z" fill="#fbbf24"/>
                    <ellipse cx="100" cy="110" rx="55" ry="60" fill="#f97316" stroke="#1a1a1a" stroke-width="3"/>
                    <ellipse cx="100" cy="130" rx="35" ry="40" fill="#fed7aa"/>
                    <circle cx="82" cy="95" r="8" fill="#1a1a1a"/>
                    <circle cx="118" cy="95" r="8" fill="#1a1a1a"/>
                    <circle cx="84" cy="92" r="2.5" fill="#fff"/>
                    <circle cx="120" cy="92" r="2.5" fill="#fff"/>
                    <path d="M90 115 Q100 122 110 115" stroke="#1a1a1a" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                </g>
            </svg>
        </div>

        {{-- Bulbasaur (inferior esquerdo) --}}
        <div class="mon mon-4">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <ellipse cx="100" cy="120" rx="60" ry="50" fill="#86efac" stroke="#1a1a1a" stroke-width="3"/>
                    <ellipse cx="100" cy="75" rx="45" ry="35" fill="#4ade80" stroke="#1a1a1a" stroke-width="3"/>
                    <path d="M60 65 Q55 45 70 40 Q78 55 75 70 Z" fill="#22c55e" stroke="#1a1a1a" stroke-width="2"/>
                    <path d="M140 65 Q145 45 130 40 Q122 55 125 70 Z" fill="#22c55e" stroke="#1a1a1a" stroke-width="2"/>
                    <circle cx="82" cy="80" r="7" fill="#1a1a1a"/>
                    <circle cx="118" cy="80" r="7" fill="#1a1a1a"/>
                    <circle cx="84" cy="77" r="2.5" fill="#fff"/>
                    <circle cx="120" cy="77" r="2.5" fill="#fff"/>
                    <path d="M90 95 Q100 102 110 95" stroke="#1a1a1a" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                </g>
            </svg>
        </div>

        {{-- Squirtle (meio esquerda) --}}
        <div class="mon mon-5">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <ellipse cx="100" cy="120" rx="55" ry="50" fill="#a16207" stroke="#1a1a1a" stroke-width="3"/>
                    <ellipse cx="100" cy="115" rx="45" ry="40" fill="#fbbf24"/>
                    <ellipse cx="100" cy="75" rx="40" ry="35" fill="#60a5fa" stroke="#1a1a1a" stroke-width="3"/>
                    <circle cx="85" cy="75" r="7" fill="#1a1a1a"/>
                    <circle cx="115" cy="75" r="7" fill="#1a1a1a"/>
                    <circle cx="87" cy="72" r="2.5" fill="#fff"/>
                    <circle cx="117" cy="72" r="2.5" fill="#fff"/>
                    <path d="M90 90 Q100 96 110 90" stroke="#1a1a1a" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                </g>
            </svg>
        </div>

        {{-- Pokébola Great Ball (meio direita) --}}
        <div class="mon mon-6">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <circle cx="100" cy="100" r="70" fill="#fff" stroke="#1a1a1a" stroke-width="4"/>
                <path d="M30 100 A70 70 0 0 1 170 100" fill="#3b82f6" stroke="#1a1a1a" stroke-width="4"/>
                <path d="M50 60 Q70 40 100 50" stroke="#ef4444" stroke-width="6" fill="none" stroke-linecap="round"/>
                <path d="M150 60 Q130 40 100 50" stroke="#ef4444" stroke-width="6" fill="none" stroke-linecap="round"/>
                <path d="M30 100 L170 100" stroke="#1a1a1a" stroke-width="8"/>
                <circle cx="100" cy="100" r="18" fill="#fff" stroke="#1a1a1a" stroke-width="4"/>
                <circle cx="100" cy="100" r="8" fill="#e5e7eb"/>
            </svg>
        </div>

        {{-- Raios elétricos --}}
        <svg class="bolt" style="top: 20%; left: 40%; width: 40px; animation-delay: 0s;" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13 2 L4 14 L11 14 L9 22 L20 10 L13 10 Z"/>
        </svg>
        <svg class="bolt" style="top: 70%; right: 30%; width: 30px; animation-delay: 1s;" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13 2 L4 14 L11 14 L9 22 L20 10 L13 10 Z"/>
        </svg>
        <svg class="bolt" style="top: 45%; left: 45%; width: 25px; animation-delay: 2s;" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13 2 L4 14 L11 14 L9 22 L20 10 L13 10 Z"/>
        </svg>

        {{-- Estrelinhas --}}
        <div class="sparkle" style="top: 15%; left: 30%; animation-delay: 0s;"></div>
        <div class="sparkle" style="top: 30%; right: 35%; animation-delay: 1s;"></div>
        <div class="sparkle" style="bottom: 25%; left: 40%; animation-delay: 2s;"></div>
        <div class="sparkle" style="top: 60%; right: 20%; animation-delay: 1.5s;"></div>
        <div class="sparkle" style="top: 75%; left: 25%; animation-delay: 0.5s;"></div>
        <div class="sparkle" style="top: 35%; left: 60%; animation-delay: 2.5s;"></div>

        {{-- Folhas caindo (geradas via JS) --}}
        <div id="leaves"></div>
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
                <input
                    type="text"
                    name="pokemon"
                    placeholder="Buscar por nome ou número"
                    value="{{ request('pokemon') }}"
                    class="input flex-1 rounded-xl px-4 py-2.5 text-sm"
                >
                <button type="submit" class="btn rounded-xl px-5 py-2.5 text-sm">Buscar</button>
            </div>
        </form>

        @if(session('Erro'))
            <div class="error rounded-xl px-4 py-3 mb-5">{{ session('Erro') }}</div>
        @endif

        @isset($pokemon)
            <div class="fade-up">
                <div class="pokemon-stage flex items-center justify-center p-6 mb-5" style="height: 240px;">
                    <img
                        src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}"
                        alt="{{ $pokemon['name'] }}"
                        class="pokemon-img max-h-full w-auto"
                    >
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
                        <span class="type-badge type-{{ $tipo['type']['name'] }}">
                            {{ $tipo['type']['name'] }}
                        </span>
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
                            'hp' => 'HP',
                            'attack' => 'Ataque',
                            'defense' => 'Defesa',
                            'special-attack' => 'At. Esp.',
                            'special-defense' => 'Def. Esp.',
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
                                     style="width: {{ $percent }}%; animation-delay: {{ $i * 0.08 }}s;">
                                </div>
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
        // Folhas caindo
        const leavesContainer = document.getElementById('leaves');
        const leafColors = ['#22c55e', '#4ade80', '#86efac', '#fbbf24', '#f97316'];
        for (let i = 0; i < 10; i++) {
            const leaf = document.createElement('div');
            leaf.className = 'leaf';
            leaf.style.left = Math.random() * 100 + 'vw';
            leaf.style.animationDuration = (10 + Math.random() * 10) + 's';
            leaf.style.animationDelay = -(Math.random() * 15) + 's';
            const color = leafColors[Math.floor(Math.random() * leafColors.length)];
            leaf.innerHTML = `
                <svg viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 5 Q5 15 10 30 Q20 35 30 30 Q35 15 20 5 Z"
                          fill="${color}" stroke="#1a1a1a" stroke-width="1.5" opacity="0.7"/>
                    <path d="M20 5 L20 35" stroke="#1a1a1a" stroke-width="1" opacity="0.5"/>
                </svg>
            `;
            leavesContainer.appendChild(leaf);
        }
    </script>

</body>
</html>