<!DOCTYPE html>
<html lang="pt-BR" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFE · @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        senai: {
                            50: '#fef2f2', 100: '#fee2e2', 200: '#fecaca',
                            500: '#ef4444', 600: '#e30613', 700: '#b8050f', 800: '#8e040c', 900: '#5f0308',
                        },
                        ink: { 900: '#1d1d1b', 800: '#2a2a28', 700: '#3d3d3a', 500: '#6b6b67' },
                    }
                }
            }
        }
    </script>
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="h-full bg-slate-50">
    @yield('content')
</body>
</html>
