<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-6 text-center tracking-tight drop-shadow-sm">
            Create Poll
        </h1>
        <div class="max-w-6xl mx-auto">
            <div class="bg-white/95 rounded-2xl shadow-2xl border border-gray-100 p-8 relative overflow-hidden">
                <!-- Decorative Circles -->
                <div class="absolute -top-8 -left-8 w-32 h-32 bg-blue-100 rounded-full opacity-20 blur-2xl"></div>
                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-yellow-100 rounded-full opacity-20 blur-2xl"></div>
                
                <!-- Title -->
                <div class="mb-8">
                    <label class="block text-xl md:text-2xl font-bold text-gray-800 mb-2">Title</label>
                    <input type="text" class="w-full px-5 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg bg-gray-50 placeholder-gray-400 transition" placeholder="Type your question here">
                </div>
                <!-- Options -->
                <div class="mb-8">
                    <label class="block text-xl md:text-2xl font-bold text-gray-800 mb-2">Options</label>
                    <input type="text" class="w-full mb-3 px-5 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg bg-gray-50 placeholder-gray-400 transition" placeholder="Option 1">
                    <input type="text" class="w-full mb-3 px-5 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg bg-gray-50 placeholder-gray-400 transition" placeholder="Option 2">
                    <div class="flex items-center gap-2 mt-1">
                        <button type="button" class="inline-flex items-center px-4 py-2 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 font-medium transition">
                            <i class="fas fa-plus mr-2"></i> Add option
                        </button>
                        <span class="mx-1 text-gray-500">or</span>
                        <button type="button" class="text-blue-600 hover:underline text-base font-medium">
                            Add "Other"
                        </button>
                    </div>
                </div>
                <hr class="my-8 border-gray-100">
                <!-- Settings -->
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Left: Settings -->
                    <div class="flex-1">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4">Settings</h2>
                        <div class="flex items-center justify-between mb-5">
                            <span class="text-gray-700 text-base">Allow selection of multiple options</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-500 peer-checked:bg-blue-600 transition"></div>
                                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md peer-checked:translate-x-5 transition"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-gray-700 text-base">Close poll on a scheduled time</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="scheduleToggle">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-500 peer-checked:bg-blue-600 transition"></div>
                                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md peer-checked:translate-x-5 transition"></div>
                            </label>
                        </div>
                        <div class="ml-8 mt-2 hidden" id="datetimeInput">
                            <input type="datetime-local" class="w-60 max-w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base bg-gray-50 placeholder-gray-400 transition" placeholder="mm/dd/yy --:--">
                        </div>
                    </div>

                    <!-- Vertical Divider -->
                    <div class="hidden md:flex items-stretch mx-2">
                        <div class="border-l border-gray-100"></div>
                    </div>

                    <!-- Right: Require name and Create button -->
                    <div class="flex-1 flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-8">
                            <span class="text-gray-700 text-base">Require participant name</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-500 peer-checked:bg-blue-600 transition"></div>
                                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md peer-checked:translate-x-5 transition"></div>
                            </label>
                        </div>
                        <button class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-blue-600 text-white hover:bg-blue-700 font-semibold transition shadow-sm hover:shadow-md">
                            <i class="fas fa-plus mr-2"></i> Create Poll
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scheduleToggle = document.getElementById('scheduleToggle');
    const datetimeInput = document.getElementById('datetimeInput');

    scheduleToggle.addEventListener('change', function() {
        if (this.checked) {
            datetimeInput.classList.remove('hidden');
        } else {
            datetimeInput.classList.add('hidden');
        }
    });
});
</script>
