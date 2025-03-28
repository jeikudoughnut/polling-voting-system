<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md w-full p-4 fixed top-0 left-0 right-0 flex items-center justify-between z-50">
        <div class="flex items-center gap-2">
            <button class="p-2" id="menu-button">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl font-semibold">Online Polling and Voting System</h1>
        </div>
        <div class="flex items-center space-x-4">
            <div class="relative w-64">
                <input class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Search..." type="text"/>
                <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
            </div>
            <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-300 shadow-md">
                <img src="{{ asset(path: 'images/jeyk.png') }}" alt="Profile Picture" class="w-full h-full object-cover" />
            </div>

        </div>
    </nav>
</body>
</html>