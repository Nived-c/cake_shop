<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Driver Dashboard | L'Atelier Confections</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #B2915F;
            --dark: #050505;
            --bg: #121212;
            --text-dark: #F5F0E6;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: var(--text-dark);
            margin: 0;
            padding-bottom: 80px; /* Space for mobile nav */
        }

        .header {
            background: var(--dark);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .profile-img {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: rgba(178, 145, 95, 0.15);
            color: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }

        .driver-stats {
            background: var(--dark);
            color: white;
            margin: 20px;
            padding: 24px;
            border-radius: 4px;
            border: 1px solid rgba(255,255,255,0.05);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
        }

        .stat-block h3 { font-size: 2rem; font-weight: 800; line-height: 1; margin-bottom: 4px; color: var(--primary); }
        .stat-block p { font-size: 0.75rem; color: #a09d94; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; }

        .order-card {
            background: var(--dark);
            border-radius: 4px;
            margin: 0 20px 20px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s;
        }
        
        .status-badge {
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-pending { background: rgba(232, 160, 0, 0.15); color: #FFB300; border: 1px solid rgba(232, 160, 0, 0.2); }
        .status-processing { background: rgba(57, 73, 171, 0.15); color: #7986CB; border: 1px solid rgba(57, 73, 171, 0.2); }
        .status-transit { background: rgba(46, 125, 50, 0.15); color: #66BB6A; border: 1px solid rgba(46, 125, 50, 0.2); }

        .btn-action {
            width: 100%;
            padding: 12px;
            border-radius: 4px;
            font-weight: 600;
            text-align: center;
            margin-top: 10px;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary { background: var(--primary); color: #000; }
        .btn-success { background: #4CAF50; color: white; }
        .btn-danger { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }

        .modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.7); backdrop-filter: blur(4px);
            z-index: 100; display: hidden;
            align-items: flex-end; justify-content: center;
        }

        .modal-content {
            background: var(--dark); width: 100%; border-radius: 20px 20px 0 0;
            padding: 30px 20px; border-top: 1px solid rgba(255,255,255,0.1);
            transform: translateY(100%); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .modal-overlay.active { display: flex; }
        .modal-overlay.active .modal-content { transform: translateY(0); }

        .reason-input {
            width: 100%; padding: 14px; border-radius: 4px;
            border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.02);
            margin-bottom: 16px; font-family: 'Outfit'; outline: none; color: var(--text-dark);
        }
        .reason-input:focus { border-color: var(--primary); background: rgba(18,18,18,0.9); }

        /* Custom utility classes to replace Tailwind v3 arbitrary values */
        .bg-gradient-premium { background: linear-gradient(to bottom right, #1A1A1A, #0A0A0A); }
        .border-premium { border-color: rgba(255,255,255,0.05); border-width: 1px; }
        .bg-premium-light { background-color: rgba(255,255,255,0.05); }
        .text-primary-accent { color: #F59E0B; }
        .bg-primary-accent { background-color: #F59E0B; }
        .text-xxs { font-size: 10px; }
    </style>
</head>
<body>

    <header class="header">
        <div class="flex items-center gap-3">
            <div class="profile-img"><i class="fa-solid fa-motorcycle"></i></div>
            <div>
                <h1 class="font-bold text-lg leading-tight">{{ Auth::user()->name }}</h1>
                <p class="text-xs text-gray-500 font-medium" style="color:var(--primary);">Delivery Partner</p>
            </div>
        </div>
        <form method="POST" action="{{ route('delivery.logout') }}">
            @csrf
            <button class="w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-red-500" style="background: rgba(255,255,255,0.05);">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </button>
        </form>
    </header>

    <!-- Performance Snapshot -->
    <div class="px-5 mt-4 mb-2 flex justify-between items-end">
        <h2 class="text-sm font-bold uppercase tracking-widest text-gray-500">Status Snapshot</h2>
    </div>
    <div class="driver-stats">
        <div class="stat-block">
            <div class="flex items-center gap-2 mb-1 justify-start">
                <i class="fa-solid fa-clipboard-list text-gray-500 text-xs"></i>
                <p>To Deliver</p>
            </div>
            <h3>{{ $stats['active_count'] }}</h3>
        </div>
        <div class="stat-block text-center border-l border-r border-premium">
            <div class="flex items-center gap-2 mb-1 justify-center">
                <i class="fa-solid fa-calendar-check text-gray-500 text-xs"></i>
                <p>Done Today</p>
            </div>
            <h3>{{ $stats['today_delivered'] }}</h3>
        </div>
        <div class="stat-block text-right">
            <div class="flex items-center gap-2 mb-1 justify-end">
                <i class="fa-solid fa-triangle-exclamation text-primary-accent text-xs"></i>
                <p>Delayed</p>
            </div>
            <h3 class="text-primary-accent">{{ $stats['delayed_count'] }}</h3>
        </div>
    </div>

    <!-- Enhanced Work Report Card -->
    <div class="mx-5 mb-8 p-5 rounded-xl border border-premium bg-gradient-premium relative overflow-hidden group">
        <h3 class="font-display font-bold text-primary-accent text-sm uppercase tracking-widest mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-line"></i> Performance Report
        </h3>
        
        <div class="grid grid-cols-2 gap-4">
            <div class="p-4 rounded-lg bg-premium-light border border-premium relative">
                <i class="fa-solid fa-calendar-day absolute top-4 right-4 text-white/10 text-xl"></i>
                <div class="text-xs text-gray-400 mb-1 uppercase font-bold tracking-tighter">This Month</div>
                <div class="text-2xl font-bold text-white">{{ $stats['monthly_delivered'] }} <span class="text-xs font-normal text-gray-500">jobs</span></div>
            </div>
            <div class="p-4 rounded-lg bg-premium-light border border-premium relative">
                <i class="fa-solid fa-trophy absolute top-4 right-4 text-white/10 text-xl"></i>
                <div class="text-xs text-gray-400 mb-1 uppercase font-bold tracking-tighter">All-Time Success</div>
                <div class="text-2xl font-bold text-white">{{ $stats['total_delivered'] }} <span class="text-xs font-normal text-gray-500">total</span></div>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-premium">
            <div class="flex justify-between items-center mb-2">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Growth & Accuracy</span>
                @php
                    $rate = ($stats['total_delivered'] + $stats['active_count']) > 0 
                        ? round(($stats['total_delivered'] / ($stats['total_delivered'] + $stats['active_count'] + 0.1)) * 100) 
                        : 0;
                @endphp
                <span class="text-xs font-bold text-primary-accent">{{ $rate }}% Accuracy</span>
            </div>
            <div class="w-full h-1.5 bg-premium-light rounded-full overflow-hidden">
                <div class="h-full bg-primary-accent rounded-full" style="width: {{ $rate }}%"></div>
            </div>
            <p class="text-xxs text-gray-500 mt-2 italic">* Metrics are updated in real-time as you finalize deliveries.</p>
        </div>
    </div>

    <div class="px-5 mb-4 flex justify-between items-end">
        <h2 class="text-lg font-bold" style="color: var(--primary);">Your Deliveries</h2>
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">{{ now()->format('M d, Y') }}</span>
    </div>

    @forelse($orders as $order)
        <div class="order-card" id="card-{{ $order->id }}">
            <div class="flex justify-between items-start border-b pb-4 mb-4" style="border-color: rgba(255,255,255,0.05);">
                <div>
                    <h3 class="font-bold text-lg text-white">#{{ $order->order_number }}</h3>
                    <p class="text-sm font-medium text-gray-400">
                        @if($order->status == 'Pending' || $order->status == 'Processing')
                            <i class="fa-regular fa-clock mr-1"></i> Due {{ \Carbon\Carbon::parse($order->delivery_date)->format('M d') }} • {{ $order->delivery_time_slot }}
                        @else
                            <i class="fa-solid fa-motorcycle mr-1" style="color:var(--primary);"></i> Active Delivery
                        @endif
                    </p>
                </div>
                <span class="status-badge 
                    @if($order->status == 'Pending') status-pending 
                    @elseif($order->status == 'Processing') status-processing 
                    @else status-transit @endif" id="badge-{{ $order->id }}">
                    {{ $order->status }}
                </span>
            </div>

            <div class="mb-5">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1" style="background:rgba(178,145,95,0.1); color:var(--primary);">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest mb-1" style="color:var(--primary);">Deliver To</p>
                        <p class="font-bold text-white">{{ optional($order->user)->name }}</p>
                        <p class="text-sm leading-snug text-gray-400">{{ $order->shipping_address }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1" style="background:rgba(255,255,255,0.05); color:var(--text-dark);">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Items (Total: AED {{ $order->total_amount }})</p>
                        <p class="text-sm font-medium text-gray-300">
                            @if($order->items->count() > 0)
                                {{ $order->items->first()->quantity }}x {{ optional($order->items->first()->product)->name }}
                                @if($order->items->count() > 1)
                                    <span class="text-gray-500 text-xs ml-1">+{{ $order->items->count() - 1 }} more item(s)</span>
                                @endif
                            @else
                                No items listed.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div id="actions-{{ $order->id }}">
                @if($order->status == 'Pending' || $order->status == 'Processing')
                    <button class="btn-action btn-primary" onclick="updateStatus({{ $order->id }}, 'On the Way')">
                        <i class="fa-solid fa-box-open text-white/50"></i> Start Route (Picked Up)
                    </button>
                    
                @elseif($order->status == 'On the Way' || $order->status == 'Delayed')
                    <div class="grid grid-cols-2 gap-3 mb-2">
                        <button class="btn-action btn-danger" onclick="openReasonModal({{ $order->id }}, 'Delayed')">
                            <i class="fa-solid fa-clock-rotate-left"></i> Delay
                        </button>
                        <button class="btn-action btn-danger" onclick="openReasonModal({{ $order->id }}, 'Not Delivered')">
                            <i class="fa-solid fa-ban"></i> Failed
                        </button>
                    </div>
                    <button class="btn-action btn-success shadow-lg shadow-emerald-500/30" onclick="updateStatus({{ $order->id }}, 'Delivered')">
                        <i class="fa-solid fa-check-circle"></i> Mark Delivered
                    </button>
                @endif
            </div>

        </div>
    @empty
        <div class="text-center p-10 mx-5 rounded-md border border-dashed" style="background:var(--dark); border-color:rgba(255,255,255,0.1);">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl" style="background:rgba(255,255,255,0.05); color:var(--text-dark);">
                <i class="fa-solid fa-mug-hot"></i>
            </div>
            <h3 class="font-bold text-white text-lg mb-1">All Caught Up!</h3>
            <p class="text-sm text-gray-400 leading-relaxed font-medium">You have no active deliveries assigned to you right now. Take a break.</p>
        </div>
    @endforelse

    <!-- Reason Modal -->
    <div class="modal-overlay hidden" id="reasonModal">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-xl text-white" id="modalTitle">Report Issue</h3>
                <button onclick="closeModal()" class="w-8 h-8 rounded-full text-gray-400 font-bold" style="background: rgba(255,255,255,0.05);"><i class="fa-solid fa-times"></i></button>
            </div>
            
            <p class="text-sm text-gray-500 font-medium mb-3">Please provide a reason for the update. This will be sent immediately to the store manager.</p>
            
            <textarea id="issueReason" class="reason-input" rows="3" placeholder="e.g., Customer not at home, stuck in heavy traffic..."></textarea>
            
            <input type="hidden" id="modalOrderId">
            <input type="hidden" id="modalStatusAction">
            
            <button class="btn-action btn-dark w-full bg-gray-900 text-white" onclick="submitReason()">
                Submit Report <i class="fa-solid fa-paper-plane ml-1"></i>
            </button>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        async function updateStatus(orderId, status, reason = null) {
            
            // Show loading state
            const actionsDiv = document.getElementById(`actions-${orderId}`);
            const originalHtml = actionsDiv.innerHTML;
            actionsDiv.innerHTML = `<div class="text-center py-3 text-sm font-semibold text-gray-500"><i class="fa-solid fa-spinner fa-spin mr-2"></i> Updating...</div>`;

            try {
                const response = await fetch(`/driver/order/${orderId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ status, reason })
                });

                const data = await response.json();

                if(data.success) {
                    if (status === 'Delivered' || status === 'Not Delivered') {
                        // Remove card with animation
                        const card = document.getElementById(`card-${orderId}`);
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(() => card.remove(), 300);
                        
                        // Close modal if open
                        closeModal();
                    } else {
                        // Just reload page to easily get new buttons for transit state
                        window.location.reload();
                    }
                } else {
                    alert('Failed to update status.');
                    actionsDiv.innerHTML = originalHtml;
                }
            } catch (error) {
                console.error(error);
                alert('Network error.');
                actionsDiv.innerHTML = originalHtml;
            }
        }

        function openReasonModal(orderId, actionStatus) {
            document.getElementById('modalTitle').innerText = actionStatus === 'Delayed' ? 'Report Delay' : 'Delivery Failed';
            document.getElementById('modalOrderId').value = orderId;
            document.getElementById('modalStatusAction').value = actionStatus;
            document.getElementById('issueReason').value = '';
            
            const modal = document.getElementById('reasonModal');
            modal.classList.remove('hidden');
            // small delay for css transition
            setTimeout(() => modal.classList.add('active'), 10);
        }

        function closeModal() {
            const modal = document.getElementById('reasonModal');
            modal.classList.remove('active');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function submitReason() {
            const reason = document.getElementById('issueReason').value;
            if(!reason) {
                alert('Please enter a reason.');
                return;
            }
            const orderId = document.getElementById('modalOrderId').value;
            const status = document.getElementById('modalStatusAction').value;
            
            const btn = document.querySelector('#reasonModal .btn-action');
            btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Submitting...`;
            btn.disabled = true;

            updateStatus(orderId, status, reason);
        }
    </script>
</body>
</html>
