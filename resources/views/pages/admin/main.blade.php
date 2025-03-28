@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

@include('global.topbar')

<div class="flex min-h-screen border border-gray-300">
    <!-- Sidebar -->
    <aside class="bg-white w-64 p-6 h-screen shadow-lg border-r border-gray-50 rounded-lg">
        <ul class="space-y-2">
            <li>
                <a class="flex items-center p-3 text-gray-700 text-xl hover:bg-gray-200 rounded-lg" href="?page=dashboard">
                    <i class="fas fa-chart-pie mr-3"></i>
                    <span class="whitespace-nowrap">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="flex items-center p-3 text-gray-700 text-xl hover:bg-gray-200 rounded-lg" href="?page=create-poll">
                    <i class="fas fa-poll mr-3"></i>
                    <span class="whitespace-nowrap">Poll Approval</span>
                </a>
            </li>
            <li>
                <a class="flex items-center p-3 text-gray-700 text-xl hover:bg-gray-200 rounded-lg" href="?page=manage-user">
                    <i class="fas fa-users-cog mr-3"></i>
                    <span class="whitespace-nowrap">User Management</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 bg-gray-100 border-l border-gray-300">
        @php
            $page = request()->get('page', 'dashboard');
        @endphp

        @if($page == 'create-poll')
            @include('pages.admin.components.create-poll')
        @elseif($page == 'dashboard')
            @include('pages.admin.components.dashboard')
        @elseif($page == 'manage-user')
            @include('pages.admin.components.manage-user')
        @else
            <p class="text-gray-700 text-lg">Page not found.</p>
        @endif
    </main>
</div>

@endsection
