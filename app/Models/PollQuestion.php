<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PollQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'question_text',
        'question_type',
        'allow_custom_answers'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function options()
    {
        return $this->hasMany(PollOption::class, 'question_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'question_id');
    }
}
