@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

@include('global.topbar')

<div class="flex min-h-screen border border-gray-300">
    <!-- Sidebar -->
    <aside class="bg-white w-80 p-8 h-screen shadow-lg border-r border-gray-50">
        <ul>
            <li class="mb-6">
                <a class="flex items-center text-gray-700 text-xl hover:text-blue-600" href="?page=dashboard">
                    <i class="fas fa-tachometer-alt mr-4"></i>
                    Dashboard
                </a>
            </li>
            <li class="mb-6">
                <a class="flex items-center text-gray-700 text-xl hover:text-blue-600" href="?page=create-poll">
                    <i class="fas fa-check-circle mr-4"></i>
                    Poll Approval
                </a>
            </li>
            <li class="mb-6">
                <a class="flex items-center text-gray-700 text-xl hover:text-blue-600" href="?page=manage-user">
                    <i class="fas fa-users mr-4"></i>
                    User Management
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
