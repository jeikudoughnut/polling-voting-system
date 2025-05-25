<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Poll;
use App\Models\PollQuestion;
use App\Models\PollOption;
use App\Models\Vote;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
        ]);

        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'user',
        ]);

        $user3 = User::create([
            'name' => 'Bob Wilson',
            'email' => 'user3@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'user',
        ]);

        // Create polls
        $poll1 = Poll::create([
            'poll_title' => 'Favorite Programming Language',
            'poll_description' => 'What is your favorite programming language for web development?',
            'creation_date' => now()->subDays(10),
            'creator_user_id' => $admin->id,
            'status' => 'closed',
            'end_date' => now()->subDays(2),
        ]);

        $poll2 = Poll::create([
            'poll_title' => 'Best Color Scheme',
            'poll_description' => 'Which color scheme do you prefer for web applications?',
            'creation_date' => now()->subDays(5),
            'creator_user_id' => $user1->id,
            'status' => 'active',
            'end_date' => now()->addDays(5),
        ]);

        $poll3 = Poll::create([
            'poll_title' => 'Favorite Food',
            'poll_description' => 'What type of cuisine do you enjoy most?',
            'creation_date' => now()->subDays(15),
            'creator_user_id' => $admin->id,
            'status' => 'closed',
            'end_date' => now()->subDays(5),
        ]);

        // Create questions for poll 1
        $question1 = PollQuestion::create([
            'poll_id' => $poll1->id,
            'question_text' => 'What is your favorite programming language for web development?',
            'question_type' => 'single_choice',
        ]);

        // Create options for question 1
        $option1_1 = PollOption::create([
            'question_id' => $question1->id,
            'option_text' => 'JavaScript',
        ]);

        $option1_2 = PollOption::create([
            'question_id' => $question1->id,
            'option_text' => 'Python',
        ]);

        $option1_3 = PollOption::create([
            'question_id' => $question1->id,
            'option_text' => 'PHP',
        ]);

        $option1_4 = PollOption::create([
            'question_id' => $question1->id,
            'option_text' => 'Java',
        ]);

        // Create questions for poll 2
        $question2 = PollQuestion::create([
            'poll_id' => $poll2->id,
            'question_text' => 'Which color scheme do you prefer?',
            'question_type' => 'single_choice',
        ]);

        // Create options for question 2
        $option2_1 = PollOption::create([
            'question_id' => $question2->id,
            'option_text' => 'Dark Theme',
        ]);

        $option2_2 = PollOption::create([
            'question_id' => $question2->id,
            'option_text' => 'Light Theme',
        ]);

        $option2_3 = PollOption::create([
            'question_id' => $question2->id,
            'option_text' => 'Auto (System)',
        ]);

        // Create questions for poll 3
        $question3 = PollQuestion::create([
            'poll_id' => $poll3->id,
            'question_text' => 'What type of cuisine do you enjoy most?',
            'question_type' => 'single_choice',
        ]);

        // Create options for question 3
        $option3_1 = PollOption::create([
            'question_id' => $question3->id,
            'option_text' => 'Italian',
        ]);

        $option3_2 = PollOption::create([
            'question_id' => $question3->id,
            'option_text' => 'Chinese',
        ]);

        $option3_3 = PollOption::create([
            'question_id' => $question3->id,
            'option_text' => 'Mexican',
        ]);

        $option3_4 = PollOption::create([
            'question_id' => $question3->id,
            'option_text' => 'Indian',
        ]);

        // Create votes for poll 1 (Programming Languages)
        Vote::create([
            'user_id' => $user1->id,
            'poll_id' => $poll1->id,
            'question_id' => $question1->id,
            'option_id' => $option1_1->id, // JavaScript
            'vote_date' => now()->subDays(8),
        ]);

        Vote::create([
            'user_id' => $user2->id,
            'poll_id' => $poll1->id,
            'question_id' => $question1->id,
            'option_id' => $option1_2->id, // Python
            'vote_date' => now()->subDays(7),
        ]);

        Vote::create([
            'user_id' => $user3->id,
            'poll_id' => $poll1->id,
            'question_id' => $question1->id,
            'option_id' => $option1_1->id, // JavaScript
            'vote_date' => now()->subDays(6),
        ]);

        // Create votes for poll 2 (Color Schemes)
        Vote::create([
            'user_id' => $user2->id,
            'poll_id' => $poll2->id,
            'question_id' => $question2->id,
            'option_id' => $option2_1->id, // Dark Theme
            'vote_date' => now()->subDays(3),
        ]);

        Vote::create([
            'user_id' => $user3->id,
            'poll_id' => $poll2->id,
            'question_id' => $question2->id,
            'option_id' => $option2_1->id, // Dark Theme
            'vote_date' => now()->subDays(2),
        ]);

        // Create votes for poll 3 (Food)
        Vote::create([
            'user_id' => $user1->id,
            'poll_id' => $poll3->id,
            'question_id' => $question3->id,
            'option_id' => $option3_1->id, // Italian
            'vote_date' => now()->subDays(12),
        ]);

        Vote::create([
            'user_id' => $user2->id,
            'poll_id' => $poll3->id,
            'question_id' => $question3->id,
            'option_id' => $option3_2->id, // Chinese
            'vote_date' => now()->subDays(11),
        ]);

        Vote::create([
            'user_id' => $user3->id,
            'poll_id' => $poll3->id,
            'question_id' => $question3->id,
            'option_id' => $option3_1->id, // Italian
            'vote_date' => now()->subDays(10),
        ]);
    }
}
