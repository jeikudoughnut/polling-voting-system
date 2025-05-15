<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-6 text-center tracking-tight drop-shadow-sm">
            Poll Management
        </h1>
        <div class="max-w-6xl mx-auto">
            <div class="bg-white/95 rounded-2xl shadow-2xl border border-gray-100 p-8 relative overflow-hidden">
                <!-- Decorative Circles -->
                <div class="absolute -top-8 -left-8 w-32 h-32 bg-blue-100 rounded-full opacity-20 blur-2xl"></div>
                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-yellow-100 rounded-full opacity-20 blur-2xl"></div>
                <!-- Tabs with Floating Indicator -->
                <div class="flex relative mb-8">
                    <button id="tab-all"
                        class="relative z-10 py-3 px-10 text-xl font-semibold transition-all duration-200 focus:outline-none text-blue-600 border-b-2 border-blue-500"
                        onclick="showTab('all')">
                        All Polls
                    </button>
                    <button id="tab-pending"
                        class="relative z-10 py-3 px-10 text-xl font-semibold transition-all duration-200 focus:outline-none text-gray-500 border-b-2 border-transparent hover:text-yellow-600 hover:border-yellow-400"
                        onclick="showTab('pending')">
                        Pending Polls
                    </button>
                </div>
                <!-- All Polls Table -->
                <div id="tab-content-all">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left rounded-xl overflow-hidden">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-50 to-green-50">
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Poll</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Status</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-blue-50/60 transition">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Fave Food</td>
                                    <td>
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-base font-semibold shadow">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex flex-wrap gap-3">
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 text-blue-700 hover:bg-blue-100 font-medium transition">
                                                <i class="fas fa-eye mr-2"></i> View
                                            </a>
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 hover:bg-yellow-100 font-medium transition">
                                                <i class="fas fa-stop mr-2"></i> End
                                            </a>
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-700 hover:bg-red-100 font-medium transition">
                                                <i class="fas fa-trash mr-2"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50/60 transition">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Weekly Survey #2</td>
                                    <td>
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-base font-semibold shadow">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Closed
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex flex-wrap gap-3">
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 text-blue-700 hover:bg-blue-100 font-medium transition">
                                                <i class="fas fa-eye mr-2"></i> View
                                            </a>
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 hover:bg-yellow-100 font-medium transition">
                                                <i class="fas fa-stop mr-2"></i> End
                                            </a>
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-700 hover:bg-red-100 font-medium transition">
                                                <i class="fas fa-trash mr-2"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pending Polls Table -->
                <div id="tab-content-pending" class="hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left rounded-xl overflow-hidden">
                            <thead>
                                <tr class="bg-gradient-to-r from-yellow-50 to-green-50">
                                    <th class="px-6 py-4 text-lg font-semibold text-yellow-700">Poll</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-yellow-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-yellow-50/60 transition">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Fave Food</td>
                                    <td>
                                        <div class="flex flex-wrap gap-3">
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-green-50 text-green-700 hover:bg-green-100 font-medium transition">
                                                <i class="fas fa-check mr-2"></i> Approve
                                            </a>
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-700 hover:bg-red-100 font-medium transition">
                                                <i class="fas fa-times mr-2"></i> Reject
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-yellow-50/60 transition">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Weekly Survey #2</td>
                                    <td>
                                        <div class="flex flex-wrap gap-3">
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-green-50 text-green-700 hover:bg-green-100 font-medium transition">
                                                <i class="fas fa-check mr-2"></i> Approve
                                            </a>
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-700 hover:bg-red-100 font-medium transition">
                                                <i class="fas fa-times mr-2"></i> Reject
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tab) {
    document.getElementById('tab-content-all').classList.toggle('hidden', tab !== 'all');
    document.getElementById('tab-content-pending').classList.toggle('hidden', tab !== 'pending');
    // Tab active state
    document.getElementById('tab-all').classList.toggle('text-blue-600', tab === 'all');
    document.getElementById('tab-all').classList.toggle('border-blue-500', tab === 'all');
    document.getElementById('tab-all').classList.toggle('text-gray-500', tab !== 'all');
    document.getElementById('tab-all').classList.toggle('border-transparent', tab !== 'all');
    document.getElementById('tab-pending').classList.toggle('text-yellow-600', tab === 'pending');
    document.getElementById('tab-pending').classList.toggle('border-yellow-400', tab === 'pending');
    document.getElementById('tab-pending').classList.toggle('text-gray-500', tab !== 'pending');
    document.getElementById('tab-pending').classList.toggle('border-transparent', tab !== 'pending');
}

// Check URL parameters on page load
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');
    if (tab === 'pending' || tab === 'all') {
        showTab(tab);
    }
});
</script>
