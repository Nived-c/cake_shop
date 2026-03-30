<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Driver Login | L'Atelier Confections</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.05);
            border: 1px solid #f1f5f9;
        }

        .logo-circle {
            width: 64px;
            height: 64px;
            background: #D48B96;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 24px;
            box-shadow: 0 8px 16px -4px rgba(212, 139, 150, 0.4);
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            background: #f8fafc;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            transition: all 0.2s;
            outline: none;
        }

        .form-input:focus {
            background: white;
            border-color: #D48B96;
            box-shadow: 0 0 0 4px rgba(212, 139, 150, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            background: #2F2A32;
            color: white;
            font-weight: 600;
            margin-top: 10px;
            transition: all 0.2s;
        }

        .btn-submit:hover {
            background: #1a171c;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(47, 42, 50, 0.2);
        }

        .alert-error {
            background: #fef2f2;
            color: #ef4444;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.85rem;
            margin-bottom: 24px;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>

    <div class="login-card">
        
        <div class="text-center mb-8">
            <div class="logo-circle">
                <i class="fa-solid fa-truck-fast"></i>
            </div>
            <h1 class="text-2xl font-bold mb-1">Driver Portal</h1>
            <p class="text-sm text-gray-500">Sign in to manage your deliveries</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation mr-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('delivery.login.submit') }}">
            @csrf

            <div class="input-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" name="email" class="form-input" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" class="form-input" placeholder="Password" required>
            </div>

            <div class="flex items-center mb-6 pl-1">
                <input type="checkbox" name="remember" id="remember" class="mr-2 rounded text-pink-500 focus:ring-pink-500">
                <label for="remember" class="text-sm text-gray-600 cursor-pointer select-none">Keep me signed in</label>
            </div>

            <button type="submit" class="btn-submit">
                Sign In <i class="fa-solid fa-arrow-right ml-1"></i>
            </button>
        </form>

    </div>

</body>
</html>
