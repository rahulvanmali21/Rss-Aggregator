<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRssFeedRequest;
use App\Jobs\UpdateFeedsJob;
use App\Models\RssFeed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    //
    public function home()
    {
        $rssFeed = RssFeed::all();
        return view("feeds.index", compact("rssFeed"));
    }
    public function create(Request $request)
    {
        return view("feeds.create");
    }
    public function store(StoreRssFeedRequest $request)
    {
        try {
            $rss_feed = RssFeed::firstOrCreate(["url" => $request->rss_url]);
            UpdateFeedsJob::dispatch($rss_feed)->onQueue("feed_update");
            return redirect()->back()->with('message', 'Rss url Added');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->withErrors(["rss_url" => "Something went wrong"]);
        }
    }

    public function show(Request $request ,RssFeed $rssFeed)
    {
        $rssFeed = $rssFeed->load("items");
        return view("feeds.show",compact("rssFeed"));
    }
}
