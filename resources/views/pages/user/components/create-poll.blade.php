<div class="w-full min-h-screen pt-8 pb-12 px-6">
    <div class="w-full">
        <h1 class="text-5xl font-extrabold text-gray-800 dark:text-dark-100 mb-6 text-center tracking-tight drop-shadow-sm transition-colors duration-300">
            Create Poll
        </h1>

        <!-- Success/Error Messages -->
        <div id="messageContainer" class="max-w-4xl mx-auto mb-6 hidden">
            <div id="messageAlert" class="px-4 py-3 rounded-xl relative transition-colors duration-300" role="alert">
                <strong class="font-bold" id="messageType"></strong>
                <span class="block sm:inline" id="messageText"></span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="hideMessage()">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white/95 dark:bg-dark-800/95 rounded-2xl shadow-2xl border border-gray-100 dark:border-dark-700 p-8 relative overflow-hidden transition-colors duration-300">
                <!-- Decorative Circles -->
                <div class="absolute -top-8 -left-8 w-32 h-32 bg-blue-100 dark:bg-blue-900/30 rounded-full opacity-20 blur-2xl"></div>
                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-yellow-100 dark:bg-yellow-900/30 rounded-full opacity-20 blur-2xl"></div>
                
                <form id="createPollForm" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <!-- Poll Title -->
                    <div class="mb-8">
                        <label for="pollTitle" class="block text-xl md:text-2xl font-bold text-gray-800 dark:text-dark-100 mb-3 transition-colors duration-300">
                            Poll Title *
                        </label>
                        <input type="text" 
                               id="pollTitle" 
                               name="poll_title" 
                               required
                               class="w-full px-5 py-3 rounded-lg border-2 border-gray-200 dark:border-dark-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg bg-gray-50 dark:bg-dark-700 placeholder-gray-400 dark:placeholder-dark-400 text-gray-900 dark:text-dark-100 transition-all duration-300"
                               placeholder="Enter your poll question">
                        <div class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" id="pollTitleError"></div>
                    </div>

                    <!-- Poll Description -->
                    <div class="mb-8">
                        <label for="pollDescription" class="block text-xl md:text-2xl font-bold text-gray-800 dark:text-dark-100 mb-3 transition-colors duration-300">
                            Description (Optional)
                        </label>
                        <textarea id="pollDescription" 
                                  name="poll_description" 
                                  rows="3"
                                  class="w-full px-5 py-3 rounded-lg border-2 border-gray-200 dark:border-dark-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg bg-gray-50 dark:bg-dark-700 placeholder-gray-400 dark:placeholder-dark-400 text-gray-900 dark:text-dark-100 transition-all duration-300 resize-none"
                                  placeholder="Provide additional details about your poll"></textarea>
                        <div class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" id="pollDescriptionError"></div>
                    </div>

                    <!-- Question Text -->
                    <div class="mb-8">
                        <label for="questionText" class="block text-xl md:text-2xl font-bold text-gray-800 dark:text-dark-100 mb-3 transition-colors duration-300">
                            Question *
                        </label>
                        <input type="text" 
                               id="questionText" 
                               name="question_text" 
                               required
                               class="w-full px-5 py-3 rounded-lg border-2 border-gray-200 dark:border-dark-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg bg-gray-50 dark:bg-dark-700 placeholder-gray-400 dark:placeholder-dark-400 text-gray-900 dark:text-dark-100 transition-all duration-300"
                               placeholder="What question do you want to ask?">
                        <div class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" id="questionTextError"></div>
                    </div>

                    <!-- Options -->
                    <div class="mb-8">
                        <label class="block text-xl md:text-2xl font-bold text-gray-800 dark:text-dark-100 mb-3 transition-colors duration-300">
                            Answer Options *
                        </label>
                        <div id="optionsContainer">
                            <!-- Initial options -->
                            <div class="option-group mb-3 flex items-center gap-3">
                                <input type="text" 
                                       name="options[]" 
                                       required
                                       class="flex-1 px-5 py-3 rounded-lg border-2 border-gray-200 dark:border-dark-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg bg-gray-50 dark:bg-dark-700 placeholder-gray-400 dark:placeholder-dark-400 text-gray-900 dark:text-dark-100 transition-all duration-300"
                                       placeholder="Option 1">
                                <button type="button" 
                                        onclick="removeOption(this)" 
                                        class="px-3 py-3 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors opacity-50 cursor-not-allowed"
                                        disabled>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="option-group mb-3 flex items-center gap-3">
                                <input type="text" 
                                       name="options[]" 
                                       required
                                       class="flex-1 px-5 py-3 rounded-lg border-2 border-gray-200 dark:border-dark-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg bg-gray-50 dark:bg-dark-700 placeholder-gray-400 dark:placeholder-dark-400 text-gray-900 dark:text-dark-100 transition-all duration-300"
                                       placeholder="Option 2">
                                <button type="button" 
                                        onclick="removeOption(this)" 
                                        class="px-3 py-3 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors opacity-50 cursor-not-allowed"
                                        disabled>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Add Option Button -->
                        <div class="flex items-center gap-2 mt-3">
                            <button type="button" 
                                    onclick="addOption()" 
                                    class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-900/50 font-medium transition-colors">
                                <i class="fas fa-plus mr-2"></i> Add option
                            </button>
                            <span class="text-gray-500 dark:text-dark-400 text-sm transition-colors duration-300">Minimum 2 options required, maximum 10</span>
                        </div>
                        <div class="text-red-500 dark:text-red-400 text-sm mt-1 hidden" id="optionsError"></div>
                    </div>

                    <hr class="my-8 border-gray-200 dark:border-dark-600 transition-colors duration-300">

                    <!-- Settings -->
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Left: Settings -->
                        <div class="flex-1">
                            <h2 class="text-lg md:text-xl font-bold text-gray-800 dark:text-dark-100 mb-6 transition-colors duration-300">Poll Settings</h2>
                            
                            <!-- Multiple Choice -->
                            <div class="flex items-center justify-between mb-6 p-4 bg-gray-50 dark:bg-dark-700 rounded-lg transition-colors duration-300">
                                <div>
                                    <span class="text-gray-800 dark:text-dark-100 text-base font-medium transition-colors duration-300">Allow multiple selections</span>
                                    <p class="text-gray-600 dark:text-dark-300 text-sm transition-colors duration-300">Let voters choose more than one option</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="allow_multiple" value="1" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 dark:bg-dark-600 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-500 peer-checked:bg-blue-600 transition-all"></div>
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md peer-checked:translate-x-5 transition-all"></div>
                                </label>
                            </div>

                            <!-- Allow Custom Answers -->
                            <div class="flex items-center justify-between mb-6 p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <span class="text-gray-800 text-base font-medium">Allow custom answers</span>
                                    <p class="text-gray-600 text-sm">Let voters provide their own answer option</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="allow_custom_answers" value="1" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-purple-500 peer-checked:bg-purple-600 transition-all"></div>
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md peer-checked:translate-x-5 transition-all"></div>
                                </label>
                            </div>

                            <!-- Schedule Close -->
                            <div class="flex items-center justify-between mb-4 p-4 bg-gray-50 dark:bg-dark-700 rounded-lg transition-colors duration-300">
                                <div>
                                    <span class="text-gray-800 dark:text-dark-100 text-base font-medium transition-colors duration-300">Schedule poll closure</span>
                                    <p class="text-gray-600 dark:text-dark-300 text-sm transition-colors duration-300">Set when this poll should automatically close</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" id="scheduleToggle">
                                    <div class="w-11 h-6 bg-gray-200 dark:bg-dark-600 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-500 peer-checked:bg-blue-600 transition-all"></div>
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md peer-checked:translate-x-5 transition-all"></div>
                                </label>
                            </div>
                            
                            <!-- Date/Time Input -->
                            <div class="ml-4 mb-6 hidden" id="datetimeContainer">
                                <label for="endDate" class="block text-gray-700 dark:text-dark-200 font-medium mb-2 transition-colors duration-300">End Date & Time</label>
                                <input type="datetime-local" 
                                       id="endDate" 
                                       name="end_date"
                                       class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-dark-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base bg-gray-50 dark:bg-dark-700 text-gray-900 dark:text-dark-100 transition-all duration-300">
                                <p class="text-gray-500 dark:text-dark-400 text-sm mt-1 transition-colors duration-300">Leave empty for no expiration</p>
                            </div>
                        </div>

                        <!-- Vertical Divider -->
                        <div class="hidden md:flex items-stretch mx-4">
                            <div class="border-l border-gray-200 dark:border-dark-600 transition-colors duration-300"></div>
                        </div>

                        <!-- Right: Status Info and Create button -->
                        <div class="flex-1 flex flex-col justify-between">
                            <!-- Status Information -->
                            <div class="mb-8">
                                <h3 class="text-lg font-bold text-gray-800 dark:text-dark-100 mb-4 transition-colors duration-300">Poll Status</h3>
                                <div class="p-4 bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-600 rounded-lg transition-colors duration-300">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-clock text-yellow-600 dark:text-yellow-400 mr-2"></i>
                                        <span class="font-medium text-yellow-800 dark:text-yellow-300 transition-colors duration-300">Pending Approval</span>
                                    </div>
                                    <p class="text-yellow-700 dark:text-yellow-300 text-sm transition-colors duration-300">
                                        Your poll will be submitted for admin review. Once approved, it will become active and users can vote on it.
                                    </p>
                                </div>
                            </div>

                            <!-- Create Button -->
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:from-blue-700 hover:to-indigo-700 font-semibold transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                                <span class="submit-text">
                                    <i class="fas fa-plus mr-2"></i> Create Poll
                                </span>
                                <span class="loading-text hidden">
                                    <i class="fas fa-spinner fa-spin mr-2"></i> Creating...
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Global variables
let optionCount = 2;

document.addEventListener('DOMContentLoaded', function() {
    const scheduleToggle = document.getElementById('scheduleToggle');
    const datetimeContainer = document.getElementById('datetimeContainer');
    const form = document.getElementById('createPollForm');

    // Schedule toggle functionality
    scheduleToggle.addEventListener('change', function() {
        if (this.checked) {
            datetimeContainer.classList.remove('hidden');
        } else {
            datetimeContainer.classList.add('hidden');
            document.getElementById('endDate').value = '';
        }
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            submitForm();
        }
    });

    updateRemoveButtons();
});

// Message handling functions
function showMessage(type, message) {
    const container = document.getElementById('messageContainer');
    const alert = document.getElementById('messageAlert');
    const messageType = document.getElementById('messageType');
    const messageText = document.getElementById('messageText');
    
    messageType.textContent = type === 'success' ? 'Success!' : 'Error!';
    messageText.textContent = message;
    
    if (type === 'success') {
        alert.className = 'bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl relative transition-colors duration-300';
    } else {
        alert.className = 'bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl relative transition-colors duration-300';
    }
    
    container.classList.remove('hidden');
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        hideMessage();
    }, 5000);
    
    // Scroll to top to show message
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function hideMessage() {
    document.getElementById('messageContainer').classList.add('hidden');
}

// Option management functions
function addOption() {
    if (optionCount >= 10) {
        showMessage('error', 'Maximum 10 options allowed.');
        return;
    }

    optionCount++;
    const container = document.getElementById('optionsContainer');
    const newOption = document.createElement('div');
    newOption.className = 'option-group mb-3 flex items-center gap-3';
    newOption.innerHTML = `
        <input type="text" 
               name="options[]" 
               required
               class="flex-1 px-5 py-3 rounded-lg border-2 border-gray-200 dark:border-dark-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg bg-gray-50 dark:bg-dark-700 placeholder-gray-400 dark:placeholder-dark-400 text-gray-900 dark:text-dark-100 transition-all duration-300"
               placeholder="Option ${optionCount}">
        <button type="button" 
                onclick="removeOption(this)" 
                class="px-3 py-3 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(newOption);
    updateRemoveButtons();
    updatePlaceholders();
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

// Form validation
function validateForm() {
    clearErrors();
    let isValid = true;

    // Validate poll title
    const pollTitle = document.getElementById('pollTitle').value.trim();
    if (!pollTitle) {
        showFieldError('pollTitleError', 'Poll title is required.');
        isValid = false;
    } else if (pollTitle.length > 255) {
        showFieldError('pollTitleError', 'Poll title must not exceed 255 characters.');
        isValid = false;
    }

    // Validate question text
    const questionText = document.getElementById('questionText').value.trim();
    if (!questionText) {
        showFieldError('questionTextError', 'Question text is required.');
        isValid = false;
    } else if (questionText.length > 500) {
        showFieldError('questionTextError', 'Question must not exceed 500 characters.');
        isValid = false;
    }

    // Validate poll description
    const pollDescription = document.getElementById('pollDescription').value.trim();
    if (pollDescription.length > 1000) {
        showFieldError('pollDescriptionError', 'Poll description must not exceed 1000 characters.');
        isValid = false;
    }

    // Validate options
    const options = Array.from(document.querySelectorAll('input[name="options[]"]'))
        .map(input => input.value.trim())
        .filter(value => value !== '');

    if (options.length < 2) {
        showFieldError('optionsError', 'At least 2 options are required.');
        isValid = false;
    } else if (options.length > 10) {
        showFieldError('optionsError', 'Maximum 10 options allowed.');
        isValid = false;
    } else {
        // Check for duplicate options
        const uniqueOptions = [...new Set(options)];
        if (uniqueOptions.length !== options.length) {
            showFieldError('optionsError', 'All options must be unique.');
            isValid = false;
        }

        // Check option length
        for (let option of options) {
            if (option.length > 255) {
                showFieldError('optionsError', 'Each option must not exceed 255 characters.');
                isValid = false;
                break;
            }
        }
    }

    // Validate end date if scheduled
    const scheduleToggle = document.getElementById('scheduleToggle');
    const endDate = document.getElementById('endDate').value;
    if (scheduleToggle.checked && endDate) {
        const selectedDate = new Date(endDate);
        const now = new Date();
        if (selectedDate <= now) {
            showFieldError('optionsError', 'End date must be in the future.');
            isValid = false;
        }
    }

    return isValid;
}

function showFieldError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = message;
    errorElement.classList.remove('hidden');
}

function clearErrors() {
    const errorElements = document.querySelectorAll('[id$="Error"]');
    errorElements.forEach(element => {
        element.textContent = '';
        element.classList.add('hidden');
    });
}

// Form submission
async function submitForm() {
    const form = document.getElementById('createPollForm');
    const formData = new FormData();
    
    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const submitText = submitBtn.querySelector('.submit-text');
    const loadingText = submitBtn.querySelector('.loading-text');
    
    submitText.classList.add('hidden');
    loadingText.classList.remove('hidden');
    submitBtn.disabled = true;

    try {
        // Collect form data
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('poll_title', document.getElementById('pollTitle').value.trim());
        formData.append('poll_description', document.getElementById('pollDescription').value.trim());
        formData.append('question_text', document.getElementById('questionText').value.trim());
        
        // Collect options
        const options = Array.from(document.querySelectorAll('input[name="options[]"]'))
            .map(input => input.value.trim())
            .filter(value => value !== '');
        
        options.forEach(option => {
            formData.append('options[]', option);
        });

        // Add settings
        const allowMultiple = document.querySelector('input[name="allow_multiple"]').checked;
        if (allowMultiple) {
            formData.append('allow_multiple', '1');
        }

        const allowCustomAnswers = document.querySelector('input[name="allow_custom_answers"]').checked;
        if (allowCustomAnswers) {
            formData.append('allow_custom_answers', '1');
        }

        const scheduleToggle = document.getElementById('scheduleToggle');
        const endDate = document.getElementById('endDate').value;
        if (scheduleToggle.checked && endDate) {
            formData.append('end_date', endDate);
        }

        // Submit form
        const response = await fetch('/user/polls', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            showMessage('success', data.message);
            resetForm();
        } else {
            showMessage('error', data.message || 'Failed to create poll. Please try again.');
        }

    } catch (error) {
        console.error('Error submitting form:', error);
        showMessage('error', 'Failed to create poll. Please check your connection and try again.');
    } finally {
        // Reset button state
        submitText.classList.remove('hidden');
        loadingText.classList.add('hidden');
        submitBtn.disabled = false;
    }
}

// Reset form
function resetForm() {
    const form = document.getElementById('createPollForm');
    form.reset();
    
    // Reset options to initial 2
    optionCount = 2;
    const container = document.getElementById('optionsContainer');
    container.innerHTML = `
        <div class="option-group mb-3 flex items-center gap-3">
            <input type="text" 
                   name="options[]" 
                   required
                   class="flex-1 px-5 py-3 rounded-lg border-2 border-gray-200 dark:border-dark-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg bg-gray-50 dark:bg-dark-700 placeholder-gray-400 dark:placeholder-dark-400 text-gray-900 dark:text-dark-100 transition-all duration-300"
                   placeholder="Option 1">
            <button type="button" 
                    onclick="removeOption(this)" 
                    class="px-3 py-3 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors opacity-50 cursor-not-allowed"
                    disabled>
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="option-group mb-3 flex items-center gap-3">
            <input type="text" 
                   name="options[]" 
                   required
                   class="flex-1 px-5 py-3 rounded-lg border-2 border-gray-200 dark:border-dark-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg bg-gray-50 dark:bg-dark-700 placeholder-gray-400 dark:placeholder-dark-400 text-gray-900 dark:text-dark-100 transition-all duration-300"
                   placeholder="Option 2">
            <button type="button" 
                    onclick="removeOption(this)" 
                    class="px-3 py-3 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors opacity-50 cursor-not-allowed"
                    disabled>
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    
    // Hide datetime container
    document.getElementById('datetimeContainer').classList.add('hidden');
    
    // Clear errors
    clearErrors();
    
    updateRemoveButtons();
}
</script>
