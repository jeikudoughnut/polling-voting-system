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
                        <a href="{{ route('polls') }}" class="hover:text-blue-700 transition-colors duration-200">Poll History</a>
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
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-blue-50/60 transition">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Favorite Fruit</td>
                                    <td class="px-6 py-5 text-gray-600">05/01/2024</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Closed
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-blue-600 font-medium">Banana</td>
                                </tr>
                                <tr class="hover:bg-blue-50/60 transition">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Favorite Color</td>
                                    <td class="px-6 py-5 text-gray-600">04/10/2024</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-400">-</td>
                                </tr>
                                <tr class="hover:bg-blue-50/60 transition">
                                    <td class="px-6 py-5 text-lg text-gray-800 font-medium">Dream Vacation</td>
                                    <td class="px-6 py-5 text-gray-600">03/28/2024</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-base font-semibold shadow-sm">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-400">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Poll Result Details (Horizontal Layout) -->
                <div class="flex-1 bg-white/95 rounded-3xl shadow-xl border border-gray-100/50 p-8 flex flex-col justify-center backdrop-blur-sm">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                        <!-- Left: Question and Options -->
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Favorite Fruit
                            </h2>
                            <ul class="mb-4 text-lg text-gray-700 space-y-2">
                                <li class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                                    Apple
                                </li>
                                <li class="flex items-center font-medium">
                                    <span class="w-3 h-3 rounded-full bg-yellow-400 mr-2"></span>
                                    Banana <span class="ml-2 text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full">(your choice)</span>
                                </li>
                                <li class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-red-400 mr-2"></span>
                                    Orange
                                </li>
                                <li class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-green-400 mr-2"></span>
                                    Mango
                                </li>
                            </ul>
                            <div class="text-lg font-semibold text-gray-800 mt-4 p-3 bg-blue-50 rounded-lg inline-block">
                                Winning option: <span class="text-blue-600">Banana</span>
                            </div>
                        </div>
                        <!-- Right: Pie Chart -->
                        <div class="flex-shrink-0 w-56 h-56 flex items-center justify-center bg-white/80 rounded-full shadow-inner p-2">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Poll Options Bar Chart -->
            <div class="bg-white/95 rounded-3xl shadow-xl border border-gray-100/50 p-8 backdrop-blur-sm">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Vote Distribution
                </h2>
                <div class="space-y-6 max-w-4xl mx-auto">
                    <div>
                        <div class="flex justify-between text-gray-700 mb-2">
                            <span class="font-medium">Apple</span>
                            <span>30%</span>
                        </div>
                        <div class="h-8 bg-blue-100 rounded-lg relative overflow-hidden shadow-inner">
                            <div class="h-8 bg-blue-500 rounded-lg flex items-center justify-end pr-3 transition-all duration-1000" style="width: 30%">
                                <span class="text-sm text-white font-medium">15</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-gray-700 mb-2">
                            <span class="font-medium">Banana</span>
                            <span>50%</span>
                        </div>
                        <div class="h-8 bg-yellow-100 rounded-lg relative overflow-hidden shadow-inner">
                            <div class="h-8 bg-yellow-400 rounded-lg flex items-center justify-end pr-3 transition-all duration-1000" style="width: 50%">
                                <span class="text-sm text-yellow-800 font-medium">25</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-gray-700 mb-2">
                            <span class="font-medium">Orange</span>
                            <span>15%</span>
                        </div>
                        <div class="h-8 bg-red-100 rounded-lg relative overflow-hidden shadow-inner">
                            <div class="h-8 bg-red-400 rounded-lg flex items-center justify-end pr-3 transition-all duration-1000" style="width: 15%">
                                <span class="text-sm text-white font-medium">8</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-gray-700 mb-2">
                            <span class="font-medium">Mango</span>
                            <span>5%</span>
                        </div>
                        <div class="h-8 bg-green-100 rounded-lg relative overflow-hidden shadow-inner">
                            <div class="h-8 bg-green-400 rounded-lg flex items-center justify-end pr-3 transition-all duration-1000" style="width: 5%">
                                <span class="text-sm text-white font-medium">2</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-4 mt-10">
                    <button class="bg-gray-100 hover:bg-gray-200 px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 transition-colors duration-200 flex items-center shadow-sm hover:shadow">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export CSV
                    </button>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center shadow-sm hover:shadow">
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
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('pieChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Apple', 'Banana', 'Orange', 'Mango'],
            datasets: [{
                data: [15, 25, 8, 2], // sample data
                backgroundColor: [
                    '#3b82f6', // blue
                    '#facc15', // yellow
                    '#f87171', // red
                    '#34d399'  // green
                ],
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
                            let percent = ((value / total) * 100).toFixed(1) + '%';
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
});
</script>
