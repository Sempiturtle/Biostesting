<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | AISAT Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --school-navy: #0f172a;
            --school-gold: #fbbf24;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .auth-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            max-width: 900px;
            width: 100%;
            min-height: 600px;
        }
        .auth-image {
            background: linear-gradient(135deg, var(--school-navy) 0%, #1e293b 100%);
            width: 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
            color: white;
            position: relative;
        }
        .auth-image::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2v-4h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2v-4h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .auth-form {
            width: 60%;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .input-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin-bottom: 0.5rem;
        }
        .input-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            outline: none;
        }
        .input-group input:focus {
            border-color: var(--school-navy);
            box-shadow: 0 0 0 4px rgba(15, 23, 42, 0.05);
        }
        .btn-auth {
            background: var(--school-navy);
            color: white;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.2);
        }
        @media (max-width: 768px) {
            .auth-image { display: none; }
            .auth-form { width: 100%; padding: 2rem; }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="auth-card">
        <div class="auth-image">
            <div class="relative z-10">
                <div class="bg-white p-3 rounded-2xl inline-block mb-6">
                    <x-application-logo class="w-10 h-10 text-slate-800" />
                </div>
                <h2 class="text-3xl font-bold mb-4" style="font-family: 'Outfit', sans-serif;">AISAT Portal</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Secure institutional gateway. Please provide your authorized credentials to access your academic dashboard.</p>
            </div>
            <div class="mt-auto relative z-10">
                <p class="text-[10px] uppercase tracking-widest text-slate-500 font-bold">&copy; {{ date('Y') }} AISAT Excellence</p>
            </div>
        </div>
        <div class="auth-form">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
