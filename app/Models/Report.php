<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'report_date',
        'report_type',
        'report_data'
    ];

    protected $casts = [
        'report_date' => 'date',
        'report_data' => 'array'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
