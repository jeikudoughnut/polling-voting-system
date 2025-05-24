@extends('layouts.app')

@section('title', 'Poll Details - ' . $poll->poll_title)

@section('content')

@include('global.topbar')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800">{{ $poll->poll_title }}</h1>
                    <p class="text-gray-600 mt-2">Created by {{ $poll->creator->name ?? 'Unknown' }} on {{ $poll->formatted_creation_date }}</p>
                </div>
                <a href="{{ route('admin.dashboard') }}?page=poll-management" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Polls
                </a>
            </div>
        </div>

        <!-- Poll Info Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Status -->
                <div class="text-center">
                    <div class="text-sm text-gray-500 mb-2">Status</div>
                    @if($poll->status === 'active')
                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-lg font-semibold">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                            Active
                        </span>
                    @elseif($poll->status === 'pending')
                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-lg font-semibold">
                            <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                            Pending
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-lg font-semibold">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                            Closed
                        </span>
                    @endif
                </div>

                <!-- Total Votes -->
                <div class="text-center">
                    <div class="text-sm text-gray-500 mb-2">Total Votes</div>
                    <div class="text-3xl font-bold text-blue-600">{{ $poll->votes->count() }}</div>
                </div>

                <!-- End Date -->
                <div class="text-center">
                    <div class="text-sm text-gray-500 mb-2">End Date</div>
                    <div class="text-lg font-medium text-gray-700">
                        {{ $poll->end_date ? $poll->formatted_end_date : 'No expiration' }}
                    </div>
                </div>
            </div>

            @if($poll->poll_description)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Description</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $poll->poll_description }}</p>
                </div>
            @endif
        </div>

        <!-- Questions and Results -->
        @foreach($poll->questions as $question)
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ $question->question_text }}</h2>
                
                <div class="space-y-4">
                    @php
                        $totalVotes = $question->votes->count();
                    @endphp
                    
                    @foreach($question->options as $option)
                        @php
                            $optionVotes = $option->votes->count();
                            $percentage = $totalVotes > 0 ? round(($optionVotes / $totalVotes) * 100, 1) : 0;
                        @endphp
                        
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-medium text-gray-800">{{ $option->option_text }}</span>
                                <span class="text-sm text-gray-600">{{ $optionVotes }} votes ({{ $percentage }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-blue-500 h-3 rounded-full transition-all duration-500" 
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                    
                    @if($totalVotes === 0)
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-vote-yea text-4xl mb-4"></i>
                            <p class="text-lg">No votes yet</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Actions -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Actions</h3>
            <div class="flex flex-wrap gap-4">
                @if($poll->status === 'active')
                    <form action="{{ route('admin.polls.status', $poll) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="closed">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white rounded-xl hover:bg-yellow-700 transition-colors">
                            <i class="fas fa-stop mr-2"></i> Close Poll
                        </button>
                    </form>
                @elseif($poll->status === 'pending')
                    <form action="{{ route('admin.polls.status', $poll) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="active">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-colors">
                            <i class="fas fa-check mr-2"></i> Approve Poll
                        </button>
                    </form>
                    <form action="{{ route('admin.polls.status', $poll) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="closed">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                            <i class="fas fa-times mr-2"></i> Reject Poll
                        </button>
                    </form>
                @endif
                
                <form action="{{ route('admin.polls.destroy', $poll) }}" method="POST" class="inline" 
                      onsubmit="return confirm('Are you sure you want to delete this poll? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                        <i class="fas fa-trash mr-2"></i> Delete Poll
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection 