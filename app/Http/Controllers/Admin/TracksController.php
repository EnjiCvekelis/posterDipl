<?php

namespace App\Http\Controllers\Admin;

use App\Core\Services\Infrastructure\IImageService;
use App\Core\Traits\GridWithSimpleSearch;
use App\Dal\Entities\Admin\SubCategoryAdmin;
use App\Dal\Entities\Admin\TrackAdmin;
use App\Dal\Entities\Goods;
use App\Dal\Entities\CategorySubcategory;
use App\Dal\Entities\SubCategory;
use App\Dal\Entities\SubCategoryLocale;
use App\Dal\Entities\Locale;
use App\Dal\Entities\SubcategoryTrack;
use Illuminate\Http\Request;
use App\Http\Controllers\BkControllerBase;

class TracksController extends BkControllerBase
{
    use GridWithSimpleSearch;

    public function __construct(IImageService $imageService)
    {
        $this->_imageService = $imageService;
    }

    public function index(Request $request)
    {
        $gridItems = $this->getGrid($request, TrackAdmin::class);

        return view(
            'admin.tracks.index',
            [
                'gridItems' => $gridItems,
                'query' => $gridItems->searchQuery,
            ]
        );
    }

    public function add(Request $request)
    {
        $returnToListUrl = routeWithQuery('admin.tracks');

        if ($this->isPost()) {
            $this->validateAddForm($request);
            $entity = new TrackAdmin($request->all());
            if(isset($request->cover)) {
                $image = $request->file('cover');
                if ($image->getClientMimeType() == "image/svg+xml" ) {
                    $name = str_random(10).'.'.$request->file('cover')->getClientOriginalExtension();
                    $path = \Storage::disk('public')->putFileAs(
                        'images/covers', $request->cover, $name);
                    $destinationPath = 'covers/'.$name;
                    $entity->cover = $destinationPath;
                } else {
                    $entity->cover = $this->_imageService->upload($request->cover, 'icons');
                }
            }

            $track = $request->file('track');
            if (isset($track)) {
                if ($track->getClientMimeType() == "audio/mpeg") {
                    $name = str_replace(" ", '', strtolower(trim($request->name))) . '.' . $request->file('track')->getClientOriginalExtension();
                    $path = \Storage::disk('public')->putFileAs(
                        'tracks', $request->track, $name);
                    $destinationPath = 'tracks/' . $name;
                    $entity->track = $destinationPath;
                }
            }
            $ffprobe = \FFMpeg\FFProbe::create([
                'ffmpeg.binaries' => '/usr/local/bin/ffmpeg',
                'ffprobe.binaries' => '/usr/local/bin/ffprobe'
            ]);
            $durationMp3 = $ffprobe->format($destinationPath)->get('duration');

            $entity->length = gmdate("H:i:s", $durationMp3);
            $entity->save();

            $selectedSubCategories = $request->parent;
            foreach ($selectedSubCategories as $selected) {
                $selected_subcategory = new SubcategoryTrack($request->all());
                $selected_subcategory->track_id = $entity->id;
                $selected_subcategory->subcategory_id = $selected;
                $selected_subcategory->save();
            }

            if (isset($entity->sort_order)) {
                $swap = TrackAdmin::select(['sort_order', 'id'])->where('id', '!=', $entity->id)->get();

                foreach ($swap as $key => $item) {
                    if ($request->sort_order <= $item->sort_order ) {
                        TrackAdmin::where('id', $item->id)->update(['sort_order' => $item->sort_order + 1]);
                    }
                }
            }

            return redirect(
                routeWithQuery(
                    'admin.tracks.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );

        } else {
            $entity = new TrackAdmin();
        }

        $subcategories = SubCategory::all();
        $subcategoriesArr = array();
        foreach ($subcategories as $subcategory) {
            $item = (object)['id' => $subcategory->id, 'name' => $subcategory->name];
            $subcategoriesArr[] = $item;
        }

        return view(
            'admin.tracks.form',
            [
                'entity' => $entity,
                'returnToListUrl' => $returnToListUrl,
                'goods' => $subcategoriesArr,
//                'selectedCategory' => '0',
                'selectedIds' => [],
            ]
        );
    }

    public function edit(Request $request, $id)
    {
        $returnToListUrl = routeWithQuery('admin.tracks', [], ['success']);

        if ($this->isPost()) {

            $this->validateEditForm($request);

            $entity = TrackAdmin::findOrFail($id);
            $currentPos = $entity->sort_order;
            $entity->fill($request->all());
            $oldTrack = $entity->track;
            $old = $entity->cover;
            $track = $request->file('track');
            if (isset($track)) {
                if ($track->getClientMimeType() == "audio/mpeg") {
                    $newName = str_replace(" ", '', strtolower(trim($request->name))) . '.' . $request->file('track')->getClientOriginalExtension();
                    unlink(public_path() . DIRECTORY_SEPARATOR . $oldTrack);
                    $path = \Storage::disk('public')->putFileAs(
                        'tracks', $request->track, $newName);
                    $newDestinationPath = 'tracks/' . $newName;
                    $entity->track = $newDestinationPath;
                }
                $ffprobe = \FFMpeg\FFProbe::create([
                    'ffmpeg.binaries' => '/usr/local/bin/ffmpeg',
                    'ffprobe.binaries' => '/usr/local/bin/ffprobe'
                ]);
                $durationMp3 = $ffprobe->format($newDestinationPath)->get('duration');

                $entity->length = gmdate("H:i:s", $durationMp3);
            }

            if ($request->cover) {
                $image = $request->file('cover');
                if ($image->getClientMimeType() == "image/svg+xml" ) {
                    $newName = str_random(10).'.'.$request->file('cover')->getClientOriginalExtension();
                    if (isset($old)) {
                        unlink(public_path('images'). DIRECTORY_SEPARATOR . $old);
                    }
                    $path = \Storage::disk('public')->putFileAs(
                        'images/covers', $request->cover, $newName);
                    $newDestinationPath = 'covers/'.$newName;
                    $entity->cover = $newDestinationPath;

                } else {
                    $newImage = $this->_imageService->upload($request->cover, 'covers');
                    $this->_imageService->delete($entity->cover);
                    $entity->cover = $newImage;
                }
            }

            $entity->save();

            SubcategoryTrack::where('track_id', '=', $id)->delete();
            $selectedSubCategories = $request->parent;
            foreach ($selectedSubCategories as $selected) {
                $selected_subcategory = new SubcategoryTrack($request->all());
                $selected_subcategory->track_id = $entity->id;
                $selected_subcategory->subcategory_id = $selected;
                $selected_subcategory->save();
            }


            $swap = TrackAdmin::select(['sort_order', 'id'])->where('id', '!=', $id)->get();

            foreach ($swap as $key => $item) {
                if ($request->sort_order <= $item->sort_order && $request->sort_order != $currentPos) {
                    TrackAdmin::where('id', $item->id)->update(['sort_order' => $item->sort_order + 1]);
                }
            }


            return redirect(
                routeWithQuery(
                    'admin.tracks.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );
        }

        $entity = TrackAdmin::findOrFail($id);
        $subcategories = SubCategory::all();
        $subcategoriesArr = array();
        foreach ($subcategories as $subcategory) {
            $item = (object)['id' => $subcategory->id, 'name' => $subcategory->name];
            $subcategoriesArr[] = $item;
        }


        $selectedSubCategory = SubcategoryTrack::where('track_id', '=', $id)->select('subcategory_id')->first();

        $selectedSubcategoryTrack = SubcategoryTrack::where('track_id', '=', $id)->select('subcategory_id')->get();
        $selectedIds = array();
        foreach ($selectedSubcategoryTrack as $singleId) {
            array_push($selectedIds, $singleId->subcategory_id);
        }

        return view(
            'admin.tracks.form',
            [
                'entity' => $entity,
                'success' => $request->success,
                'returnToListUrl' => $returnToListUrl,
                'goods' => $subcategoriesArr,
                'selectedCategory' => $selectedSubCategory->subcategory_id,
                'selectedIds' => $selectedIds,
            ]
        );
    }

    public function delete($id)
    {
        $entity = TrackAdmin::findOrFail($id);
        SubcategoryTrack::where('track_id', '=', $id)->delete();
        $entity->delete();

        return redirect()->back();
    }

    private function validateAddForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'bail|required',
                'description' => 'bail|required',
//                'length' => 'bail|required',
                'track' => 'bail|required',
                'cover' => 'bail|required',
            ],
            [],
            [
                'name' => 'Name',
                'description' => 'Description',
//                'length' => 'Length',
                'track' => 'Track',
                'cover' => 'Cover',
            ]
        );
    }

    private function validateEditForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'bail|required',
            ],
            [],
            [
                'name' => 'Name',
            ]
        );
    }


}
