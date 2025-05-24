<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-6 text-center tracking-tight drop-shadow-sm">
            Poll Management
        </h1>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="max-w-6xl mx-auto mb-6">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none'">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                        </svg>
                    </span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-6xl mx-auto mb-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none'">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                        </svg>
                    </span>
                </div>
            </div>
        @endif

        <div class="max-w-6xl mx-auto">
            <div class="bg-white/95 rounded-2xl shadow-2xl border border-gray-100 p-8 relative overflow-hidden">
                <!-- Decorative Circles -->
                <div class="absolute -top-8 -left-8 w-32 h-32 bg-blue-100 rounded-full opacity-20 blur-2xl"></div>
                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-yellow-100 rounded-full opacity-20 blur-2xl"></div>
                <!-- Tabs with Floating Indicator -->
                <div class="flex relative mb-8">
                    <button id="tab-all"
                        class="relative z-10 py-3 px-10 text-xl font-semibold transition-all duration-200 focus:outline-none text-blue-600 border-b-2 border-blue-500"
                        onclick="showTab('all')">
                        All Polls
                    </button>
                    <button id="tab-pending"
                        class="relative z-10 py-3 px-10 text-xl font-semibold transition-all duration-200 focus:outline-none text-gray-500 border-b-2 border-transparent hover:text-yellow-600 hover:border-yellow-400"
                        onclick="showTab('pending')">
                        Pending Polls
                    </button>
                </div>

                <!-- Create New Poll Button -->
                <div class="mb-6 text-center">
                    <button onclick="openCreatePollModal()" 
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 shadow-xl hover:shadow-2xl">
                        <i class="fas fa-plus mr-3 text-lg"></i>
                        Create New Poll
                    </button>
                </div>

                <!-- All Polls Table -->
                <div id="tab-content-all">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left rounded-xl overflow-hidden">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-50 to-green-50">
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Poll</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Status</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Created</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-blue-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @php
                                    $allPolls = App\Models\Poll::with(['questions.options', 'creator'])->orderBy('creation_date', 'desc')->get();
                                @endphp
                                @forelse($allPolls as $poll)
                                    <tr class="hover:bg-blue-50/60 transition">
                                        <td class="px-6 py-5">
                                            <div>
                                                <div class="text-lg text-gray-800 font-medium">{{ $poll->poll_title }}</div>
                                                @if($poll->poll_description)
                                                    <div class="text-sm text-gray-600 mt-1">{{ Str::limit($poll->poll_description, 100) }}</div>
                                                @endif
                                                <div class="text-xs text-gray-500 mt-1">by {{ $poll->creator->name ?? 'Unknown' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($poll->status === 'active')
                                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-base font-semibold shadow">
                                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                                    Active
                                                </span>
                                            @elseif($poll->status === 'pending')
                                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-base font-semibold shadow">
                                                    <svg class="w-4 h-4 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                                    Pending
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-base font-semibold shadow">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                                                    Closed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="text-sm text-gray-600">{{ $poll->formatted_creation_date }}</div>
                                            @if($poll->end_date)
                                                <div class="text-xs text-gray-500">Expires: {{ $poll->formatted_end_date }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex flex-wrap gap-3">
                                                <a href="{{ route('admin.polls.show', $poll) }}" class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 text-blue-700 hover:bg-blue-100 font-medium transition">
                                                    <i class="fas fa-eye mr-2"></i> View
                                                </a>
                                                @if($poll->status === 'active')
                                                    <form action="{{ route('admin.polls.status', $poll) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="closed">
                                                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 hover:bg-yellow-100 font-medium transition">
                                                            <i class="fas fa-stop mr-2"></i> Close
                                                        </button>
                                                    </form>
                                                @elseif($poll->status === 'pending')
                                                    <form action="{{ route('admin.polls.status', $poll) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="active">
                                                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-full bg-green-50 text-green-700 hover:bg-green-100 font-medium transition">
                                                            <i class="fas fa-check mr-2"></i> Approve
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.polls.destroy', $poll) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this poll?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-700 hover:bg-red-100 font-medium transition">
                                                        <i class="fas fa-trash mr-2"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-poll text-4xl text-gray-300 mb-4"></i>
                                                <p class="text-lg font-medium">No polls found</p>
                                                <p class="text-sm">Create your first poll to get started!</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pending Polls Table -->
                <div id="tab-content-pending" class="hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left rounded-xl overflow-hidden">
                            <thead>
                                <tr class="bg-gradient-to-r from-yellow-50 to-green-50">
                                    <th class="px-6 py-4 text-lg font-semibold text-yellow-700">Poll</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-yellow-700">Created</th>
                                    <th class="px-6 py-4 text-lg font-semibold text-yellow-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @php
                                    $pendingPolls = App\Models\Poll::where('status', 'pending')->with(['questions.options', 'creator'])->orderBy('creation_date', 'desc')->get();
                                @endphp
                                @forelse($pendingPolls as $poll)
                                    <tr class="hover:bg-yellow-50/60 transition">
                                        <td class="px-6 py-5">
                                            <div>
                                                <div class="text-lg text-gray-800 font-medium">{{ $poll->poll_title }}</div>
                                                @if($poll->poll_description)
                                                    <div class="text-sm text-gray-600 mt-1">{{ Str::limit($poll->poll_description, 100) }}</div>
                                                @endif
                                                <div class="text-xs text-gray-500 mt-1">by {{ $poll->creator->name ?? 'Unknown' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="text-sm text-gray-600">{{ $poll->formatted_creation_date }}</div>
                                            @if($poll->end_date)
                                                <div class="text-xs text-gray-500">Expires: {{ $poll->formatted_end_date }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex flex-wrap gap-3">
                                                <form action="{{ route('admin.polls.status', $poll) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-full bg-green-50 text-green-700 hover:bg-green-100 font-medium transition">
                                                        <i class="fas fa-check mr-2"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.polls.status', $poll) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="closed">
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-full bg-red-50 text-red-700 hover:bg-red-100 font-medium transition">
                                                        <i class="fas fa-times mr-2"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-clock text-4xl text-gray-300 mb-4"></i>
                                                <p class="text-lg font-medium">No pending polls</p>
                                                <p class="text-sm">All polls have been reviewed!</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Poll Modal -->
    <div id="createPollModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6 rounded-t-3xl">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Create New Poll</h2>
                    <button onclick="closeCreatePollModal()" class="text-white hover:text-gray-200 text-2xl font-bold">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-8">
                <form id="createPollForm" action="{{ route('admin.polls.store') }}" method="POST">
                    @csrf
                    
                    <!-- Poll Title -->
                    <div class="mb-6">
                        <label for="pollTitle" class="block text-lg font-semibold text-gray-700 mb-3">
                            Poll Title *
                        </label>
                        <input type="text" 
                               id="pollTitle" 
                               name="poll_title" 
                               required
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors text-lg @error('poll_title') border-red-500 @enderror"
                               placeholder="Enter your poll question"
                               value="{{ old('poll_title') }}">
                        @error('poll_title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Poll Description -->
                    <div class="mb-6">
                        <label for="pollDescription" class="block text-lg font-semibold text-gray-700 mb-3">
                            Description (Optional)
                        </label>
                        <textarea id="pollDescription" 
                                  name="poll_description" 
                                  rows="3"
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors resize-none @error('poll_description') border-red-500 @enderror"
                                  placeholder="Provide additional details about your poll">{{ old('poll_description') }}</textarea>
                        @error('poll_description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Question Text -->
                    <div class="mb-6">
                        <label for="questionText" class="block text-lg font-semibold text-gray-700 mb-3">
                            Question *
                        </label>
                        <input type="text" 
                               id="questionText" 
                               name="question_text" 
                               required
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors text-lg @error('question_text') border-red-500 @enderror"
                               placeholder="What question do you want to ask?"
                               value="{{ old('question_text') }}">
                        @error('question_text')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Poll Options -->
                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-3">
                            Answer Options *
                        </label>
                        <div id="optionsContainer">
                            <!-- Initial options -->
                            @if(old('options'))
                                @foreach(old('options') as $index => $option)
                                    <div class="option-group mb-3 flex items-center gap-3">
                                        <input type="text" 
                                               name="options[]" 
                                               required
                                               class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors"
                                               placeholder="Option {{ $index + 1 }}"
                                               value="{{ $option }}">
                                        <button type="button" 
                                                onclick="removeOption(this)" 
                                                class="px-3 py-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition-colors {{ $index < 2 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                {{ $index < 2 ? 'disabled' : '' }}>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="option-group mb-3 flex items-center gap-3">
                                    <input type="text" 
                                           name="options[]" 
                                           required
                                           class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors"
                                           placeholder="Option 1">
                                    <button type="button" 
                                            onclick="removeOption(this)" 
                                            class="px-3 py-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition-colors opacity-50 cursor-not-allowed"
                                            disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="option-group mb-3 flex items-center gap-3">
                                    <input type="text" 
                                           name="options[]" 
                                           required
                                           class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors"
                                           placeholder="Option 2">
                                    <button type="button" 
                                            onclick="removeOption(this)" 
                                            class="px-3 py-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition-colors opacity-50 cursor-not-allowed"
                                            disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Add Option Button -->
                        <button type="button" 
                                onclick="addOption()" 
                                class="mt-3 inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-xl hover:bg-green-200 transition-colors font-medium">
                            <i class="fas fa-plus mr-2"></i>
                            Add Option
                        </button>
                        
                        <p class="text-sm text-gray-500 mt-2">Minimum 2 options required</p>
                        @error('options')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Poll Settings -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Poll Settings</h3>
                        
                        <!-- Question Type -->
                        <div class="mb-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       name="allow_multiple" 
                                       id="allowMultiple"
                                       value="1"
                                       class="w-5 h-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500"
                                       {{ old('allow_multiple') ? 'checked' : '' }}>
                                <span class="ml-3 text-gray-700 font-medium">Allow multiple selections</span>
                            </label>
                            <p class="text-sm text-gray-500 mt-1">If unchecked, users can only select one option</p>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 font-medium mb-2">
                                Poll Status
                            </label>
                            <select name="status" 
                                    id="status"
                                    class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending Approval</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active (Auto-approve)</option>
                            </select>
                        </div>

                        <!-- End Date -->
                        <div class="mb-4">
                            <label for="endDate" class="block text-gray-700 font-medium mb-2">
                                End Date (Optional)
                            </label>
                            <input type="datetime-local" 
                                   id="endDate" 
                                   name="end_date"
                                   value="{{ old('end_date') }}"
                                   class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors">
                            <p class="text-sm text-gray-500 mt-1">Leave empty for no expiration</p>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-4 justify-end pt-6 border-t border-gray-200">
                        <button type="button" 
                                onclick="closeCreatePollModal()"
                                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all font-medium shadow-lg">
                            <span class="submit-text">Create Poll</span>
                            <span class="loading-text hidden">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Creating...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tab) {
    document.getElementById('tab-content-all').classList.toggle('hidden', tab !== 'all');
    document.getElementById('tab-content-pending').classList.toggle('hidden', tab !== 'pending');
    // Tab active state
    document.getElementById('tab-all').classList.toggle('text-blue-600', tab === 'all');
    document.getElementById('tab-all').classList.toggle('border-blue-500', tab === 'all');
    document.getElementById('tab-all').classList.toggle('text-gray-500', tab !== 'all');
    document.getElementById('tab-all').classList.toggle('border-transparent', tab !== 'all');
    document.getElementById('tab-pending').classList.toggle('text-yellow-600', tab === 'pending');
    document.getElementById('tab-pending').classList.toggle('border-yellow-400', tab === 'pending');
    document.getElementById('tab-pending').classList.toggle('text-gray-500', tab !== 'pending');
    document.getElementById('tab-pending').classList.toggle('border-transparent', tab !== 'pending');
}

// Modal Functions
function openCreatePollModal() {
    document.getElementById('createPollModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeCreatePollModal() {
    document.getElementById('createPollModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    resetForm();
}

function resetForm() {
    document.getElementById('createPollForm').reset();
    // Reset options to initial 2
    const container = document.getElementById('optionsContainer');
    container.innerHTML = `
        <div class="option-group mb-3 flex items-center gap-3">
            <input type="text" 
                   name="options[]" 
                   required
                   class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors"
                   placeholder="Option 1">
            <button type="button" 
                    onclick="removeOption(this)" 
                    class="px-3 py-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition-colors"
                    disabled>
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="option-group mb-3 flex items-center gap-3">
            <input type="text" 
                   name="options[]" 
                   required
                   class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors"
                   placeholder="Option 2">
            <button type="button" 
                    onclick="removeOption(this)" 
                    class="px-3 py-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition-colors"
                    disabled>
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    updateRemoveButtons();
}

// Option Management Functions
let optionCount = 2;

function addOption() {
    optionCount++;
    const container = document.getElementById('optionsContainer');
    const newOption = document.createElement('div');
    newOption.className = 'option-group mb-3 flex items-center gap-3';
    newOption.innerHTML = `
        <input type="text" 
               name="options[]" 
               required
               class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors"
               placeholder="Option ${optionCount}">
        <button type="button" 
                onclick="removeOption(this)" 
                class="px-3 py-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition-colors">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(newOption);
    updateRemoveButtons();
}

function removeOption(button) {
    const optionGroup = button.closest('.option-group');
    optionGroup.remove();
    optionCount--;
    updateRemoveButtons();
    updatePlaceholders();
}

function updateRemoveButtons() {
    const removeButtons = document.querySelectorAll('#optionsContainer .option-group button');
    const hasMinimum = removeButtons.length <= 2;
    
    removeButtons.forEach(button => {
        button.disabled = hasMinimum;
        if (hasMinimum) {
            button.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            button.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    });
}

function updatePlaceholders() {
    const inputs = document.querySelectorAll('#optionsContainer input[name="options[]"]');
    inputs.forEach((input, index) => {
        input.placeholder = `Option ${index + 1}`;
    });
}

// Form Submission
document.getElementById('createPollForm').addEventListener('submit', function(e) {
    // Basic client-side validation before submitting
    const title = document.getElementById('pollTitle').value.trim();
    const questionText = document.getElementById('questionText').value.trim();
    const options = Array.from(document.querySelectorAll('input[name="options[]"]'))
        .map(input => input.value.trim())
        .filter(value => value !== '');
    
    if (!title) {
        alert('Please enter a poll title.');
        e.preventDefault();
        return;
    }
    
    if (!questionText) {
        alert('Please enter a question.');
        e.preventDefault();
        return;
    }
    
    if (options.length < 2) {
        alert('Please provide at least 2 options.');
        e.preventDefault();
        return;
    }
    
    // Check for duplicate options
    const uniqueOptions = [...new Set(options)];
    if (uniqueOptions.length !== options.length) {
        alert('Please ensure all options are unique.');
        e.preventDefault();
        return;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const submitText = submitBtn.querySelector('.submit-text');
    const loadingText = submitBtn.querySelector('.loading-text');
    
    submitText.classList.add('hidden');
    loadingText.classList.remove('hidden');
    submitBtn.disabled = true;
    
    // Form will submit normally to Laravel backend
});

// Close modal when clicking outside
document.getElementById('createPollModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreatePollModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('createPollModal').classList.contains('hidden')) {
        closeCreatePollModal();
    }
});

// Check URL parameters on page load
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');
    if (tab === 'pending' || tab === 'all') {
        showTab(tab);
    }
    updateRemoveButtons();
});
</script>
