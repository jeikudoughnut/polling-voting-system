<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poll;
use App\Models\PollQuestion;
use App\Models\PollOption;
use App\Models\User;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get or create an admin user
        $admin = User::where('user_type', 'admin')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'user_type' => 'admin',
            ]);
        }

        // Create sample polls
        $polls = [
            [
                'title' => 'Favorite Programming Language',
                'description' => 'What is your favorite programming language for web development?',
                'question' => 'Which programming language do you prefer for web development?',
                'options' => ['PHP', 'JavaScript', 'Python', 'Java', 'C#'],
                'status' => 'active',
            ],
            [
                'title' => 'Best Time for Team Meetings',
                'description' => 'Help us decide the best time for our weekly team meetings.',
                'question' => 'What time works best for you for weekly team meetings?',
                'options' => ['9:00 AM', '10:00 AM', '2:00 PM', '3:00 PM', '4:00 PM'],
                'status' => 'active',
            ],
            [
                'title' => 'Office Lunch Preference',
                'description' => 'Vote for your preferred lunch option for the office cafeteria.',
                'question' => 'What type of food would you like to see more of in our cafeteria?',
                'options' => ['Italian', 'Asian', 'Mexican', 'American', 'Vegetarian'],
                'status' => 'active',
            ],
            [
                'title' => 'Remote Work Policy',
                'description' => 'Share your thoughts on our remote work policy.',
                'question' => 'How many days per week would you prefer to work remotely?',
                'options' => ['0 days (Full office)', '1-2 days', '3 days', '4 days', '5 days (Full remote)'],
                'status' => 'pending',
            ],
        ];

        foreach ($polls as $pollData) {
            $poll = Poll::create([
                'poll_title' => $pollData['title'],
                'poll_description' => $pollData['description'],
                'creation_date' => now(),
                'creator_user_id' => $admin->id,
                'status' => $pollData['status'],
                'end_date' => now()->addDays(30), // 30 days from now
            ]);

            $question = PollQuestion::create([
                'poll_id' => $poll->id,
                'question_text' => $pollData['question'],
                'question_type' => 'single_choice',
            ]);

            foreach ($pollData['options'] as $optionText) {
                PollOption::create([
                    'question_id' => $question->id,
                    'option_text' => $optionText,
                ]);
            }
        }
    }
}
