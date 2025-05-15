<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-8 text-center tracking-tight drop-shadow-sm">
            Polls
        </h1>
        <div class="max-w-6xl mx-auto">
            <div class="bg-white/95 rounded-3xl shadow-xl border border-gray-100/50 p-8 relative overflow-hidden backdrop-blur-sm">
                <!-- Decorative Elements -->
                <div class="absolute -top-12 -left-12 w-40 h-40 bg-blue-100 rounded-full opacity-30 blur-3xl"></div>
                <div class="absolute -bottom-12 -right-12 w-40 h-40 bg-yellow-100 rounded-full opacity-30 blur-3xl"></div>
                <div class="absolute top-1/3 right-1/4 w-24 h-24 bg-green-100 rounded-full opacity-20 blur-2xl"></div>
                
                <!-- Tabs -->
                <div class="flex relative mb-10 border-b border-gray-100">
                    <button id="tab-polls"
                        class="relative z-10 py-4 px-10 text-xl font-bold transition-all duration-300 focus:outline-none text-blue-600 border-b-3 border-blue-500"
                        onclick="showUserTab('polls')">
                        Polls
                    </button>
                    <button id="tab-myvotes"
                        class="relative z-10 py-4 px-10 text-xl font-bold transition-all duration-300 focus:outline-none text-gray-500 border-b-3 border-transparent hover:text-yellow-600 hover:border-yellow-400"
                        onclick="showUserTab('myvotes')">
                        My Votes
                    </button>
                    <button id="tab-mycreated"
                        class="relative z-10 py-4 px-10 text-xl font-bold transition-all duration-300 focus:outline-none text-gray-500 border-b-3 border-transparent hover:text-green-600 hover:border-green-400"
                        onclick="showUserTab('mycreated')">
                        My Created Polls
                    </button>
                </div>
                
                <!-- Polls Tab -->
                <div id="tab-content-polls">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-700">Available Polls</h2>
                        <select class="border border-gray-200 rounded-lg px-4 py-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm" id="polls-filter">
                            <option>All Polls</option>
                            <option>Active Only</option>
                            <option>Closed Only</option>
                        </select>
                    </div>
                    <div class="overflow-hidden rounded-xl border border-gray-100 shadow-lg">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Poll</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Status</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Deadline</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <!-- Example Row -->
                                <tr class="hover:bg-blue-50/60 transition-all duration-200">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Fave Food</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">05/15/24 23:59 PM</td>
                                    <td class="px-6 py-5">
                                        <a href="#" class="inline-flex items-center px-5 py-2 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 font-medium transition-all duration-200 shadow-sm">
                                            <i class="fas fa-vote-yea mr-2"></i> Vote
                                        </a>
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50/60 transition-all duration-200">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Weekly Survey #2</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Voted
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">05/10/24 12:00 PM</td>
                                    <td class="px-6 py-5">
                                        <a href="#" class="inline-flex items-center px-5 py-2 rounded-full bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-medium transition-all duration-200 shadow-sm">
                                            <i class="fas fa-eye mr-2"></i> View
                                        </a>
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50/60 transition-all duration-200">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Weekly Survey #1</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Closed
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">04/30/24 11:59 PM</td>
                                    <td class="px-6 py-5">
                                        <a href="#" class="inline-flex items-center px-5 py-2 rounded-full bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-medium transition-all duration-200 shadow-sm">
                                            <i class="fas fa-eye mr-2"></i> View
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- My Votes Tab -->
                <div id="tab-content-myvotes" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-700">Your Voting History</h2>
                    </div>
                    <div class="overflow-hidden rounded-xl border border-gray-100 shadow-lg">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="bg-gradient-to-r from-yellow-50 to-amber-50">
                                    <th class="px-6 py-4 text-lg font-semibold text-amber-700">Poll</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-amber-700">Status</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-amber-700">Date Voted</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-amber-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <!-- Example Row -->
                                <tr class="hover:bg-yellow-50/60 transition-all duration-200">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Fave Food</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">05/15/24 10:30 AM</td>
                                    <td class="px-6 py-5">
                                        <a href="#" class="inline-flex items-center px-5 py-2 rounded-full bg-amber-50 text-amber-700 hover:bg-amber-100 font-medium transition-all duration-200 shadow-sm">
                                            <i class="fas fa-chart-bar mr-2"></i> View Result
                                        </a>
                                    </td>
                                </tr>
                                <tr class="hover:bg-yellow-50/60 transition-all duration-200">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Weekly Survey #2</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Voted
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">05/10/24 09:45 AM</td>
                                    <td class="px-6 py-5">
                                        <a href="#" class="inline-flex items-center px-5 py-2 rounded-full bg-amber-50 text-amber-700 hover:bg-amber-100 font-medium transition-all duration-200 shadow-sm">
                                            <i class="fas fa-chart-bar mr-2"></i> View Result
                                        </a>
                                    </td>
                                </tr>
                                <tr class="hover:bg-yellow-50/60 transition-all duration-200">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Weekly Survey #1</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Closed
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">04/30/24 02:15 PM</td>
                                    <td class="px-6 py-5">
                                        <a href="#" class="inline-flex items-center px-5 py-2 rounded-full bg-amber-50 text-amber-700 hover:bg-amber-100 font-medium transition-all duration-200 shadow-sm">
                                            <i class="fas fa-chart-bar mr-2"></i> View Result
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- My Created Polls Tab -->
                <div id="tab-content-mycreated" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-700">Your Created Polls</h2>
                        <select class="border border-gray-200 rounded-lg px-4 py-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 shadow-sm" id="created-polls-filter">
                            <option>All Polls</option>
                            <option>Active Only</option>
                            <option>Closed Only</option>
                        </select>
                    </div>
                    <div class="overflow-hidden rounded-xl border border-gray-100 shadow-lg">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="bg-gradient-to-r from-green-50 to-emerald-50">
                                    <th class="px-6 py-4 text-lg font-semibold text-green-700">Poll Title</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-green-700">Status</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-green-700">Created Date</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-green-700">Responses</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-green-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <!-- Example Rows -->
                                <tr class="hover:bg-green-50/60 transition-all duration-200">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Favorite Color</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">05/12/24</td>
                                    <td class="px-6 py-5 text-gray-800 font-medium">24</td>
                                    <td class="px-6 py-5">
                                        <div class="flex space-x-2">
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 hover:bg-green-200 font-medium transition-all duration-200 shadow-sm">
                                                <i class="fas fa-chart-pie mr-2"></i> Results
                                            </a>
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-700 hover:bg-red-200 font-medium transition-all duration-200 shadow-sm">
                                                <i class="fas fa-times mr-2"></i> Close
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-green-50/60 transition-all duration-200">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Dream Vacation</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">05/05/24</td>
                                    <td class="px-6 py-5 text-gray-800 font-medium">18</td>
                                    <td class="px-6 py-5">
                                        <div class="flex space-x-2">
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 hover:bg-green-200 font-medium transition-all duration-200 shadow-sm">
                                                <i class="fas fa-chart-pie mr-2"></i> Results
                                            </a>
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-700 hover:bg-red-200 font-medium transition-all duration-200 shadow-sm">
                                                <i class="fas fa-times mr-2"></i> Close
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-green-50/60 transition-all duration-200">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Favorite Fruit</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Closed
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">04/20/24</td>
                                    <td class="px-6 py-5 text-gray-800 font-medium">32</td>
                                    <td class="px-6 py-5">
                                        <div class="flex space-x-2">
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 hover:bg-green-200 font-medium transition-all duration-200 shadow-sm">
                                                <i class="fas fa-chart-pie mr-2"></i> Results
                                            </a>
                                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 font-medium transition-all duration-200 shadow-sm">
                                                <i class="fas fa-copy mr-2"></i> Duplicate
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Pagination & Create Poll -->
                <div class="flex items-center justify-between mt-10 pt-6 border-t border-gray-100">
                    <div class="flex items-center space-x-3">
                        <button class="inline-flex items-center px-5 py-2.5 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 font-medium transition-all duration-200 shadow-sm">
                            <i class="fas fa-chevron-left mr-2"></i> Previous
                        </button>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-medium shadow-sm">1</span>
                        <button class="inline-flex items-center px-5 py-2.5 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 font-medium transition-all duration-200 shadow-sm">
                            Next <i class="fas fa-chevron-right ml-2"></i>
                        </button>
                    </div>
                    <a href="/user-dashboard?page=create-poll" class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Create Poll
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showUserTab(tab) {
    document.getElementById('tab-content-polls').classList.toggle('hidden', tab !== 'polls');
    document.getElementById('tab-content-myvotes').classList.toggle('hidden', tab !== 'myvotes');
    document.getElementById('tab-content-mycreated').classList.toggle('hidden', tab !== 'mycreated');
    
    // Tab active state - Polls tab
    document.getElementById('tab-polls').classList.toggle('text-blue-600', tab === 'polls');
    document.getElementById('tab-polls').classList.toggle('border-blue-500', tab === 'polls');
    document.getElementById('tab-polls').classList.toggle('text-gray-500', tab !== 'polls');
    document.getElementById('tab-polls').classList.toggle('border-transparent', tab !== 'polls');
    
    // Tab active state - My Votes tab
    document.getElementById('tab-myvotes').classList.toggle('text-yellow-600', tab === 'myvotes');
    document.getElementById('tab-myvotes').classList.toggle('border-yellow-400', tab === 'myvotes');
    document.getElementById('tab-myvotes').classList.toggle('text-gray-500', tab !== 'myvotes');
    document.getElementById('tab-myvotes').classList.toggle('border-transparent', tab !== 'myvotes');
    
    // Tab active state - My Created Polls tab
    document.getElementById('tab-mycreated').classList.toggle('text-green-600', tab === 'mycreated');
    document.getElementById('tab-mycreated').classList.toggle('border-green-400', tab === 'mycreated');
    document.getElementById('tab-mycreated').classList.toggle('text-gray-500', tab !== 'mycreated');
    document.getElementById('tab-mycreated').classList.toggle('border-transparent', tab !== 'mycreated');
}

// Check URL parameters on page load
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');
    if (tab === 'myvotes' || tab === 'polls' || tab === 'mycreated') {
        showUserTab(tab);
    }
});
</script>
