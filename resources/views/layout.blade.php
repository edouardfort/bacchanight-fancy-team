<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bacchanight 2026</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Cinzel+Decorative:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #042018; 
            color: #ecfdf5;
            font-family: 'Lato', sans-serif;
            background-size: cover;
            background-blend-mode: overlay;
        }
        h1, h2, h3, .titre-fancy, .font-cinzel {
            font-family: 'Cinzel', serif;
        }
        .ornament-text {
            font-family: 'Cinzel Decorative', serif;
        }

        .btn-baccha {
            background: radial-gradient(circle at center, #134e3f 0%, #051f18 100%);
            border: 1px solid #1a5746; 
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.1); 
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .btn-baccha:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.6), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
            border-color: #2d7a67;
        }
        .btn-baccha::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 40%;
            background: linear-gradient(to bottom, rgba(255,255,255,0.1), transparent);
            border-radius: 9999px 9999px 0 0;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-start p-4 text-center antialiased relative overflow-y-auto bg-fixed">
    
    <div class="absolute inset-0 opacity-5 pointer-events-none" 
         style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;">
    </div>

    <div class="relative z-10 w-full max-w-md py-8">
        @yield('content')
    </div>

</body>
</html>