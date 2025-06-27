<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Furry Friends') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-['Figtree'] leading-6 text-gray-800">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-between py-2">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="h-10 w-auto">
                </a>


                <!-- Navigation Menu -->
                <ul class="hidden lg:flex items-center space-x-8">
                    <!-- Adopt Dropdown -->
                    <li class="relative group">
                        <a href="#" class="text-gray-800 font-medium transition-colors duration-300 
                            {{ request()->routeIs('adoption.*') ? 'text-violet-600 font-semibold' : 'hover:text-violet-500' }}">
                            Adopt
                            </a>
                        <div class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="{{ route('adoption.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">Adopt a Pet</a>
                            <a href="{{ route('adoption.how-it-works') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">How it works</a>
                            <a href="{{ route('adoption.requirements') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">Adopt FAQ's</a>
                        </div>
                    </li>
                    
                    <!-- Rehome Dropdown -->
                    <li class="relative group">
                        <a href="#" 
                        class="text-gray-800 font-medium transition-colors duration-300 
                                {{ request()->routeIs('rehoming.*') ? 'text-violet-600 font-semibold' : 'hover:text-violet-500' }}">
                            Rehome
                        </a>

                        <div class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="{{ route('rehoming.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">Rehome a Pet</a>
                            <a href="{{ route('rehoming.how-it-works') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">How it works</a>
                            <a href="{{ route('rehoming.faq-rehomers') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">Rehome FAQ's</a>
                        </div>
                    </li>
                    
                    <!-- Care Guide Dropdown -->
                    <li class="relative group">
                        <a href="{{ route('care-guide') }}" 
                        class="font-medium transition-colors duration-300 
                                {{ request()->routeIs('care-guide*') 
                                    ? 'text-violet-600 font-semibold' 
                                    : 'text-gray-800 hover:text-violet-500' }}">
                            Care Guide
                        </a>

                        <div class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="{{ route('care-guide.cats') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">Cat Guides</a>
                            <a href="{{ route('care-guide.dogs') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">Dog Guides</a>
                        </div>
                    </li>
                    
                    <!-- About Us Dropdown -->
                    <li class="relative group">
                         <a href="{{ route('about') }}" 
                        class="font-medium transition-colors duration-300 
                                {{ request()->routeIs('about*') 
                                    ? 'text-violet-600 font-semibold' 
                                    : 'text-gray-800 hover:text-violet-500' }}">
                            About Us
                        </a>

                        <div class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="{{ route('about.mission') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">Our Mission</a>
                            <a href="{{ route('contact') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">Contact Us</a>
                        </div>
                    </li>
                </ul>
                
                <!-- Right Side Actions -->
                <div class="flex items-center space-x-3">
                    <!-- Notification Bell -->
                    <button class="p-2 text-gray-600 hover:text-violet-500 transition-colors duration-300 border border-gray-300 rounded-full">
                        <i class="far fa-bell text-sm"></i>
                    </button>
                    
                   <!-- Auth Buttons -->
                    @guest
                        <div class="flex items-center">
                            <a href="{{ route('login') }}" 
                               class="bg-violet-100 text-violet-700 px-4 py-1.5 rounded-full font-medium hover:bg-violet-200 transition-colors duration-300 flex items-center space-x-1 border border-violet-200 text-sm">
                                <i class="fas fa-user text-xs"></i>
                                <span>Login | Register</span>
                            </a>
                        </div>
                    @else
                        <!-- User Profile Dropdown -->
                        <div class="relative group">
                            <button class="bg-violet-100 text-violet-700 px-4 py-1.5 rounded-full font-medium hover:bg-violet-200 transition-colors duration-300 flex items-center space-x-1 text-sm">
                                @if(Auth::user()->is_admin)
                                    <i class="fas fa-crown text-xs text-yellow-600"></i>
                                    <span>Admin: {{ Auth::user()->name }}</span>
                                @else
                                    <i class="fas fa-user text-xs"></i>
                                    <span>{{ Auth::user()->name }}</span>
                                @endif
                                <i class="fas fa-chevron-down text-xs ml-1"></i>
                            </button>
                            
                            <div class="absolute top-full right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                @if(Auth::user()->is_admin)
                                    <!-- Admin Dropdown Menu -->
                                    
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">
                                        <i class="fas fa-tachometer-alt mr-2 text-blue-500"></i>Admin Dashboard
                                    </a>
                                    
                                    <hr class="my-1">
                                    
                                    <hr class="my-1">
                                    
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-500 transition-colors duration-200">
                                            <i class="fas fa-sign-out-alt mr-2 text-red-500"></i>Log Out
                                        </button>
                                    </form>
                                @else
                                    <!-- Regular User Dropdown Menu -->
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">
                                        <i class="fas fa-tachometer-alt mr-2"></i>Overview
                                    </a>
                                    <a href="{{ route('user.profile') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">
                                        <i class="fas fa-user mr-2"></i>Profile
                                    </a>
                                    <a href="{{ route('user.favorites') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">
                                        <i class="fas fa-heart mr-2"></i>Favourites
                                    </a>
                                    <a href="{{ route('user.messages') }}" class="block px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">
                                        <i class="fas fa-envelope mr-2"></i>Messages
                                    </a>
                                    <hr class="my-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-violet-50 hover:text-violet-500 transition-colors duration-200">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endguest

                    
                    <!-- Mobile Menu Button -->
                    <button class="lg:hidden text-gray-600 p-2" id="mobile-menu-button">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </nav>
            
            <!-- Mobile Menu -->
            <div class="lg:hidden hidden pb-3" id="mobile-menu">
                <ul class="space-y-1">
                    <li><a href="{{ route('pets.index') }}" class="block text-gray-800 hover:text-violet-500 font-medium py-2">Adopt</a></li>
                    <li><a href="{{ route('rehoming.index') }}" class="block text-gray-800 hover:text-violet-500 font-medium py-2">Rehome</a></li>
                    <li><a href="{{ route('care-guide') }}" class="block text-gray-800 hover:text-violet-500 font-medium py-2">Care Guide</a></li>
                    <li><a href="{{ route('about') }}" class="block text-gray-800 hover:text-violet-500 font-medium py-2">About Us</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Purple Bar with Breadcrumbs + Search -->
    <div class="bg-violet-500 px-4 py-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
        {{-- Breadcrumbs --}}
        <nav class="text-white text-sm" aria-label="breadcrumb">
            <ol class="list-reset flex space-x-2">
            <li>
                <a href="{{ route('home') }}" class="hover:underline">Home</a>
            </li>
            @php $path = ''; @endphp
            @foreach(Request::segments() as $segment)
                @php $path .= '/'.$segment; @endphp
                <li>/</li>
                <li>
                <a href="{{ url($path) }}" class="hover:underline">
                    {{ ucwords(str_replace('-', ' ', $segment)) }}
                </a>
                </li>
            @endforeach
            </ol>
        </nav>

        {{-- Search box --}}
        <div class="relative">
            <input
            type="text"
            class="w-72 pl-4 pr-10 py-1.5 rounded-full bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-300 text-sm"
            placeholder="search..."
            >
            <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-violet-500 hover:text-violet-700">
            <i class="fas fa-search text-sm"></i>
            </button>
        </div>
        </div>
    </div>
    </div>


    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
<footer class="bg-gray-50 mt-16 text-sm">
    <!-- Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- How Can We Help -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">How Can We Help?</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('pets.index') }}" class="text-gray-600 hover:text-violet-500 transition-colors duration-300">Adopt a pet</a></li>
                    <li><a href="{{ route('rehoming.index') }}" class="text-gray-600 hover:text-violet-500 transition-colors duration-300">Rehome a pet</a></li>
                    <li><a href="{{ route('faq.adopters') }}" class="text-gray-600 hover:text-violet-500 transition-colors duration-300">Adopt FAQ's</a></li>
                    <li><a href="{{ route('faq.rehomers') }}" class="text-gray-600 hover:text-violet-500 transition-colors duration-300">Rehome FAQ's</a></li>
                </ul>
            </div>

            <!-- Contact Us -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Contact Us</h3>
                <ul class="space-y-3">
                    <li class="flex items-start text-gray-600">
                        <i class="fas fa-map-marker-alt text-violet-500 mr-3 mt-1"></i>
                        <span>123 Main Street, Anytown, USA</span>
                    </li>
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-phone text-violet-500 mr-3"></i>
                        <span>+1 (555) 123-4567</span>
                    </li>
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-envelope text-violet-500 mr-3"></i>
                        <span>FurryFriendsSupport@gmail.com</span>
                    </li>
                </ul>
            </div>

            <!-- Keep In Touch -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Keep In Touch With Us</h3>
                <p class="text-gray-600 mb-4">Join the FurryFriends magazine and be first to hear about news</p>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="email" 
                           placeholder="E-mail Address" 
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
                    <button class="bg-violet-500 hover:bg-violet-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-300">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Purple Bar -->
<div class="bg-violet-500 py-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
            <p class="text-white text-sm">©2024 Furryfriends.com</p>
            <div class="flex space-x-3">
                <a href="#" class="text-white hover:text-violet-200 text-base transition-transform duration-300 hover:scale-105">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="text-white hover:text-violet-200 text-base transition-transform duration-300 hover:scale-105">
                    <i class="fab fa-pinterest"></i>
                </a>
                <a href="#" class="text-white hover:text-violet-200 text-base transition-transform duration-300 hover:scale-105">
                    <i class="fab fa-tumblr"></i>
                </a>
                <a href="#" class="text-white hover:text-violet-200 text-base transition-transform duration-300 hover:scale-105">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-white hover:text-violet-200 text-base transition-transform duration-300 hover:scale-105">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
</div>

</footer>


    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>