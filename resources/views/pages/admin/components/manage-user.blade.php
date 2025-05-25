<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-6 text-center tracking-tight drop-shadow-sm">
            User Management
        </h1>

        <!-- Success/Error Messages -->
        <div id="messageContainer" class="max-w-7xl mx-auto mb-6 hidden">
            <div id="messageAlert" class="px-4 py-3 rounded-xl relative" role="alert">
                <strong class="font-bold" id="messageType"></strong>
                <span class="block sm:inline" id="messageText"></span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 cursor-pointer" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="hideMessage()">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto">
            <div class="relative bg-white/95 rounded-2xl shadow-xl border border-gray-100 p-8 overflow-hidden">
                <!-- Decorative Circles -->
                <div class="absolute -top-8 -left-8 w-32 h-32 bg-blue-100 rounded-full opacity-20 blur-2xl"></div>
                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-green-100 rounded-full opacity-20 blur-2xl"></div>
                
                <!-- Header with Stats -->
                <div class="mb-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                        <h2 class="text-3xl font-bold text-gray-700 mb-4 md:mb-0 border-b-2 border-blue-200 inline-block px-4 pb-2">
                            Users
                        </h2>
                        <button onclick="openCreateUserModal()" class="inline-flex items-center px-5 py-2.5 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 font-medium transition-all duration-200 shadow-lg hover:shadow-xl text-sm">
                            <i class="fas fa-plus mr-2 text-xs"></i> Add New User
                        </button>
                    </div>
                    
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-500 rounded-lg">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-600 font-medium">Total Users</p>
                                    <p class="text-2xl font-bold text-blue-800" id="totalUsers">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-green-50 to-green-100 p-4 rounded-xl border border-green-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-500 rounded-lg">
                                    <i class="fas fa-user-shield text-white"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-600 font-medium">Admins</p>
                                    <p class="text-2xl font-bold text-green-800" id="adminUsers">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 p-4 rounded-xl border border-yellow-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-yellow-500 rounded-lg">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-600 font-medium">Regular Users</p>
                                    <p class="text-2xl font-bold text-yellow-800" id="regularUsers">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-purple-500 rounded-lg">
                                    <i class="fas fa-user-plus text-white"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-purple-600 font-medium">New (30 days)</p>
                                    <p class="text-2xl font-bold text-purple-800" id="recentUsers">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters and Search -->
                <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <div class="flex-1">
                        <input type="text" id="searchInput" placeholder="Search users by name, email, or username..." 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm">
                    </div>
                    <select id="userTypeFilter" class="px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm">
                        <option value="all">All User Types</option>
                        <option value="admin">Admins Only</option>
                        <option value="user">Regular Users Only</option>
                    </select>
                </div>

                <!-- Users Table -->
                <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-inner">
                    <table class="min-w-full text-left">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-50 to-green-50">
                                <th class="px-6 py-4 text-lg font-semibold text-blue-700">User Info</th>
                                <th class="px-6 py-4 text-lg font-semibold text-blue-700">Email</th>
                                <th class="px-6 py-4 text-lg font-semibold text-blue-700">Role</th>
                                <th class="px-6 py-4 text-lg font-semibold text-blue-700">Activity</th>
                                <th class="px-6 py-4 text-lg font-semibold text-blue-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody" class="divide-y divide-gray-100">
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-spinner fa-spin text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-lg font-medium">Loading users...</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create/Edit User Modal -->
    <div id="userModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-t-3xl">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold" id="userModalTitle">Create New User</h2>
                    <button onclick="closeUserModal()" class="text-white hover:text-gray-200 text-2xl font-bold">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-8">
                <form id="userForm">
                    <input type="hidden" id="userId" name="userId">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="userName" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="userName" name="name" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>
                        
                        <div>
                            <label for="userUsername" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                            <input type="text" id="userUsername" name="username"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="userEmail" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" id="userEmail" name="email" required
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    </div>

                    <div class="mt-6">
                        <label for="userType" class="block text-sm font-medium text-gray-700 mb-2">User Role *</label>
                        <select id="userType" name="user_type" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="user">Regular User</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <div class="mt-6">
                        <label for="userPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span id="passwordRequired">*</span>
                            <span id="passwordOptional" class="text-gray-500 text-xs">(leave blank to keep current password)</span>
                        </label>
                        <input type="password" id="userPassword" name="password"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    </div>

                    <div class="flex gap-3 justify-end pt-6 border-t border-gray-200 mt-8">
                        <button onclick="closeUserModal()" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all font-medium shadow-lg text-sm">
                            <span id="submitButtonText">Create User</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-red-100 rounded-full">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 ml-3">Confirm Deletion</h3>
                </div>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this user? This action cannot be undone.</p>
                <div class="flex gap-3 justify-end">
                    <button onclick="closeDeleteModal()" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm">
                        Cancel
                    </button>
                    <button onclick="confirmDeleteUser()" class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium text-sm">
                        Delete User
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Global variables
let allUsers = [];
let currentEditingUser = null;
let userToDelete = null;

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    loadUsers();
    loadUserStats();
    
    // Add event listeners
    document.getElementById('searchInput').addEventListener('input', debounce(filterUsers, 300));
    document.getElementById('userTypeFilter').addEventListener('change', filterUsers);
    document.getElementById('userForm').addEventListener('submit', handleUserSubmit);
});

// Load users
async function loadUsers() {
    try {
        const response = await fetch('/admin/users');
        const data = await response.json();
        
        if (data.success) {
            allUsers = data.users;
            renderUsers();
        } else {
            showMessage('error', 'Failed to load users');
        }
    } catch (error) {
        console.error('Error loading users:', error);
        showMessage('error', 'Failed to load users');
        renderEmptyState();
    }
}

// Load user statistics
async function loadUserStats() {
    try {
        const response = await fetch('/admin/users/stats');
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('totalUsers').textContent = data.stats.total_users;
            document.getElementById('adminUsers').textContent = data.stats.admin_users;
            document.getElementById('regularUsers').textContent = data.stats.regular_users;
            document.getElementById('recentUsers').textContent = data.stats.recent_users;
        }
    } catch (error) {
        console.error('Error loading user stats:', error);
    }
}

// Render users table
function renderUsers() {
    const tbody = document.getElementById('usersTableBody');
    
    if (allUsers.length === 0) {
        renderEmptyState();
        return;
    }
    
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const userTypeFilter = document.getElementById('userTypeFilter').value;
    
    let filteredUsers = allUsers.filter(user => {
        const matchesSearch = user.name.toLowerCase().includes(searchTerm) ||
                            user.email.toLowerCase().includes(searchTerm) ||
                            (user.username && user.username.toLowerCase().includes(searchTerm));
        
        const matchesType = userTypeFilter === 'all' || user.user_type === userTypeFilter;
        
        return matchesSearch && matchesType;
    });
    
    tbody.innerHTML = filteredUsers.map(user => `
        <tr class="hover:bg-blue-50/60 transition">
            <td class="px-6 py-5">
                <div>
                    <div class="text-lg text-gray-800 font-medium">${user.name}</div>
                    ${user.username ? `<div class="text-sm text-gray-600">@${user.username}</div>` : ''}
                    <div class="text-xs text-gray-500">Joined ${user.created_at}</div>
                </div>
            </td>
            <td class="px-6 py-5 text-gray-800 font-medium text-lg">${user.email}</td>
            <td class="px-6 py-5">
                <span class="inline-flex items-center px-4 py-2 rounded-full ${user.user_type === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700'} text-base font-semibold shadow">
                    ${user.user_type === 'admin' ? 'Admin' : 'User'}
                </span>
            </td>
            <td class="px-6 py-5">
                <div class="text-sm text-gray-600">
                    <div>${user.polls_created} polls created</div>
                    <div>${user.votes_count} votes cast</div>
                </div>
            </td>
            <td class="px-6 py-5">
                <div class="flex flex-wrap gap-2">
                    <button onclick="editUser(${user.id})" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-yellow-50 text-yellow-700 hover:bg-yellow-100 font-medium transition text-sm">
                        <i class="fas fa-edit mr-1.5 text-xs"></i> Edit
                    </button>
                    <button onclick="deleteUser(${user.id})" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 font-medium transition text-sm">
                        <i class="fas fa-trash mr-1.5 text-xs"></i> Delete
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

// Render empty state
function renderEmptyState() {
    document.getElementById('usersTableBody').innerHTML = `
        <tr>
            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                <div class="flex flex-col items-center">
                    <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                    <p class="text-lg font-medium">No users found</p>
                </div>
            </td>
        </tr>
    `;
}

// Filter users
function filterUsers() {
    renderUsers();
}

// Debounce function for search
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Modal functions
function openCreateUserModal() {
    currentEditingUser = null;
    document.getElementById('userModalTitle').textContent = 'Create New User';
    document.getElementById('submitButtonText').textContent = 'Create User';
    document.getElementById('passwordRequired').style.display = 'inline';
    document.getElementById('passwordOptional').style.display = 'none';
    document.getElementById('userPassword').required = true;
    document.getElementById('userForm').reset();
    document.getElementById('userModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function editUser(userId) {
    const user = allUsers.find(u => u.id === userId);
    if (!user) return;
    
    currentEditingUser = user;
    document.getElementById('userModalTitle').textContent = 'Edit User';
    document.getElementById('submitButtonText').textContent = 'Update User';
    document.getElementById('passwordRequired').style.display = 'none';
    document.getElementById('passwordOptional').style.display = 'inline';
    document.getElementById('userPassword').required = false;
    
    // Populate form
    document.getElementById('userId').value = user.id;
    document.getElementById('userName').value = user.name;
    document.getElementById('userUsername').value = user.username || '';
    document.getElementById('userEmail').value = user.email;
    document.getElementById('userType').value = user.user_type;
    document.getElementById('userPassword').value = '';
    
    document.getElementById('userModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeUserModal() {
    document.getElementById('userModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    currentEditingUser = null;
}

function deleteUser(userId) {
    const user = allUsers.find(u => u.id === userId);
    if (!user) return;
    
    userToDelete = user;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    userToDelete = null;
}

// Handle form submission
async function handleUserSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const userData = Object.fromEntries(formData.entries());
    
    try {
        let url, method;
        if (currentEditingUser) {
            url = `/admin/users/${currentEditingUser.id}`;
            method = 'PUT';
        } else {
            url = '/admin/users';
            method = 'POST';
        }
        
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(userData)
        });
        
        const data = await response.json();
        
        if (data.success) {
            showMessage('success', data.message);
            closeUserModal();
            loadUsers();
            loadUserStats();
        } else {
            showMessage('error', data.message);
        }
    } catch (error) {
        console.error('Error saving user:', error);
        showMessage('error', 'Failed to save user. Please try again.');
    }
}

// Confirm delete user
async function confirmDeleteUser() {
    if (!userToDelete) return;
    
    try {
        const response = await fetch(`/admin/users/${userToDelete.id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showMessage('success', data.message);
            closeDeleteModal();
            loadUsers();
            loadUserStats();
        } else {
            showMessage('error', data.message);
        }
    } catch (error) {
        console.error('Error deleting user:', error);
        showMessage('error', 'Failed to delete user. Please try again.');
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
        alert.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative';
    } else {
        alert.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative';
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

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    const userModal = document.getElementById('userModal');
    const deleteModal = document.getElementById('deleteModal');
    
    if (e.target === userModal) {
        closeUserModal();
    }
    if (e.target === deleteModal) {
        closeDeleteModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (!document.getElementById('userModal').classList.contains('hidden')) {
            closeUserModal();
        }
        if (!document.getElementById('deleteModal').classList.contains('hidden')) {
            closeDeleteModal();
        }
    }
});
</script>
