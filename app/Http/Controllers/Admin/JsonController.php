<?php

namespace App\Http\Controllers\Admin;

use App\Core\Services\Infrastructure\IImageService;
use App\Core\Traits\GridWithSimpleSearch;
use App\Dal\Entities\Admin\SubCategoryAdmin;
use App\Dal\Entities\Goods;
use App\Dal\Entities\CategorySubcategory;
use App\Dal\Entities\SubCategory;
use App\Dal\Entities\SubCategoryLocale;
use App\Dal\Entities\Locale;
use Illuminate\Http\Request;
use App\Http\Controllers\BkControllerBase;

class JsonController extends BkControllerBase
{

    public function jsonFirst()
    {
        $json = Goods::with(['locale' => function ($q) {
//            $q->where('language', '=', 'en');
        }, 'subcategory'])->get();

        foreach ($json as $item)
        {
            unset($item['id']);
            unset($item['sort_order']);
            unset($item['created_at']);
            unset($item['updated_at']);
            foreach ($item->locale as $lang) {
                unset($lang['id']);
                unset($lang['created_at']);
                unset($lang['updated_at']);
                unset($lang['pivot']);
            }
            foreach ($item->subcategory as $subcat) {
                unset($subcat['id']);
                unset($subcat['created_at']);
                unset($subcat['updated_at']);
                unset($subcat['pivot']);
                unset($subcat['sort_order']);
                if (isset($subcat->icon)) {
                    $subcat->icon = url('/') .'/images/' .  $subcat->icon;
                }
//                foreach ($subcat->track as $song) {
//                    unset($song['id']);
//                    unset($song['created_at']);
//                    unset($song['updated_at']);
//                    unset($song['pivot']);
//                    unset($item['sort_order']);
//                    $song->track = url('/') . '/' .  $song->track;
//                    $song->cover = url('/') . '/images/' . $song->cover;
//                }
            }
        }

        $data = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $filename = "test.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $data);
        fclose($handle);
        $headers = array('Content-type'=> 'application/json');
        return response()->download($filename,'test.json',$headers);
    }

    public function jsonSecond()
    {
        $json = Goods::with(['locale'=> function ($q) {
            $q->where('language', '=', 'ru');
        }, 'subcategory.track'])->get();

        foreach ($json as $item)
        {
            unset($item['id']);
            unset($item['sort_order']);
            unset($item['created_at']);
            unset($item['updated_at']);
            foreach ($item->locale as $lang) {
                unset($lang['id']);
                unset($lang['created_at']);
                unset($lang['updated_at']);
                unset($lang['pivot']);
            }
            foreach ($item->subcategory as $subcat) {
                unset($subcat['id']);
                unset($subcat['created_at']);
                unset($subcat['updated_at']);
                unset($subcat['pivot']);
                unset($item['sort_order']);
                if (isset($subcat->icon)) {
                    $subcat->icon = url('/') .'/images/' .  $subcat->icon;
                }
                foreach ($subcat->track as $song) {
                    unset($song['id']);
                    unset($song['created_at']);
                    unset($song['updated_at']);
                    unset($song['pivot']);
                    unset($item['sort_order']);
                    $song->track = url('/') . '/' .  $song->track;
                    $song->cover = url('/') . '/images/' . $song->cover;
                }
            }
        }

        $data = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $filename = "test.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $data);
        fclose($handle);
        $headers = array('Content-type'=> 'application/json');
        return response()->download($filename,'test.json',$headers);
    }

    public function categories(Request $request) {
        $lang = $request->lang;
        $json = Goods::whereHas('locale', function ($query) use ($lang) {
            return $query->where('language', '=', $lang);
        })->with('subcategory')->get();

        foreach ($json as $item)
        {
            unset($item['id']);
            unset($item['locale']);
            unset($item['sort_order']);
            unset($item['created_at']);
            unset($item['updated_at']);
            unset($item['locale']);
            foreach ($item->locale as $lang) {
                unset($lang['id']);
                unset($lang['created_at']);
                unset($lang['updated_at']);
                unset($lang['pivot']);
            }
            foreach ($item->subcategory as $subcat) {
                unset($subcat['created_at']);
                unset($subcat['updated_at']);
                unset($subcat['pivot']);
                unset($subcat['sort_order']);
                if (isset($subcat->icon)) {
                    $subcat->icon = url('/') .'/images/' .  $subcat->icon;
                }
            }
        }

        $data = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $filename = "goods.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $data);
        fclose($handle);
        $headers = array('Content-type'=> 'application/json');
        return response()->download($filename,'goods.json',$headers);
    }

    public function tracks(Request $request) {
        $selected = $request->id;
        $json = SubCategory::whereHas('track', function ($query) use ($selected) {
            return $query->where('subcategory_id', '=', $selected);
        })->with('track')->get();

        foreach ($json as $item)
        {
            unset($item['id']);
            unset($item['locale']);
            unset($item['sort_order']);
            unset($item['created_at']);
            unset($item['updated_at']);
            unset($item['name']);
            unset($item['icon']);
            foreach ($item->track as $song) {
                unset($song['id']);
                unset($song['created_at']);
                unset($song['updated_at']);
                unset($song['pivot']);
                unset($song['sort_order']);
                $song->track = url('/') . '/' .  $song->track;
                $song->cover = url('/') . '/images/' . $song->cover;
            }
        }

        $data = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $filename = "goods.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $data);
        fclose($handle);
        $headers = array('Content-type'=> 'application/json');
        return response()->download($filename,'goods.json',$headers);
    }
}
