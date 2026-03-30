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
            --primary: #D48B96;
            --dark: #2F2A32;
            --bg: #F8FAFC;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: #334155;
            margin: 0;
            padding-bottom: 80px; /* Space for mobile nav */
        }

        .header {
            background: white;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .profile-img {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: rgba(212, 139, 150, 0.15);
            color: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }

        .driver-stats {
            background: var(--dark);
            color: white;
            margin: 20px;
            padding: 24px;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(47, 42, 50, 0.3);
            display: flex;
            justify-content: space-between;
        }

        .stat-block h3 { font-size: 2rem; font-weight: 800; line-height: 1; margin-bottom: 4px; }
        .stat-block p { font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; }

        .order-card {
            background: white;
            border-radius: 16px;
            margin: 0 20px 20px;
            padding: 20px;
            box-shadow: 0 4px 12px -2px rgba(0,0,0,0.04);
            border: 1px solid #f1f5f9;
            transition: all 0.3s;
        }
        
        .status-badge {
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-pending { background: #fef3c7; color: #b45309; }
        .status-processing { background: #e0e7ff; color: #4338ca; }
        .status-transit { background: #dbeafe; color: #1d4ed8; }

        .btn-action {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
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

        .btn-primary { background: var(--primary); color: white; }
        .btn-success { background: #10b981; color: white; }
        .btn-danger { background: #fef2f2; color: #ef4444; border: 1px solid #fecaca; }

        .modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);
            z-index: 100; display: hidden;
            align-items: flex-end; justify-content: center;
        }

        .modal-content {
            background: white; width: 100%; border-radius: 24px 24px 0 0;
            padding: 30px 20px;
            transform: translateY(100%); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .modal-overlay.active { display: flex; }
        .modal-overlay.active .modal-content { transform: translateY(0); }

        .reason-input {
            width: 100%; padding: 14px; border-radius: 12px;
            border: 1.5px solid #e2e8f0; background: #f8fafc;
            margin-bottom: 16px; font-family: 'Outfit'; outline: none;
        }
        .reason-input:focus { border-color: var(--primary); background: white; }
    </style>
</head>
<body>

    <header class="header">
        <div class="flex items-center gap-3">
            <div class="profile-img"><i class="fa-solid fa-motorcycle"></i></div>
            <div>
                <h1 class="font-bold text-lg leading-tight">{{ Auth::user()->name }}</h1>
                <p class="text-xs text-gray-500 font-medium">Delivery Partner</p>
            </div>
        </div>
        <form method="POST" action="{{ route('delivery.logout') }}">
            @csrf
            <button class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:text-red-500 hover:bg-red-50 transition-colors">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </button>
        </form>
    </header>

    <div class="driver-stats">
        <div class="stat-block">
            <h3>{{ $orders->count() }}</h3>
            <p>Active Routes</p>
        </div>
        <div class="stat-block text-right">
            <h3 class="text-green-400">
                {{ \App\Models\Order::where('delivery_boy_id', Auth::id())->where('status', 'Delivered')->whereDate('updated_at', today())->count() }}
            </h3>
            <p>Done Today</p>
        </div>
    </div>

    <div class="px-5 mb-4 flex justify-between items-end">
        <h2 class="text-lg font-bold">Your Deliveries</h2>
        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ now()->format('M d, Y') }}</span>
    </div>

    @forelse($orders as $order)
        <div class="order-card" id="card-{{ $order->id }}">
            <div class="flex justify-between items-start border-b border-gray-100 pb-4 mb-4">
                <div>
                    <h3 class="font-bold text-lg text-gray-800">#{{ $order->order_number }}</h3>
                    <p class="text-sm font-medium text-gray-500">
                        @if($order->status == 'Pending' || $order->status == 'Processing')
                            <i class="fa-regular fa-clock mr-1"></i> Due {{ \Carbon\Carbon::parse($order->delivery_date)->format('M d') }} • {{ $order->delivery_time_slot }}
                        @else
                            <i class="fa-solid fa-motorcycle mr-1 text-blue-500"></i> Active Delivery
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
                    <div class="w-8 h-8 rounded-full bg-pink-50 flex items-center justify-center text-pink-500 shrink-0 mt-1">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Deliver To</p>
                        <p class="font-bold text-gray-800">{{ optional($order->user)->name }}</p>
                        <p class="text-sm text-gray-600 leading-snug">{{ $order->shipping_address }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 shrink-0 mt-1">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Items (Total: ${{ $order->total_amount }})</p>
                        <p class="text-sm font-medium text-gray-700">
                            @if($order->items->count() > 0)
                                {{ $order->items->first()->quantity }}x {{ optional($order->items->first()->product)->name }}
                                @if($order->items->count() > 1)
                                    <span class="text-gray-400 text-xs ml-1">+{{ $order->items->count() - 1 }} more item(s)</span>
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
        <div class="text-center p-10 bg-white mx-5 rounded-2xl border border-dashed border-gray-300">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 text-2xl">
                <i class="fa-solid fa-mug-hot"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-1">All Caught Up!</h3>
            <p class="text-sm text-gray-500 leading-relaxed font-medium">You have no active deliveries assigned to you right now. Take a break.</p>
        </div>
    @endforelse

    <!-- Reason Modal -->
    <div class="modal-overlay hidden" id="reasonModal">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-xl text-dark" id="modalTitle">Report Issue</h3>
                <button onclick="closeModal()" class="w-8 h-8 bg-gray-100 rounded-full text-gray-500 font-bold"><i class="fa-solid fa-times"></i></button>
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
