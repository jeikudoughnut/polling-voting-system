@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

@include('global.topbar')

<div class="flex min-h-screen bg-gray-50 dark:bg-dark-900 transition-colors duration-300">
    <!-- Sidebar -->
    <aside class="bg-white dark:bg-dark-800 w-72 shadow-xl border-r border-gray-100 dark:border-dark-700 transition-colors duration-300">
        <!-- Navigation -->
        <nav class="p-6">
            <ul class="space-y-3">
                <li>
                    <a class="relative flex items-center p-4 text-gray-700 dark:text-dark-200 text-base hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-2xl transition-all duration-300 group {{ request()->get('page', 'dashboard') == 'dashboard' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 shadow-sm' : '' }}" 
                       href="?page=dashboard">
                        <div class="absolute inset-0 bg-blue-100 dark:bg-blue-800 opacity-0 group-hover:opacity-10 dark:group-hover:opacity-20 rounded-2xl transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-800 group-hover:bg-blue-200 dark:group-hover:bg-blue-700 transition-colors duration-300 {{ request()->get('page', 'dashboard') == 'dashboard' ? 'bg-blue-200 dark:bg-blue-700' : '' }}">
                            <i class="fas fa-chart-pie text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300 {{ request()->get('page', 'dashboard') == 'dashboard' ? 'text-blue-700 dark:text-blue-300' : '' }}"></i>
                        </div>
                        <span class="ml-4 font-medium">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="relative flex items-center p-4 text-gray-700 dark:text-dark-200 text-base hover:bg-yellow-50 dark:hover:bg-yellow-900/20 hover:text-yellow-600 dark:hover:text-yellow-400 rounded-2xl transition-all duration-300 group {{ request()->get('page') == 'poll-management' ? 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 shadow-sm' : '' }}" 
                       href="?page=poll-management">
                        <div class="absolute inset-0 bg-yellow-100 dark:bg-yellow-800 opacity-0 group-hover:opacity-10 dark:group-hover:opacity-20 rounded-2xl transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-yellow-200 dark:bg-yellow-800 group-hover:bg-yellow-300 dark:group-hover:bg-yellow-700 transition-colors duration-300 {{ request()->get('page') == 'poll-management' ? 'bg-yellow-300 dark:bg-yellow-700' : '' }}">
                            <i class="fas fa-poll text-yellow-600 dark:text-yellow-400 group-hover:text-yellow-700 dark:group-hover:text-yellow-300 {{ request()->get('page') == 'poll-management' ? 'text-yellow-700 dark:text-yellow-300' : '' }}"></i>
                        </div>
                        <span class="ml-4 font-medium">Poll Management</span>
                    </a>
                </li>
                <li>
                    <a class="relative flex items-center p-4 text-gray-700 dark:text-dark-200 text-base hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-600 dark:hover:text-green-400 rounded-2xl transition-all duration-300 group {{ request()->get('page') == 'manage-user' ? 'bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 shadow-sm' : '' }}" 
                       href="?page=manage-user">
                        <div class="absolute inset-0 bg-green-100 dark:bg-green-800 opacity-0 group-hover:opacity-10 dark:group-hover:opacity-20 rounded-2xl transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-green-200 dark:bg-green-800 group-hover:bg-green-300 dark:group-hover:bg-green-700 transition-colors duration-300 {{ request()->get('page') == 'manage-user' ? 'bg-green-300 dark:bg-green-700' : '' }}">
                            <i class="fas fa-users-cog text-green-600 dark:text-green-400 group-hover:text-green-700 dark:group-hover:text-green-300 {{ request()->get('page') == 'manage-user' ? 'text-green-700 dark:text-green-300' : '' }}"></i>
                        </div>
                        <span class="ml-4 font-medium">Manage User</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 bg-gray-50 dark:bg-dark-900 transition-colors duration-300">
        @php
            $page = request()->get('page', 'dashboard');
        @endphp

        <div class="max-w-7xl mx-auto">
            @if($page == 'poll-management')
                @include('pages.admin.components.poll-management')
            @elseif($page == 'dashboard')
                @include('pages.admin.components.dashboard')
            @elseif($page == 'manage-user')
                @include('pages.admin.components.manage-user')
            @else
                <div class="bg-white dark:bg-dark-800 rounded-xl p-8 shadow-sm border border-gray-100 dark:border-dark-700 transition-colors duration-300">
                    <p class="text-gray-700 dark:text-dark-200 text-lg">Page not found.</p>
                </div>
            @endif
        </div>
    </main>
</div>

@endsection