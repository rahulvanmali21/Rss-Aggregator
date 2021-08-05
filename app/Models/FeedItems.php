<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedItems extends Model
{
    use HasFactory;
    protected $casts = [
        'content'         => 'json',
    ];
}
