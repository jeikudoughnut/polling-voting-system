{{-- resources/views/pages/user/components/results.blade.php --}}
<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-8 text-center tracking-tight drop-shadow-sm">
            Poll Results
        </h1>
        <div class="max-w-6xl mx-auto flex flex-col gap-10">
            <div class="flex flex-col md:flex-row gap-10">
                <!-- Poll Participation Table -->
                <div class="flex-1 bg-white/95 rounded-3xl shadow-xl border border-gray-100/50 p-8 backdrop-blur-sm">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <a href="?page=polls" class="hover:text-blue-700 transition-colors duration-200">Poll History</a>
                    </h2>
                    <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-inner">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Title</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Date Participated</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Status</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Vote</th>
                                </tr>
                            </thead>
                            <tbody id="pollHistoryTableBody" class="divide-y divide-gray-100">
                                <!-- Dynamic content will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Poll Result Details (Horizontal Layout) -->
                <div id="pollDetailsSection" class="flex-1 bg-white/95 rounded-3xl shadow-xl border border-gray-100/50 p-8 flex flex-col justify-center backdrop-blur-sm">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-chart-pie text-4xl mb-4"></i>
                        <p class="text-lg">Select a poll from the table to view detailed results</p>
                    </div>
                </div>
            </div>
            <!-- Poll Options Bar Chart -->
            <div id="barChartSection" class="bg-white/95 rounded-3xl shadow-xl border border-gray-100/50 p-8 backdrop-blur-sm" style="display: none;">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Vote Distribution
                </h2>
                <div id="barChartContent" class="space-y-6 max-w-4xl mx-auto">
                    <!-- Dynamic bar chart content will be loaded here -->
                </div>
                <div class="flex justify-end gap-4 mt-10">
                    <button id="exportCSVBtn" class="bg-gray-100 hover:bg-gray-200 px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 transition-colors duration-200 flex items-center shadow-sm hover:shadow">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export CSV
                    </button>
                    <button id="exportPDFBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center shadow-sm hover:shadow">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Global variables
let userPolls = [];
let currentPoll = null;
let pieChart = null;

// Color schemes for charts
const colors = [
    '#3b82f6', // blue
    '#facc15', // yellow
    '#f87171', // red
    '#34d399', // green
    '#a855f7', // purple
    '#f97316', // orange
    '#06b6d4', // cyan
    '#84cc16', // lime
    '#ec4899', // pink
    '#8b5cf6'  // violet
];

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    loadUserPolls();
    setupEventListeners();
    
    // Check if there's a specific poll to load from URL
    const urlParams = new URLSearchParams(window.location.search);
    const pollId = urlParams.get('poll');
    if (pollId) {
        // Delay loading poll results to ensure polls are loaded first
        setTimeout(() => {
            loadPollResults(pollId);
        }, 500);
    }
});

// Setup event listeners
function setupEventListeners() {
    document.getElementById('exportCSVBtn').addEventListener('click', exportCSV);
    document.getElementById('exportPDFBtn').addEventListener('click', exportPDF);
}

// Load user's poll participation history
async function loadUserPolls() {
    try {
        const response = await fetch('/user/results');
        const data = await response.json();
        
        if (data.success) {
            userPolls = data.polls;
            renderPollHistory();
        } else {
            showError('Failed to load poll history');
        }
    } catch (error) {
        console.error('Error loading polls:', error);
        showError('Failed to load poll history');
    }
}

// Render poll history table
function renderPollHistory() {
    const tbody = document.getElementById('pollHistoryTableBody');
    
    if (userPolls.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                    <div class="flex flex-col items-center">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <p class="text-lg font-medium">You haven't voted on any polls yet</p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = userPolls.map(poll => {
        const statusClass = poll.status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700';
        const statusIcon = poll.status === 'active' ? 'text-green-500' : 'text-gray-400';
        
        return `
            <tr class="hover:bg-blue-50/60 transition cursor-pointer" onclick="loadPollResults(${poll.id})">
                <td class="px-6 py-5 text-lg text-gray-800 font-medium">${poll.title}</td>
                <td class="px-6 py-5 text-gray-600">${poll.vote_date || 'N/A'}</td>
                <td class="px-6 py-5">
                    <span class="inline-flex items-center px-4 py-2 rounded-full ${statusClass} text-base font-semibold shadow-sm">
                        <svg class="w-4 h-4 mr-2 ${statusIcon}" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                        ${poll.status.charAt(0).toUpperCase() + poll.status.slice(1)}
                    </span>
                </td>
                <td class="px-6 py-5 text-blue-600 font-medium">${poll.user_choice || '-'}</td>
            </tr>
        `;
    }).join('');
}

// Load detailed results for a specific poll
async function loadPollResults(pollId) {
    try {
        const response = await fetch(`/user/polls/${pollId}/results`);
        const data = await response.json();
        
        if (data.success) {
            currentPoll = data.poll;
            renderPollDetails();
            renderBarChart();
            document.getElementById('barChartSection').style.display = 'block';
        } else {
            showError(data.message || 'Failed to load poll results');
        }
    } catch (error) {
        console.error('Error loading poll results:', error);
        showError('Failed to load poll results');
    }
}

// Render poll details section with pie chart
function renderPollDetails() {
    if (!currentPoll || !currentPoll.results || currentPoll.results.length === 0) return;
    
    const question = currentPoll.results[0]; // Assuming single question for now
    const pollDetailsSection = document.getElementById('pollDetailsSection');
    
    pollDetailsSection.innerHTML = `
        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
            <!-- Left: Question and Options -->
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    ${question.question}
                </h2>
                <ul class="mb-4 text-lg text-gray-700 space-y-2">
                    ${question.options.map((option, index) => {
                        const isUserChoice = option.text === question.user_choice;
                        const userChoiceTag = isUserChoice ? '<span class="ml-2 text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full">(your choice)</span>' : '';
                        
                        return `
                            <li class="flex items-center ${isUserChoice ? 'font-medium' : ''}">
                                <span class="w-3 h-3 rounded-full mr-2" style="background-color: ${colors[index] || '#6b7280'}"></span>
                                ${option.text} ${userChoiceTag}
                            </li>
                        `;
                    }).join('')}
                </ul>
                <div class="text-lg font-semibold text-gray-800 mt-4 p-3 bg-blue-50 rounded-lg inline-block">
                    Winning option: <span class="text-blue-600">${question.winning_option || 'N/A'}</span>
                </div>
            </div>
            <!-- Right: Pie Chart -->
            <div class="flex-shrink-0 w-56 h-56 flex items-center justify-center bg-white/80 rounded-full shadow-inner p-2">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    `;

    // Create pie chart
    setTimeout(() => {
        createPieChart(question);
    }, 100);
}

// Create pie chart
function createPieChart(question) {
    const ctx = document.getElementById('pieChart').getContext('2d');
    
    // Destroy existing chart if it exists
    if (pieChart) {
        pieChart.destroy();
    }
    
    pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: question.options.map(option => option.text),
            datasets: [{
                data: question.options.map(option => option.votes),
                backgroundColor: colors.slice(0, question.options.length),
                borderWidth: 2,
                borderColor: '#ffffff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let value = context.parsed;
                            let percent = total > 0 ? ((value / total) * 100).toFixed(1) + '%' : '0%';
                            return `${context.label}: ${value} votes (${percent})`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true,
                duration: 2000
            }
        }
    });
}

// Render bar chart
function renderBarChart() {
    if (!currentPoll || !currentPoll.results || currentPoll.results.length === 0) return;
    
    const question = currentPoll.results[0];
    const barChartContent = document.getElementById('barChartContent');
    
    barChartContent.innerHTML = question.options.map((option, index) => `
        <div>
            <div class="flex justify-between text-gray-700 mb-2">
                <span class="font-medium">${option.text}</span>
                <span>${option.percentage}%</span>
            </div>
            <div class="h-8 bg-gray-100 rounded-lg relative overflow-hidden shadow-inner">
                <div class="h-8 rounded-lg flex items-center justify-end pr-3 transition-all duration-1000" 
                     style="width: ${option.percentage}%; background-color: ${colors[index] || '#6b7280'}">
                    <span class="text-sm text-white font-medium">${option.votes}</span>
                </div>
            </div>
        </div>
    `).join('');
}

// Export functions
function exportCSV() {
    if (!currentPoll) {
        showError('Please select a poll first');
        return;
    }
    
    window.open(`/user/polls/${currentPoll.id}/export/csv`, '_blank');
}

function exportPDF() {
    if (!currentPoll) {
        showError('Please select a poll first');
        return;
    }
    
    window.open(`/user/polls/${currentPoll.id}/export/pdf`, '_blank');
}

// Show error message
function showError(message) {
    // You can implement a toast notification system here
    alert(message);
}
</script>
