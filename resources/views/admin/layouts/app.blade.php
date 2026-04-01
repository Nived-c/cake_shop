<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') | L'Atelier Confections</title>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Cinzel:wght@400;600&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #B2915F; /* Muted Gold */
            --primary-dark: #8c7148;
            --text-dark: #F5F0E6; /* Light text for dark bg */
            --text-light: #A09D94;
            --bg-offwhite: #121212;
            --bg-darker: #050505;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-darker);
            color: var(--text-dark);
            margin: 0;
        }

        .font-serif-elegant { font-family: 'Cormorant Garamond', serif; }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--bg-offwhite);
            border-right: 1px solid rgba(255,255,255,0.05);
            min-height: 100vh;
            position: fixed;
            left: 0; top: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-logo {
            padding: 28px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 24px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 10px;
            margin: 2px 12px;
            transition: all 0.25s ease;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(178, 145, 95, 0.18);
            color: var(--primary);
        }

        .nav-item .icon { width: 20px; text-align: center; }

        .nav-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.25);
            padding: 16px 24px 6px;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            background: var(--bg-offwhite);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        /* Stat cards */
        .stat-card {
            background: var(--bg-offwhite);
            border-radius: 20px;
            padding: 24px;
            border: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            border-color: var(--primary);
            box-shadow: 0 12px 25px -5px rgba(178, 145, 95, 0.18);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            background: rgba(178, 145, 95, 0.1) !important;
            color: var(--primary) !important;
        }

        /* Table */
        .data-table {
            background: var(--bg-offwhite);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .data-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: rgba(255,255,255,0.02);
            padding: 14px 20px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--primary);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .data-table td {
            padding: 16px 20px;
            font-size: 0.88rem;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            color: var(--text-dark);
            background: transparent !important;
        }
        
        /* Select and inputs in tables */
        .data-table select, .data-table input {
            background: var(--bg-darker);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--text-dark);
        }

        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: rgba(255,255,255,0.02) !important; }

        /* Status badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Status badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-pending    { background: rgba(232, 160, 0, 0.15) !important; color: #FFB300 !important; border: 1px solid rgba(232, 160, 0, 0.2); }
        .badge-delivered  { background: rgba(46, 125, 50, 0.15) !important; color: #66BB6A !important; border: 1px solid rgba(46, 125, 50, 0.2); }
        .badge-processing { background: rgba(57, 73, 171, 0.15) !important; color: #7986CB !important; border: 1px solid rgba(57, 73, 171, 0.2); }
        .badge-cancelled  { background: rgba(198, 40, 40, 0.15) !important; color: #EF5350 !important; border: 1px solid rgba(198, 40, 40, 0.2); }
        .badge-transit    { background: rgba(2, 132, 199, 0.15) !important; color: #38BDF8 !important; border: 1px solid rgba(2, 132, 199, 0.2); }
        .badge-delayed    { background: rgba(220, 38, 38, 0.15) !important; color: #F87171 !important; border: 1px solid rgba(220, 38, 38, 0.2); }
        .badge-pickedup   { background: rgba(99, 102, 241, 0.15) !important; color: #818CF8 !important; border: 1px solid rgba(99, 102, 241, 0.2); }

        /* Fix select options for dark theme */
        select option {
            background-color: #1A1A1A !important;
            color: #F5F0E6 !important;
            padding: 10px;
        }

        select:focus {
            outline: none;
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 2px rgba(178, 145, 95, 0.2);
        }

        /* Logout btn */
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            border-radius: 50px;
            background: rgba(178, 145, 95, 0.12);
            color: var(--primary);
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.25s;
        }

        .btn-logout:hover {
            background: var(--primary);
            color: #000;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">

        <!-- Logo -->
        <div class="sidebar-logo">
            <div class="flex items-center gap-3">
                <div style="width:40px;height:40px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-cookie-bite text-white text-lg"></i>
                </div>
                <div>
                    <div class="font-serif-elegant text-white text-xl font-bold leading-none">L'Atelier</div>
                    <div style="font-size:0.65rem;color:rgba(255,255,255,0.35);letter-spacing:0.25em;text-transform:uppercase;margin-top:2px;">Admin Panel</div>
                </div>
            </div>
        </div>

        <!-- Nav Links -->
        <nav style="flex:1; padding: 12px 0; overflow-y: auto;">

            <div class="nav-section-label">Main Menu</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="icon"><i class="fa-solid fa-gauge-high"></i></span> Dashboard
            </a>

            <div class="nav-section-label">Delivery Module</div>
            <a href="{{ route('admin.deliveries.index') }}" class="nav-item {{ request()->routeIs('admin.deliveries.*') ? 'active' : '' }}">
                <span class="icon"><i class="fa-solid fa-truck-fast"></i></span> Deliveries
            </a>

            <div class="nav-section-label">Orders</div>
            <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <span class="icon"><i class="fa-solid fa-bag-shopping"></i></span> Orders
            </a>
            
            <div class="nav-section-label">Catalog</div>
            <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <span class="icon"><i class="fa-solid fa-cake-candles"></i></span> Products
            </a>

            <div class="nav-section-label">Settings</div>
            <a href="#" class="nav-item">
                <span class="icon"><i class="fa-solid fa-gear"></i></span> Settings
            </a>

        </nav>

        <!-- Sidebar Footer -->
        <div style="padding: 16px 24px; border-top: 1px solid rgba(255,255,255,0.07);">
            <div class="flex items-center gap-3">
                <div style="width:36px;height:36px;background:rgba(255,255,255,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-user text-sm" style="color:var(--primary);"></i>
                </div>
                <div style="flex:1; overflow:hidden;">
                    <div style="color:white;font-weight:600;font-size:0.85rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        {{ session('admin_name', 'Admin') }}
                    </div>
                    <div style="color:rgba(255,255,255,0.35);font-size:0.72rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        {{ session('admin_email') }}
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Topbar -->
        <div class="topbar">
            <div>
                <h1 class="font-serif-elegant text-2xl font-bold" style="color:var(--primary);">@yield('header_title', 'Dashboard')</h1>
                <p style="font-size:0.8rem;color:var(--text-light);margin:0;">
                    @yield('header_subtitle', 'Welcome back, ' . session('admin_name', 'Admin') . ' • ' . now()->format('l, d M Y'))
                </p>
            </div>
            <div class="flex items-center gap-4">
                @php
                    $unreadCount = \App\Models\User::where('role', 'admin')->first()?->unreadNotifications->count() ?? 0;
                @endphp
                <div style="position:relative;cursor:pointer;">
                    <div style="width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.05);display:flex;align-items:center;justify-content:center;color:var(--text-light);">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    @if($unreadCount > 0)
                        <div id="bellCountWrapper" style="position:absolute;top:-2px;right:-2px;background:#ef4444;color:white;font-size:0.65rem;font-weight:700;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid white;">
                            <span id="bellCount">{{ $unreadCount }}</span>
                        </div>
                    @else
                        <div id="bellCountWrapper" style="display:none;position:absolute;top:-2px;right:-2px;background:#ef4444;color:white;font-size:0.65rem;font-weight:700;width:18px;height:18px;border-radius:50%;align-items:center;justify-content:center;border:2px solid white;">
                            <span id="bellCount">0</span>
                        </div>
                    @endif
                </div>

                <a href="{{ route('admin.logout') }}" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>
        </div>

        <!-- Page Body -->
        <div style="padding: 32px;">
            @yield('content')
        </div>
    </div>

    @yield('scripts')
    
    <!-- Notification Polling Script -->
    <script>
        let lastNotifCheck = null;

        // Initialize by getting a server timestamp silently
        fetch('{{ route("admin.notifications.poll") }}')
            .then(res => res.json())
            .then(data => {
                lastNotifCheck = data.timestamp;
                
                // Start polling every 5 seconds
                setInterval(pollNewNotifications, 5000);
            })
            .catch(err => console.error("Initial poll failed", err));

        function pollNewNotifications() {
            if(!lastNotifCheck) return;
            
            fetch(`{{ route('admin.notifications.poll') }}?since=${encodeURIComponent(lastNotifCheck)}`)
                .then(res => res.json())
                .then(data => {
                    if(data.notifications && data.notifications.length > 0) {
                        data.notifications.forEach(notif => {
                            // Show toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'info',
                                iconColor: '#D48B96',
                                title: `<span style="font-family:'Outfit'">Delivery Update!</span>`,
                                html: `<span style="font-family:'Outfit';font-size:0.9rem;">${notif.data.message} <br/><strong style="color:#C62828">${notif.data.reason ? 'Note: '+notif.data.reason : ''}</strong></span>`,
                                showConfirmButton: false,
                                timer: 6000,
                                timerProgressBar: true,
                                customClass: {
                                    popup: 'swal2-toast-custom'
                                }
                            });
                        });
                        
                        // Because there's a new one, we probably should reload the table if we are on orders or deliveries view.
                        // For now we just optionally show real-time changes or just let the user see the visual toast.
                        if (window.location.pathname.includes('deliveries') || window.location.pathname.includes('orders')) {
                            // Optionally could reload: window.location.reload(); 
                            // But soft-refreshing via toast is fine unless they want auto-reload.
                        }
                    }
                    
                    if(data.timestamp) lastNotifCheck = data.timestamp;
                    
                    // Update bell
                    if(typeof data.total_unread !== 'undefined') {
                        const wrapper = document.getElementById('bellCountWrapper');
                        const countSpan = document.getElementById('bellCount');
                        if(data.total_unread > 0) {
                            wrapper.style.display = 'flex';
                            countSpan.innerText = data.total_unread;
                        } else {
                            wrapper.style.display = 'none';
                        }
                    }
                })
                .catch(err => console.log('Poll failed', err));
        }
    </script>
</body>
</html>
