<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cake Atelier | Premium E-Commerce</title>
    
    <!-- Modern Elegant Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    
    <!-- Stable Tailwind CSS 2.0 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Premium Soft Color Palette */
            --primary: #D48B96;       /* Soft Blush Pink */
            --primary-dark: #C6727E;  
            --text-dark: #2F2A32;     /* Dark Charcoal Plum */
            --text-light: #675D6E;
            --bg-offwhite: #FDFCFB;   
            --accent-gold: #D4AF37;
        }

        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: var(--bg-offwhite);
            color: var(--text-dark);
        }
        
        .font-serif-elegant { font-family: 'Playfair Display', serif; }

        /* Custom Tailwind Utilities for Premium Palette */
        .text-primary { color: var(--primary); }
        .text-primary-dark { color: var(--primary-dark); }
        .bg-primary { background-color: var(--primary); }
        .border-primary { border-color: var(--primary); }
        .text-dark { color: var(--text-dark); }
        .bg-dark { background-color: var(--text-dark); }
        
        .hover\:text-primary:hover { color: var(--primary); }
        .hover\:bg-primary-dark:hover { background-color: var(--primary-dark); color: white; border-color: var(--primary-dark); }
        .hover\:scale-102:hover { transform: scale(1.02); }

        /* Fancy micro-animations */
        .glass-search {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .glass-search:focus-within {
            background: white;
            box-shadow: 0 10px 25px -5px rgba(212, 139, 150, 0.2);
            border-color: rgba(212, 139, 150, 0.3);
        }

        .category-pill {
            background: white;
            color: var(--text-light);
            border: 1px solid transparent;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .category-pill:hover {
            color: white;
            background-color: var(--text-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(47, 42, 50, 0.2);
        }

        .circle-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .circle-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 20px 25px -5px rgba(212, 139, 150, 0.2);
        }

        /* Beautiful Gradient Promo Banners */
        .promo-1 { 
            background: linear-gradient(135deg, #FFE8EB 0%, #FDF7F8 100%); 
        }
        .promo-2 { 
            background: linear-gradient(135deg, #EBE6E8 0%, #F5F1F2 100%); 
        }
        .promo-3 { 
            background: linear-gradient(135deg, var(--text-dark) 0%, #463F4A 100%); 
            color: white;
        }
        
        .promo-text-shadow { text-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .text-xxs { font-size: 0.65rem; line-height: 1; }
    </style>
</head>
<body class="antialiased">

    <!-- Top Header / Notice Bar -->
    <div class="bg-primary text-white text-center py-2 text-xs font-semibold tracking-widest uppercase shadow-sm">
        Free Delivery on Wedding & Event Cakes • Order 24hrs in advance
    </div>

    <!-- Main Header -->
    <header class="container mx-auto px-4 py-8 flex flex-wrap items-center justify-between">
        
        <!-- Premium Logo -->
        <div class="flex items-center space-x-3 cursor-pointer hover:opacity-80 transition-opacity">
            <div class="bg-primary text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                <i class="fa-solid fa-cookie-bite text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-serif-elegant font-bold tracking-tight leading-none text-dark">L'Atelier</h1>
                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-[0.3em] leading-none mt-1">Confections</p>
            </div>
        </div>

        <!-- Animated Search Bar -->
        <div class="flex-grow max-w-xl mx-8 hidden md:block">
            <form action="#" class="flex rounded-full overflow-hidden glass-search">
                <input type="text" placeholder="Search for luxury cakes & pastries..." class="w-full px-6 py-3 outline-none text-sm text-gray-700 bg-transparent font-medium">
                <button type="submit" class="text-gray-400 hover:text-primary px-6 transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </button>
            </form>
        </div>

        <!-- Elegant Icons -->
        <div class="flex items-center space-x-8 text-gray-600">
            <a href="#" class="flex flex-col items-center hover:text-primary transition-all hover:scale-102 relative">
                <div class="absolute -top-1 -right-2 bg-dark text-white text-xxs w-4 h-4 rounded-full flex items-center justify-center font-bold">3</div>
                <i class="fa-regular fa-heart text-2xl"></i>
            </a>
            
            <a href="#" class="flex flex-col items-center hover:text-primary transition-all hover:scale-102 relative">
                <div class="absolute -top-1 -right-2 bg-primary text-white text-xxs w-4 h-4 rounded-full flex items-center justify-center font-bold shadow-md">1</div>
                <i class="fa-solid fa-bag-shopping text-2xl"></i>
            </a>

            <a href="#" class="flex flex-col items-center hover:text-primary transition-all hover:scale-102">
                <i class="fa-regular fa-user text-2xl"></i>
            </a>
        </div>
    </header>

    <!-- Navigation Bordered -->
    <div class="border-y border-gray-100 mb-12">
        <nav class="container mx-auto px-4 py-4 flex flex-wrap justify-center md:justify-start items-center space-x-8 text-sm font-semibold tracking-wide">
            
            <!-- Dark Modern Dropdown Button -->
            <div class="relative group cursor-pointer inline-block mr-4">
                <div class="bg-dark text-white px-6 py-3 rounded-full flex items-center space-x-2 hover:bg-gray-800 transition-colors shadow-md">
                    <i class="fa-solid fa-layer-group text-primary"></i>
                    <span>All Categories</span>
                    <i class="fa-solid fa-chevron-down text-xs ml-2 opacity-70"></i>
                </div>
            </div>
            
            <!-- Standard Links -->
            <a href="#" class="text-primary border-b-2 border-primary pb-1">Home</a>
            <a href="#" class="text-gray-500 hover:text-primary transition-colors">Our Story</a>
            <a href="#" class="text-gray-500 hover:text-primary transition-colors">Contact</a>
            
            <!-- Dropdown link -->
            <div class="relative group inline-block cursor-pointer">
                <a href="#" class="text-gray-500 hover:text-primary transition-colors flex items-center space-x-1">
                    <span>Signature Cakes</span> <i class="fa-solid fa-angle-down text-xs mt-0.5"></i>
                </a>
            </div>
            
            <a href="#" class="text-gray-500 hover:text-primary transition-colors">Weddings</a>
            <a href="#" class="text-primary-dark font-bold hover:opacity-80 transition-opacity flex items-center space-x-1">
                <i class="fa-solid fa-star text-xs"></i> <span>Special Offers</span>
            </a>
        </nav>
    </div>

    <!-- Main Content Area -->
    <main class="container mx-auto px-4 pb-20">
        
        <!-- Modern Typography Section Header -->
        <div class="flex flex-col items-center text-center mb-12">
            <h2 class="text-4xl font-serif-elegant font-bold text-dark mb-4">Discover Our Collections</h2>
            <p class="text-gray-500 max-w-2xl text-sm leading-relaxed mb-6">Handcrafted with the finest ingredients. Choose from our wide variety of premium bakes or request a custom design for your next celebration.</p>
            
            <!-- Elegant Category Pills -->
            <div class="flex flex-wrap justify-center items-center gap-4 mt-2">
                <a href="#" class="category-pill px-6 py-2.5 rounded-full text-sm font-semibold">Gourmet Bento</a>
                <a href="#" class="category-pill px-6 py-2.5 rounded-full text-sm font-semibold">Dessert Tables</a>
                <a href="#" class="category-pill px-6 py-2.5 rounded-full text-sm font-semibold">Artisan Cupcakes</a>
                <a href="#" class="category-pill px-6 py-2.5 rounded-full text-sm font-semibold">3D Sculpted</a>
                <a href="#" class="category-pill px-6 py-2.5 rounded-full text-sm font-semibold">Vegan Options</a>
            </div>
        </div>

        <!-- Premium Circular Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 mb-24 text-center">
            <!-- Item 1 -->
            <a href="#" class="flex flex-col items-center group">
                <div class="circle-card w-40 h-40 rounded-full bg-white shadow-sm flex items-center justify-center p-2.5 mb-5 border border-pink-50 relative">
                    <div class="absolute inset-0 border-2 border-transparent group-hover:border-primary rounded-full transition-colors duration-300"></div>
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=300&auto=format&fit=crop" class="w-full h-full object-cover rounded-full" alt="Birthday Cake">
                </div>
                <h3 class="text-base font-bold text-dark group-hover:text-primary transition-colors">Birthday Cakes</h3>
                <p class="text-xs text-gray-400 font-medium mt-1">24 Items</p>
            </a>

            <!-- Item 2 -->
            <a href="#" class="flex flex-col items-center group">
                <div class="circle-card w-40 h-40 rounded-full bg-white shadow-sm flex items-center justify-center p-2.5 mb-5 border border-pink-50 relative">
                    <div class="absolute inset-0 border-2 border-transparent group-hover:border-primary rounded-full transition-colors duration-300"></div>
                    <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=300&auto=format&fit=crop" class="w-full h-full object-cover rounded-full" alt="Wedding">
                </div>
                <h3 class="text-base font-bold text-dark group-hover:text-primary transition-colors">Wedding</h3>
                <p class="text-xs text-gray-400 font-medium mt-1">12 Items</p>
            </a>

            <!-- Item 3 -->
            <a href="#" class="flex flex-col items-center group">
                <div class="circle-card w-40 h-40 rounded-full bg-white shadow-sm flex items-center justify-center p-2.5 mb-5 border border-pink-50 relative">
                    <div class="absolute inset-0 border-2 border-transparent group-hover:border-primary rounded-full transition-colors duration-300"></div>
                    <img src="https://images.unsplash.com/photo-1535141192574-5d4897c12636?q=80&w=300&auto=format&fit=crop" class="w-full h-full object-cover rounded-full" alt="Baby Shower">
                </div>
                <h3 class="text-base font-bold text-dark group-hover:text-primary transition-colors">Baby Shower</h3>
                <p class="text-xs text-gray-400 font-medium mt-1">18 Items</p>
            </a>

            <!-- Item 4 -->
            <a href="#" class="flex flex-col items-center group">
                <div class="circle-card w-40 h-40 rounded-full bg-white shadow-sm flex items-center justify-center p-2.5 mb-5 border border-pink-50 relative">
                    <div class="absolute inset-0 border-2 border-transparent group-hover:border-primary rounded-full transition-colors duration-300"></div>
                    <img src="https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=300&auto=format&fit=crop" class="w-full h-full object-cover rounded-full" alt="Gender Reveal">
                </div>
                <h3 class="text-base font-bold text-dark group-hover:text-primary transition-colors">Gender Reveal</h3>
                <p class="text-xs text-gray-400 font-medium mt-1">8 Items</p>
            </a>

            <!-- Item 5 -->
            <a href="#" class="flex flex-col items-center group">
                <div class="circle-card w-40 h-40 rounded-full bg-white shadow-sm flex items-center justify-center p-2.5 mb-5 border border-pink-50 relative">
                    <div class="absolute inset-0 border-2 border-transparent group-hover:border-primary rounded-full transition-colors duration-300"></div>
                    <img src="https://images.unsplash.com/photo-1588195538326-c5b1e9f80a1b?q=80&w=300&auto=format&fit=crop" class="w-full h-full object-cover rounded-full" alt="Anniversary">
                </div>
                <h3 class="text-base font-bold text-dark group-hover:text-primary transition-colors">Anniversary</h3>
                <p class="text-xs text-gray-400 font-medium mt-1">14 Items</p>
            </a>

            <!-- Item 6 -->
            <a href="#" class="flex flex-col items-center group">
                <div class="circle-card w-40 h-40 rounded-full bg-white shadow-sm flex items-center justify-center p-2.5 mb-5 border border-pink-50 relative">
                    <div class="absolute inset-0 border-2 border-transparent group-hover:border-primary rounded-full transition-colors duration-300"></div>
                    <img src="https://images.unsplash.com/photo-1557925923-33b251dc32d6?q=80&w=300&auto=format&fit=crop" class="w-full h-full object-cover rounded-full rotate-12" alt="Cupcakes">
                </div>
                <h3 class="text-base font-bold text-dark group-hover:text-primary transition-colors">Macarons & Bites</h3>
                <p class="text-xs text-gray-400 font-medium mt-1">32 Items</p>
            </a>
        </div>

        <!-- High-End Promo Banners Array -->
        <h2 class="text-2xl font-serif-elegant font-bold text-dark mb-6 text-center md:text-left">Special Offers & Events</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            
            <!-- Large Main Featured Banner -->
            <div class="promo-1 col-span-1 md:col-span-7 rounded-2xl p-10 relative overflow-hidden h-80 flex flex-col justify-center hover:shadow-xl transition-all duration-300 group">
                <div class="relative z-10 w-3/5">
                    <span class="bg-white text-primary text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4 inline-block shadow-sm">Bestseller</span>
                    <h3 class="text-4xl font-serif-elegant font-bold text-dark mb-3 leading-tight">Elevate Your Celebrations</h3>
                    <p class="text-sm text-gray-600 mb-6 font-medium">Pre-order our signature velvet collection and get 15% off.</p>
                    <a href="#" class="text-sm font-bold border-b-2 border-dark inline-block pb-1 hover:text-primary hover:border-primary transition-colors">Explore Collection <i class="fa-solid fa-arrow-right ml-1 text-xs"></i></a>
                </div>
                <!-- Banner Image -->
                <img src="https://images.unsplash.com/photo-1513151233558-d860c5398176?q=80&w=600&auto=format&fit=crop" class="absolute -right-16 top-0 h-full w-1/2 object-cover object-left mask-image-gradient group-hover:scale-105 transition-transform duration-700" alt="Cake">
            </div>

            <!-- Side Banners -->
            <div class="col-span-1 md:col-span-5 flex flex-col gap-6">
                <!-- Top Mini Banner -->
                <div class="promo-2 rounded-2xl p-8 relative overflow-hidden h-full flex flex-col justify-center hover:shadow-xl transition-all duration-300 group">
                    <div class="relative z-10 w-2/3">
                        <h3 class="text-2xl font-serif-elegant font-bold text-dark mb-2 leading-tight">Pastry Tasting Boxes</h3>
                        <a href="#" class="text-xs font-bold border-b-2 border-dark inline-block mt-2 pb-1 hover:text-primary hover:border-primary transition-colors">Reserve Yours</a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=400&auto=format&fit=crop" class="absolute -right-4 top-1/2 -translate-y-1/2 w-1/2 rounded-full h-auto aspect-square object-cover shadow-lg group-hover:-rotate-6 transition-transform duration-500" alt="Cake bg">
                </div>

                <!-- Bottom Dark Banner -->
                <div class="promo-3 rounded-2xl p-8 relative overflow-hidden h-full flex flex-col justify-center hover:shadow-xl transition-all duration-300 group">
                    <div class="relative z-10 w-2/3">
                        <h3 class="text-2xl font-serif-elegant font-bold mb-2 leading-tight promo-text-shadow">Bespoke Wedding Cakes</h3>
                        <a href="#" class="text-xs font-bold border-b-2 border-white inline-block mt-2 pb-1 hover:text-primary hover:border-primary transition-colors">Book a Consultation</a>
                    </div>
                    <div class="absolute right-0 bottom-0 top-0 w-1/2 bg-gradient-to-l from-transparent to-[#2F2A32] opacity-60 z-0"></div>
                    <img src="https://images.unsplash.com/photo-1535141192574-5d4897c12636?q=80&w=400&auto=format&fit=crop" class="absolute right-0 top-0 w-1/2 h-full object-cover object-center group-hover:scale-110 transition-transform duration-700" alt="Wedding Cake">
                </div>
            </div>

        </div>
    </main>

</body>
</html>
