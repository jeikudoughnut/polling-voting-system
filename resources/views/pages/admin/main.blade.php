@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

@include('global.topbar')

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white p-5">
        <h2 class="text-lg font-semibold mb-4">Admin Panel</h2>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="?page=dashboard" class="block px-4 py-2 bg-gray-700 rounded hover:bg-gray-600 transition">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="?page=create-poll" class="block px-4 py-2 bg-gray-700 rounded hover:bg-gray-600 transition">
                        Create Poll
                    </a>
                </li>
                <li>
                    <a href="?page=manage-user" class="block px-4 py-2 bg-gray-700 rounded hover:bg-gray-600 transition">
                        Manage Users
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-100">
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
            <p class="text-gray-700">Page not found.</p>
        @endif
    </main>

</div>

@endsection
