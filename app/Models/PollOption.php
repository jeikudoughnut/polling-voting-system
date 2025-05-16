<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PollOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'option_text'
    ];

    public function question()
    {
        return $this->belongsTo(PollQuestion::class, 'question_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'option_id');
    }
}
