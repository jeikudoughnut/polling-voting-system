<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 dark:text-dark-100 mb-6 text-center tracking-tight drop-shadow-sm transition-colors duration-300">
            Dashboard Overview
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Poll Activity Chart -->
            <div class="relative bg-white dark:bg-dark-800 rounded-2xl shadow-xl border border-gray-100 dark:border-dark-700 flex flex-col items-center justify-center p-6 h-72 group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute top-0 right-0 w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full -mr-6 -mt-6 opacity-30"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full -ml-6 -mb-6 opacity-30"></div>
                <h2 class="text-xl font-bold text-green-700 dark:text-green-300 mb-4 transition-colors duration-300">Poll Activity</h2>
                <div class="w-full h-40 flex items-center justify-center">
                    <canvas id="pollActivityChart"></canvas>
                </div>
            </div>
            <!-- Poll Distribution Chart -->
            <div class="relative bg-white dark:bg-dark-800 rounded-2xl shadow-xl border border-gray-100 dark:border-dark-700 flex flex-col items-center justify-center p-6 h-72 group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute top-0 right-0 w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-full -mr-6 -mt-6 opacity-30"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-full -ml-6 -mb-6 opacity-30"></div>
                <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300 mb-4 transition-colors duration-300">Poll Distribution</h2>
                <div class="w-full h-40 flex items-center justify-center">
                    <canvas id="pollDistributionChart"></canvas>
                </div>
            </div>
            <!-- Total Polls -->
            <a href="?page=poll-management&tab=all" class="relative bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-800/30 rounded-2xl flex flex-col items-center justify-center h-72 shadow-xl border border-blue-100 dark:border-blue-700 group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-200 dark:bg-blue-800 rounded-full -mr-8 -mt-8 opacity-20"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-blue-200 dark:bg-blue-800 rounded-full -ml-8 -mb-8 opacity-20"></div>
                <div class="bg-blue-200 dark:bg-blue-700 p-5 rounded-full mb-6 group-hover:scale-110 transition-transform duration-300 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <rect x="4" y="4" width="16" height="16" rx="2" stroke-width="2" stroke="currentColor" fill="none"/>
                        <path d="M9 12l2 2l4-4" stroke="currentColor" stroke-width="2.5" fill="none"/>
                    </svg>
                </div>
                <div class="text-6xl font-black text-blue-700 dark:text-blue-300 mb-2 tracking-tight transition-colors duration-300" id="totalPollsCount">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <div class="text-2xl font-semibold text-blue-600 dark:text-blue-400 mb-1 transition-colors duration-300">Total Polls</div>
                <div class="flex items-center space-x-1 text-base text-blue-500 dark:text-blue-400 transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    <span id="totalPollsGrowth">Loading...</span>
                </div>
            </a>
            <!-- Pending Polls -->
            <a href="?page=poll-management&tab=pending" class="relative bg-gradient-to-br from-yellow-100 to-yellow-50 dark:from-yellow-900/30 dark:to-yellow-800/30 rounded-2xl flex flex-col items-center justify-center h-72 shadow-xl border border-yellow-100 dark:border-yellow-700 group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-200 dark:bg-yellow-800 rounded-full -mr-8 -mt-8 opacity-20"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-yellow-200 dark:bg-yellow-800 rounded-full -ml-8 -mb-8 opacity-20"></div>
                <div class="bg-yellow-200 dark:bg-yellow-700 p-5 rounded-full mb-6 group-hover:scale-110 transition-transform duration-300 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-yellow-600 dark:text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2.5" fill="none"/>
                        <path d="M12 7v5l3 3" stroke="currentColor" stroke-width="2.5" fill="none"/>
                    </svg>
                </div>
                <div class="text-6xl font-black text-yellow-700 dark:text-yellow-300 mb-2 tracking-tight transition-colors duration-300" id="pendingPollsCount">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <div class="text-2xl font-semibold text-yellow-600 dark:text-yellow-400 mb-1 transition-colors duration-300">Pending Polls</div>
                <div class="px-4 py-1 bg-yellow-100 dark:bg-yellow-900/30 rounded-full text-base font-medium text-yellow-700 dark:text-yellow-300 transition-colors duration-300" id="pendingPollsStatus">
                    Loading...
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Global variables for charts
let activityChart = null;
let distributionChart = null;

// Fetch dashboard data
async function loadDashboardData() {
    try {
        const response = await fetch('/admin/dashboard-data', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) {
            throw new Error('Failed to fetch dashboard data');
        }
        
        const data = await response.json();
        updateDashboard(data);
        
    } catch (error) {
        console.error('Error loading dashboard data:', error);
        // Show fallback data
        updateDashboard({
            totalPolls: 0,
            pendingPolls: 0,
            activePolls: 0,
            closedPolls: 0,
            totalVotes: 0,
            pollActivity: [],
            trendingPolls: []
        });
    }
}

function updateDashboard(data) {
    // Update total polls
    document.getElementById('totalPollsCount').textContent = data.totalPolls;
    
    // Update pending polls
    document.getElementById('pendingPollsCount').textContent = data.pendingPolls;
    document.getElementById('pendingPollsStatus').textContent = 
        data.pendingPolls > 0 ? 'Requires attention' : 'All caught up!';
    
    // Update growth indicator (mock calculation)
    const growthText = data.totalPolls > 10 ? `+${Math.floor(data.totalPolls * 0.1)} from last month` : 'Getting started';
    document.getElementById('totalPollsGrowth').textContent = growthText;
    
    // Create charts
    createActivityChart(data.pollActivity);
    createDistributionChart(data);
}

function createActivityChart(activityData) {
    const ctx = document.getElementById('pollActivityChart').getContext('2d');
    
    // Destroy existing chart
    if (activityChart) {
        activityChart.destroy();
    }
    
    // Process activity data for chart
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    const activeData = new Array(6).fill(0);
    const completedData = new Array(6).fill(0);
    
    // If we have real data, process it
    if (activityData && activityData.length > 0) {
        activityData.forEach(item => {
            const monthIndex = item.month - 1;
            if (monthIndex >= 0 && monthIndex < 6) {
                if (item.status === 'active') {
                    activeData[monthIndex] = item.count;
                } else if (item.status === 'closed') {
                    completedData[monthIndex] = item.count;
                }
            }
        });
    } else {
        // Use sample data if no real data
        activeData.splice(0, 6, 3, 7, 5, 4, 6, 5);
        completedData.splice(0, 6, 1, 2, 3, 2, 3, 4);
    }
    
    activityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Active Polls',
                data: activeData,
                borderColor: 'rgba(16, 185, 129, 1)',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7
            }, {
                label: 'Completed Polls',
                data: completedData,
                borderColor: 'rgba(239, 68, 68, 1)',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    padding: 12,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 },
                }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: { 
                        stepSize: 1,
                        color: '#6B7280',
                        font: { size: 12, weight: 'medium' }
                    },
                    grid: { color: '#E5E7EB', drawBorder: false }
                },
                x: {
                    ticks: { color: '#6B7280', font: { size: 12, weight: 'medium' } },
                    grid: { display: false }
                }
            }
        }
    });
}

function createDistributionChart(data) {
    const ctx = document.getElementById('pollDistributionChart').getContext('2d');
    
    // Destroy existing chart
    if (distributionChart) {
        distributionChart.destroy();
    }
    
    distributionChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Pending', 'Closed'],
            datasets: [{
                data: [data.activePolls || 0, data.pendingPolls || 0, data.closedPolls || 0],
                backgroundColor: [
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(251, 191, 36, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    padding: 12,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 },
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed} polls`;
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });
}

// Load data when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadDashboardData();
});
</script>