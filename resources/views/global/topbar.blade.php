<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-50">
    <div class="flex justify-between items-center p-4 bg-gradient-to-r from-white to-gray-50 shadow-lg border-b border-gray-200">
        <div class="flex items-center space-x-4">
            <button class="p-2 rounded-lg hover:bg-blue-50 transition-all duration-200">
                <i class="fas fa-bars text-xl text-gray-700 hover:text-blue-600"></i>
            </button>
            <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                Online Polling and Voting System
            </span>
        </div>
        <div class="flex items-center space-x-6">
            <div class="relative w-96">
                <input 
                    class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-200 
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           bg-gray-50 hover:bg-white transition-all duration-200
                           placeholder-gray-400 text-gray-700" 
                    placeholder="Search polls, users, or settings..." 
                    type="text"
                />
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-lg hover:bg-gray-100 transition-all duration-200">
                    <i class="fas fa-bell text-xl text-gray-600 hover:text-blue-600"></i>
                </button>
                <div class="relative group">
                    <div class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-all duration-200 cursor-pointer">
                        <img 
                            alt="User profile picture" 
                            class="rounded-full border-2 border-gray-200 w-10 h-10 object-cover
                                   transition duration-200 hover:border-blue-500 hover:shadow-lg" 
                            src="../../images/jeyk.jpg"
                        />
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-gray-700">Jake</span>
                            <span class="text-xs text-gray-500">Administrator</span>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                    </div>
                    <span class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 border-2 border-white rounded-full"></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>