<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_title',
        'poll_description',
        'creation_date',
        'creator_user_id'
    ];

    protected $casts = [
        'creation_date' => 'datetime'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    public function questions()
    {
        return $this->hasMany(PollQuestion::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
