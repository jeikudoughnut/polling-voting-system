<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollQuestion;
use App\Models\PollOption;
use App\Models\Vote;
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

    /**
     * User-specific methods
     */

    /**
     * Display polls for regular users
     */
    public function userIndex(Request $request)
    {
        $polls = Poll::active()
            ->with(['questions.options', 'creator'])
            ->orderBy('creation_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'polls' => $polls->map(function ($poll) {
                return [
                    'id' => $poll->id,
                    'title' => $poll->poll_title,
                    'description' => $poll->poll_description,
                    'status' => $poll->status,
                    'end_date' => $poll->end_date,
                    'formatted_end_date' => $poll->formatted_end_date,
                    'creator' => $poll->creator->name ?? 'Unknown',
                    'questions' => $poll->questions->map(function ($question) {
                        return [
                            'id' => $question->id,
                            'text' => $question->question_text,
                            'type' => $question->question_type,
                            'options' => $question->options->map(function ($option) {
                                return [
                                    'id' => $option->id,
                                    'text' => $option->option_text,
                                ];
                            }),
                        ];
                    }),
                    'user_voted' => $poll->votes()->where('user_id', Auth::id())->exists(),
                ];
            }),
        ]);
    }

    /**
     * Show poll details for users
     */
    public function userShow(Poll $poll)
    {
        $poll->load(['questions.options', 'creator']);
        
        // Check if user has already voted
        $userVoted = $poll->votes()->where('user_id', Auth::id())->exists();
        
        return response()->json([
            'success' => true,
            'poll' => [
                'id' => $poll->id,
                'title' => $poll->poll_title,
                'description' => $poll->poll_description,
                'status' => $poll->status,
                'end_date' => $poll->end_date,
                'formatted_end_date' => $poll->formatted_end_date,
                'creator' => $poll->creator->name ?? 'Unknown',
                'questions' => $poll->questions->map(function ($question) {
                    return [
                        'id' => $question->id,
                        'text' => $question->question_text,
                        'type' => $question->question_type,
                        'options' => $question->options->map(function ($option) {
                            return [
                                'id' => $option->id,
                                'text' => $option->option_text,
                            ];
                        }),
                    ];
                }),
                'user_voted' => $userVoted,
            ],
        ]);
    }

    /**
     * Handle user voting
     */
    public function vote(Request $request, Poll $poll)
    {
        // Check if poll is active
        if ($poll->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'This poll is not active.',
            ], 400);
        }

        // Check if poll has expired
        if ($poll->end_date && $poll->end_date < now()) {
            return response()->json([
                'success' => false,
                'message' => 'This poll has expired.',
            ], 400);
        }

        // Check if user has already voted
        if ($poll->votes()->where('user_id', Auth::id())->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'You have already voted on this poll.',
            ], 400);
        }

        $validated = $request->validate([
            'question_id' => 'required|exists:poll_questions,id',
            'option_ids' => 'required|array|min:1',
            'option_ids.*' => 'required|exists:poll_options,id',
        ]);

        try {
            DB::beginTransaction();

            $question = PollQuestion::findOrFail($validated['question_id']);
            
            // Validate that question belongs to this poll
            if ($question->poll_id !== $poll->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid question for this poll.',
                ], 400);
            }

            // Check if multiple options are allowed
            if ($question->question_type === 'single_choice' && count($validated['option_ids']) > 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only one option can be selected for this question.',
                ], 400);
            }

            // Create votes
            foreach ($validated['option_ids'] as $optionId) {
                $option = PollOption::findOrFail($optionId);
                
                // Validate that option belongs to this question
                if ($option->question_id !== $question->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid option for this question.',
                    ], 400);
                }

                Vote::create([
                    'user_id' => Auth::id(),
                    'poll_id' => $poll->id,
                    'question_id' => $question->id,
                    'option_id' => $option->id,
                    'vote_date' => now(),
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vote submitted successfully!',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit vote. Please try again.',
            ], 500);
        }
    }

    /**
     * Get user's voting history
     */
    public function myVotes()
    {
        $votes = Vote::where('user_id', Auth::id())
            ->with(['poll', 'question', 'option'])
            ->orderBy('vote_date', 'desc')
            ->get()
            ->groupBy('poll_id');

        $pollsVoted = [];
        foreach ($votes as $pollId => $pollVotes) {
            $poll = $pollVotes->first()->poll;
            $pollsVoted[] = [
                'id' => $poll->id,
                'title' => $poll->poll_title,
                'status' => $poll->status,
                'vote_date' => $pollVotes->first()->vote_date->format('M d, Y h:i A'),
                'votes_count' => $pollVotes->count(),
            ];
        }

        return response()->json([
            'success' => true,
            'polls' => $pollsVoted,
        ]);
    }

    /**
     * Get user's created polls
     */
    public function myPolls()
    {
        $polls = Poll::where('creator_user_id', Auth::id())
            ->with(['questions.options', 'votes'])
            ->orderBy('creation_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'polls' => $polls->map(function ($poll) {
                return [
                    'id' => $poll->id,
                    'title' => $poll->poll_title,
                    'status' => $poll->status,
                    'creation_date' => $poll->formatted_creation_date,
                    'votes_count' => $poll->votes->count(),
                    'end_date' => $poll->formatted_end_date,
                ];
            }),
        ]);
    }

    /**
     * Store poll created by user
     */
    public function userStore(Request $request)
    {
        $validated = $request->validate([
            'poll_title' => 'required|string|max:255',
            'poll_description' => 'nullable|string|max:1000',
            'question_text' => 'required|string|max:500',
            'options' => 'required|array|min:2|max:10',
            'options.*' => 'required|string|max:255|distinct',
            'allow_multiple' => 'nullable|boolean',
            'end_date' => 'nullable|date|after:now',
        ]);

        try {
            DB::beginTransaction();

            // Create the poll (users create polls with pending status)
            $poll = Poll::create([
                'poll_title' => $validated['poll_title'],
                'poll_description' => $validated['poll_description'],
                'creation_date' => now(),
                'creator_user_id' => Auth::id(),
                'status' => 'pending', // User polls start as pending
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

            return response()->json([
                'success' => true,
                'message' => 'Poll created successfully! It will be reviewed by administrators.',
                'poll_id' => $poll->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create poll. Please try again.',
            ], 500);
        }
    }

    /**
     * Get dashboard data for admin
     */
    public function adminDashboard()
    {
        // Get poll statistics
        $totalPolls = Poll::count();
        $pendingPolls = Poll::where('status', 'pending')->count();
        $activePolls = Poll::where('status', 'active')->count();
        $closedPolls = Poll::where('status', 'closed')->count();
        
        // Get total votes
        $totalVotes = Vote::count();
        
        // Get poll activity by month (last 6 months)
        $pollActivity = Poll::selectRaw('MONTH(creation_date) as month, YEAR(creation_date) as year, status, COUNT(*) as count')
            ->where('creation_date', '>=', now()->subMonths(6))
            ->groupBy('year', 'month', 'status')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        // Get trending polls (top 5 by vote count)
        $trendingPolls = Poll::withCount('votes')
            ->orderBy('votes_count', 'desc')
            ->limit(5)
            ->get();
        
        return response()->json([
            'totalPolls' => $totalPolls,
            'pendingPolls' => $pendingPolls,
            'activePolls' => $activePolls,
            'closedPolls' => $closedPolls,
            'totalVotes' => $totalVotes,
            'pollActivity' => $pollActivity,
            'trendingPolls' => $trendingPolls,
        ]);
    }

    /**
     * Get dashboard data for users
     */
    public function userDashboard()
    {
        $userId = Auth::id();
        
        // Get user-specific statistics
        $totalPolls = Poll::where('status', 'active')->count();
        $userVotes = Vote::where('user_id', $userId)->count();
        $userCreatedPolls = Poll::where('creator_user_id', $userId)->count();
        
        // Get trending polls (top 5 by vote count)
        $trendingPolls = Poll::where('status', 'active')
            ->withCount('votes')
            ->orderBy('votes_count', 'desc')
            ->limit(5)
            ->get();
        
        // Get user's recent activity
        $recentVotes = Vote::where('user_id', $userId)
            ->with(['poll', 'option'])
            ->orderBy('vote_date', 'desc')
            ->limit(5)
            ->get();
        
        return response()->json([
            'totalPolls' => $totalPolls,
            'userVotes' => $userVotes,
            'userCreatedPolls' => $userCreatedPolls,
            'trendingPolls' => $trendingPolls,
            'recentVotes' => $recentVotes,
        ]);
    }
} 