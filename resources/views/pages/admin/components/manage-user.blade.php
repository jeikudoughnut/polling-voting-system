<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-6 text-center tracking-tight drop-shadow-sm">
            User Management
        </h1>
        <div class="max-w-7xl mx-auto">
            <div class="relative bg-white/95 rounded-2xl shadow-xl border border-gray-100 p-8 overflow-hidden">
                <!-- Decorative Circles -->
                <div class="absolute -top-8 -left-8 w-32 h-32 bg-blue-100 rounded-full opacity-20 blur-2xl"></div>
                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-green-100 rounded-full opacity-20 blur-2xl"></div>
                <!-- Users Table Card -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-700 mb-4 border-b-2 border-blue-200 inline-block px-4 pb-2">
                        Users
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left rounded-xl overflow-hidden">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-50 to-green-50">
                                <th class="px-6 py-4 text-lg font-semibold text-blue-700">Email</th>
                                <th class="px-6 py-4 text-lg font-semibold text-blue-700">Username</th>
                                <th class="px-6 py-4 text-lg font-semibold text-blue-700">Status</th>
                                <th class="px-6 py-4 text-lg font-semibold text-blue-700">Role</th>
                                <th class="px-6 py-4 text-lg font-semibold text-blue-700">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-blue-50/60 transition">
                                <td class="px-6 py-5 text-gray-800 font-medium text-lg">RichmondDulduao@gmail.com</td>
                                <td class="px-6 py-5 text-gray-700 text-lg">Richmond Dulduao</td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-base font-semibold shadow">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-base font-semibold shadow">
                                        Admin
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-wrap gap-3">
                                        <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 hover:bg-yellow-100 font-medium transition text-base">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </a>
                                        <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-700 hover:bg-red-100 font-medium transition text-base">
                                            <i class="fas fa-trash mr-2"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/60 transition">
                                <td class="px-6 py-5 text-gray-800 font-medium text-lg">JakeCartsro@gmail.com</td>
                                <td class="px-6 py-5 text-gray-700 text-lg">Jake Cartsro</td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-base font-semibold shadow">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-base font-semibold shadow">
                                        Admin
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-wrap gap-3">
                                        <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 hover:bg-yellow-100 font-medium transition text-base">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </a>
                                        <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-700 hover:bg-red-100 font-medium transition text-base">
                                            <i class="fas fa-trash mr-2"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/60 transition">
                                <td class="px-6 py-5 text-gray-800 font-medium text-lg">Ebafan@gmail.com</td>
                                <td class="px-6 py-5 text-gray-700 text-lg">Eba</td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-base font-semibold shadow">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                        Inactive
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-100 text-gray-700 text-base font-semibold shadow">
                                        User
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-wrap gap-3">
                                        <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 hover:bg-yellow-100 font-medium transition text-base">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </a>
                                        <a href="#" class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-700 hover:bg-red-100 font-medium transition text-base">
                                            <i class="fas fa-trash mr-2"></i> Delete
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
