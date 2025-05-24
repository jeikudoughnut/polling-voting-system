<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollQuestion;
use App\Models\PollOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PollController extends Controller
{
    /**
     * Display a listing of polls
     */
    public function index(Request $request)
    {
        $query = Poll::with(['questions.options', 'creator'])
            ->orderBy('creation_date', 'desc');
            
        // Filter by status if specified
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $polls = $query->paginate(10);
        
        return view('pages.admin.polls.index', compact('polls'));
    }

    /**
     * Show the form for creating a new poll
     */
    public function create()
    {
        return view('pages.admin.polls.create');
    }

    /**
     * Store a newly created poll in storage
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'poll_title' => 'required|string|max:255',
            'poll_description' => 'nullable|string|max:1000',
            'question_text' => 'required|string|max:500',
            'options' => 'required|array|min:2|max:10',
            'options.*' => 'required|string|max:255|distinct',
            'allow_multiple' => 'nullable|boolean',
            'status' => ['required', Rule::in(['pending', 'active', 'closed'])],
            'end_date' => 'nullable|date|after:now',
        ], [
            'poll_title.required' => 'Poll title is required.',
            'poll_title.max' => 'Poll title must not exceed 255 characters.',
            'poll_description.max' => 'Poll description must not exceed 1000 characters.',
            'question_text.required' => 'Question text is required.',
            'question_text.max' => 'Question must not exceed 500 characters.',
            'options.required' => 'At least 2 options are required.',
            'options.min' => 'At least 2 options are required.',
            'options.max' => 'Maximum 10 options allowed.',
            'options.*.required' => 'All options must have text.',
            'options.*.max' => 'Each option must not exceed 255 characters.',
            'options.*.distinct' => 'All options must be unique.',
            'status.required' => 'Poll status is required.',
            'status.in' => 'Invalid poll status.',
            'end_date.after' => 'End date must be in the future.',
        ]);

        try {
            DB::beginTransaction();

            // Create the poll
            $poll = Poll::create([
                'poll_title' => $validated['poll_title'],
                'poll_description' => $validated['poll_description'],
                'creation_date' => now(),
                'creator_user_id' => Auth::id(),
                'status' => $validated['status'],
                'end_date' => $validated['end_date'] ?? null,
            ]);

            // Create the question
            $question = PollQuestion::create([
                'poll_id' => $poll->id,
                'question_text' => $validated['question_text'],
                'question_type' => isset($validated['allow_multiple']) && $validated['allow_multiple'] ? 'multiple_choice' : 'single_choice',
            ]);

            // Create the options
            foreach ($validated['options'] as $optionText) {
                PollOption::create([
                    'question_id' => $question->id,
                    'option_text' => trim($optionText),
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.polls.index')
                ->with('success', 'Poll created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create poll. Please try again.');
        }
    }

    /**
     * Display the specified poll
     */
    public function show(Poll $poll)
    {
        $poll->load(['questions.options', 'creator', 'votes']);
        
        return view('pages.admin.polls.show', compact('poll'));
    }

    /**
     * Show the form for editing the specified poll
     */
    public function edit(Poll $poll)
    {
        $poll->load(['questions.options']);
        
        return view('pages.admin.polls.edit', compact('poll'));
    }

    /**
     * Update the specified poll in storage
     */
    public function update(Request $request, Poll $poll)
    {
        $validated = $request->validate([
            'poll_title' => 'required|string|max:255',
            'poll_description' => 'nullable|string|max:1000',
            'status' => ['required', Rule::in(['pending', 'active', 'closed'])],
            'end_date' => 'nullable|date',
        ]);

        try {
            $poll->update($validated);
            
            return redirect()
                ->route('admin.polls.index')
                ->with('success', 'Poll updated successfully!');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update poll. Please try again.');
        }
    }

    /**
     * Remove the specified poll from storage
     */
    public function destroy(Poll $poll)
    {
        try {
            // Check if poll has votes
            if ($poll->votes()->count() > 0) {
                return redirect()
                    ->back()
                    ->with('error', 'Cannot delete poll that has votes.');
            }

            DB::beginTransaction();
            
            // Delete poll options
            foreach ($poll->questions as $question) {
                $question->options()->delete();
            }
            
            // Delete poll questions
            $poll->questions()->delete();
            
            // Delete the poll
            $poll->delete();
            
            DB::commit();
            
            return redirect()
                ->route('admin.polls.index')
                ->with('success', 'Poll deleted successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->with('error', 'Failed to delete poll. Please try again.');
        }
    }

    /**
     * Update poll status
     */
    public function updateStatus(Request $request, Poll $poll)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'active', 'closed'])],
        ]);

        try {
            $poll->update(['status' => $validated['status']]);
            
            $statusText = ucfirst($validated['status']);
            
            return redirect()
                ->back()
                ->with('success', "Poll status updated to {$statusText}!");
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to update poll status. Please try again.');
        }
    }

    /**
     * Get polls by status for AJAX requests
     */
    public function getPollsByStatus(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = Poll::with(['questions.options', 'creator'])
            ->orderBy('creation_date', 'desc');
            
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $polls = $query->get();
        
        return response()->json([
            'success' => true,
            'polls' => $polls,
        ]);
    }
} 