<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 dark:text-dark-100 mb-8 text-center tracking-tight drop-shadow-sm transition-colors duration-300">
            Polls
        </h1>

        <!-- Success/Error Messages -->
        <div id="messageContainer" class="max-w-6xl mx-auto mb-6 hidden">
            <div id="messageAlert" class="px-4 py-3 rounded-xl relative transition-colors duration-300" role="alert">
                <strong class="font-bold" id="messageType"></strong>
                <span class="block sm:inline" id="messageText"></span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="hideMessage()">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="bg-white/95 dark:bg-dark-800/95 rounded-3xl shadow-xl border border-gray-100/50 dark:border-dark-700 p-8 relative overflow-hidden backdrop-blur-sm transition-colors duration-300">
                <!-- Decorative Elements -->
                <div class="absolute -top-12 -left-12 w-40 h-40 bg-blue-100 dark:bg-blue-900/30 rounded-full opacity-30 blur-3xl"></div>
                <div class="absolute -bottom-12 -right-12 w-40 h-40 bg-yellow-100 dark:bg-yellow-900/30 rounded-full opacity-30 blur-3xl"></div>
                <div class="absolute top-1/3 right-1/4 w-24 h-24 bg-green-100 dark:bg-green-900/30 rounded-full opacity-20 blur-2xl"></div>
                
                <!-- Tabs -->
                <div class="flex relative mb-10 border-b border-gray-100 dark:border-dark-600 transition-colors duration-300">
                    <button id="tab-polls"
                        class="relative z-10 py-4 px-10 text-xl font-bold transition-all duration-300 focus:outline-none text-blue-600 dark:text-blue-400 border-b-3 border-blue-500 dark:border-blue-400"
                        onclick="showUserTab('polls')">
                        Polls
                    </button>
                    <button id="tab-myvotes"
                        class="relative z-10 py-4 px-10 text-xl font-bold transition-all duration-300 focus:outline-none text-gray-500 dark:text-dark-400 border-b-3 border-transparent hover:text-yellow-600 dark:hover:text-yellow-400 hover:border-yellow-400"
                        onclick="showUserTab('myvotes')">
                        My Votes
                    </button>
                    <button id="tab-mycreated"
                        class="relative z-10 py-4 px-10 text-xl font-bold transition-all duration-300 focus:outline-none text-gray-500 dark:text-dark-400 border-b-3 border-transparent hover:text-green-600 dark:hover:text-green-400 hover:border-green-400"
                        onclick="showUserTab('mycreated')">
                        My Created Polls
                    </button>
                </div>
                
                <!-- Polls Tab -->
                <div id="tab-content-polls">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-700 dark:text-dark-200 transition-colors duration-300">Available Polls</h2>
                        <select class="border border-gray-200 dark:border-dark-600 rounded-lg px-4 py-2 text-gray-600 dark:text-dark-200 bg-white dark:bg-dark-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm" id="polls-filter">
                            <option value="all">All Polls</option>
                            <option value="active">Active Only</option>
                            <option value="voted">Already Voted</option>
                        </select>
                    </div>
                    <div class="overflow-hidden rounded-xl border border-gray-100 dark:border-dark-600 shadow-lg transition-colors duration-300">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30">
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700 dark:text-blue-300">Poll</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700 dark:text-blue-300">Status</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700 dark:text-blue-300">Deadline</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700 dark:text-blue-300">Action</th>
                                </tr>
                            </thead>
                            <tbody id="pollsTableBody" class="divide-y divide-gray-100 dark:divide-dark-600">
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-dark-400">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-spinner fa-spin text-4xl text-gray-300 dark:text-dark-500 mb-4"></i>
                                            <p class="text-lg font-medium">Loading polls...</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- My Votes Tab -->
                <div id="tab-content-myvotes" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-700 dark:text-dark-200 transition-colors duration-300">Your Voting History</h2>
                    </div>
                    <div class="overflow-hidden rounded-xl border border-gray-100 dark:border-dark-600 shadow-lg transition-colors duration-300">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="bg-gradient-to-r from-yellow-50 to-amber-50 dark:from-yellow-900/30 dark:to-amber-900/30">
                                    <th class="px-6 py-4 text-lg font-semibold text-amber-700 dark:text-amber-300">Poll</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-amber-700 dark:text-amber-300">Status</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-amber-700 dark:text-amber-300">Date Voted</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-amber-700 dark:text-amber-300">Action</th>
                                </tr>
                            </thead>
                            <tbody id="myVotesTableBody" class="divide-y divide-gray-100 dark:divide-dark-600">
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-dark-400">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-spinner fa-spin text-4xl text-gray-300 dark:text-dark-500 mb-4"></i>
                                            <p class="text-lg font-medium">Loading your votes...</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- My Created Polls Tab -->
                <div id="tab-content-mycreated" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-700 dark:text-dark-200 transition-colors duration-300">Your Created Polls</h2>
                    </div>
                    <div class="overflow-hidden rounded-xl border border-gray-100 dark:border-dark-600 shadow-lg transition-colors duration-300">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/30">
                                    <th class="px-6 py-4 text-lg font-semibold text-green-700 dark:text-green-300">Poll Title</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-green-700 dark:text-green-300">Status</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-green-700 dark:text-green-300">Created Date</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-green-700 dark:text-green-300">Responses</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-green-700 dark:text-green-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="myPollsTableBody" class="divide-y divide-gray-100 dark:divide-dark-600">
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-dark-400">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-spinner fa-spin text-4xl text-gray-300 dark:text-dark-500 mb-4"></i>
                                            <p class="text-lg font-medium">Loading your polls...</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Pagination & Create Poll -->
                <div class="flex items-center justify-between mt-10 pt-6 border-t border-gray-100 dark:border-dark-600 transition-colors duration-300">
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-600 dark:text-dark-300 transition-colors duration-300">Showing all available polls</span>
                    </div>
                    <a href="/user-dashboard?page=create-poll" class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 font-semibold transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Create Poll
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Vote Modal -->
    <div id="voteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-dark-800 rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative transition-colors duration-300">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-t-3xl">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold" id="voteModalTitle">Vote on Poll</h2>
                    <button onclick="closeVoteModal()" class="text-white hover:text-gray-200 text-2xl font-bold">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-8">
                <div id="voteModalContent">
                    <!-- Poll content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Global variables
let allPolls = [];
let myVotes = [];
let myPolls = [];
let currentPoll = null;

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    loadPolls();
    
    // Add filter event listeners
    document.getElementById('polls-filter').addEventListener('change', filterPolls);
    
    // Check URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');
    if (tab === 'myvotes' || tab === 'polls' || tab === 'mycreated') {
        showUserTab(tab);
    }
});

// Tab management
function showUserTab(tab) {
    // Hide all tab contents
    document.getElementById('tab-content-polls').classList.toggle('hidden', tab !== 'polls');
    document.getElementById('tab-content-myvotes').classList.toggle('hidden', tab !== 'myvotes');
    document.getElementById('tab-content-mycreated').classList.toggle('hidden', tab !== 'mycreated');
    
    // Tab active state - Polls tab
    document.getElementById('tab-polls').classList.toggle('text-blue-600', tab === 'polls');
    document.getElementById('tab-polls').classList.toggle('dark:text-blue-400', tab === 'polls');
    document.getElementById('tab-polls').classList.toggle('border-blue-500', tab === 'polls');
    document.getElementById('tab-polls').classList.toggle('dark:border-blue-400', tab === 'polls');
    document.getElementById('tab-polls').classList.toggle('text-gray-500', tab !== 'polls');
    document.getElementById('tab-polls').classList.toggle('dark:text-dark-400', tab !== 'polls');
    document.getElementById('tab-polls').classList.toggle('border-transparent', tab !== 'polls');
    
    // Tab active state - My Votes tab
    document.getElementById('tab-myvotes').classList.toggle('text-yellow-600', tab === 'myvotes');
    document.getElementById('tab-myvotes').classList.toggle('dark:text-yellow-400', tab === 'myvotes');
    document.getElementById('tab-myvotes').classList.toggle('border-yellow-400', tab === 'myvotes');
    document.getElementById('tab-myvotes').classList.toggle('text-gray-500', tab !== 'myvotes');
    document.getElementById('tab-myvotes').classList.toggle('dark:text-dark-400', tab !== 'myvotes');
    document.getElementById('tab-myvotes').classList.toggle('border-transparent', tab !== 'myvotes');
    
    // Tab active state - My Created Polls tab
    document.getElementById('tab-mycreated').classList.toggle('text-green-600', tab === 'mycreated');
    document.getElementById('tab-mycreated').classList.toggle('dark:text-green-400', tab === 'mycreated');
    document.getElementById('tab-mycreated').classList.toggle('border-green-400', tab === 'mycreated');
    document.getElementById('tab-mycreated').classList.toggle('text-gray-500', tab !== 'mycreated');
    document.getElementById('tab-mycreated').classList.toggle('dark:text-dark-400', tab !== 'mycreated');
    document.getElementById('tab-mycreated').classList.toggle('border-transparent', tab !== 'mycreated');

    // Load data for the active tab
    if (tab === 'myvotes') {
        loadMyVotes();
    } else if (tab === 'mycreated') {
        loadMyPolls();
    }
}

// Message handling
function showMessage(type, message) {
    const container = document.getElementById('messageContainer');
    const alert = document.getElementById('messageAlert');
    const messageType = document.getElementById('messageType');
    const messageText = document.getElementById('messageText');
    
    messageType.textContent = type === 'success' ? 'Success!' : 'Error!';
    messageText.textContent = message;
    
    if (type === 'success') {
        alert.className = 'bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl relative transition-colors duration-300';
    } else {
        alert.className = 'bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl relative transition-colors duration-300';
    }
    
    container.classList.remove('hidden');
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        hideMessage();
    }, 5000);
}

function hideMessage() {
    document.getElementById('messageContainer').classList.add('hidden');
}

// Load polls data
async function loadPolls() {
    try {
        const response = await fetch('/user/polls');
        const data = await response.json();
        
        if (data.success) {
            allPolls = data.polls;
            renderPolls();
        } else {
            showMessage('error', 'Failed to load polls');
        }
    } catch (error) {
        console.error('Error loading polls:', error);
        showMessage('error', 'Failed to load polls');
        renderEmptyState('pollsTableBody', 'No polls available', 4);
    }
}

// Load user's votes
async function loadMyVotes() {
    try {
        const response = await fetch('/user/my-votes');
        const data = await response.json();
        
        if (data.success) {
            myVotes = data.polls;
            renderMyVotes();
        } else {
            showMessage('error', 'Failed to load your votes');
        }
    } catch (error) {
        console.error('Error loading votes:', error);
        showMessage('error', 'Failed to load your votes');
        renderEmptyState('myVotesTableBody', 'No votes found', 4);
    }
}

// Load user's created polls
async function loadMyPolls() {
    try {
        const response = await fetch('/user/my-polls');
        const data = await response.json();
        
        if (data.success) {
            myPolls = data.polls;
            renderMyPolls();
        } else {
            showMessage('error', 'Failed to load your polls');
        }
    } catch (error) {
        console.error('Error loading your polls:', error);
        showMessage('error', 'Failed to load your polls');
        renderEmptyState('myPollsTableBody', 'No polls created yet', 5);
    }
}

// Render polls
function renderPolls() {
    const tbody = document.getElementById('pollsTableBody');
    
    if (allPolls.length === 0) {
        renderEmptyState('pollsTableBody', 'No polls available', 4);
        return;
    }
    
    const filter = document.getElementById('polls-filter').value;
    let filteredPolls = allPolls;
    
    if (filter === 'active') {
        filteredPolls = allPolls.filter(poll => poll.status === 'active' && !poll.user_voted);
    } else if (filter === 'voted') {
        filteredPolls = allPolls.filter(poll => poll.user_voted);
    }
    
    tbody.innerHTML = filteredPolls.map(poll => `
        <tr class="hover:bg-blue-50/60 dark:hover:bg-blue-900/20 transition-all duration-200">
            <td class="px-6 py-5">
                <div>
                    <div class="text-lg text-gray-800 dark:text-dark-100 font-medium transition-colors duration-300">${poll.title}</div>
                    ${poll.description ? `<div class="text-sm text-gray-600 dark:text-dark-300 mt-1 transition-colors duration-300">${poll.description.substring(0, 100)}${poll.description.length > 100 ? '...' : ''}</div>` : ''}
                    <div class="text-xs text-gray-500 dark:text-dark-400 mt-1 transition-colors duration-300">by ${poll.creator}</div>
                </div>
            </td>
            <td class="px-6 py-5">
                ${getStatusBadge(poll)}
            </td>
            <td class="px-6 py-5 text-gray-600 dark:text-dark-300 transition-colors duration-300">
                ${poll.end_date ? poll.formatted_end_date : 'No deadline'}
            </td>
            <td class="px-6 py-5">
                ${getActionButton(poll)}
            </td>
        </tr>
    `).join('');
}

// Render my votes
function renderMyVotes() {
    const tbody = document.getElementById('myVotesTableBody');
    
    if (myVotes.length === 0) {
        renderEmptyState('myVotesTableBody', 'You haven\'t voted on any polls yet', 4);
        return;
    }
    
    tbody.innerHTML = myVotes.map(vote => `
        <tr class="hover:bg-yellow-50/60 dark:hover:bg-yellow-900/20 transition-all duration-200">
            <td class="px-6 py-5 text-lg text-gray-800 dark:text-dark-100 font-medium transition-colors duration-300">${vote.title}</td>
            <td class="px-6 py-5">
                ${getStatusBadge(vote)}
            </td>
            <td class="px-6 py-5 text-gray-600 dark:text-dark-300 transition-colors duration-300">${vote.vote_date}</td>
            <td class="px-6 py-5">
                <button onclick="viewPollResults(${vote.id})" class="inline-flex items-center px-5 py-2 rounded-full bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 hover:bg-amber-100 dark:hover:bg-amber-900/50 font-medium transition-all duration-200 shadow-sm">
                    <i class="fas fa-chart-bar mr-2"></i> View Results
                </button>
            </td>
        </tr>
    `).join('');
}

// Render my polls
function renderMyPolls() {
    const tbody = document.getElementById('myPollsTableBody');
    
    if (myPolls.length === 0) {
        renderEmptyState('myPollsTableBody', 'You haven\'t created any polls yet', 5);
        return;
    }
    
    tbody.innerHTML = myPolls.map(poll => `
        <tr class="hover:bg-green-50/60 dark:hover:bg-green-900/20 transition-all duration-200">
            <td class="px-6 py-5 text-lg text-gray-800 dark:text-dark-100 font-medium transition-colors duration-300">${poll.title}</td>
            <td class="px-6 py-5">
                ${getStatusBadge(poll)}
            </td>
            <td class="px-6 py-5 text-gray-600 dark:text-dark-300 transition-colors duration-300">${poll.creation_date}</td>
            <td class="px-6 py-5 text-gray-800 dark:text-dark-100 font-medium transition-colors duration-300">${poll.votes_count}</td>
            <td class="px-6 py-5">
                <div class="flex space-x-2">
                    <button onclick="viewPollResults(${poll.id})" class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-900/50 font-medium transition-all duration-200 shadow-sm">
                        <i class="fas fa-chart-pie mr-2"></i> Results
                    </button>
                    ${poll.status === 'active' ? `
                        <button onclick="closePoll(${poll.id})" class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-700 hover:bg-red-200 font-medium transition-all duration-200 shadow-sm">
                            <i class="fas fa-stop mr-2"></i> Close Poll
                        </button>
                    ` : ''}
                </div>
            </td>
        </tr>
    `).join('');
}

// Helper functions
function getStatusBadge(poll) {
    if (poll.user_voted) {
        return `<span class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-base font-semibold shadow-sm transition-colors duration-300">
                    <svg class="w-4 h-4 mr-2 text-blue-500 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                    Voted
                </span>`;
    }
    
    switch (poll.status) {
        case 'active':
            return `<span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-base font-semibold shadow-sm transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                        Active
                    </span>`;
        case 'pending':
            return `<span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-base font-semibold shadow-sm transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-yellow-500 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                        Pending
                    </span>`;
        case 'closed':
            return `<span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-base font-semibold shadow-sm transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                        Closed
                    </span>`;
        default:
            return '';
    }
}

function getActionButton(poll) {
    if (poll.user_voted) {
        return `<button onclick="viewPollResults(${poll.id})" class="inline-flex items-center px-5 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 font-medium transition-all duration-200 shadow-sm">
                    <i class="fas fa-eye mr-2"></i> View Results
                </button>`;
    } else if (poll.status === 'active') {
        return `<button onclick="openVoteModal(${poll.id})" class="inline-flex items-center px-5 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/50 font-medium transition-all duration-200 shadow-sm">
                    <i class="fas fa-vote-yea mr-2"></i> Vote
                </button>`;
    } else {
        return `<button onclick="viewPollResults(${poll.id})" class="inline-flex items-center px-5 py-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 font-medium transition-all duration-200 shadow-sm">
                    <i class="fas fa-eye mr-2"></i> View
                </button>`;
    }
}

function renderEmptyState(tbodyId, message, colspan) {
    document.getElementById(tbodyId).innerHTML = `
        <tr>
            <td colspan="${colspan}" class="px-6 py-8 text-center text-gray-500 dark:text-dark-400">
                <div class="flex flex-col items-center">
                    <i class="fas fa-inbox text-4xl text-gray-300 dark:text-dark-500 mb-4"></i>
                    <p class="text-lg font-medium">${message}</p>
                </div>
            </td>
        </tr>
    `;
}

// Filter polls
function filterPolls() {
    renderPolls();
}

// Vote modal functions
async function openVoteModal(pollId) {
    try {
        const response = await fetch(`/user/polls/${pollId}`);
        const data = await response.json();
        
        if (data.success) {
            currentPoll = data.poll;
            renderVoteModal();
            document.getElementById('voteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            showMessage('error', 'Failed to load poll details');
        }
    } catch (error) {
        console.error('Error loading poll:', error);
        showMessage('error', 'Failed to load poll details');
    }
}

function closeVoteModal() {
    document.getElementById('voteModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    currentPoll = null;
}

function renderVoteModal() {
    if (!currentPoll) return;
    
    document.getElementById('voteModalTitle').textContent = currentPoll.title;
    
    const content = document.getElementById('voteModalContent');
    content.innerHTML = `
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-dark-100 mb-2 transition-colors duration-300">${currentPoll.title}</h3>
            ${currentPoll.description ? `<p class="text-gray-600 dark:text-dark-300 mb-4 transition-colors duration-300">${currentPoll.description}</p>` : ''}
            <div class="text-sm text-gray-500 dark:text-dark-400 transition-colors duration-300">
                Created by ${currentPoll.creator} 
                ${currentPoll.end_date ? ` • Ends: ${currentPoll.formatted_end_date}` : ''}
            </div>
        </div>
        
        ${currentPoll.questions.map(question => `
            <div class="mb-8">
                <h4 class="text-lg font-medium text-gray-800 dark:text-dark-100 mb-4 transition-colors duration-300">${question.text}</h4>
                <div class="space-y-3" data-question-id="${question.id}" data-question-type="${question.type}">
                    ${question.options.map((option, index) => `
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-blue-300 hover:bg-blue-50 cursor-pointer transition-all duration-200">
                            <input type="${question.type === 'single_choice' ? 'radio' : 'checkbox'}" 
                                   name="question_${question.id}" 
                                   value="${option.id}" 
                                   class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                   ${option.text.includes('Other') ? `onchange="toggleCustomInput(this, ${index})"` : ''}>
                            <span class="ml-3 text-gray-800 font-medium">${option.text}</span>
                        </label>
                        ${option.text.includes('Other') && question.allow_custom_answers ? `
                            <div class="ml-8 mt-2 hidden" id="custom-input-${index}">
                                <input type="text" 
                                       name="custom_response_${index}" 
                                       placeholder="Please specify your answer..." 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       maxlength="500">
                            </div>
                        ` : ''}
                    `).join('')}
                </div>
            </div>
        `).join('')}
        
        <div class="flex gap-4 justify-end pt-6 border-t border-gray-200 dark:border-dark-600 transition-colors duration-300">
            <button onclick="closeVoteModal()" class="px-6 py-3 bg-gray-200 dark:bg-dark-600 text-gray-700 dark:text-dark-200 rounded-xl hover:bg-gray-300 dark:hover:bg-dark-500 transition-colors font-medium">
                Cancel
            </button>
            <button onclick="submitVote()" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all font-medium shadow-lg">
                Submit Vote
            </button>
        </div>
    `;
}

// Toggle custom input visibility
function toggleCustomInput(checkbox, index) {
    const customInputDiv = document.getElementById(`custom-input-${index}`);
    if (customInputDiv) {
        if (checkbox.checked) {
            customInputDiv.classList.remove('hidden');
            customInputDiv.querySelector('input').focus();
        } else {
            customInputDiv.classList.add('hidden');
            customInputDiv.querySelector('input').value = '';
        }
    }
}

// Submit vote
async function submitVote() {
    if (!currentPoll) return;
    
    const question = currentPoll.questions[0]; // Assuming single question for now
    const questionContainer = document.querySelector(`[data-question-id="${question.id}"]`);
    const selectedOptions = Array.from(questionContainer.querySelectorAll('input:checked')).map(input => input.value);
    
    if (selectedOptions.length === 0) {
        showMessage('error', 'Please select at least one option');
        return;
    }
    
    // Collect custom responses
    const customResponses = [];
    const customInputs = document.querySelectorAll('[name^="custom_response_"]');
    customInputs.forEach((input, index) => {
        customResponses[index] = input.value.trim();
    });
    
    try {
        const response = await fetch(`/user/polls/${currentPoll.id}/vote`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                question_id: question.id,
                option_ids: selectedOptions,
                custom_responses: customResponses
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            showMessage('success', data.message);
            closeVoteModal();
            loadPolls(); // Reload polls to update status
        } else {
            showMessage('error', data.message);
        }
    } catch (error) {
        console.error('Error submitting vote:', error);
        showMessage('error', 'Failed to submit vote. Please try again.');
    }
}

// View poll results (placeholder)
function viewPollResults(pollId) {
    // Navigate to results page and load the specific poll
    window.location.href = `?page=results&poll=${pollId}`;
}

// Close poll function
async function closePoll(pollId) {
    if (!confirm('Are you sure you want to close this poll? This action cannot be undone.')) {
        return;
    }
    
    try {
        const response = await fetch(`/user/polls/${pollId}/close`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showMessage('success', data.message);
            loadMyPolls(); // Reload the polls to update the status
            // Also reload main polls if that tab is visible
            if (!document.getElementById('tab-content-polls').classList.contains('hidden')) {
                loadPolls();
            }
        } else {
            showMessage('error', data.message);
        }
    } catch (error) {
        console.error('Error closing poll:', error);
        showMessage('error', 'Failed to close poll. Please try again.');
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('voteModal');
    if (e.target === modal) {
        closeVoteModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('voteModal').classList.contains('hidden')) {
        closeVoteModal();
    }
});
</script>
