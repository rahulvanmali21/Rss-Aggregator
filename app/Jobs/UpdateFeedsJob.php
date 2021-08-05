<?php

namespace App\Jobs;

use App\Models\FeedItems;
use App\Models\RssFeed;
use DOMDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use stdClass;

class UpdateFeedsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $rssFeed;
    public function __construct(RssFeed $rssFeed)
    {
        $this->rssFeed = $rssFeed;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $xml = new DOMDocument();
        $xml->load($this->rssFeed->url);
        $channel = $xml->getElementsByTagName('channel')->item(0);
        $title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
        $description = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
        $hash = Hash::make($xml->saveXML());
        if (!!$this->rssFeed->hash && $this->rssFeed->hash == $hash) return;

        //update feed
        $this->rssFeed->title = $title;
        $this->rssFeed->description = $description;
        $this->rssFeed->hash = $hash;
        $this->rssFeed->save();
        $items = $xml->getElementsByTagName('item');
        $xml = null;
        $data = [];
        for ($i = 0; $i < count($items) / 2; $i++) {
            $item = [];
            foreach($items->item($i)->getElementsByTagName('*') as $tags){
                $item[$tags->tagName]=$tags->textContent;
                
            }            
            // $item->title = $items->item($i)->getElementsByTagName('title')
            //     ->item(0)->childNodes->item(0)->nodeValue;
            // $item->link = $items->item($i)->getElementsByTagName('link')
            //     ->item(0)->childNodes->item(0)->nodeValue;
            // $item->description = $items->item($i)->getElementsByTagName('description')
            //     ->item(0)->childNodes->item(0)->nodeValue;
            $data[] = ["content" => json_encode($item),"rss_feed_id"=>$this->rssFeed->id];
          
        }

        FeedItems::upsert(
            $data
        , ["rss_feed_id"], ['content']);
       
    }
}
