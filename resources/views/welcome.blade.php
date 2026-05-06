<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | AISAT Institutional Portal</title>

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
            margin: 0;
        }
        .hero-section {
            background: linear-gradient(135deg, var(--school-navy) 0%, #1e293b 100%);
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2v-4h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2v-4h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .school-logo-container {
            background: white;
            padding: 1.5rem;
            border-radius: 24px;
            display: inline-block;
            margin-bottom: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .btn-portal {
            padding: 1rem 2.5rem;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.875rem;
        }
        .btn-portal-primary {
            background-color: var(--school-gold);
            color: var(--school-navy);
        }
        .btn-portal-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(251, 191, 36, 0.4);
        }
        .btn-portal-outline {
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: white;
        }
        .btn-portal-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
        }
    </style>
</head>
<body class="antialiased">
    <div class="hero-section">
        <div class="container mx-auto px-6 relative z-10">
            <div class="school-logo-container">
                <x-application-logo class="w-16 h-16 text-slate-800" />
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-tight font-serif" style="font-family: 'Outfit', sans-serif;">
                AISAT <span class="text-amber-400">Portal</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-400 mb-12 max-w-2xl mx-auto font-light leading-relaxed">
                Empowering the future through digital academic excellence. Access your grades, manage attendance, and stay connected with the institutional community.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-portal btn-portal-primary">
                            Enter Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-portal btn-portal-primary">
                            Institutional Login
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div>
                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6 text-slate-800">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-4.04-8.03c.513-.036 1.033-.054 1.558-.054a11.16 11.16 0 015.19 1.254m1.196-4.411a11.003 11.003 0 0110.155 1.103M12 11Vc0 2.383-.394 4.675-1.121 6.821M3 7a9 9 0 0118 0v1a9 9 0 01-18 0V7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900">Biometric Attendance</h3>
                    <p class="text-slate-500 leading-relaxed">Integrated fingerprint scanning for real-time, high-integrity attendance tracking across campus.</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6 text-slate-800">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900">Academic Records</h3>
                    <p class="text-slate-500 leading-relaxed">Secure access to grades, schedules, and institutional announcements tailored to your profile.</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6 text-slate-800">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900">Admin Management</h3>
                    <p class="text-slate-500 leading-relaxed">Powerful tools for administrators to manage employees, users, and system-wide configurations.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-slate-900 text-slate-500 border-t border-slate-800">
        <div class="container mx-auto px-6 text-center">
            <p class="mb-4">&copy; {{ date('Y') }} AISAT Institutional Portal. All rights reserved.</p>
            <div class="flex justify-center gap-6">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors">Contact Support</a>
            </div>
        </div>
    </footer>
</body>
</html>