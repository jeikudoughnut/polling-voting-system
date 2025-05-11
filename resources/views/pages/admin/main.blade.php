@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

@include('global.topbar')

<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside class="bg-white w-72 shadow-xl border-r border-gray-100">
        <!-- Navigation -->
        <nav class="p-6">
            <ul class="space-y-3">
                <li>
                    <a class="relative flex items-center p-4 text-gray-700 text-base hover:bg-blue-50 hover:text-blue-600 rounded-2xl transition-all duration-300 group {{ request()->get('page', 'dashboard') == 'dashboard' ? 'bg-blue-50 text-blue-600 shadow-sm' : '' }}" 
                       href="?page=dashboard">
                        <div class="absolute inset-0 bg-blue-100 opacity-0 group-hover:opacity-10 rounded-2xl transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100 group-hover:bg-blue-200 transition-colors duration-300 {{ request()->get('page', 'dashboard') == 'dashboard' ? 'bg-blue-200' : '' }}">
                            <i class="fas fa-chart-pie text-blue-600 group-hover:text-blue-700 {{ request()->get('page', 'dashboard') == 'dashboard' ? 'text-blue-700' : '' }}"></i>
                        </div>
                        <span class="ml-4 font-medium">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="relative flex items-center p-4 text-gray-700 text-base hover:bg-yellow-50 hover:text-yellow-600 rounded-2xl transition-all duration-300 group {{ request()->get('page') == 'create-poll' ? 'bg-yellow-50 text-yellow-600 shadow-sm' : '' }}" 
                       href="?page=create-poll">
                        <div class="absolute inset-0 bg-yellow-100 opacity-0 group-hover:opacity-10 rounded-2xl transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-yellow-200 group-hover:bg-yellow-300 transition-colors duration-300 {{ request()->get('page') == 'create-poll' ? 'bg-yellow-300' : '' }}">
                            <i class="fas fa-poll text-yellow-600 group-hover:text-yellow-700 {{ request()->get('page') == 'create-poll' ? 'text-yellow-700' : '' }}"></i>
                        </div>
                        <span class="ml-4 font-medium">Poll Management</span>
                    </a>
                </li>
                <li>
                    <a class="relative flex items-center p-4 text-gray-700 text-base hover:bg-green-50 hover:text-green-600 rounded-2xl transition-all duration-300 group {{ request()->get('page') == 'manage-user' ? 'bg-green-50 text-green-600 shadow-sm' : '' }}" 
                       href="?page=manage-user">
                        <div class="absolute inset-0 bg-green-100 opacity-0 group-hover:opacity-10 rounded-2xl transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-green-200 group-hover:bg-green-300 transition-colors duration-300 {{ request()->get('page') == 'manage-user' ? 'bg-green-300' : '' }}">
                            <i class="fas fa-users-cog text-green-600 group-hover:text-green-700 {{ request()->get('page') == 'manage-user' ? 'text-green-700' : '' }}"></i>
                        </div>
                        <span class="ml-4 font-medium">Manage User</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 bg-gray-50">
        @php
            $page = request()->get('page', 'dashboard');
        @endphp

        <div class="max-w-7xl mx-auto">
            @if($page == 'create-poll')
                @include('pages.admin.components.create-poll')
            @elseif($page == 'dashboard')
                @include('pages.admin.components.dashboard')
            @elseif($page == 'manage-user')
                @include('pages.admin.components.manage-user')
            @else
                <div class="bg-white rounded-xl p-8 shadow-sm">
                    <p class="text-gray-700 text-lg">Page not found.</p>
                </div>
            @endif
        </div>
    </main>
</div>

@endsection