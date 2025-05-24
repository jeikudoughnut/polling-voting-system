<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-8 text-center tracking-tight drop-shadow-sm">
            Dashboard Overview
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- All Polls -->
            <a href="?page=polls&tab=polls" class="relative bg-gradient-to-br from-blue-100 to-blue-50 rounded-2xl flex flex-col items-center justify-center h-48 shadow-xl border border-blue-100 group hover:scale-[1.02] transition-all duration-300 overflow-hidden focus:outline-none focus:ring-2 focus:ring-blue-400">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-200 rounded-full -mr-8 -mt-8 opacity-30 blur-sm"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-blue-200 rounded-full -ml-8 -mb-8 opacity-30 blur-sm"></div>
                <div class="bg-blue-200/80 p-4 rounded-full mb-3 group-hover:scale-110 transition-transform duration-300 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <rect x="4" y="4" width="16" height="16" rx="2" stroke-width="2" stroke="currentColor" fill="none"/>
                        <path d="M9 12l2 2l4-4" stroke="currentColor" stroke-width="2.5" fill="none"/>
                    </svg>
                </div>
                <div class="text-4xl font-black text-blue-700 mb-1 tracking-tight" id="totalPollsCount">
                    <i class="fas fa-spinner fa-spin text-2xl"></i>
                </div>
                <div class="text-lg font-semibold text-blue-600">All Polls</div>
            </a>
            <!-- Participated Polls -->
            <a href="?page=polls&tab=myvotes" class="relative bg-gradient-to-br from-purple-100 to-purple-50 rounded-2xl flex flex-col items-center justify-center h-48 shadow-xl border border-purple-100 group hover:scale-[1.02] transition-all duration-300 overflow-hidden focus:outline-none focus:ring-2 focus:ring-purple-400">
                <div class="absolute top-0 right-0 w-20 h-20 bg-purple-200 rounded-full -mr-8 -mt-8 opacity-30 blur-sm"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-purple-200 rounded-full -ml-8 -mb-8 opacity-30 blur-sm"></div>
                <div class="bg-purple-200/80 p-4 rounded-full mb-3 group-hover:scale-110 transition-transform duration-300 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <g>
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M8 13l2.5 2.5L16 10" stroke="currentColor" stroke-width="2.5" fill="none"/>
                        </g>
                    </svg>
                </div>
                <div class="text-4xl font-black text-purple-700 mb-1 tracking-tight" id="userVotesCount">
                    <i class="fas fa-spinner fa-spin text-2xl"></i>
                </div>
                <div class="text-lg font-semibold text-purple-600">Participated Polls</div>
            </a>
            <!-- Created Polls -->
            <a href="?page=polls&tab=mycreated" class="relative bg-gradient-to-br from-green-100 to-green-50 rounded-2xl flex flex-col items-center justify-center h-48 shadow-xl border border-green-100 group hover:scale-[1.02] transition-all duration-300 overflow-hidden focus:outline-none focus:ring-2 focus:ring-green-400">
                <div class="absolute top-0 right-0 w-20 h-20 bg-green-200 rounded-full -mr-8 -mt-8 opacity-30 blur-sm"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-green-200 rounded-full -ml-8 -mb-8 opacity-30 blur-sm"></div>
                <div class="bg-green-200/80 p-4 rounded-full mb-3 group-hover:scale-110 transition-transform duration-300 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div class="text-4xl font-black text-green-700 mb-1 tracking-tight" id="userCreatedCount">
                    <i class="fas fa-spinner fa-spin text-2xl"></i>
                </div>
                <div class="text-lg font-semibold text-green-600">Created Polls</div>
            </a>
        </div>
        
        <!-- Trending Polls -->
        <div class="grid grid-cols-1 mb-8">
            <!-- Trending Polls Chart -->
            <div class="bg-white/95 rounded-2xl shadow-xl border border-gray-100 p-6 backdrop-blur-sm">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        Trending Polls
                    </h2>
                    <div class="text-sm text-gray-500" id="trendingSubtext">Loading...</div>
                </div>
                <div class="w-full h-64 flex items-center justify-center">
                    <canvas id="trendingPollsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Global variables
let trendingChart = null;

// Fetch dashboard data
async function loadUserDashboardData() {
    try {
        const response = await fetch('/user/dashboard-data', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) {
            throw new Error('Failed to fetch dashboard data');
        }
        
        const data = await response.json();
        updateUserDashboard(data);
        
    } catch (error) {
        console.error('Error loading user dashboard data:', error);
        // Show fallback data
        updateUserDashboard({
            totalPolls: 0,
            userVotes: 0,
            userCreatedPolls: 0,
            trendingPolls: [],
            recentVotes: []
        });
    }
}

function updateUserDashboard(data) {
    // Update statistics
    document.getElementById('totalPollsCount').textContent = data.totalPolls;
    document.getElementById('userVotesCount').textContent = data.userVotes;
    document.getElementById('userCreatedCount').textContent = data.userCreatedPolls;
    
    // Update trending subtext
    const trendingText = data.trendingPolls.length > 0 ? 
        `${data.trendingPolls.length} active polls available` : 
        'No active polls at the moment';
    document.getElementById('trendingSubtext').textContent = trendingText;
    
    // Create trending chart
    createTrendingChart(data.trendingPolls);
}

function createTrendingChart(trendingPolls) {
    const ctx = document.getElementById('trendingPollsChart').getContext('2d');
    
    // Destroy existing chart
    if (trendingChart) {
        trendingChart.destroy();
    }
    
    // Prepare data
    let labels = [];
    let votes = [];
    let colors = [
        'rgba(59, 130, 246, 0.8)',   // blue-500
        'rgba(168, 85, 247, 0.8)',   // purple-500
        'rgba(16, 185, 129, 0.8)',   // green-500
        'rgba(251, 191, 36, 0.8)',   // yellow-400
        'rgba(239, 68, 68, 0.8)'     // red-500
    ];
    let borderColors = [
        'rgba(59, 130, 246, 1)',
        'rgba(168, 85, 247, 1)',
        'rgba(16, 185, 129, 1)',
        'rgba(251, 191, 36, 1)',
        'rgba(239, 68, 68, 1)'
    ];
    
    if (trendingPolls && trendingPolls.length > 0) {
        // Use real data
        trendingPolls.forEach((poll, index) => {
            labels.push(poll.poll_title.length > 15 ? 
                poll.poll_title.substring(0, 15) + '...' : 
                poll.poll_title
            );
            votes.push(poll.votes_count || 0);
        });
    } else {
        // Use sample data if no real data
        labels = ['No Polls', 'Available', 'Yet', '', ''];
        votes = [0, 0, 0, 0, 0];
    }
    
    trendingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Votes',
                data: votes,
                backgroundColor: colors.slice(0, labels.length),
                borderColor: borderColors.slice(0, labels.length),
                borderWidth: 2,
                borderRadius: 8,
                maxBarThickness: 35
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    padding: 12,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 },
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return `${context.parsed.y} votes`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { 
                        stepSize: Math.max(1, Math.ceil(Math.max(...votes) / 5)),
                        color: '#6B7280', 
                        font: { size: 12, weight: 'medium' } 
                    },
                    grid: { color: '#E5E7EB', drawBorder: false }
                },
                x: {
                    ticks: { color: '#6B7280', font: { size: 12, weight: 'medium' } },
                    grid: { display: false }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            }
        }
    });
}

// Load data when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadUserDashboardData();
});
</script>
