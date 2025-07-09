<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo -->
        <div class="text-2xl font-bold text-pink-600">
            <a href="{{ url('/') }}">Kosan Pink</a>
        </div>
        
        <!-- Navigation Links -->
        <div class="hidden md:flex space-x-6">
            @auth
                <!-- Authenticated User Links -->
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-pink-600 transition flex items-center">
                    <i class="fas fa-home mr-1"></i> Dashboard
                </a>
                <a href="{{ route('tagihan.index') }}" class="text-gray-700 hover:text-pink-600 transition flex items-center">
                    <i class="fas fa-receipt mr-1"></i> Tagihan
                </a>
                <a href="{{ route('laporan.index') }}" class="text-gray-700 hover:text-pink-600 transition flex items-center">
                    <i class="fas fa-flag mr-1"></i> Laporan
                </a>
            @else
                <!-- Guest Links (Landing Page Only) -->
                <a href="{{ url('/') }}#fasilitas" class="text-gray-700 hover:text-pink-600 transition">Fasilitas</a>
                <a href="{{ url('/') }}#kontak" class="text-gray-700 hover:text-pink-600 transition">Kontak Kami</a>
            @endauth
        </div>
        
        <!-- Right Side -->
        <div class="flex items-center">
            @auth
                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none">
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" 
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                         style="display: none;">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 items-center">
                            <i class="fas fa-user-circle mr-2"></i> Profil
                        </a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ url('/admin') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 items-center">
                                <i class="fas fa-tools mr-2"></i> Admin Panel
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Login Button -->
                <a href="{{ route('login') }}" class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition duration-300">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>