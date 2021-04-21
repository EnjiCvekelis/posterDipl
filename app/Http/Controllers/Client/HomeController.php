<?php

namespace App\Http\Controllers\Client;

use App\Core\Services\Infrastructure\IMailService;
use App\Dal\Entities\Meta;
use App\Dal\Entities\Feed;
use App\Http\Controllers\Client\Base\ClientControllerBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeController extends ClientControllerBase
{
    public function index(Request $request)
    {
        $feed = Feed::orderBy('sort_order')->get();
        $feed = Feed::with(['feedStories', 'feedImages'])->orderBy('sort_order')->get();
//        dd($domains);
        return $this->view("client.home.index", [
            'domains' => $feed,
        ]);
//        DB::statement()
    }
}
