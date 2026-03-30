<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | L'Atelier Confections</title>

    <!-- Same Fonts as Template -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #D48B96;
            --primary-dark: #C6727E;
            --text-dark: #2F2A32;
            --text-light: #675D6E;
            --bg-offwhite: #FDFCFB;
            --accent-gold: #D4AF37;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-offwhite);
            color: var(--text-dark);
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .font-serif-elegant { font-family: 'Playfair Display', serif; }

        /* Left panel – mirrors template's promo-1 gradient */
        .login-panel-left {
            background: linear-gradient(145deg, #FFE8EB 0%, #FDF0F2 50%, #F5E6E8 100%);
            position: relative;
            overflow: hidden;
        }

        .login-panel-left::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(212, 139, 150, 0.12);
            top: -100px;
            right: -100px;
        }

        .login-panel-left::after {
            content: '';
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(212, 139, 150, 0.10);
            bottom: -80px;
            left: -60px;
        }

        /* Glass card – same as template's glass-search style */
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 139, 150, 0.15);
            box-shadow: 0 25px 50px -12px rgba(212, 139, 150, 0.18),
                        0 8px 20px -4px rgba(47, 42, 50, 0.06);
        }

        /* Input styling matching template */
        .form-input {
            width: 100%;
            border: 1.5px solid #EDE8EA;
            border-radius: 12px;
            padding: 14px 18px 14px 48px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            color: var(--text-dark);
            background: rgba(255,255,255,0.8);
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(212, 139, 150, 0.12);
        }

        .form-input::placeholder {
            color: #B8ADB5;
            font-weight: 400;
        }

        /* Primary button – matches template's dark pill button */
        .btn-primary {
            background: var(--text-dark);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 15px 32px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(198, 114, 126, 0.45);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Circle badge – same as category items in template */
        .icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px -4px rgba(212, 139, 150, 0.5);
        }

        /* Input wrapper */
        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #C4B8BC;
            font-size: 0.95rem;
        }

        /* Decorative cake circles – same circle-card style */
        .deco-circle {
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid rgba(255,255,255,0.6);
            box-shadow: 0 15px 30px -6px rgba(212, 139, 150, 0.25);
        }

        /* Notice bar same as template */
        .notice-bar {
            background-color: var(--primary);
        }

        /* Back link hover – same as template's nav links */
        .back-link {
            color: var(--text-light);
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.25s;
        }

        .back-link:hover {
            color: var(--primary);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #EDE8EA;
        }

        .divider span {
            font-size: 0.78rem;
            color: #C4B8BC;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* Checkbox */
        .custom-checkbox {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        /* Alert messages */
        .alert-error {
            background: #FFF0F2;
            border: 1px solid rgba(212, 139, 150, 0.3);
            border-radius: 10px;
            padding: 12px 16px;
            color: var(--primary-dark);
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Floating animation for deco elements */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(3deg); }
        }

        @keyframes floatReverse {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(10px) rotate(-3deg); }
        }

        .float-1 { animation: float 5s ease-in-out infinite; }
        .float-2 { animation: floatReverse 6s ease-in-out infinite; }
        .float-3 { animation: float 4s ease-in-out infinite; animation-delay: 1s; }

        /* Shimmer effect on button */
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
    </style>
</head>
<body>

    <!-- Top Notice Bar (same as template) -->
    <div class="notice-bar text-white text-center py-2 text-xs font-semibold tracking-widest uppercase shadow-sm">
        Admin Portal &nbsp;•&nbsp; L'Atelier Confections Management System
    </div>

    <!-- Main Layout -->
    <div class="flex flex-1" style="min-height: calc(100vh - 36px);">

        <!-- ======================== LEFT DECORATIVE PANEL ======================== -->
        <div class="login-panel-left hidden lg:flex lg:w-1/2 flex-col items-center justify-center p-16 relative">

            <!-- Logo (same as template header) -->
            <div class="flex items-center space-x-3 mb-16">
                <div class="icon-circle">
                    <i class="fa-solid fa-cookie-bite text-xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-4xl font-serif-elegant font-bold tracking-tight leading-none" style="color: var(--text-dark);">L'Atelier</h1>
                    <p class="text-xs uppercase font-bold text-gray-400 tracking-widest leading-none mt-1">Confections</p>
                </div>
            </div>

            <!-- Decorative Circular Images (same circle-card as template) -->
            <div class="relative w-full flex items-center justify-center" style="height: 380px;">

                <!-- Large center circle -->
                <div class="float-1 deco-circle absolute" style="width:220px; height:220px; z-index:3;">
                    <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=400&auto=format&fit=crop"
                         class="w-full h-full object-cover" alt="Wedding Cake">
                </div>

                <!-- Top-left small circle -->
                <div class="float-2 deco-circle absolute" style="width:130px; height:130px; top: 20px; left: 60px; z-index:4;">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=300&auto=format&fit=crop"
                         class="w-full h-full object-cover" alt="Birthday Cake">
                </div>

                <!-- Bottom-right small circle -->
                <div class="float-3 deco-circle absolute" style="width:140px; height:140px; bottom: 20px; right: 60px; z-index:4;">
                    <img src="https://images.unsplash.com/photo-1535141192574-5d4897c12636?q=80&w=300&auto=format&fit=crop"
                         class="w-full h-full object-cover" alt="Baby Shower">
                </div>

                <!-- Tiny accent circle -->
                <div class="float-1 deco-circle absolute" style="width:80px; height:80px; top: 40px; right: 90px; z-index:2; animation-delay: 2s;">
                    <img src="https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=200&auto=format&fit=crop"
                         class="w-full h-full object-cover" alt="Pastry">
                </div>
            </div>

            <!-- Tagline -->
            <div class="text-center mt-10 relative z-10">
                <h2 class="font-serif-elegant text-3xl font-bold mb-3" style="color: var(--text-dark);">
                    Manage Your Atelier
                </h2>
                <p class="text-sm leading-relaxed max-w-sm mx-auto" style="color: var(--text-light);">
                    Access orders, deliveries, and inventory through your secure admin dashboard.
                </p>

                <!-- Category pills (same as template) -->
                <div class="flex flex-wrap justify-center gap-3 mt-6">
                    <span class="bg-white px-5 py-2 rounded-full text-xs font-semibold shadow-sm" style="color: var(--text-light);">Orders</span>
                    <span class="bg-white px-5 py-2 rounded-full text-xs font-semibold shadow-sm" style="color: var(--text-light);">Deliveries</span>
                    <span class="bg-white px-5 py-2 rounded-full text-xs font-semibold shadow-sm" style="color: var(--text-light);">Analytics</span>
                    <span class="bg-white px-5 py-2 rounded-full text-xs font-semibold shadow-sm" style="color: var(--text-light);">Inventory</span>
                </div>
            </div>

        </div>

        <!-- ======================== RIGHT LOGIN PANEL ======================== -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-12" style="background-color: var(--bg-offwhite);">

            <div class="w-full max-w-md">

                <!-- Back to Store Link -->
                <a href="{{ url('/') }}" class="back-link mb-8 inline-flex">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to Store
                </a>

                <!-- Card -->
                <div class="glass-card rounded-3xl p-10">

                    <!-- Card Header -->
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-4">
                            <!-- Mobile logo (hidden on desktop) -->
                            <div class="icon-circle lg:hidden" style="width:40px; height:40px;">
                                <i class="fa-solid fa-cookie-bite text-sm text-white"></i>
                            </div>
                            <div>
                                <span class="text-xs uppercase font-bold tracking-widest" style="color: var(--primary);">Admin Access</span>
                            </div>
                        </div>
                        <h2 class="font-serif-elegant text-3xl font-bold leading-tight" style="color: var(--text-dark);">
                            Welcome Back
                        </h2>
                        <p class="text-sm mt-2" style="color: var(--text-light);">
                            Sign in to your admin account to manage the dashboard.
                        </p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert-error mb-6">
                            <i class="fa-solid fa-circle-exclamation mr-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert-error mb-6">
                            <i class="fa-solid fa-circle-exclamation mr-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('admin.login.submit') }}" id="adminLoginForm">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-5">
                            <label class="block text-sm font-semibold mb-2" style="color: var(--text-dark);">
                                Email Address
                            </label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-envelope input-icon"></i>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    class="form-input"
                                    placeholder="admin@example.com"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                >
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-5">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-sm font-semibold" style="color: var(--text-dark);">
                                    Password
                                </label>
                                <a href="#" class="text-xs font-medium" style="color: var(--primary);">
                                    Forgot password?
                                </a>
                            </div>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="form-input"
                                    placeholder="Enter your password"
                                    required
                                >
                                <!-- Toggle visibility -->
                                <button type="button"
                                        onclick="togglePassword()"
                                        style="position:absolute; right:16px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#C4B8BC; padding:0;"
                                        id="toggleBtn">
                                    <i class="fa-regular fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center gap-2 mb-7">
                            <input type="checkbox" name="remember" id="remember" class="custom-checkbox">
                            <label for="remember" class="text-sm cursor-pointer select-none" style="color: var(--text-light);">
                                Keep me signed in
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-primary" id="loginBtn">
                            <i class="fa-solid fa-right-to-bracket mr-2"></i>
                            Sign In to Dashboard
                        </button>

                        <!-- Divider -->
                        <div class="divider">
                            <span>Secure Login</span>
                        </div>

                        <!-- Security badge -->
                        <div class="flex items-center justify-center gap-2 text-xs" style="color: var(--text-light);">
                            <i class="fa-solid fa-shield-halved" style="color: var(--primary);"></i>
                            <span>Protected by 256-bit SSL encryption</span>
                        </div>

                    </form>
                </div>

                <!-- Footer -->
                <p class="text-center text-xs mt-6" style="color: #C4B8BC;">
                    &copy; {{ date('Y') }} L'Atelier Confections &bull; All rights reserved
                </p>

            </div>
        </div>

    </div>

    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                pwd.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Add loading state to button
        document.getElementById('adminLoginForm').addEventListener('submit', function () {
            const btn = document.getElementById('loginBtn');
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Signing in...';
            btn.style.opacity = '0.85';
            btn.disabled = true;
        });
    </script>

</body>
</html>
