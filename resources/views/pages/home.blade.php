@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white flex flex-col items-center justify-center px-4 py-12">
    <div class="max-w-4xl w-full text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold text-blue-900 mb-6">
            Online Polling and Voting System
        </h1>
        <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
            Create, manage, and participate in polls with our easy-to-use platform
        </p>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-16">
            @guest
                <a href="{{ route('login') }}" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition-colors">
                    Sign In
                </a>
                <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-lg border border-blue-200 hover:bg-blue-50 transition-colors">
                    Create Account
                </a>
            @else
                @if(auth()->user()->user_type === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition-colors">
                        Admin Dashboard
                    </a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition-colors">
                        User Dashboard
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-8 py-3 bg-white text-red-600 font-semibold rounded-lg shadow-lg border border-red-200 hover:bg-red-50 transition-colors">
                        Logout
                    </button>
                </form>
            @endguest
        </div>
        
        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <div class="bg-blue-100 w-12 h-12 flex items-center justify-center rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Create Custom Polls</h3>
                <p class="text-gray-600">Design polls with multiple question types, customizable options, and detailed settings.</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <div class="bg-green-100 w-12 h-12 flex items-center justify-center rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Real-time Results</h3>
                <p class="text-gray-600">View detailed analytics and results as votes come in with beautiful visualizations.</p>
            </div>
        </div>
    </div>
</div>
@endsection 