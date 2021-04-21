<?php

namespace App\Http\Controllers\Client;

use App\Dal\Entities\Feed;
use App\Http\Controllers\Client\Base\ClientControllerBase;
use Illuminate\Support\Facades\DB;


class JsonController extends ClientControllerBase
{
    public function index()
    {
        $feed = Feed::with(['feedStories', 'feedImages'])->orderBy('sort_order')->get();


        foreach ($feed as $item)
        {
            unset($item['id']);
            unset($item['sort_order']);
            unset($item['created_at']);
            unset($item['updated_at']);
            $item->icon_image = url('/') .'/images/' .  $item->icon_image;
            foreach ($item->feedImages as $story) {
                $story->image = url('/') .'/images/' .  $story->image;
                unset($story['id']);
                unset($story['sort_order']);
                unset($story['story_id']);
                unset($story['created_at']);
                unset($story['updated_at']);
            }
            foreach ($item->feedStories as $info) {
                unset($info['id']);
                unset($info['story_id']);
                unset($info['created_at']);
                unset($info['updated_at']);
            }
        }

        $data = json_encode($feed, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $filename = "data.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $data);
        fclose($handle);
        $headers = array('Content-type'=> 'application/json');
        return response()->download($filename,'data.json',$headers);

    }
}
