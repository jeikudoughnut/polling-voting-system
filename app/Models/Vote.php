<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'poll_id',
        'question_id',
        'option_id',
        'vote_response'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function question()
    {
        return $this->belongsTo(PollQuestion::class);
    }

    public function option()
    {
        return $this->belongsTo(PollOption::class);
    }
}
