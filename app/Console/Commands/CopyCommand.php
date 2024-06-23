<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Feed;
use App\Models\InstagramSource;
use App\Models\TiktokSource;
use App\Models\Post;

class CopyCommand extends Command
{
    
    protected $signature = 'copy {feedId?} {--only=} {--include-posts=} {--af} {--h}';
    protected $description = 'So it should copy the feed you want will all the associated data or just the source';

    public function handle()
    {
        $feedId = $this->argument('feedId');
        $only = $this->option('only');
        $includePosts = $this->option('include-posts');
        $showAllFeedIDs = $this->option('af');
        $helpCommand = $this->option('h');

        if ($helpCommand){
            $this->giveHelp();
            return Command::SUCCESS;
        }

        if ($showAllFeedIDs){
            $this->giveAllFeedIDs();
            return Command::SUCCESS;
        }

        if ($feedId === '' || $feedId === Null) {
            $this->error("Please add the Feed ID that you want to be copied");
        }

        $feed = Feed::find($feedId);
        if (!$feed) {
            $this->error("Feed ID $feedId does not exist or its not in db. feeds begin from and including 120 so maybe check ID?");
        }

        // here i like to start with checking the includePosts arg because if there aren't that many we have to stop
        if ($includePosts) {
            if($this->checkPosts($includePosts, $feedId) === True){
                // now that we have checked that we have enough posts we can continue
                $newFeed = Feed::create(['name' => $feed->name]);
                $this->copySources($only, $feedId, $newFeed->id);
                $this->copyPosts($feedId, $newFeed->id, $includePosts);
                $this->info("Copied | $includePosts | posts of Feed ID | $feedId | with new ID of | $newFeed->id |");
            }
            return Command::SUCCESS;
        }elseif($only){
                // if there was a source arg included than we proceed
                $newFeed = Feed::create(['name' => $feed->name]);
                $this->copySources($only, $feedId, $newFeed->id);
                return Command::SUCCESS;
        }else {
                $newFeed = Feed::create(['name' => $feed->name]);
                $this->copySources($only, $feedId, $newFeed->id);
                return Command::SUCCESS;
                
        }

        return Command::FAILURE;
    }

    private function giveAllFeedIDs(){
        $allFeedIDs = Feed::all('id');
        return $this->info($allFeedIDs);
    }

    private function checkPosts($limit, $feedId){
        $query = Post::where('feed_id', $feedId);
        if ($limit > $query->count()){
            $this->info("There are not that many Posts for Feed ID | $feedId |");
            return false;
            exit();
        }else{
            return true;
        }
    }

    private function copySources($only, $feedId, $newFeedId ){
        if ($only === 'instagram') {
            $this->copyInstagram($feedId, $newFeedId);
            $this->info("Feed with the ID of | $feedId | copied to a new feed with ID of | $newFeedId | with only Instagram source copied");
        }elseif ($only === 'tiktok'){
            $this->copyTiktok($feedId, $newFeedId);
            $this->info("Feed with the ID of | $feedId | copied to a new feed with ID of | $newFeedId| with only Ticktok source copied");
        }else {
            $this->copyInstagram($feedId, $newFeedId);
            $this->copyTiktok($feedId, $newFeedId);
            $this->info("Feed with the ID of | $feedId | copied to a new feed with ID of | $newFeedId | with all sources");
        }
    }

    private function copyInstagram($oldFeedId, $newFeedId)
    {
        $source = InstagramSource::where('feed_id', $oldFeedId)->first();
        if ($source) {
            InstagramSource::create([
                'feed_id' => $newFeedId,
                'name' => $source->name,
                'fan_count' => $source->fan_count,
            ]);
        }
    }

    private function copyTiktok($oldFeedId, $newFeedId)
    {
        $source = TiktokSource::where('feed_id', $oldFeedId)->first();
        if ($source) {
            TiktokSource::create([
                'feed_id' => $newFeedId,
                'name' => $source->name,
                'fan_count' => $source->fan_count,
            ]);
        }
    }

    private function copyPosts($oldFeedId, $newFeedId, $limit = null)
    {
        $query = Post::where('feed_id', $oldFeedId);

        if ($limit) {
            $query->limit($limit);
        }
        $posts = $query->get();
        /* if ($limit > $query->count()){
            return FALSE;
            exit();
        } */

        foreach ($posts as $post) {
            Post::create([
                'feed_id' => $newFeedId,
                'url' => $post->url,
            ]);
        }
    }

    protected function giveHelp()
    {
        $this->info('Usage:');
        $this->info('  copy {feedId} {--only=} {--include-posts=} {--af} {--h}');
        $this->info('Options:');
        $this->info('  --only: to specify only which source to be copied like instagram or tiktok');
        $this->info('  --include-posts: you can set how many posts to be copied');
        $this->info('Arguments:');
        $this->info('  feedId: This is the id of the feed you want to copy which starts from and including 120, cannot be empty or null!');
        $this->info('  --af  : It displays all the feed IDs, you can check if your ID is in db');
        $this->info('  --h   : It shows this help command :)');
    }
        
}
