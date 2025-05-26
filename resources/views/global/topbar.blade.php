<div class="flex justify-between items-center p-4 bg-gradient-to-r from-white to-gray-50 shadow-lg border-b border-gray-200">
    <div class="flex items-center space-x-4">
        <!-- <button class="p-2 rounded-lg hover:bg-blue-50 transition-all duration-200">
            <i class="fas fa-bars text-xl text-gray-700 hover:text-blue-600"></i>
        </button> -->
        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
            Online Polling and Voting System
        </span>
    </div>
    <div class="flex items-center space-x-6">
        <!-- <div class="relative w-96">
            <input 
                class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-200 
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                       bg-gray-50 hover:bg-white transition-all duration-200
                       placeholder-gray-400 text-gray-700" 
                placeholder="Search polls, users, or settings..." 
                type="text"
                id="searchInput"
            />
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div> -->
        <div class="flex items-center space-x-4">
            <!-- <button class="relative p-2 rounded-lg hover:bg-gray-100 transition-all duration-200" title="Notifications">
                <i class="fas fa-bell text-xl text-gray-600 hover:text-blue-600"></i>
                <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
            </button> -->
            <div class="relative">
                <button 
                    id="userMenuButton" 
                    class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500"
                    onclick="toggleUserMenu()"
                >
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>
                    <div class="flex flex-col text-left">
                        <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-gray-500 capitalize">{{ Auth::user()->user_type }}</span>
                    </div>
                    <i id="dropdownArrow" class="fas fa-chevron-down text-gray-400 text-sm transition-transform duration-200"></i>
                </button>
                
                <div 
                    id="userDropdownMenu" 
                    class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 hidden transform transition-all duration-200 origin-top-right"
                >
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ Auth::user()->user_type === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }} mt-1">
                                    <i class="fas {{ Auth::user()->user_type === 'admin' ? 'fa-shield-alt' : 'fa-user' }} mr-1"></i>
                                    {{ ucfirst(Auth::user()->user_type) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="py-2">
                        <!-- <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                            <i class="fas fa-user-circle mr-3 text-gray-400"></i>
                            View Profile
                        </a>
                        
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                            <i class="fas fa-cog mr-3 text-gray-400"></i>
                            Account Settings
                        </a> -->
                        
                        @if(Auth::user()->user_type === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                            <i class="fas fa-tachometer-alt mr-3 text-gray-400"></i>
                            Admin Dashboard
                        </a>
                        @else
                        <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                            <i class="fas fa-home mr-3 text-gray-400"></i>
                            User Dashboard
                        </a>
                        @endif
                        
                        <!-- <div class="border-t border-gray-100 my-2"></div>
                        
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                            <i class="fas fa-question-circle mr-3 text-gray-400"></i>
                            Help & Support
                        </a> -->
                        
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50 transition-colors duration-150 group">
                                <i class="fas fa-sign-out-alt mr-3 text-red-500 group-hover:text-red-600"></i>
                                <span class="group-hover:text-red-800">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let isDropdownOpen = false;

function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdownMenu');
    const arrow = document.getElementById('dropdownArrow');
    
    if (isDropdownOpen) {
        dropdown.classList.add('hidden');
        dropdown.classList.remove('scale-100', 'opacity-100');
        dropdown.classList.add('scale-95', 'opacity-0');
        arrow.classList.remove('rotate-180');
        isDropdownOpen = false;
    } else {
        dropdown.classList.remove('hidden');
        setTimeout(() => {
            dropdown.classList.remove('scale-95', 'opacity-0');
            dropdown.classList.add('scale-100', 'opacity-100');
        }, 10);
        arrow.classList.add('rotate-180');
        isDropdownOpen = true;
    }
}

document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdownMenu');
    const button = document.getElementById('userMenuButton');
    
    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        if (isDropdownOpen) {
            toggleUserMenu();
        }
    }
});

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && isDropdownOpen) {
        toggleUserMenu();
    }
});

document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    if (searchTerm.length > 2) {
        console.log('Searching for:', searchTerm);
    }
});

document.getElementById('userDropdownMenu').addEventListener('click', function(event) {
    if (event.target.closest('form')) {
        return;
    }
    event.stopPropagation();
});
</script>