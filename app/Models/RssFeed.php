<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RssFeed extends Model
{
    protected $table ="rss_feeds";
    protected $fillable =["url"];
    use HasFactory;
    public function items()
    {
        return $this->hasMany(FeedItems::class);
    }
}
