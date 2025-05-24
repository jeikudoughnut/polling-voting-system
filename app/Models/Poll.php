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
        'creator_user_id',
        'status',
        'end_date'
    ];

    protected $casts = [
        'creation_date' => 'datetime',
        'end_date' => 'datetime'
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

    // Accessor for formatted creation date
    public function getFormattedCreationDateAttribute()
    {
        return $this->creation_date ? $this->creation_date->format('M d, Y h:i A') : '';
    }

    // Accessor for formatted end date
    public function getFormattedEndDateAttribute()
    {
        return $this->end_date ? $this->end_date->format('M d, Y h:i A') : 'No expiration';
    }

    // Check if poll is active
    public function getIsActiveAttribute()
    {
        return $this->status === 'active' && (!$this->end_date || $this->end_date > now());
    }

    // Check if poll is expired
    public function getIsExpiredAttribute()
    {
        return $this->end_date && $this->end_date < now();
    }

    // Scope for active polls
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where(function($q) {
                        $q->whereNull('end_date')
                          ->orWhere('end_date', '>', now());
                    });
    }

    // Scope for pending polls
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for closed polls
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }
}
