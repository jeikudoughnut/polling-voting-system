<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-6 text-center tracking-tight drop-shadow-sm">
            Dashboard Overview
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Poll Activity Chart -->
            <div class="relative bg-white rounded-2xl shadow-xl border border-gray-100 flex flex-col items-center justify-center p-6 h-72 group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute top-0 right-0 w-16 h-16 bg-green-100 rounded-full -mr-6 -mt-6 opacity-30"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-green-100 rounded-full -ml-6 -mb-6 opacity-30"></div>
                <h2 class="text-xl font-bold text-green-700 mb-4">Poll Activity</h2>
                <div class="w-full h-40 flex items-center justify-center">
                    <canvas id="pollActivityChart"></canvas>
                </div>
            </div>
            <!-- Poll Distribution Chart -->
            <div class="relative bg-white rounded-2xl shadow-xl border border-gray-100 flex flex-col items-center justify-center p-6 h-72 group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute top-0 right-0 w-16 h-16 bg-purple-100 rounded-full -mr-6 -mt-6 opacity-30"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-purple-100 rounded-full -ml-6 -mb-6 opacity-30"></div>
                <h2 class="text-xl font-bold text-purple-700 mb-4">Poll Distribution</h2>
                <div class="w-full h-40 flex items-center justify-center">
                    <canvas id="pollDistributionChart"></canvas>
                </div>
            </div>
            <!-- Total Polls -->
            <a href="/admin?page=poll-management&tab=all" class="relative bg-gradient-to-br from-blue-100 to-blue-50 rounded-2xl flex flex-col items-center justify-center h-72 shadow-xl border border-blue-100 group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-200 rounded-full -mr-8 -mt-8 opacity-20"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-blue-200 rounded-full -ml-8 -mb-8 opacity-20"></div>
                <div class="bg-blue-200 p-5 rounded-full mb-6 group-hover:scale-110 transition-transform duration-300 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <rect x="4" y="4" width="16" height="16" rx="2" stroke-width="2" stroke="currentColor" fill="none"/>
                        <path d="M9 12l2 2l4-4" stroke="currentColor" stroke-width="2.5" fill="none"/>
                    </svg>
                </div>
                <div class="text-6xl font-black text-blue-700 mb-2 tracking-tight">10</div>
                <div class="text-2xl font-semibold text-blue-600 mb-1">Total Polls</div>
                <div class="flex items-center space-x-1 text-base text-blue-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    <span>+2 from last month</span>
                </div>
            </a>
            <!-- Pending Polls -->
            <a href="/admin?page=poll-management&tab=pending" class="relative bg-gradient-to-br from-yellow-100 to-yellow-50 rounded-2xl flex flex-col items-center justify-center h-72 shadow-xl border border-yellow-100 group hover:scale-[1.02] transition-all duration-300">
                <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-200 rounded-full -mr-8 -mt-8 opacity-20"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-yellow-200 rounded-full -ml-8 -mb-8 opacity-20"></div>
                <div class="bg-yellow-200 p-5 rounded-full mb-6 group-hover:scale-110 transition-transform duration-300 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2.5" fill="none"/>
                        <path d="M12 7v5l3 3" stroke="currentColor" stroke-width="2.5" fill="none"/>
                    </svg>
                </div>
                <div class="text-6xl font-black text-yellow-700 mb-2 tracking-tight">5</div>
                <div class="text-2xl font-semibold text-yellow-600 mb-1">Pending Polls</div>
                <div class="px-4 py-1 bg-yellow-100 rounded-full text-base font-medium text-yellow-700">
                    Requires attention
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Poll Activity Chart
    var activityCtx = document.getElementById('pollActivityChart').getContext('2d');
    var activityChart = new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Active Polls',
                data: [3, 7, 5, 4, 6, 5],
                borderColor: 'rgba(16, 185, 129, 1)',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7
            }, {
                label: 'Completed Polls',
                data: [1, 2, 3, 2, 3, 4],
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
                legend: { position: 'bottom' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Poll Distribution Chart
    var distributionCtx = document.getElementById('pollDistributionChart').getContext('2d');
    var distributionChart = new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Pending', 'Closed'],
            datasets: [{
                data: [6, 3, 1],
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
                legend: { position: 'bottom' }
            },
            cutout: '70%'
        }
    });
</script>